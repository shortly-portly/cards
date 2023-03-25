<?php

use App\Models\Deck;
use App\Models\User;

it('can store a Deck', function () {
    login()->post('/decks', [
        'name' => "My First Deck",
    ])->assertRedirect('/decks');

    $deck = Deck::latest()->first();

    expect($deck->name)->toBe('My First Deck');
});

it('must have a name', function () {
    login()->post('/decks', [
        'name' => "",
    ])->assertSessionHasErrors([
        'name' => 'The name field is required.',
    ]);
});

it('can update a Deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    login($user)->put('decks/' . $deck->id, [
        'name' => 'My Updated Post',
    ])->assertRedirect('/decks');

    expect($deck->refresh()->name)->toBe('My Updated Post');
});

it('cannot update a deck for a different user', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    // Login as a different user.
    login()->put('decks/' . $deck->id, [
        'name' => 'My Updated Post',
    ])->assertForbidden();

    $name = $deck->name;
    expect($deck->refresh()->name)->toBe($name);

});

it('can delete a Deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    login($user)->delete('decks/' . $deck->id)->assertRedirect('/decks');
});

it('cannot delete a deck for a different user', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    // Login as a different user.
    login()->delete('decks/' . $deck->id)->assertForbidden();

    $name = $deck->name;
    expect($deck->refresh()->name)->toBe($name);
});
