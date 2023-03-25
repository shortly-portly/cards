<?php

use App\Models\Deck;
use App\Models\User;

it('filters on name', function () {
    $user = User::factory()->create();

    Deck::factory()
        ->count(3)
        ->for($user)
        ->sequence(
            ['name' => 'First Deck'],
            ['name' => 'Second Deck'],
            ['name' => 'Second One']
        )
        ->create();

    $decks = Deck::latest()
        ->where('user_id', $user->id)
        ->filter(["search" => 'Second'])
        ->get();

    expect($decks)
        ->toHaveCount(2)
        ->sequence(
            fn($deck) => $deck->name->toEqual('Second Deck'),
            fn($deck) => $deck->name->toEqual('Second One'),
        );
});
