<x-app-layout>
  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Decks') }}
    </h2>


  </x-slot>

  <div class="py-2">
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
      <form method="POST" action="{{ route('decks.update', $deck) }}">
        @csrf
        @method('patch')
        <div>
          <x-input-label for="name" :value="__('Name')" />
          <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
            autocomplete="name" value="{{ old('name', $deck->name) }}" />
          <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="mt-4 space-x-2">
          <x-primary-button>{{ __('Save') }}</x-primary-button>
          <a href="{{ route('decks.index') }}">{{ __('Cancel') }}</a>
        </div>
      </form>
    </div>
  </div>

</x-app-layout>
