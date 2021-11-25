<?php

namespace App\Http\Controllers;

use App\Program;
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
        return view('employee');
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
            $message = 'uspesno';
            dd($message);
            /*
            Session::flash('addEmployee_success');
            return redirect()->route('admin.dashboard')->with(['employeeName' => $employee->name]);
            */
        } else {
            $message = 'neuspesno';
            dd($message);
            /*
            Session::flash('addEmployee_failed');
            return redirect()->route('admin.createEmployee');
            */
        }
    }
}
