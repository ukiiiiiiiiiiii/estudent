<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Information;
use App\Program;
use App\Result;
use App\Schedule;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    /**
     * Oglasna tabla
     **/
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
        $programs = Program::all()->sortByDesc('name');
        return view('employee.createInformation')->with('programs', $programs);
    }

    public function storeInformation(Request $request) {
        $this->validate($request, [
            'program_id' => 'required',
            'grade' => 'required',
            'text' => 'required|max:65535',
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
            'text' => 'required|max:65535',
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

        //if ($information->delete()) {
            //Session::flash('deleteInformation_success');
           // return redirect()->route('employee.dashboard');
        //} else {
            Session::flash('deleteInformation_failed');
            return redirect()->route('employee.dashboard');
        //}
    }

    /**
     * Studijski programi
     **/
    public function showPrograms()
    {
        $programs = DB::table('programs')->orderBy('name', 'desc')->paginate(10);
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
            'program_name' => 'required|string|max:255',
        ]);

        $program = new Program();

        $program->name = $request->program_name;

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
            'program_name' => 'required|string|max:255',
        ]);

        $program = Program::findOrFail($id);
        $program->name = $request->program_name;

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

    /**
     * Predmeti
     **/
    public function showSubjects()
    {
        $subjects = Subject::join('programs', 'subjects.program_id', '=', 'programs.id')
            ->select('subjects.*', 'programs.name as program_name')
            ->orderBy('program_name', 'desc')
            ->orderBy('grade', 'asc')
            ->orderBy('name', 'asc')
            ->get();
        //$subjects = Subject::orderBy('program_id', 'asc')->orderBy('grade', 'asc')->orderBy('name', 'asc')->get();
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
                ->orderBy('program_name', 'desc')
                ->orderBy('grade', 'asc')
                ->orderBy('subjects.name', 'asc')
                ->get();

            return view('employee.subjects_data', compact('subjects'))->render();
        }
    }

    public function createSubject()
    {
        $programs = Program::orderBy('name', 'desc')->get();
        return view('employee.createSubject')->with('programs', $programs);
    }

    public function storeSubject(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'program_id' => 'required',
            'grade' => 'required',
            'espb' => 'required|numeric',
        ]);

        $subject = new Subject();

        $subject->name = $request->name;
        $subject->program_id = $request->program_id;
        $subject->grade = $request->grade;
        $subject->espb = $request->espb;

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
            'espb' => 'required|numeric',
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

    /**
     * Studenti
     **/
    public function showUsers()
    {
        $users = User::orderBy('program_id', 'asc')->orderBy('rank', 'asc')->orderBy('grade', 'asc')->orderBy('espb', 'asc')->get();
        return view('employee.users', compact('users'));
    }

    public function fetch_users_data(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $users = User::join('programs', 'users.program_id', '=', 'programs.id')
                ->select('users.*', 'programs.name as program_name')
                ->where('programs.name', 'like', '%'. $query .'%')
                ->orWhere('users.name', 'like', '%'. $query .'%')
                ->orWhere('username', 'like', '%'. $query .'%')
                ->orWhere('grade', 'like', '%'. $query .'%')
                ->orWhere('espb', 'like', '%'. $query .'%')
                ->orderBy('program_id', 'asc')
                ->orderBy('rank', 'asc')
                ->orderBy('grade', 'asc')
                ->orderBy('espb', 'asc')
                ->get();

            //dd($users);

            return view('employee.users_data', compact('users'))->render();
        }
    }

    public function createUser()
    {
       if (count(User::all()) < 1) {
           $latestRank = DB::table('users')->orderBy('rank', 'desc')->first('rank');
           $nextRank = $latestRank+1;
       } elseif (count(User::all()) > 0) {
           $latestRank = DB::table('users')->orderBy('rank', 'desc')->first('rank');
           $nextRank = $latestRank->rank+1;
       }

        $programs = Program::all()->sortByDesc('name');
        return view('employee.createUser')->with('programs', $programs)->with('nextRank', $nextRank);
    }

    public function storeUser(Request $request) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|numeric|digits:13',
            'program_id' => 'required',
            'budget' => 'required|string|max:1',
            'rank' => 'required|numeric|max:65535',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->program_id = $request->program_id;
        $user->budget = $request->budget;
        $user->rank = $request->rank;

        if ($user->save()) {
            Session::flash('createUser_success');
            return redirect()->route('employee.showUsers')->with(['userName' => $user->name]);
        } else {
            Session::flash('createUser_failed');
            return redirect()->route('employee.createUser');
        }
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        $programs = Program::all();
        return view('employee.editUser')->withUser($user)->withPrograms($programs);
    }

    public function updateUser(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'grade' => 'required|numeric',
            'budget' => 'required|string|max:1',
            'espb' => 'required|numeric'
        ]);

        $user = User::findOrFail($id);

        if ($user->grade != $request->grade) {
            $user->paid = 0;
        } elseif ($user->budget != $request->budget) {
            $user->paid = 0;
        }

        $user->name = $request->name;
        $user->grade = $request->grade;
        $user->budget = $request->budget;
        $user->espb = $request->espb;

        if ($user->save()) {
            Session::flash('updateUser_success');
            return redirect()->route('employee.showUsers')->with(['userName' => $user->name]);
        } else {
            Session::flash('updateUser_failed');
            return redirect()->route('employee.editUser');
        }
    }

    public function destroyUser($id) {
        $user = User::findOrFail($id);

        if ($user->delete()) {
            Session::flash('deleteUser_success');
            return redirect()->route('employee.showUsers');
        } else {
            Session::flash('deleteUser_failed');
            return redirect()->route('employee.showUsers');
        }
    }

    /**
     * Raspored nastave
     **/
    public function showSchedule()
    {
        $programs = DB::table('programs')->orderBy('name', 'desc')->paginate(10);
        return view('employee.schedule', compact('programs'));
    }

    public function createSchedule($id)
    {
        $program = Program::findOrFail($id);
        $schedules = Schedule::all();
        $schedules2 = Schedule::all();
        $schedules3 = Schedule::all();
        $schedules4 = Schedule::all();

        if (count($schedules) > 0) {
            $subjects = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 1);
            $subjects2 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 2);
            $subjects3 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 3);
            $subjects4 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 4);

            $schedules = Subject::join('schedules', 'subjects.id', '=', 'schedules.subject_id')
                ->select('subjects.*', 'schedules.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 1)
                ->orderBy('schedules.start', 'asc')
                ->orderBy('schedules.end', 'asc')
                ->get();

            $schedules2 = Subject::join('schedules', 'subjects.id', '=', 'schedules.subject_id')
                ->select('subjects.*', 'schedules.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 2)
                ->orderBy('schedules.start', 'asc')
                ->orderBy('schedules.end', 'asc')
                ->get();

            $schedules3 = Subject::join('schedules', 'subjects.id', '=', 'schedules.subject_id')
                ->select('subjects.*', 'schedules.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 3)
                ->orderBy('schedules.start', 'asc')
                ->orderBy('schedules.end', 'asc')
                ->get();

            $schedules4 = Subject::join('schedules', 'subjects.id', '=', 'schedules.subject_id')
                ->select('subjects.*', 'schedules.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 4)
                ->orderBy('schedules.start', 'asc')
                ->orderBy('schedules.end', 'asc')
                ->get();

            return view('employee.createSchedule')->withSubjects($subjects)->withSubjects2($subjects2)->withSubjects3($subjects3)->withSubjects4($subjects4)
                ->withSchedules($schedules)->withSchedules2($schedules2)->withSchedules3($schedules3)->withSchedules4($schedules4)->withProgram($program);
        } else {
            $subjects = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 1);
            $subjects2 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 2);
            $subjects3 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 3);
            $subjects4 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 4);

            return view('employee.createSchedule')->withSubjects($subjects)->withSubjects2($subjects2)->withSubjects3($subjects3)->withSubjects4($subjects4)
                ->withSchedules($schedules)->withSchedules2($schedules2)->withSchedules3($schedules3)->withSchedules4($schedules4)->withProgram($program);
        }
    }

    public function storeSchedule(Request $request) {
        $this->validate($request, [
            'subject_id' => 'required|unique:schedules',
            'day' => 'required',
            'start' => 'required|numeric',
            'end' => 'required|numeric',
        ]);

        $schedule = new Schedule();

        $schedule->subject_id = $request->subject_id;
        $schedule->day = $request->day;
        $schedule->start = $request->start;
        $schedule->end = $request->end;

        $subject = Subject::all()->where('id', $schedule->subject_id)->first();

        if ($schedule->save()) {
            Session::flash('createSchedule_success');
            return redirect()->route('employee.createSchedule', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createSchedule_failed');
            return redirect()->route('employee.createSchedule', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        }
    }

    public function storeSchedule2(Request $request) {
        $this->validate($request, [
            'subject_id2' => 'required|unique:schedules,subject_id',
            'day2' => 'required',
            'start2' => 'required|numeric',
            'end2' => 'required|numeric',
        ]);

        $schedule = new Schedule();

        $schedule->subject_id = $request->subject_id2;
        $schedule->day = $request->day2;
        $schedule->start = $request->start2;
        $schedule->end = $request->end2;

        $subject = Subject::all()->where('id', $schedule->subject_id)->first();

        if ($schedule->save()) {
            Session::flash('createSchedule_success');
            return redirect()->route('employee.createSchedule', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createSchedule_failed');
            return redirect()->route('employee.createSchedule');
        }
    }

    public function storeSchedule3(Request $request) {
        $this->validate($request, [
            'subject_id3' => 'required|unique:schedules,subject_id',
            'day3' => 'required',
            'start3' => 'required|numeric',
            'end3' => 'required|numeric',
        ]);

        $schedule = new Schedule();

        $schedule->subject_id = $request->subject_id3;
        $schedule->day = $request->day3;
        $schedule->start = $request->start3;
        $schedule->end = $request->end3;

        $subject = Subject::all()->where('id', $schedule->subject_id)->first();

        if ($schedule->save()) {
            Session::flash('createSchedule_success');
            return redirect()->route('employee.createSchedule', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createSchedule_failed');
            return redirect()->route('employee.createSchedule');
        }
    }

    public function storeSchedule4(Request $request) {
        $this->validate($request, [
            'subject_id4' => 'required|unique:schedules,subject_id',
            'day4' => 'required',
            'start4' => 'required|numeric',
            'end4' => 'required|numeric',
        ]);

        $schedule = new Schedule();

        $schedule->subject_id = $request->subject_id4;
        $schedule->day = $request->day4;
        $schedule->start = $request->start4;
        $schedule->end = $request->end4;

        $subject = Subject::all()->where('id', $schedule->subject_id)->first();

        if ($schedule->save()) {
            Session::flash('createSchedule_success');
            return redirect()->route('employee.createSchedule', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createSchedule_failed');
            return redirect()->route('employee.createSchedule');
        }
    }

    public function destroySchedule($scheduleID, $programID) {
        $schedule = Schedule::findOrFail($scheduleID);

        $subject = Subject::all()->where('id', $schedule->subject_id)->first();
        if ($schedule->delete()) {
            Session::flash('deleteSchedule_success');
            return redirect()->route('employee.createSchedule', $programID)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('deleteSchedule_failed');
            return redirect()->route('employee.createSchedule', $programID)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        }
    }

    /**
     * Raspored ispita
     **/
    public function showExams()
    {
        $programs = DB::table('programs')->orderBy('name', 'desc')->paginate(10);
        return view('employee.exams', compact('programs'));
    }

    public function createExam($id)
    {
        $program = Program::findOrFail($id);
        $exams = Exam::all()->where('status', '=', 'open');
        $exams2 = Exam::all()->where('status', '=', 'open');
        $exams3 = Exam::all()->where('status', '=', 'open');
        $exams4 = Exam::all()->where('status', '=', 'open');

        if (count($exams) > 0) {
            $subjects = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 1);
            $subjects2 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 2);
            $subjects3 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 3);
            $subjects4 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 4);

            $exams = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
                ->select('subjects.*', 'exams.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 1)
                ->where('exams.status', '=', 'open')
                ->orderBy('exams.date', 'asc')
                ->orderBy('exams.time', 'asc')
                ->get();

            $exams2 = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
                ->select('subjects.*', 'exams.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 2)
                ->where('exams.status', '=', 'open')
                ->orderBy('exams.date', 'asc')
                ->orderBy('exams.time', 'asc')
                ->get();

            $exams3 = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
                ->select('subjects.*', 'exams.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 3)
                ->where('exams.status', '=', 'open')
                ->orderBy('exams.date', 'asc')
                ->orderBy('exams.time', 'asc')
                ->get();

            $exams4 = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
                ->select('subjects.*', 'exams.*')
                ->where('subjects.program_id', '=', $id)
                ->where('subjects.grade', '=', 4)
                ->where('exams.status', '=', 'open')
                ->orderBy('exams.date', 'asc')
                ->orderBy('exams.time', 'asc')
                ->get();

            return view('employee.createExam')->withSubjects($subjects)->withSubjects2($subjects2)->withSubjects3($subjects3)->withSubjects4($subjects4)
                ->withExams($exams)->withExams2($exams2)->withExams3($exams3)->withExams4($exams4)->withProgram($program);
        } else {
            $subjects = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 1);
            $subjects2 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 2);
            $subjects3 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 3);
            $subjects4 = Subject::all()->where('program_id', '=', $id)->where('grade', '=', 4);

            return view('employee.createExam')->withSubjects($subjects)->withSubjects2($subjects2)->withSubjects3($subjects3)->withSubjects4($subjects4)
                ->withExams($exams)->withExams2($exams2)->withExams3($exams3)->withExams4($exams4)->withProgram($program);
        }
    }

    public function storeExam(Request $request) {
        $this->validate($request, [
            'subject_id_exam' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $exam = new Exam();

        $exam->subject_id = $request->subject_id_exam;
        $strDate = date('Y-m-d', strtotime($request->date));
        $exam->date = $strDate;
        $exam->time = $request->time;

        $subject = Subject::all()->where('id', $exam->subject_id)->first();

        if ($exam->save()) {
            Session::flash('createExam_success');
            return redirect()->route('employee.createExam', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createExam_failed');
            return redirect()->route('employee.createExam', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        }
    }

    public function storeExam2(Request $request) {
        $this->validate($request, [
            'subject_id_exam2' => 'required',
            'date2' => 'required',
            'time2' => 'required',
        ]);

        $exam = new Exam();

        $exam->subject_id = $request->subject_id_exam2;
        $strDate = date('Y-m-d', strtotime($request->date2));
        $exam->date = $strDate;
        $exam->time = $request->time2;

        $subject = Subject::all()->where('id', $exam->subject_id)->first();

        if ($exam->save()) {
            Session::flash('createExam_success');
            return redirect()->route('employee.createExam', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createExam_failed');
            return redirect()->route('employee.createExam');
        }
    }

    public function storeExam3(Request $request) {
        $this->validate($request, [
            'subject_id_exam3' => 'required',
            'date3' => 'required',
            'time3' => 'required',
        ]);

        $exam = new Exam();

        $exam->subject_id = $request->subject_id_exam3;
        $strDate = date('Y-m-d', strtotime($request->date3));
        $exam->date = $strDate;
        $exam->time = $request->time3;

        $subject = Subject::all()->where('id', $exam->subject_id)->first();

        if ($exam->save()) {
            Session::flash('createExam_success');
            return redirect()->route('employee.createExam', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createExam_failed');
            return redirect()->route('employee.createExam');
        }
    }

    public function storeExam4(Request $request) {
        $this->validate($request, [
            'subject_id_exam4' => 'required',
            'date4' => 'required',
            'time4' => 'required',
        ]);

        $exam = new Exam();

        $exam->subject_id = $request->subject_id_exam4;
        $strDate = date('Y-m-d', strtotime($request->date4));
        $exam->date = $strDate;
        $exam->time = $request->time4;

        $subject = Subject::all()->where('id', $exam->subject_id)->first();

        if ($exam->save()) {
            Session::flash('createExam_success');
            return redirect()->route('employee.createExam', $request->program_id)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('createExam_failed');
            return redirect()->route('employee.createExam');
        }
    }

    public function updateExam($examID, $programID) {
        $exam = Exam::findOrFail($examID);

        $exam->status = "closed";

        $subject = Subject::all()->where('id', $exam->subject_id)->first();

        if ($exam->save()) {
            Session::flash('updateExam_success');
            return redirect()->route('employee.createExam', $programID)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        } else {
            Session::flash('updateExam_failed');
            return redirect()->route('employee.createExam', $programID)->with(['subjectName' => $subject->name])->with(['subjectGrade' => $subject->grade]);
        }
    }

    /*
     * Prijavljeni ispiti
     */
    public function showRegisteredExams()
    {
        $programs = DB::table('programs')->orderBy('name', 'desc')->paginate(10);
        return view('employee.registeredExams', compact('programs'));
    }

    public function showRegisteredExams2($programID)
    {
        $program = Program::findOrFail($programID);

        $results = Result::join('subjects', 'results.subject_id', '=', 'subjects.id')
            ->select('subjects.program_id', 'results.*')
            ->where('subjects.program_id', '=', $programID)
            ->where('results.result', '=', null)
            ->orderBy('results.user_id', 'asc')
            ->get();

        return view('employee.registeredExams2', compact('results', 'program'));
    }

    public function fetch_registeredExams2_data(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            $program_id = $request->program_id;
            $query = str_replace(" ", "%", $query);

            $results = Result::join('subjects', 'results.subject_id', '=', 'subjects.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->select('subjects.*', 'results.*', 'users.name as student')
                ->where('subjects.program_id', '=', $program_id)
                ->where('results.result', '=', null)
                ->where('users.name', 'like', '%'. $query .'%')
                ->orderBy('results.user_id', 'asc')
                ->get();

            return view('employee.registeredExams2_data', compact('results'))->render();
        }
    }

    public function updateResult(Request $request) {
        $this->validate($request, [
            'result_id' => 'required',
            'result' => 'required',
        ]);

        $result = Result::findOrFail($request->result_id);
        $programID = Program::all()->where('id', $request->program_id)->first();

        if ($request->result > 5) {
            $result->result = $request->result;

            if ($result->save()) {
                $user = User::findOrFail($result->user_id);
                $subject = Subject::findOrFail($result->subject_id);

                $user->espb = $user->espb+$subject->espb;

                if ($user->save()) {
                    Session::flash('updateResult_success');
                    return redirect()->route('employee.showRegisteredExams2', $programID);
                } else {
                    Session::flash('updateResult_failed');
                    return redirect()->route('employee.showRegisteredExams2', $programID);
                }
            } else {
                Session::flash('updateResult_failed');
                return redirect()->route('employee.showRegisteredExams2', $programID);
            }
        } else {
            $result->result = $request->result;

            if ($result->save()) {
                Session::flash('updateResult_success');
                return redirect()->route('employee.showRegisteredExams2', $programID);
            } else {
                Session::flash('updateResult_failed');
                return redirect()->route('employee.showRegisteredExams2', $programID);
            }
        }
    }

    public function showPassedExams() {
        $results = Result::all()->where('result', '>', 5);

        return view('employee.passedExams', compact('results'));
    }

    public function updateResult2(Request $request) {
        $this->validate($request, [
            'result_id' => 'required',
            'result' => 'required',
        ]);

        $result = Result::findOrFail($request->result_id);

        if ($request->result = 5) {
            $result->result = $request->result;

            if ($result->save()) {
                $user = User::findOrFail($result->user_id);
                $subject = Subject::findOrFail($result->subject_id);

                $user->espb = $user->espb-$subject->espb;

                if ($user->save()) {
                    Session::flash('updateResult_success');
                    return redirect()->route('employee.showPassedExams');
                } else {
                    Session::flash('updateResult_failed');
                    return redirect()->route('employee.showPassedExams');
                }
            } else {
                Session::flash('updateResult_failed');
                return redirect()->route('employee.showPassedExams');
            }
        } else {
            Session::flash('updateResult_failed');
            return redirect()->route('employee.showPassedExams');
        }
    }

    public function fetch_passedExams_data(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $results = Result::join('subjects', 'results.subject_id', '=', 'subjects.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->select('subjects.*', 'results.*', 'users.name as student')
                ->where('results.result', '>', 5)
                ->where('users.name', 'like', '%'. $query .'%')
                ->get();

            return view('employee.passedExams_data', compact('results'))->render();
        }
    }

    public function showUnsuccessfullyExams() {
        $results = Result::all()->where('result', '=', 5);

        return view('employee.unsuccessfullyExams', compact('results'));
    }

    public function fetch_unsuccessfullyExams_data(Request $request) {
        if($request->ajax()) {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);

            $results = Result::join('subjects', 'results.subject_id', '=', 'subjects.id')
                ->join('users', 'results.user_id', '=', 'users.id')
                ->select('subjects.*', 'results.*', 'users.name as student')
                ->where('results.result', '=', 5)
                ->where('users.name', 'like', '%'. $query .'%')
                ->get();

            return view('employee.unsuccessfullyExams_data', compact('results'))->render();
        }
    }

    public function updateResult3(Request $request) {
        $this->validate($request, [
            'result_id' => 'required',
            'result' => 'required',
        ]);

        $result = Result::findOrFail($request->result_id);

        if ($request->result > 5) {
            $result->result = $request->result;

            if ($result->save()) {
                $user = User::findOrFail($result->user_id);
                $subject = Subject::findOrFail($result->subject_id);

                $user->espb = $user->espb+$subject->espb;

                if ($user->save()) {
                    Session::flash('updateResult_success');
                    return redirect()->route('employee.showUnsuccessfullyExams');
                } else {
                    Session::flash('updateResult_failed');
                    return redirect()->route('employee.showUnsuccessfullyExams');
                }
            } else {
                Session::flash('updateResult_failed');
                return redirect()->route('employee.showUnsuccessfullyExams');
            }
        } else {
            $result->result = $request->result;

            if ($result->save()) {
                Session::flash('updateResult_success');
                return redirect()->route('employee.showUnsuccessfullyExams');
            } else {
                Session::flash('updateResult_failed');
                return redirect()->route('employee.showUnsuccessfullyExams');
            }
        }
    }
}
