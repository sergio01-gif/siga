<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Matricula;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    // Exibir matrículas
    public function index(Request $request)
    {
        $matriculas = Matricula::with(['student', 'course'])->get();
        return view('admin.matriculas.index', compact('matriculas'));
    }

    // Exibir formulário para adicionar nova matrícula
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('admin.matriculas.create', compact('students', 'courses'));
    }

    // Salvar nova matrícula
    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'ano_lectivo' => 'required|string|max:10',
            'data_matricula' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        Matricula::create($request->all());

        return redirect()->route('admin.matriculas.index')->with('success', 'Matrícula realizada com sucesso!');
    }

    // Exibir formulário de edição de matrícula
    public function edit($id)
    {
        $matricula = Matricula::findOrFail($id);
        $students = Student::all();
        $courses = Course::all();
        return view('admin.matriculas.edit', compact('matricula', 'students', 'courses'));
    }

    // Atualizar matrícula
    public function update(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'ano_lectivo' => 'required|string|max:10',
            'data_matricula' => 'required|date',
            'estado' => 'required|string|max:20',
        ]);

        $matricula = Matricula::findOrFail($id);
        $matricula->update($request->all());

        return redirect()->route('admin.matriculas.index')->with('success', 'Matrícula atualizada com sucesso!');
    }

    // Deletar matrícula
    public function destroy($id)
    {
        $matricula = Matricula::findOrFail($id);
        $matricula->delete();

        return redirect()->route('admin.matriculas.index')->with('success', 'Matrícula deletada com sucesso!');
    }
}
