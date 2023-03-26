<x-app-layout>
  <x-flash></x-flash>
  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cards') }}
    </h2>
  </x-slot>

  <div class="py-2">
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">

      <form method="POST" action="{{ route('decks.cards.store', $deck) }}">
        @csrf

        <div>
          <x-input-label for="question" :value="__('Question')" />
          <x-text-input id="question" name="question" type="text" class="mt-1 block w-full" required autofocus
            autocomplete="question" value="{{ old('question') }}" />
          <x-input-error class="mt-2" :messages="$errors->get('question')" />
        </div>

        <div>
          <x-input-label for="answer" :value="__('Answer')" />
          <x-text-input id="answer" name="answer" type="text" class="mt-1 block w-full" required autofocus
            autocomplete="answer" value="{{ old('answer') }}" />
          <x-input-error class="mt-2" :messages="$errors->get('answer')" />
        </div>

        <div class="mt-4 space-x-2">
          <x-primary-button>{{ __('Save') }}</x-primary-button>
          <a href="{{ route('decks.cards.index', $deck) }}">{{ __('Cancel') }}</a>
        </div>
      </form>
    </div>
  </div>
  <x-flash></x-flash>
</x-app-layout>
