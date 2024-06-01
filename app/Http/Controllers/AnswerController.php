<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Models\Answer;
use App\Models\Assessment;
use App\Models\Question;
use App\Models\Student;

class AnswerController extends Controller
{
    public function store(StoreAnswerRequest $request, Assessment $assessment, Student $student)
    {
        try {
            $questions = Question::all();
            $answers = $request->except('_token');

            foreach ($answers as $key => $value) {
                $question = $questions->where('uuid', $key)->first();
                if ($value == 'opsi-lain') $value = $answers["{$key}_other"];
                if ($question)
                    Answer::create([
                        'value' => $value,
                        'student_id' => $student->id,
                        'question_id' => $question->id
                    ]);
            }

            return redirect()->back()->with('success', 'Jawaban anda berhasil disimpan.');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage())->withInput();
        }
    }

    public function update(UpdateAnswerRequest $request, Answer $answer)
    {
        //
    }
}
