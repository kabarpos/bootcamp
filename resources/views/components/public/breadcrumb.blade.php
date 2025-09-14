<nav class="bg-card/80 backdrop-blur-sm border-b border-border" aria-label="Breadcrumb">
    <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 lg:px-8">
        <ol class="flex items-center space-x-2 text-sm">
            @foreach($items as $item)
                @if(!$loop->last)
                    <li>
                        <div class="flex items-center">
                            <a href="{{ $item['url'] }}" class="text-muted-foreground hover:text-foreground transition-colors duration-300">{{ $item['label'] }}</a>
                            <svg class="flex-shrink-0 h-5 w-5 text-muted-foreground ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </li>
                @else
                    <li>
                        <div class="flex items-center">
                            <span class="text-foreground font-medium">{{ $item['label'] }}</span>
                        </div>
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>