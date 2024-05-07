<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAssessmentRequest;
use App\Models\Answer;
use App\Models\Assessment;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Assessment::all();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $usersWithAnswers = User::whereHas('student.answers.question.assessment', function ($query) use ($row) {
                        $query->where('assessments.id', $row->id);
                    })->get();
                    $answersButton = '<a href="' . route('dashboard.master.assessments.answers', $row->uuid) . '" class="btn btn-secondary btn-sm"><i class="bi bi-list-ul"></i> Jawaban <span class="badge bg-transparent">' . $usersWithAnswers->count() . '</span></a>';
                    $viewButton = '<a href="' . route('public.assessment', ['assessment' => $row->uuid, 'nisn' => 'preview']) . '" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Pratinjau</a>';
                    $editButton = '<a href="' . route('dashboard.master.assessments.edit', $row->uuid) . '" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i> Edit</a>';
                    $deleteModal = view('components.modal.delete', [
                        'id' => 'deleteModal-' . $row->uuid,
                        'route' => route('dashboard.master.assessments.destroy', $row->uuid),
                        'data' => $row->title,
                        'text' => 'Hapus'
                    ])->render();

                    return $answersButton . ' ' . $viewButton . ' ' . $editButton . ' ' . $deleteModal;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.master.assessments.index');
    }

    public function create()
    {
        $created = Assessment::create([
            'description' => 'Lorem ipsum dolor sit amet.'
        ]);
        $assessment = Assessment::where('id', $created->id)->first();

        return redirect()->route('dashboard.master.assessments.edit', $assessment->uuid);
    }

    public function edit(Assessment $assessment)
    {
        return view('pages.dashboard.master.assessments.edit', compact('assessment'));
    }

    public function update(UpdateAssessmentRequest $request, Assessment $assessment)
    {
        try {
            if ($request->hasFile('cover')) {
                $assessment->cover = basename($request->file('cover')->store('public/uploads/covers'));
            }

            $assessment->title = $request->title;
            $assessment->description = $request->description;
            $assessment->status = $request->status;
            $assessment->save();

            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function destroy(Assessment $assessment)
    {
        $assessment->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function answers(Request $request, Assessment $assessment)
    {
        if ($request->ajax()) {
            $usersWithAnswers = User::whereHas('student.answers.question.assessment', function ($query) use ($assessment) {
                $query->where('assessments.id', $assessment->id);
            })->get();

            return DataTables::of($usersWithAnswers)
                ->addIndexColumn()
                ->addColumn('student_nisn', function ($row) {
                    return $row->student->nisn;
                })
                ->addColumn('action', function ($row) use ($assessment) {
                    $actionBtn = '
                    <a href="' . route('dashboard.master.assessments.answers.user', ['assessment' => $assessment->uuid, 'user' => $row->uuid]) . '" class="btn btn-primary btn-sm">
                        <i class="bi bi-list-ul"></i>
                        Detail Jawaban
                    </a> 
                    ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('pages.dashboard.master.assessments.answers', compact('assessment'));
    }

    public function answers_user(Request $request, Assessment $assessment, User $user)
    {
        if ($request->ajax()) {
            $assessmentId = $assessment->id;
            $answers = Answer::whereHas('question.assessment', function ($query) use ($assessmentId) {
                $query->where('assessments.id', $assessmentId);
            })
                ->where('student_id', $user->student->id)
                ->get();

            return DataTables::of($answers)
                ->addIndexColumn()
                ->addColumn('question', function ($row) {
                    return $row->question->question;
                })
                ->addColumn('answer', function ($row) {
                    return $row->value;
                })
                ->rawColumns(['question'])
                ->make(true);
        }

        return view('pages.dashboard.master.assessments.answers-detail', compact('assessment', 'user'));
    }
}
