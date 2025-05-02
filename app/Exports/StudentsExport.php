<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $curso_id;
    protected $ano_lectivo;

    public function __construct($curso_id, $ano_lectivo)
    {
        $this->curso_id = $curso_id;
        $this->ano_lectivo = $ano_lectivo;
    }

    public function collection()
    {
        $query = Student::query();

        if ($this->curso_id) {
            $query = $query->where('curso_id', $this->curso_id);
        }

        if ($this->ano_lectivo) {
            $query = $query->where('ano_lectivo', $this->ano_lectivo);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Nome',
            'Email',
            'Telefone',
            'Data de Nascimento',
            'Genero',
            'Morada',
            'Numero Estudante',
            'Curso ID',
            'Ano Letivo',
            'Estado',
        ];
    }
}
