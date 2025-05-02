<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    // Listar todos os cursos
    public function index()
    {
        $courses = Course::all();
        return view('admin.courses.index', compact('courses'));
    }

    // Mostrar o formulário de criação de novo curso
    public function create()
    {
        $courses = Course::all(); // <-- Aqui corrigido
        return view('admin.courses.create', compact('courses'));
    }

    // Salvar o novo curso no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'duracao' => 'nullable|string|max:50',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Curso criado com sucesso.');
    }

    // Mostrar o formulário de edição de curso
    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    // Atualizar o curso no banco de dados
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'duracao' => 'nullable|string|max:50',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')->with('success', 'Curso atualizado com sucesso.');
    }

    // Excluir um curso
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Curso removido com sucesso.');
    }
}
