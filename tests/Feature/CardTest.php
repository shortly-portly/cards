<?php
use App\Models\Card;
use App\Models\Deck;
use App\Models\User;

test('can retrieve a list of cards for a deck', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();

    $url = 'decks/' . $deck->id . '/cards';
    login($user)->get($url)->assertStatus(200)->assertSee($card->question);
});

test('can retrieve a form to create a card', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/cards/create';

    login($user)->get($url)->assertStatus(200);
});

test('can store a Card', function () {

    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login($user)->post($url, [
        'question' => "Will this test pass?",
        'answer'   => 'Who knows',
    ])
        ->assertRedirect($url)
        ->assertSessionHas('success', 'Card created');

    $card = Card::latest()->first();

    expect($card->question)->toBe('Will this test pass?');
});

test('Card must have a question and answer', function () {

    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login($user)->post($url, [
    ])->assertSessionHasErrors([
        'question' => 'The question field is required.',
        'answer'   => 'The answer field is required.',
    ]);

});

test('Can retrieve a form to edit a card', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/cards/' . $card->id . '/edit';

    login($user)->get($url)->assertStatus(200);
});

test('Can update a card', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login($user)->put($url . '/' . $card->id, [
        'question' => 'An updated question',
        'answer'   => $card->answer,
    ])->assertRedirect($url);

    $card = Card::latest()->first();

    expect($card->question)->toBe('An updated question');

});

test('cannot create a card for a deck you do not own', function () {

    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login()->post($url, [
        'question' => "Will this test pass?",
        'answer'   => 'Who knows',
    ])
        ->assertForbidden();

});

test('Cannot update a card for a deck you do not own', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login()->put($url . '/' . $card->id, [
        'question' => 'An updated question',
        'answer'   => $card->answer,
    ])->assertForbidden();

});

test('Can delete a card', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login($user)->delete($url . '/' . $card->id)
        ->assertRedirect($url)
        ->assertSessionHas('success', 'Card deleted');

    $this->assertDatabaseMissing('cards', [
        'id' => $card->id,
    ]);

});

test('Cannot delete a card from a deck user does not own', function () {
    $user = User::factory()->create();
    $deck = Deck::factory()->for($user)->create();
    $card = Card::factory()->for($deck)->create();
    $url  = 'decks/' . $deck->id . '/cards';

    login()->delete($url . '/' . $card->id)
        ->assertForbidden();

    $this->assertDatabaseHas('cards', [
        'id' => $card->id,
    ]);

});
