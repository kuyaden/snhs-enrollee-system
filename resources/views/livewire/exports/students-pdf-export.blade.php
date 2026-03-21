<div>
    <button 
        wire:click="export" 
        class="flex items-center gap-2 bg-green-600 hover:bg-green-700 
               text-white px-4 py-2 rounded-lg shadow-md transition duration-200"
    >
        <!-- Heroicon: Printer -->
        <svg xmlns="http://www.w3.org/2000/svg" 
             fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
             class="w-5 h-5">
            <path stroke-linecap="round" stroke-linejoin="round" 
                d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2m-4 0v4H10v-4h4z" />
        </svg>
        <span>Print</span>
    </button>
</div>
