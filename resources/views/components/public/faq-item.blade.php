<div x-data="{ open: false }" class="border-b border-border">
    <button @click="open = !open" type="button" class="flex justify-between items-center w-full py-6 text-left text-foreground hover:text-primary transition-colors duration-300">
        <span class="text-lg font-medium">{{ $question }}</span>
        <svg x-show="!open" class="h-6 w-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        <svg x-show="open" class="h-6 w-6 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
        </svg>
    </button>
    <div x-show="open" x-collapse class="pb-6">
        <p class="text-base text-muted-foreground">
            {{ $answer }}
        </p>
    </div>
</div>