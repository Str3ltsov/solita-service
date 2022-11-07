<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Returns;
use App\Models\ReturnItem;


class ReturnsReportExport implements FromView
{
    private $returns;
    private $returnItems;

    public function __construct($returns, $returnItems)
    {
        $this->returns = $returns;
        $this->returnItems = $returnItems;
    }

    public function view(): View
    {
        return view('returns_report.report', [
            'returns' => $this->returns,
            'returnItems' => $this->returnItems
        ]);
    }
}
