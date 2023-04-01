<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use App\Models\Test;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class TestController extends Controller
{

    public function store(Request $request, Deck $deck): RedirectResponse
    {

        $cards =
        Card::latest()
            ->where('deck_id', $deck->id)
            ->get();

        $request->merge([
            'card_count' => $cards->count(),
            'deck_id'    => $deck->id,

        ]);

        $validated = $request->validate([
            'card_count' => 'integer|min:1',

        ]);

        $test = $request->user()->tests()->create($validated);
        Cache::put("Deck-{$request->user()}-{$test->id}", $cards, 60 * 60);

        return redirect(route('question.index', $test));

    }

    public function show(Test $test): View
    {
        $test->loadCount(['answers' => function (Builder $query) {
            $query->where('correct', true);
        }]);

        return view('tests.result', [
            'test' => $test]);
    }

}
