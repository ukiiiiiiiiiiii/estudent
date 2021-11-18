<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $employees = DB::table('employees')->orderBy('name', 'asc')->paginate(9);
        return view('admin', compact('employees'));
    }

    public function fetch_employees_data(Request $request) {
        //Ucitavaju se ostale stranice
        if($request->ajax()) {
            $employees = DB::table('employees')->orderBy('name', 'asc')->paginate(9);
            return view('admin.employees_data', compact('employees'))->render();
        }
    }

    public function createEmployee()
    {
        return view('admin.createEmployee');
    }
}
