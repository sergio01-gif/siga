<?php

namespace App\Exports;

use App\Models\Professor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfessoresExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Professor::select('nome', 'email', 'telefone', 'especialidade', 'tipo_contratacao')->get();
    }

    public function headings(): array
    {
        return ['Nome', 'Email', 'Telefone', 'Especialidade', 'Tipo de Contratação'];
    }
}

