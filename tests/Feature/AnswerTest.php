<?php

use App\Models\Card;
use App\Models\Deck;
use App\Models\Test;
use App\Models\User;

test('can answer all questions and retrieve a result', function () {
    $user            = User::factory()->create();
    $deck            = Deck::factory()->for($user)->create();
    $correct_cards   = Card::factory()->for($deck)->count(3)->create();
    $incorrect_cards = Card::factory()->for($deck)->count(2)->create();
    $url             = 'decks/' . $deck->id . '/tests';

    $logged_in_user = login($user);

    // Start a Test
    $logged_in_user->post($url, [
    ]);

    // Get the test that was just created
    $test = Test::latest()->first();

    // Answer all three questions
    $url = 'tests/' . $test->id . '/answer';

    foreach ($correct_cards as $card) {
        $logged_in_user->post($url, [
            'answer' => 'correct',
            'card'   => $card->id,
        ]);
    };

    foreach ($incorrect_cards as $card) {
        $logged_in_user->post($url, [
            'answer' => 'wrong',
            'card'   => $card->id,
        ]);
    };

    $url = 'tests/' . $test->id . '/result';

    $logged_in_user->get($url)->assertStatus(200)->assertSeeInOrder([
        'answers_count',
        '3',
        "card_count",
        '5',
    ]);
});
