<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Card;
use App\Models\Deck;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name'     => "Dave",
            'email'    => "dave@email.com",
            'password' => bcrypt('davedave'),
        ]);

        Deck::factory([
            'name' => 'Test Deck',
        ])
            ->for($user)
            ->has(Card::factory()->count(2)->sequence(
                ['question' => 'Question 1', 'answer' => 'Answer 1'],
                ['question' => 'Question 2', 'answer' => 'Answer 2']))
            ->create();

    }
}
