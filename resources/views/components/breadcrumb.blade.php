@props(['items' => []])

<nav class="flex" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-2">
        <!-- Home/Dashboard -->
        <li>
            <div>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-500">
                    <svg class="flex-shrink-0 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                    </svg>
                    <span class="sr-only">Dashboard</span>
                </a>
            </div>
        </li>

        @if(count($items) > 0)
            @foreach($items as $index => $item)
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if($index === count($items) - 1)
                            <!-- Last item (current page) -->
                            <span class="ml-2 text-sm font-medium text-gray-500">{{ $item['title'] }}</span>
                        @else
                            <!-- Intermediate items -->
                            <a href="{{ $item['url'] ?? '#' }}" class="ml-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $item['title'] }}
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        @else
            <!-- Auto-generate breadcrumb based on current route -->
            @php
                $routeName = request()->route()->getName();
                $segments = explode('.', $routeName);
                $breadcrumbs = [];
                
                if (count($segments) >= 2) {
                    // Remove 'admin' prefix
                    array_shift($segments);
                    
                    $currentPath = 'admin';
                    foreach ($segments as $index => $segment) {
                        $currentPath .= '.' . $segment;
                        
                        // Skip 'index', 'create', 'edit', 'show' for cleaner breadcrumb
                        if (!in_array($segment, ['index', 'create', 'edit', 'show'])) {
                            $title = ucfirst(str_replace('-', ' ', $segment));
                        $routeName = $currentPath . '.index';
                        $breadcrumbs[] = [
                            'title' => $title,
                            'url' => ($index < count($segments) - 1 && Route::has($routeName)) ? route($routeName) : null
                        ];
                        }
                    }
                    
                    // Add action-specific breadcrumb
                    $lastSegment = end($segments);
                    if (in_array($lastSegment, ['create', 'edit', 'show'])) {
                        $actionTitles = [
                            'create' => 'Tambah Baru',
                            'edit' => 'Edit',
                            'show' => 'Detail'
                        ];
                        $breadcrumbs[] = [
                            'title' => $actionTitles[$lastSegment],
                            'url' => null
                        ];
                    }
                }
            @endphp
            
            @foreach($breadcrumbs as $index => $breadcrumb)
                <li>
                    <div class="flex items-center">
                        <svg class="flex-shrink-0 h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        @if($index === count($breadcrumbs) - 1 || !$breadcrumb['url'])
                            <!-- Last item (current page) -->
                            <span class="ml-2 text-sm font-medium text-gray-500">{{ $breadcrumb['title'] }}</span>
                        @else
                            <!-- Intermediate items -->
                            <a href="{{ $breadcrumb['url'] }}" class="ml-2 text-sm font-medium text-gray-500 hover:text-gray-700">
                                {{ $breadcrumb['title'] }}
                            </a>
                        @endif
                    </div>
                </li>
            @endforeach
        @endif
    </ol>
</nav>
