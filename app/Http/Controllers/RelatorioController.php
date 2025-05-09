<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Despesa;
use Illuminate\Http\Request;
use PDF;

class RelatorioController extends Controller
{
    // Relatório de Receitas
    public function receitas()
    {
        $receitas = Receita::all();
        return view('relatorios.receitas', compact('receitas'));
    }

    // Relatório de Despesas
    public function despesas()
    {
        $despesas = Despesa::all();
        return view('relatorios.despesas', compact('despesas'));
    }

    // Relatório Geral (Receitas + Despesas)
    public function geral()
    {
        $receitas = Receita::all();
        $despesas = Despesa::all();
        return view('relatorios.geral', compact('receitas', 'despesas'));
    }

    // Gerar PDF de Relatório de Receitas
    public function gerarPdfReceitas()
    {
        $receitas = Receita::all();
        $pdf = PDF::loadView('relatorios.pdf_receitas', compact('receitas'));
        return $pdf->download('relatorio_receitas.pdf');
    }

    // Gerar PDF de Relatório de Despesas
    public function gerarPdfDespesas()
    {
        $despesas = Despesa::all();
        $pdf = PDF::loadView('relatorios.pdf_despesas', compact('despesas'));
        return $pdf->download('relatorio_despesas.pdf');
    }

    // Gerar PDF de Relatório Geral
    public function gerarPdfGeral()
    {
        $receitas = Receita::all();
        $despesas = Despesa::all();
        $pdf = PDF::loadView('relatorios.pdf_geral', compact('receitas', 'despesas'));
        return $pdf->download('relatorio_geral.pdf');
    }

    public function index()
{
    return view('relatorios.index'); // ajuste conforme sua estrutura de views
}

}
