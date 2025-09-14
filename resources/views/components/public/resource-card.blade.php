<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                @if($type === 'video')
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-300">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v8a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z" />
                    </svg>
                </div>
                @elseif($type === 'document')
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                </div>
                @elseif($type === 'link')
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-300">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                </div>
                @else
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-300">
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd" />
                        <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V7z" />
                    </svg>
                </div>
                @endif
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-foreground">{{ $title }}</h3>
                <p class="mt-1 text-sm text-muted-foreground">{{ $description }}</p>
            </div>
        </div>
    </div>
    <div class="px-6 py-4 bg-card/50 border-t border-border">
        <div class="flex justify-between items-center">
            <span class="text-sm text-muted-foreground">{{ $size }}</span>
            <a href="{{ $link ?? '#' }}" class="text-sm font-medium text-primary hover:text-primary/80 transition-colors duration-300">
                {{ $actionText ?? 'Download' }}
                <svg class="inline-block h-4 w-4 ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>