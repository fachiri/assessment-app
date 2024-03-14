<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAssessmentRequest;
use App\Models\Assessment;
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
                    $viewButton = '<a href="' . route('dashboard.master.assessments.preview', $row->uuid) . '" class="btn btn-primary btn-sm"><i class="bi bi-eye"></i> Pratinjau</a>';
                    $editButton = '<a href="' . route('dashboard.master.assessments.edit', $row->uuid) . '" class="btn btn-success btn-sm"><i class="bi bi-pencil"></i> Edit</a>';
                    $deleteModal = view('components.modal.delete', [
                        'id' => 'deleteModal-' . $row->uuid,
                        'route' => route('dashboard.master.assessments.destroy', $row->uuid),
                        'data' => $row->title,
                        'text' => 'Hapus'
                    ])->render();
                    
                    return $viewButton . ' ' . $editButton . ' ' . $deleteModal;
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

    public function show(Assessment $assessment)
    {
        //
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
}
