<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Result;
use App\Subject;
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
        return view('home');
    }

    public function showExams() {
        $program_id = Auth::user()->program_id;
        $grade = Auth::user()->grade;

        $exams = Subject::join('exams', 'subjects.id', '=', 'exams.subject_id')
            ->select('subjects.*', 'exams.*')
            ->where('subjects.program_id', '=', $program_id)
            ->where('subjects.grade', '<=', $grade)
            ->where('exams.status', '=', 'open')
            ->orderBy('exams.date', 'asc')
            ->orderBy('exams.time', 'asc')
            ->get();

        /*
        $results = Exam::join('results', 'exams.subject_id', '=', 'results.subject_id')
            ->join('subjects', 'exams.subject_id', '=', 'subjects.id')
            ->select('results.*', 'exams.*')
            ->where('subjects.program_id', '=', $program_id)
            ->where('subjects.grade', '<=', $grade)
            ->get();
        */

        //dd($results);

        return view('user.exams', compact('exams'));
    }

    public function showExamInfo($examID, $subjectID){
        $results = Result::all()->where('exam_id', '=', $examID);

        $resultsSubject = Result::all()->where('subject_id', '=', $subjectID)
        ->where('result', '>', 5);

        if (count($results) > 0) {
            $result = Result::all()->where('exam_id', '=', $examID)->first();
            return view('user.examRegistered', compact('result'));
        } elseif (count($resultsSubject) > 0) {
            $resultSubject = Result::all()->where('subject_id', '=', $subjectID)->first();
            return view('user.examPassed', compact('resultSubject'));
        }
        else {
            $exam = Exam::all()->where('id', '=', $examID)->first();
            return view('user.examInfo', compact('exam'));
        }
    }

    public function showRegisteredExam(){
        $results = Result::select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '=', null)->get();

        return view('user.examShowRegistered', compact('results'));
    }

    public function showSuccessfullyExam(){
        $results = Result::select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '>', 5)->get();

        return view('user.examShowSuccessfully', compact('results'));
    }

    public function showUnsuccessfullyExam(){
        $results = Result::select('*')
            ->where('user_id', '=', Auth::user()->id)
            ->where('result', '=', 5)->get();

        return view('user.examShowUnsuccessfully', compact('results'));
    }

    public function storeResult(Request $request, $examID) {
        $exam = Exam::findOrFail($examID);
        $subject = Subject::findOrFail($exam->subject_id);

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
    }

    public function destroyResult($resultID, $subjectID) {
        $result = Result::findOrFail($resultID);

        $subject = Subject::all()->where('id', $subjectID)->first();

        if ($result->delete()) {
            Session::flash('deleteResult_success');
            return redirect()->route('showExams')->with(['subjectName' => $subject->name]);
        } else {
            Session::flash('deleteResult_failed');
            return redirect()->route('showExams');
        }
    }
}
