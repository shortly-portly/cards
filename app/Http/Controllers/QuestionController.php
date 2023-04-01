<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class QuestionController extends Controller
{
    public function index(Request $request, Test $test): View | RedirectResponse
    {
        $cards = Cache::get("Deck-{$request->user()}-{$test->id}", function () {
            return collect([]);
        });

        if ($cards->count() == 0) {

            Cache::delete("Deck-{$request->user_id}-{$test->id}");

            return redirect(route('tests.show', $test));

        } else {
            $card      = $cards->random();
            $remaining = $cards->filter(fn($value, $key) =>
                $value->id != $card->id);

            Cache::put("Deck-{$request->user()}-{$test->id}", $remaining, 60 * 60);

        };

        return view('tests.index', [
            'card'  => $card,
            'test'  => $test,
            'count' => $cards->count(),
        ]);

    }
}
