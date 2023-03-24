<?php

namespace App\Http\Controllers;

use App\Models\Deck;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DeckController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        return view('decks.index', [
            'decks' => Deck::latest()->filter(request(['search']))->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->decks()->create($validated);

        return redirect(route('decks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Deck $deck)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deck $deck): View
    {
        $this->authorize('update', $deck);

        return view('decks.edit', [
            'deck' => $deck,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deck $deck): RedirectResponse
    {
        $this->authorize('update', $deck);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $deck->update($validated);

        return redirect(route('decks.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deck $deck): RedirectResponse
    {
        $this->authorize('delete', $deck);

        $deck->delete();

        return redirect(route('decks.index'));
    }
}
