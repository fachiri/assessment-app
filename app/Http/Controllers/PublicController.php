<?php

namespace App\Http\Controllers;

use App\Constants\AssessmentStatus;
use App\Http\Requests\StoreViolationRequest;
use App\Models\Assessment;
use App\Models\Student;
use App\Models\Violation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        return view('pages.public.index');
    }

    public function assessments(Request $request)
    {
        $assessments = Assessment::where('status', AssessmentStatus::ACTIVE)->get();

        if ($request->has('nisn')) {
            $student = Student::where('nisn', $request->nisn)->first();
        } else {
            return redirect()->route('public.assessments', ['nisn' => '']);
        }

        return view('pages.public.assessments', compact('assessments', 'student'));
    }

    public function assessment(Request $request, Assessment $assessment)
    {
        if ($request->has('nisn')) {
            $student = Student::where('nisn', $request->nisn)->first();
        } else {
            return redirect()->route('public.assessments', ['nisn' => '']);
        }

        return view('pages.public.assessment', compact('assessment', 'student'));
    }
}