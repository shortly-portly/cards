<x-app-layout>
  <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
    <form method="POST" action="{{ route('cards.store') }}">
      @csrf

      <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
          autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>
    </form>
    <x-primary-button class="mt-4">{{ __('Create') }}</x-primary-button>
    </form>
  </div>
</x-app-layout>
