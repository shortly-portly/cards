<?php

use App\Models\Deck;
use App\Models\User;

test('can retrieve a list of decks', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    $url = 'decks/';
    login($user)->get($url)->assertStatus(200)->assertSee($deck->question);
});

test('can retrieve a form to create a deck', function () {
    $user = User::factory()->create();

    $url = 'decks/create';

    login($user)->get($url)->assertStatus(200);
});

it('can store a Deck', function () {
    login()->post('/decks', [
        'name' => "My First Deck",
    ])
        ->assertRedirect('/decks')
        ->assertSessionHas('success', 'Deck created');

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

it('cannot have two decks with the same name for the same user', function () {
    $user = login();

    $user->post('/decks', [
        'name' => "My First Deck",
    ])->assertRedirect('/decks');

    $user->post('/decks', [
        'name' => "My First Deck",
    ])->assertSessionHasErrors([
        'name' => 'The name has already been taken.',
    ]);

});

it('can have two decks with the same name for different users', function () {
    login()->post('/decks', [
        'name' => "My First Deck",
    ])->assertRedirect('/decks');

    $deck = Deck::latest()->first();

    expect($deck->name)->toBe('My First Deck');

    login()->post('/decks', [
        'name' => "My First Deck",
    ])->assertRedirect('/decks');

    $deck = Deck::latest()->first();

    expect($deck->name)->toBe('My First Deck');
});

test('Can retrieve a form to edit a deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/edit';

    login($user)->get($url)->assertStatus(200)->assertSee($deck->name);
});

it('can update a Deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    login($user)->put('decks/' . $deck->id, [
        'name' => 'My Updated Post',
    ])->assertRedirect('/decks')->assertSessionHas('success', 'Deck updated');

    expect($deck->refresh()->name)
        ->toBe('My Updated Post');
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

    login($user)->delete('decks/' . $deck->id)
        ->assertRedirect('/decks')
        ->assertSessionHas('success', 'Deck deleted');;
});

it('cannot delete a deck for a different user', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();

    // Login as a different user.
    login()->delete('decks/' . $deck->id)->assertForbidden();

    $name = $deck->name;
    expect($deck->refresh()->name)->toBe($name);
});
