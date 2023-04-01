<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Need to put the Deck Name Here') }}
          {{ $count }}
        </h2>
      </div>
    </div>
  </x-slot>

  <div class="py-2" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
      <div class="p-4 sm:p-8 bg-white border border-purple-300  sm:rounded-lg">
        <section>
          <div class="flex justify-between border-b-2 border-purple-200">
            <div>
              <h2 class="text-lg font-medium text-gray-900">
                {{ __('Question') }}
              </h2>
            </div>
          </div>
        </section>
        <div class="flex justify-between m-3">
          <div>
            {{ $card->question }}
          </div>
          <div x-show="!open">
            <x-primary-button autofocus @click="open=true; $nextTick(() => { $refs.correct.focus(); });">
              {{ __('Answer') }}
            </x-primary-button>
          </div>
        </div>
      </div>
    </div>

    <div class="py-2" x-show="open" x-cloak>
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
        <div class="p-4 sm:p-8 bg-white border border-purple-300  sm:rounded-lg ">

          <section>
            <div class="flex justify-between border-b-2 border-purple-200">
              <div>
                <h2 class="text-lg font-medium text-gray-900">
                  {{ __('Answer') }}
                </h2>
              </div>
            </div>
          </section>

          <div class="m-3">
            {{ $card->answer }}
          </div>
        </div>
        <div class="flex justify-between p-4 sm:p-8 bg-white   ">

          <div>

            <x-answer x-ref="correct" :card="$card" :test="$test" answer="correct">Correct
            </x-answer>
          </div>
          <div>
            <x-answer :card="$card" :test="$test" answer="wrong">Wrong</x-answer>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-flash></x-flash>
</x-app-layout>
