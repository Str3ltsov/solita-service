<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Models\ReturnItem;
use App\Models\Returns;
use App\Mail\ReturnsReport;
use App\Exports\ReturnsReportExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Flash;
use DB;
use PDF;
use Excel;

class ReturnsReportController extends AppBaseController
{
    private function getReturns()
    {
        $returns = QueryBuilder::for(Returns::class)
            ->allowedFilters([
                AllowedFilter::exact('id'), 
                AllowedFilter::exact('order_id'), 
                'user.name',
                'admin.name',
                'code', 
                'status.name', 
                AllowedFilter::scope('date_from'), 
                AllowedFilter::scope('date_to'), 
                'description'
            ])
            ->allowedIncludes(['user', 'status'])
            ->orderBy('id')
            ->paginate(10)
            ->map(function($return) {
                $return->total = DB::select("SELECT SUM(price_current) AS total_price_current,
                                            SUM(count) AS total_count, 
                                            SUM(price_current * count) AS total_price
                                            FROM return_items
                                            WHERE return_id = '$return->id'");

                return $return;
            });

            return $returns;
    }

    private function getReturnItems()
    {
        $returnItems = ReturnItem::all()
            ->map(function($returnItem) {
                $returnItem->subtotal = $returnItem->price_current * $returnItem->count;

                return $returnItem;
            });
        
        return $returnItems;
    }

    public function index()
    {    
        $returns = $this->getReturns();
        $returnItems = $this->getReturnItems();

        return view('returns_report.index')
            ->with(['returns' => $returns, 'returnItems' => $returnItems]);
    }

    public function sendEmail() 
    {
        $returns = $this->getReturns();
        $returnItems = $this->getReturnItems();
        $email = Auth::user()->email;
        
        Mail::to($email)->send(new ReturnsReport($returns, $returnItems, $email));

        Flash::success('Email has been sent.');

        return view('returns_report.index')
            ->with(['returns' => $returns, 'returnItems' => $returnItems]);
    }

    public function downloadPdf(Request $request) 
    {
        $data = [
            'returns' => $this->getReturns(),
            'returnItems' => $this->getReturnItems()
        ];

        $pdf = PDF::loadView('returns_report.report', $data);

        return $pdf->download('returns_report.pdf');
    }

    public function downloadCsv()
    {
        $returns = $this->getReturns();
        $returnItems = $this->getReturnItems();

        return Excel::download(new ReturnsReportExport($returns, $returnItems), 'returns_report.csv');
    }
}
