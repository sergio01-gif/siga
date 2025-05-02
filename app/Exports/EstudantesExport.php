<?php

namespace App\Exports;

use App\Models\Estudante;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EstudantesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Retorna os dados a serem exportados.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Estudante::all();  // Aqui você pode adicionar filtros ou relacionamentos se necessário
    }

    /**
     * Retorna os cabeçalhos das colunas no Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Telefone',
            'Data de Nascimento',
            'Curso',
        ];
    }

    /**
     * Mapeia os dados para o formato das células no Excel.
     *
     * @param \App\Models\Estudante $estudante
     * @return array
     */
    public function map($estudante): array
    {
        return [
            $estudante->nome,
            $estudante->email,
            $estudante->telefone,
            \Carbon\Carbon::parse($estudante->data_nascimento)->format('d/m/Y'),
            $estudante->curso->nome ?? 'Sem Curso',
        ];
    }
}
