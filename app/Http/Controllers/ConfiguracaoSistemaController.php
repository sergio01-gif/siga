<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracaoSistema;
use App\Models\AnoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracaoSistemaController extends Controller
{
    public function index()
    {
        $config = ConfiguracaoSistema::first();
        $anos = AnoAcademico::all();
        return view('configuracoes.index', compact('config', 'anos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_instituicao' => 'required',
            'moeda' => 'required',
            'idioma' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $config = ConfiguracaoSistema::first();
        if ($config) {
            $config->update($data);
        } else {
            ConfiguracaoSistema::create($data);
        }

        return redirect()->back()->with('success', 'Configurações atualizadas com sucesso.');
    }
}
