<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Test $test): RedirectResponse
    {

        $card_id = $request->input('card');
        $correct = ($request->input('answer') == 'correct') ? true : false;

        $answer = [
            'correct' => $correct,
            'card_id' => $card_id,
            'test_id' => $test->id,
        ];

        Answer::create($answer);

        return redirect(route('question.index', $test));

    }

}
