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

  @if ($errors->any())
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white border border-purple-300  sm:rounded-lg">
          <ul>
            @foreach ($errors->all() as $error)
              <li class="text-red-500">{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  @endif

  @foreach ($decks as $deck)
    <x-section :title="$deck->name" :subtitle="$deck->created_at->format('j M Y, g:i a')">
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
            <x-dropdown-link :href="route('decks.edit', $deck)">
              {{ __('Edit') }}
            </x-dropdown-link>
            <x-dropdown-link :href="route('decks.cards.index', $deck)">
              {{ __('Cards') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('decks.tests.store', $deck) }}">
              @csrf
              <x-dropdown-link :href="route('decks.tests.store', $deck)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Test') }}
              </x-dropdown-link>
            </form>
            <form method="POST" action="{{ route('decks.destroy', $deck) }}">
              @csrf
              @method('delete')
              <x-dropdown-link :href="route('decks.destroy', $deck)" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Delete') }}
              </x-dropdown-link>
            </form>

          </x-slot>
        </x-dropdown>
      </x-slot:menu>
    </x-section>
  @endforeach
  <div class="m-8 ">
    {{ $decks->links() }}
  </div>

  <x-flash></x-flash>
</x-app-layout>
