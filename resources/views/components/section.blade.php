@props(['title', 'subtitle'])

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

            {{ $menu }}
          </div>

          </header>
      </section>

      {{ $slot }}
    </div>
  </div>
</div>
