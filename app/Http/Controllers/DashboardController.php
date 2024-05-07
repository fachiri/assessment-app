<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $assessments = Assessment::all();

        return view('pages.dashboard.index', compact('students', 'assessments'));
    }
}
