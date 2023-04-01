<x-app-layout>
  <div x-data="{ open: false }">
    <button type="button" @click="open=true;$nextTick(() => { $refs.foo.focus(); });">Click Me!</button>
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
              Question
            </div>
            <div>
              <x-my-button @click="open=true; $nextTick(() => { $refs.foo.focus(); });">
                {{ __('Answer2') }}
              </x-my-button>

            </div>

          </div>

        </div>

      </div>

      <div x-show="open">

        <x-secondary-button x-ref="foo" @click="alert('boom')" type="button" href="#">Okas
        </x-secondary-button>
        <x-secondary-button @click="alert('boom')" type="button" href="#">Okay</x-secondary-button>
      </div>
    </div>
  </div>


</x-app-layout>
