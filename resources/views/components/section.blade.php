@props(['title', 'subtitle'])

<div class="py-2">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white border border-purple-300 drop-shadow sm:rounded-lg">
      <div class="max-w-xl">
        <section>
          <header>
            <h2 class="text-lg font-medium text-gray-900">
              {{ __($title) }}
            </h2>
            @if (isset($subtitle))
              <p class="mt-1 text-sm text-gray-600">
                {{ __($subtitle) }}
              </p>
            @endif
          </header>
        </section>
      </div>
      {{ $slot }}
    </div>
  </div>
</div>
