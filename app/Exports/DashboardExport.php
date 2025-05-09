<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DashboardExport implements FromView
{
    protected $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function view(): View
    {
        return view('admin.exports.dashboard', [
            'dados' => $this->dados
        ]);
    }
}
