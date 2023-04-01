@props(['card', 'test', 'answer'])

<form method="post" action="{{ route('answer.store', $test) }}">
  @csrf
  <x-text-input id="answer" name="answer" type="hidden" hidden value="{{ $answer }}" />
  <x-text-input id="card" name="card" type="hidden" hidden value="{{ $card->id }}" />
  <x-primary-button {{ $attributes->merge([]) }}>
    {{ $slot }}
  </x-primary-button>
</form>
