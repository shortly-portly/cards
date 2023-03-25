@if (session()->has('success'))
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
    class="fixed bg-purple-700 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    <p>
      {{ session('success') }}
    </p>
  </div>
@endif

@if ($errors->isNotEmpty())
  <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
    class="fixed bg-red-700 text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
    <p>
      Something Went Wrong!
    </p>
  </div>
@endif
