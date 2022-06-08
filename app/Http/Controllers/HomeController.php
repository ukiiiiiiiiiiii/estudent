<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Information;
use App\Result;
use App\Schedule;
use App\Subject;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $program_id = Auth::user()->program_id;
        $grade = Auth::user()->grade;
        $information = Information::orderBy('created_at', 'desc')->where('program_id', '=', $program_id)
            ->where('grade', '=', $grade)->paginate(10);

        return view('home', compact('information'));
    }

    public function showSubjects() {
        $program_id = Auth::user()->program_id;

        $subjects1 = Subject::all()->where('program_id', '=', $program_id)
            ->where('grade', '=', '1');
        $subjects2 = Subject::all()->where('program_id', '=', $program_id)
            ->where('grade', '=', '2');
        $subjects3 = Subject::all()->where('program_id', '=', $program_id)
            ->where('grade', '=', '3');
        $subjects4 = Subject::all()->where('program_id', '=', $program_id)
            ->where('grade', '=', '4');

        return view('user.subjects', compact('subjects1', 'subjects2', 'subjects3', 'subjects4'));
    }

    public function showSchedule() {
        $program_id = Auth::user()->program_id;
        $grade = Auth::user()->grade;

        $schedules = Schedule::join('subjects', 'schedules.subject_id', '=', 'subjects.id')
            ->select('schedules.*', 'subjects.*')
            ->where('subjects.program_id', '=', $program_id)
            ->where('subjects.grade', '=', $grade)
            ->get();

        return view('user.schedule', compact('schedules'));
    }

    public function showScholarship() {
        return view('user.scholarship');
    }

    public function updateScholarship(Request $request) {
        $this->validate($request, [
            'payment' => 'required|numeric',
        ]);

        $user = User::all()->where('id', '=', Auth::user()->id)->first();

        if ($user->money >= $request->payment) {
            $user->money = $user->money - $request->payment;
            $user->paid = $user->paid + $request->payment;

            if ($user->save()) {
                Session::flash('updateScholarship_success2');
                return redirect()->route('showScholarship');
            } else {
                Session::flash('updateScholarship_failed2');
                return redirect()->route('showScholarship');
            }
        } else {
            Session::flash('updateScholarship_noMoney');
            return redirect()->route('showScholarship');
        }
    }

    public function payment(Request $request) {
        $this->validate($request, [
            'money' => 'required|numeric',
        ]);

        $user = User::all()->where('id', '=', Auth::user()->id)->first();

        $user->money = $user->money + $request->money;

        if ($user->save()) {
            Session::flash('updateScholarship_success');
            return redirect()->route('showScholarship');
        } else {
            Session::flash('updateScholarship_failed');
            return redirect()->route('showScholarship');
        }
    }

    public function showExams() {
        $program_id = Auth::user()->program_id;
        $grade = Auth::user()->grade;

        $exams = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
            ->select('subjects.*', 'exams.*')
            ->where('subjects.program_id', '=', $program_id)
            ->where('subjects.grade', '<=', $grade)
            ->where('exams.status', '=', 'open')
            ->orderBy('subjects.name', 'asc')
            ->get();

        return view('user.exams', compact('exams'));
    }

    public function showExamInfo($examID, $subjectID){
        $results = Result::all()->where('exam_id', '=', $examID)->where('user_id', '=', Auth::user()->id);

        $resultsSubject = Result::all()->where('subject_id', '=', $subjectID)
        ->where('result', '>', 5)->where('user_id', '=', Auth::user()->id);

        if (count($results) > 0) {
            $result = Result::all()->where('exam_id', '=', $examID)->where('user_id', '=', Auth::user()->id)->first();
            return view('user.examRegistered', compact('result'));
        } elseif (count($resultsSubject) > 0) {
            $resultSubject = Result::all()->where('subject_id', '=', $subjectID)->where('user_id', '=', Auth::user()->id)->first();
            return view('user.examPassed', compact('resultSubject'));
        }
        else {
            $exam = Exam::all()->where('id', '=', $examID)->first();
            return view('user.examInfo', compact('exam'));
        }
    }

    public function showRegisteredExam(){
        $results = Result::join('exams', 'results.exam_id', '=', 'exams.id')
            ->select('results.*', 'exams.*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '=', null)
            ->orderBy('exams.date', 'asc')
            ->orderBy('exams.time', 'asc')
            ->get();

        return view('user.examShowRegistered', compact('results'));
    }

    public function showSuccessfullyExam(){
        $results = Result::join('exams', 'results.exam_id', '=', 'exams.id')
            ->select('results.*', 'exams.*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '>', 5)
            ->orderBy('exams.date', 'asc')
            ->orderBy('exams.time', 'asc')
            ->get();

        return view('user.examShowSuccessfully', compact('results'));
    }

    public function showUnsuccessfullyExam(){
        $results = Result::join('exams', 'results.exam_id', '=', 'exams.id')
            ->select('results.*', 'exams.*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '=', 5)
            ->orderBy('exams.date', 'asc')
            ->orderBy('exams.time', 'asc')
            ->get();

        return view('user.examShowUnsuccessfully', compact('results'));
    }

    public function storeResult(Request $request, $examID) {
        $exam = Exam::findOrFail($examID);
        $subject = Subject::findOrFail($exam->subject_id);

        if (Auth::user()->budget == "Б") {
            $result = new Result();

            $result->exam_id = $exam->id;
            $result->subject_id = $exam->subject_id;
            $result->user_id = Auth::user()->id;

            if ($result->save()) {
                Session::flash('storeResult_success');
                return redirect()->route('showExams')->with(['subjectName' => $subject->name]);
            } else {
                Session::flash('storeResult_failed');
                return redirect()->route('showExams');
            }
        } else {
            if (Auth::user()->money >= 600) {
                $result = new Result();

                $result->exam_id = $exam->id;
                $result->subject_id = $exam->subject_id;
                $result->user_id = Auth::user()->id;
                $user = User::all()->where('id', '=', Auth::user()->id)->first();
                $user->money = $user->money - 600;

                if ($result->save() && $user->save()) {
                    Session::flash('storeResult_success');
                    return redirect()->route('showExams')->with(['subjectName' => $subject->name]);
                } else {
                    Session::flash('storeResult_failed');
                    return redirect()->route('showExams');
                }
            } else {
                Session::flash('storeResult_noMoney');
                return redirect()->route('showExams');
            }
        }
    }

    public function destroyResult($resultID, $subjectID) {
        $result = Result::findOrFail($resultID);

        $subject = Subject::all()->where('id', $subjectID)->first();
        $user = User::all()->where('id', '=', Auth::user()->id)->first();

        if ($user->budget == 'С') {
            $user->money = $user->money + 600;
        }

        if ($result->delete() && $user->save()) {
            Session::flash('deleteResult_success');
            return redirect()->route('showExams')->with(['subjectName' => $subject->name]);
        } else {
            Session::flash('deleteResult_failed');
            return redirect()->route('showExams');
        }
    }
}
