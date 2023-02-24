<?php

namespace App\Http\Controllers;

use App\Traits\TableToJson;
use App\Traits\JsonTableValidator;
use App\Traits\JsonToTable;
use App\Exports\OrdersExport;
use App\Exports\ProductsExport;
use App\Exports\UsersExport;
use App\Exports\CategoriesExport;
use App\Imports\OrdersImport;
use App\Imports\ProductsImport;
use App\Imports\UsersImport;
use App\Imports\CategoriesImport;
use App\Http\Controllers\AppBaseController;
use App\Http\Requests\ExportDataRequest;
use App\Http\Requests\ImportDataRequest;
use App\Enums\FileTypes;
use App\Enums\Tables;
use Illuminate\Support\Facades\Storage;
use Flash;
use Excel;

class DataExportImportController extends AppBaseController
{
    use TableToJson, JsonTableValidator, JsonToTable;

    private function selector($enum): array
    {
        $arr = [];

        foreach ($enum::cases() as $case) {
            $arr[$case->value] = $case->name;
        }

        return $arr;
    }

    private function exportToCsv($table)
    {
        $result = match ($table) {
            Tables::Orders->value => Excel::download(new OrdersExport(), "$table.csv"),
            Tables::Products->value => Excel::download(new ProductsExport(), "$table.csv"),
            Tables::Users->value => Excel::download(new UsersExport(), "$table.csv"),
            Tables::Categories->value => Excel::download(new CategoriesExport(), "$table.csv")
        };

        return $result;
    }

    private function exportToJson($table)
    {
        match ($table) {
            Tables::Orders->value => $this->ordersToJson(),
            Tables::Products->value => $this->productsToJson(),
            Tables::Users->value => $this->usersToJson(),
            Tables::Categories->value => $this->categoriesToJson(),
        };

        if (Storage::disk('public')->missing("$table.json")) {
            return back()->with('error', __('messages.exportFileNotExist'));
        }

        return Storage::disk('public')->download("$table.json");
    }

    private function importFromCsv($table, $file_name, $file)
    {
        match ($table) {
            Tables::Orders->value => Excel::import(new OrdersImport(), $file),
            Tables::Products->value => Excel::import(new ProductsImport(), $file),
            Tables::Users->value => Excel::import(new UsersImport(), $file),
            Tables::Categories->value => Excel::import(new CategoriesImport(), $file),
        };

        return back()->with('success', __('messages.successFileImport'));
    }

    private function getJsonData($file_name, $file)
    {
        Storage::putFileAs('public', $file, $file_name);

        if (Storage::disk('public')->exists($file_name)) {
            $data = Storage::disk('public')->get($file_name);
            $data = json_decode($data, true);

            return $data;
        }
    }

    private function importFromJson($table, $file_name, $file)
    {
        $data = $this->getJsonData($file_name, $file);

        switch ($table) {
            case Tables::Orders->value:
                $validator = $this->ordersValidator($data);
                return $this->ordersToTable($validator, $data);
                break;
            case Tables::Products->value:
                $validator = $this->productsValidator($data);
                return $this->productsToTable($validator, $data);
                break;
            case Tables::Users->value:
                $validator = $this->usersValidator($data);
                return $this->usersToTable($validator, $data);
                break;
            case Tables::Categories->value:
                $validator = $this->categoriesValidator($data);
                return $this->categoriesToTable($validator, $data);
                break;
        }
    }

    public function index()
    {
        $tables = $this->selector(Tables::class);
        $file_types = $this->selector(FileTypes::class);

        return view('data_export_import.index')
            ->with(['tables' => $tables, 'file_types' => $file_types]);
    }

    public function export(ExportDataRequest $request)
    {
        $table = $request->table;
        $file_type = $request->file_type;

        if ($file_type == FileTypes::CSV->value) {
            return $this->exportToCsv($table);
        }
        else if ($file_type == FileTypes::JSON->value) {
            return $this->exportToJson($table);
        }
        else {
            return back()->with('error', __('messages.errorFileTypeIdentity'));
        }
    }

    public function import(ImportDataRequest $request)
    {
        $table = $request->table;
        $file_name = $request->file->getClientOriginalName();
        $file = $request->file('file');

        if ($file->getClientMimeType() == 'text/csv') {
            return $this->importFromCsv($table, $file_name, $file);
        }
        else if ($file->getClientMimeType() == 'application/json') {
            return $this->importFromJson($table, $file_name, $file);
        }
        else {
            return back()->with('error', __('messages.errorFileTypeIdentity'));
        }
    }
}
