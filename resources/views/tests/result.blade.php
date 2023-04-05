<x-app-layout>
  <x-slot name="header">
    <div class="flex justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Results') }}
        </h2>
      </div>
    </div>
  </x-slot>



  <div class="flex justify-center mx-auto sm:px-6 lg:px-8 ">
    <div class=" w-40 h-40 p-4 m-4 sm:p-8 bg-white  border border-red-500 rounded-full  ">
      <div class="flex justify-center w-full border-b-4 border-black">
        <div class="text-4xl font-medium text-gray-900" id="answers_count">
          {{ $test->answers_count }}
        </div>
      </div>
      <div class="flex justify-center ">
        <div class="text-4xl font-medium text-gray-900" id="card_count">
          {{ $test->card_count }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
