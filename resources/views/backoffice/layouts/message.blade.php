<div class="flex justify-between p-4 -m-4 mb-6 bg-{{$color}}-500 text-white font-bodies leading-6" x-data="{showAlert: true}" x-show="showAlert">
    <span class="mx-auto">{{ $message }}</span>
    <button @click="showAlert = !showAlert" class="text-center focus:outline-none">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
</div>

