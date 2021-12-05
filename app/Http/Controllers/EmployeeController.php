<?php

namespace App\Http\Controllers;

use App\Information;
use App\Program;
use App\Subject;
use Illuminate\Database\Eloquent\Model;
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
        if (count(Information::all()) == 0) {
            $from = "";
            $to = " ";
            $information = Information::orderBy('created_at', 'desc')->paginate(10);

            return view('employee')->with('information', $information)
                ->with('from', $from)
                ->with('to', $to);
        } else {
            $first_created_at = DB::table('information')->orderBy('created_at', 'asc')->first('created_at');
            $latest_created_at = DB::table('information')->orderBy('created_at', 'desc')->first('created_at');
            $from =  date('d.m.Y.', strtotime($first_created_at->created_at));
            $to =  date('d.m.Y.', strtotime($latest_created_at->created_at . " +1 days"));

            $information = Information::orderBy('created_at', 'desc')->paginate(10);

            return view('employee')->with('information', $information)
                ->with('from', $from)
                ->with('to', $to);
        }
    }

    public function searchInformation(Request $request) {
        if ($request->created_at_from!="") {
            $this->validate($request, [
                'created_at_to' => 'required',
            ]);
        }
        if ($request->created_at_to!="") {
            $this->validate($request, [
                'created_at_from' => 'required',
            ]);
        }

        $program_id = "";
        $grade = "";
        $first_created_at = DB::table('information')->orderBy('created_at', 'asc')->first('created_at');
        $latest_created_at = DB::table('information')->orderBy('created_at', 'desc')->first('created_at');
        $from =  date('d.m.Y.', strtotime($first_created_at->created_at));
        $to =  date('d.m.Y.', strtotime($latest_created_at->created_at . " +1 days"));
        //dd($to);

        if ($request->program_id=="" && $request->grade=="" && $request->created_at_from=="" && $request->created_at_to=="") {
            $result = Information::orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id=="" && $request->grade=="" && $request->created_at_from!="" && $request->created_at_to!="") {
            $from = date('Y-m-d H:i:s', strtotime($request->created_at_from));
            $to = date('Y-m-d H:i:s', strtotime($request->created_at_to));

            $result = Information::whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id=="" && $request->grade!="" && $request->created_at_from=="" && $request->created_at_to=="") {
            $grade = $request->grade;
            $result = Information::where('grade', 'LIKE', '%'.$request->grade.'%')->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id!="" && $request->grade=="" && $request->created_at_from=="" && $request->created_at_to=="") {
            $program_id = $request->program_id;
            $result = Information::where('program_id', 'LIKE', '%'.$request->program_id.'%')->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id!="" && $request->grade!="" && $request->created_at_from=="" && $request->created_at_to=="") {
            $program_id = $request->program_id;
            $grade = $request->grade;
            $result = Information::where('program_id', 'LIKE', '%'.$request->program_id.'%')->
                where('grade', 'LIKE', '%'.$request->grade.'%')->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id!="" && $request->grade=="" && $request->created_at_from!="" && $request->created_at_to!="") {
            $program_id = $request->program_id;
            $from = date('Y-m-d H:i:s', strtotime($request->created_at_from));
            $to = date('Y-m-d H:i:s', strtotime($request->created_at_to));

            $result = Information::whereBetween('created_at', [$from, $to])
                ->where('program_id', 'LIKE', '%'.$request->program_id.'%')
                ->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id=="" && $request->grade!="" && $request->created_at_from!="" && $request->created_at_to!="") {
            $grade = $request->grade;
            $from = date('Y-m-d H:i:s', strtotime($request->created_at_from));
            $to = date('Y-m-d H:i:s', strtotime($request->created_at_to));

            $result = Information::whereBetween('created_at', [$from, $to])
                ->where('grade', 'LIKE', '%'.$request->grade.'%')
                ->orderBy('created_at', 'desc')->paginate(10);
        }
        if ($request->program_id!="" && $request->grade!="" && $request->created_at_from!="" && $request->created_at_to!="") {
            $program_id = $request->program_id;
            $grade = $request->grade;
            $from = date('Y-m-d H:i:s', strtotime($request->created_at_from));
            $to = date('Y-m-d H:i:s', strtotime($request->created_at_to));

            $result = Information::whereBetween('created_at', [$from, $to])
                ->where('program_id', 'LIKE', '%'.$request->program_id.'%')
                ->where('grade', 'LIKE', '%'.$request->grade.'%')
                ->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('employee.searchInformation')->with('information', $result)
            ->with('program_id', $program_id)
            ->with('grade', $grade)
            ->with('from', $from)
            ->with('to', $to);
    }

    public function createInformation()
    {
        $programs = Program::all();
        return view('employee.createInformation')->with('programs', $programs);
    }

    public function storeInformation(Request $request) {
        $this->validate($request, [
            'program_id' => 'required',
            'grade' => 'required',
            'text' => 'required',
        ]);

        if ($request->program_id == 'all' && $request->grade != 'all') {
            $programs = Program::all();

            foreach ($programs as $program) {
                $information = new Information();

                $information->program_id = $program->id;
                $information->grade = $request->grade;
                $information->text = $request->text;

                $information->save();
            }
        }
        if ($request->program_id != 'all' && $request->grade == 'all') {
            $grade = 4;

            while ($grade > 0) {
                $information = new Information();

                $information->program_id = $request->program_id;
                $information->grade = $grade;
                $information->text = $request->text;

                $grade--;

                $information->save();
            }
        }
        if ($request->program_id == 'all' && $request->grade == 'all') {
            $programs = Program::all();

            foreach ($programs as $program) {
                $grade = 4;

                while ($grade > 0) {
                    $information = new Information();

                    $information->program_id = $program->id;
                    $information->grade = $grade;
                    $information->text = $request->text;

                    $grade--;

                    $information->save();
                }
            }
        }
        if ($request->program_id != 'all' && $request->grade != 'all') {
            $information = new Information();

            $information->program_id = $request->program_id;
            $information->grade = $request->grade;
            $information->text = $request->text;
        }

        if ($information->save()) {
            Session::flash('createInformation_success');
            return redirect()->route('employee.dashboard');
        } else {
            Session::flash('createInformation_failed');
            return redirect()->route('employee.createInformation');
        }
    }

    public function editInformation($id) {
        $information = Information::findOrFail($id);
        return view('employee.editInformation')->withInformation($information);
    }

    public function updateInformation(Request $request, $id) {
        $this->validate($request, [
            'text' => 'required',
        ]);

        $information = Information::findOrFail($id);
        $information->text = $request->text;

        if ($information->save()) {
            Session::flash('updateInformation_success');
            return redirect()->route('employee.dashboard');
        } else {
            Session::flash('updateInformation_failed');
            return redirect()->route('employee.editInformation');
        }
    }

    public function destroyInformation($id) {
        $information = Information::findOrFail($id);

        if ($information->delete()) {
            Session::flash('deleteInformation_success');
            return redirect()->route('employee.dashboard');
        } else {
            Session::flash('deleteInformation_failed');
            return redirect()->route('employee.dashboard');
        }
    }

    public function showSubjects()
    {
        $subjects = Subject::orderBy('program_id', 'asc')->orderBy('grade', 'asc')->orderBy('name', 'asc')->get();
        return view('employee.subjects', compact('subjects'));
    }

    public function fetch_subjects_data(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $subjects = Subject::join('programs', 'subjects.program_id', '=', 'programs.id')
                ->select('subjects.*', 'programs.name as program_name')
                ->where('programs.name', 'like', '%'. $query .'%')
                ->orWhere('subjects.name', 'like', '%'. $query .'%')
                ->orWhere('grade', 'like', '%'. $query .'%')
                ->orWhere('espb', 'like', '%'. $query .'%')
                ->orderBy('program_id', 'asc')
                ->orderBy('grade', 'asc')
                ->orderBy('subjects.name', 'asc')
                ->get();

            return view('employee.subjects_data', compact('subjects'))->render();
        }
    }

    public function createSubject()
    {
        $programs = Program::all();
        return view('employee.createSubject')->with('programs', $programs);
    }

    public function storeSubject(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'program_id' => 'required',
            'grade' => 'required',
            'espb' => 'required|numeric',
        ]);

        if ($request->program_id == 'all' && $request->grade != 'all') {
            $programs = Program::all();

            foreach ($programs as $program) {
                $subject = new Subject();

                $subject->name = $request->name;
                $subject->program_id = $program->id;
                $subject->grade = $request->grade;
                $subject->espb = $request->espb;

                $subject->save();
            }
        }
        if ($request->program_id != 'all' && $request->grade == 'all') {
            $grade = 4;

            while ($grade > 0) {
                $subject = new Subject();

                $subject->name = $request->name;
                $subject->program_id = $program->id;
                $subject->grade = $request->grade;
                $subject->espb = $request->espb;

                $grade--;

                $subject->save();
            }
        }
        if ($request->program_id == 'all' && $request->grade == 'all') {
            $programs = Program::all();

            foreach ($programs as $program) {
                $grade = 4;

                while ($grade > 0) {
                    $subject = new Subject();

                    $subject->name = $request->name;
                    $subject->program_id = $program->id;
                    $subject->grade = $request->grade;
                    $subject->espb = $request->espb;

                    $grade--;

                    $subject->save();
                }
            }
        }
        if ($request->program_id != 'all' && $request->grade != 'all') {
            $subject = new Subject();

            $subject->name = $request->name;
            $subject->program_id = $request->program_id;
            $subject->grade = $request->grade;
            $subject->espb = $request->espb;
        }

        if ($subject->save()) {
            Session::flash('createSubject_success');
            return redirect()->route('employee.showSubjects')->with(['subjectName' => $subject->name]);
        } else {
            Session::flash('createSubject_failed');
            return redirect()->route('employee.createSubject');
        }
    }

    public function editSubject($id) {
        $subject = Subject::findOrFail($id);
        $programs = Program::all();
        return view('employee.editSubject')->withSubject($subject)->withPrograms($programs);
    }

    public function updateSubject(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'program_id' => 'required',
            'grade' => 'required',
            'espb' => 'required'
        ]);

        $subject = Subject::findOrFail($id);
        $subject->name = $request->name;
        $subject->program_id = $request->program_id;
        $subject->grade = $request->grade;
        $subject->espb = $request->espb;

        if ($subject->save()) {
            Session::flash('updateSubject_success');
            return redirect()->route('employee.showSubjects')->with(['subjectName' => $subject->name]);
        } else {
            Session::flash('updateSubject_failed');
            return redirect()->route('employee.editSubject');
        }
    }

    public function destroySubject($id) {
        $subject = Subject::findOrFail($id);

        if ($subject->delete()) {
            Session::flash('deleteSubject_success');
            return redirect()->route('employee.showSubjects');
        } else {
            Session::flash('deleteSubject_failed');
            return redirect()->route('employee.showSubjects');
        }
    }

    public function showPrograms()
    {
        $programs = DB::table('programs')->orderBy('name', 'asc')->paginate(10);
        return view('employee.programs', compact('programs'));
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
