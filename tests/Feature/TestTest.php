<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Test;
use App\Models\User;

test('can store a test', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/tests';

    $response = login($user)->post($url, [
    ]);

    // Get the test that was just created
    $test = Test::latest()->first();

    $response->assertRedirect(route('question.index', $test));
});

test('cannot store a test if the deck has no cards', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/tests';

    login($user)->post($url, [
    ])->assertSessionHasErrors([
        'card_count' => 'You must add cards to the deck before running a test.',
    ]);

});

test('can retrieve the results of a test', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/tests';

    $logged_in_user = login($user);
    // Start a Test
    $logged_in_user->post($url, [
    ]);

    // Get the test that was just created
    $test = Test::latest()->first();

    // Get the results (even though we've not answered any questions)
    $url = 'tests/' . $test->id . '/result';

    $logged_in_user->get($url)->assertStatus(200)->assertSeeInOrder([
        'answers_count',
        '0',
        "card_count",
        '1',
    ]);

});
