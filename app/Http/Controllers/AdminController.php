<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Ucitava se prva stranica
        $employees = DB::table('employees')->orderBy('name', 'asc')->paginate(10);
        return view('admin', compact('employees'));
    }

    public function fetch_employees_data(Request $request) {
        //Ucitavaju se ostale stranice
        if($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $employees = DB::table('employees')
                ->where('name', 'like', '%'.$query.'%')
                ->orWhere('username', 'like', '%'.$query.'%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);

            return view('admin.employees_data', compact('employees'))->render();
        }
    }

    public function createEmployee()
    {
        return view('admin.createEmployee');
    }

    public function storeEmployee(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:employees',
            'password' => 'required|numeric|digits:13'
        ]);

        $employee = new Employee();

        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->password = Hash::make($request->password);

        if ($employee->save()) {
            Session::flash('addEmployee_success');
            return redirect()->route('admin.dashboard')->with(['employeeName' => $employee->name]);
        } else {
            Session::flash('addEmployee_failed');
            return redirect()->route('admin.createEmployee');
        }
    }

    public function editEmployee($id) {
        $employee = Employee::findOrFail($id);
        return view('admin.editEmployee')->withEmployee($employee);
    }

    public function updateEmployee(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:employees',
            'password' => 'required|numeric|digits:13'
        ]);

        $employee = Employee::findOrFail($id);
        $employee->name = $request->name;
        $employee->username = $request->username;
        $employee->password = Hash::make($request->password);

        if ($employee->save()) {
            Session::flash('updateEmployee_success');
            return redirect()->route('admin.dashboard')->with(['employeeName' => $employee->name]);
        } else {
            Session::flash('updateEmployee_failed');
            return redirect()->route('admin.editEmployee');
        }
    }

    public function destroyEmployee($id) {
        $employee = Employee::findOrFail($id);

        if ($employee->delete()) {
            Session::flash('deleteEmployee_success');
            return redirect()->route('admin.dashboard');
        } else {
            Session::flash('deleteEmployee_failed');
            return redirect()->route('admin.dashboard');
        }
    }
}
