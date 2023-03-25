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
  <x-flash></x-flash>
</x-app-layout>

<x-modal name="new-deck" :show="$errors->userDeletion->isNotEmpty()" focusable>

  <form method="post" action="{{ route('decks.store') }}" class="p-6 h-full">
    @csrf

    <div class="flex flex-col h-full justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 text-center">
          {{ __('New Deck') }}
        </h2>

        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
            autocomplete="name" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
      </div>

      <div class="p-3">
        <div class="mt-6">
          <x-secondary-button x-on:click="$dispatch('close')">
            {{ __('Cancel') }}
          </x-secondary-button>

          <x-primary-button class="ml-3">
            {{ __('Create Deck') }}
          </x-primary-button>
        </div>
      </div>
    </div>
  </form>
</x-modal>
