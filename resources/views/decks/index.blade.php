<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Decks') }}
        </h2>
      </div>
      <div>
        <form method="GET" action="#">
          <input id="search" name="search" type="text" class="h-6" autocomplete="search" placeholder="Search Decks"
            value="{{ request('search') }}" />
        </form>
      </div>
    </div>
  </x-slot>

  <div class="py-2">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="flex justify-end py-8">
        <a href="{{ route('decks.create') }}">New Deck
        </a>
      </div>
    </div>
  </div>

  @foreach ($decks as $deck)
    <x-section :title="$deck->name" :subtitle="$deck->created_at->format('j M Y, g:i a')" :deck="$deck">
    </x-section>
  @endforeach
  <div class="m-8 ">
    {{ $decks->links() }}
  </div>

  <x-flash></x-flash>
</x-app-layout>
