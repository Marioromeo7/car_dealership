@if ($message)
    <div 
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-4 left-1/2 transform -translate-x-1/2 
    bg-green-500 text-white px-4 py-2 rounded shadow-md"
    >
        {{ $message }}
    </div>
@endif
