<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Deck;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Deck $deck): View
    {

        return view('cards.index', [
            'deck'  => $deck,
            'cards' => Card::latest()
                ->where('deck_id', $deck->id)
                ->filter(request(['search']))
                ->get(),

        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Deck $deck): View
    {
        $this->authorize('create', $deck);

        return view('cards.create', [
            'deck' => $deck,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Deck $deck): RedirectResponse
    {

        $this->authorize('store', $deck);

        $validated = $request->validate([
            'question' => ['required'],
            'answer'   => ['required'],

        ]);

        $deck->cards()->create($validated);

        return redirect(route('decks.cards.index', [
            'deck' => $deck,
        ]))
            ->with('success', 'Card created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck, Card $card)
    {
        $this->authorize('update', $deck);

        return view('cards.edit', [
            'deck' => $deck,
            'card' => $card,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck, Card $card)
    {
        $this->authorize('update', $deck);

        $validated = $request->validate([
            'question' => ['required'],
            'answer'   => ['required'],
        ]);

        $card->update($validated);

        return redirect(route('decks.cards.index', $deck))
            ->with('success', 'Card updated'); //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck, Card $card): RedirectResponse
    {
        $this->authorize('delete', $deck);

        $card->delete();

        return redirect(route('decks.cards.index', $deck))
            ->with('success', 'Card deleted');

    }
}
