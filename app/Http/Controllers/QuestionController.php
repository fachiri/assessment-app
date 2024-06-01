<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Assessment;
use App\Models\Option;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        
    }

    public function create()
    {
        
    }

    public function store(StoreQuestionRequest $request, Assessment $assessment)
    {
        try {
            $question = Question::create($request->only([
                'question', 'type'
            ]) + [
                'required' => $request->required ? 1 : 0,
                'other_option' => $request->other_option ? 1 : 0,
                'assessment_id' => $assessment->id
            ]);

            if ($request->options) {
                foreach ($request->options as $option) {
                    Option::create([
                        'label' => $option,
                        'question_id' => $question->id
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function show(Question $question)
    {
        
    }

    public function edit(Question $question)
    {
        
    }

    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
