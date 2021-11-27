<?php

namespace App\Http\Controllers;

use App\Program;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* Korisicu za oglasnu tablu */
        $programs = DB::table('programs')->orderBy('name', 'asc')->paginate(10);
        return view('employee', compact('programs'));
    }

    public function showPrograms()
    {
        $programs = DB::table('programs')->orderBy('name', 'asc')->paginate(10);
        return view('employee.program', compact('programs'));
    }

    public function fetch_programs_data(Request $request) {
        if($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $programs = DB::table('programs')
                ->where('name', 'like', '%'.$query.'%')
                ->orWhere('code', 'like', '%'.$query.'%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);

            return view('employee.programs_data', compact('programs'))->render();
        }
    }

    public function createProgram()
    {
        return view('employee.createProgram');
    }

    public function storeProgram(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:1|unique:programs',
        ]);

        $program = new Program();

        $program->name = $request->name;
        $program->code = $request->code;

        if ($program->save()) {
            Session::flash('createProgram_success');
            return redirect()->route('employee.showPrograms')->with(['programName' => $program->name]);
        } else {
            Session::flash('createProgram_failed');
            return redirect()->route('employee.createProgram');
        }
    }

        public function editProgram($id) {
        $program = Program::findOrFail($id);
        return view('employee.editProgram')->withProgram($program);
    }

    public function updateProgram(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $program = Program::findOrFail($id);
        $program->name = $request->name;

        if ($program->save()) {
            Session::flash('updateProgram_success');
            return redirect()->route('employee.showPrograms')->with(['programName' => $program->name]);
        } else {
            Session::flash('updateProgram_failed');
            return redirect()->route('employee.editProgram');
        }
    }

    public function destroyProgram($id) {
        $program = Program::findOrFail($id);

        if ($program->delete()) {
            Session::flash('deleteProgram_success');
            return redirect()->route('employee.showPrograms');
        } else {
            Session::flash('deleteProgram_failed');
            return redirect()->route('employee.showPrograms');
        }
    }
}
