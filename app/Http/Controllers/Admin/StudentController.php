<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StudentsExport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentController extends Controller
{
    // Exibir alunos com filtros
    public function index(Request $request)
    {
        // Obter todos os cursos para o filtro
        $courses = Course::all();

        // Obter filtros da requisição
        $course_id = $request->get('course_id');
        $ano_lectivo = $request->get('ano_lectivo');

        // Consultar alunos com filtros
        $students = Student::query();

        if ($course_id) {
            $students->where('course_id', $course_id);
        }

        if ($ano_lectivo) {
            $students->where('ano_lectivo', $ano_lectivo);
        }

        $students = $students->get();

        return view('admin.students.index', compact('students', 'courses'));
    }

    // Exportar dados de alunos para Excel
    public function exportExcel(Request $request)
    {
        return Excel::download(new StudentsExport($request->course_id, $request->ano_lectivo), 'students.xlsx');
    }

    // Exportar dados de alunos para PDF
    public function exportPDF(Request $request)
    {
        $students = Student::query();

        if ($request->get('course_id')) {
            $students->where('course_id', $request->get('course_id'));
        }

        if ($request->get('ano_lectivo')) {
            $students->where('ano_lectivo', $request->get('ano_lectivo'));
        }

        $students = $students->get();

        $pdf = PDF::loadView('admin.students.export_pdf', compact('students'));

        return $pdf->download('students.pdf');
    }

    // Exibir formulário para adicionar um novo aluno
    public function create()
    {
        $courses = Course::all();
        return view('admin.students.create', compact('courses'));
    }

    // Salvar novo aluno
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|unique:users,email',
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string|max:10',
            'morada' => 'required|string|max:255',
            'numero_estudante' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'ano_lectivo' => 'required|string|max:10',
            'estado' => 'required|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Criar usuário com senha padrão
        $user = User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make('12345678'), // senha padrão
            'role' => 'student',  // Definir o papel como estudante
        ]);

        // Criar o estudante e associar com o user_id
        $student = new Student($request->all());
        $student->user_id = $user->id;

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $student->foto = $path;
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Aluno criado com sucesso e conta de acesso criada. Senha padrão: 12345678');
    }

    // Exibir formulário de edição de aluno
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        $courses = Course::all();

        return view('admin.students.edit', compact('student', 'courses'));
    }

    // Atualizar aluno
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'telefone' => 'required|string|max:15',
            'data_nascimento' => 'required|date',
            'genero' => 'required|string|max:10',
            'morada' => 'required|string|max:255',
            'numero_estudante' => 'required|string|max:20',
            'course_id' => 'required|exists:courses,id',
            'ano_lectivo' => 'required|string|max:10',
            'estado' => 'required|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        $student = Student::findOrFail($id);
        $student->fill($request->all());

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('photos', 'public');
            $student->foto = $path;
        }

        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Deletar aluno
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return redirect()->route('admin.students.index')->with('success', 'Aluno deletado com sucesso!');
    }
}
