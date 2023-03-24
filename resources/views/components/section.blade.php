@props(['title', 'subtitle', 'deck'])

<div class="py-2">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white border border-purple-300  sm:rounded-lg">

      <section>
        <div class="flex justify-between">
          <div>
            <h2 class="text-lg font-medium text-gray-900">
              {{ __($title) }}
            </h2>
            @if (isset($subtitle))
              <p class="mt-1 text-xs text-gray-600">
                {{ __($subtitle) }}
              </p>
            @endif
          </div>
          <div>

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
                <form method="POST" action="{{ route('decks.destroy', $deck) }}">
                  @csrf
                  @method('delete')
                  <x-dropdown-link :href="route('decks.destroy', $deck)" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Delete') }}
                  </x-dropdown-link>
                </form>

              </x-slot>
            </x-dropdown>
          </div>

          </header>
      </section>

      {{ $slot }}
    </div>
  </div>
</div>
