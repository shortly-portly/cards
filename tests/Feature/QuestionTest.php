<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Test;
use App\Models\User;

test('can retrieve a question', function () {
    $user  = User::factory()->create();
    $deck  = Deck::factory()->for($user)->create();
    $cards = Card::factory()->for($deck)->create([
        'question' => 'What is the capital of France',
    ]);
    $url = 'decks/' . $deck->id . '/tests';

    $logged_in_user = login($user);

    // Start a Test
    $logged_in_user->post($url, [
    ]);

    // Get the test that was just created
    $test = Test::latest()->first();

    // Retireive the only question
    $url = 'tests/' . $test->id . '/question';

    $logged_in_user->get($url)->assertStatus(200)->assertSee([
        'What is the capital of France',
    ]);

});

test('returns empty if there are no questions', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $test = Test::factory()->for($user)->create([
        'card_count' => 0,
    ]);

    $url = 'decks/' . $deck->id . '/tests';

    $logged_in_user = login($user);

    // Get the test that was just created
    $test = Test::latest()->first();

    // Retireive the only question
    $url         = 'tests/' . $test->id . '/question';
    $results_url = 'tests/' . $test->id . '/result';
    $logged_in_user->get($url)->assertRedirect($results_url);;
});

test('Redirects to results page when there are no more questioons', function () {
    $user  = User::factory()->create();
    $deck  = Deck::factory()->for($user)->create();
    $cards = Card::factory()->for($deck)->create([
        'question' => 'What is the capital of France',
    ]);
    $url = 'decks/' . $deck->id . '/tests';

    $logged_in_user = login($user);

    // Start a Test
    $logged_in_user->post($url, [
    ]);

    // Get the test that was just created
    $test = Test::latest()->first();

    // Retireive the only question
    $url = 'tests/' . $test->id . '/question';

    $logged_in_user->get($url);

    // Get another question (but there aren't any)
    $results_url = 'tests/' . $test->id . '/result';
    $logged_in_user->get($url)->assertRedirect($results_url);;

});
