<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Cards') }}
        </h2>
      </div>
      <div>
        <form method="GET" action="#">
          <input id="search" name="search" type="text" class="h-6" autocomplete="search" placeholder="Search Cards"
            value="{{ request('search') }}" />
        </form>
      </div>
    </div>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="flex justify-end py-8">
        <a href="{{ route('decks.cards.create', $deck) }}">New Card
        </a>
      </div>
    </div>
  </div>

  @foreach ($cards as $card)
    <x-section :title="$card->question" :subtitle="$card->created_at->format('j M Y, g:i a')">
      <x-slot:menu>
        <x-dropdown>
          <x-slot name="trigger">
            <button>
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20"
                fill="currentColor">
                <path
                  d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
              </svg>
            </button>
          </x-slot>
          <x-slot name="content">
            <x-dropdown-link :href="route('decks.cards.edit', [$deck, $card])">
              {{ __('Edit') }}
            </x-dropdown-link>
            <form method="POST" action="{{ route('decks.cards.destroy', [$deck, $card]) }}">
              @csrf
              @method('delete')
              <x-dropdown-link :href="route('decks.cards.destroy', [$deck, $card])" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete') }}
              </x-dropdown-link>
            </form>

          </x-slot>
        </x-dropdown>
      </x-slot:menu>
    </x-section>
  @endforeach


  <x-flash></x-flash>
</x-app-layout>
