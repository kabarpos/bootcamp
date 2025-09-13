<aside class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
       :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }">
    <!-- Sidebar header -->
    <div class="flex items-center justify-between h-16 px-6 bg-indigo-600">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <img class="h-8 w-8" src="{{ asset('images/logo.svg') }}" alt="Logo">
            </div>
            <div class="ml-3">
                <h1 class="text-xl font-semibold text-white">Admin Panel</h1>
            </div>
        </div>
        <button @click="sidebarOpen = false" class="lg:hidden text-white hover:text-gray-300">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="mt-8 px-4">
        <div class="space-y-2">
            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z" />
                </svg>
                Dashboard
            </a>

            <!-- Bootcamp Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.bootcamps*') || request()->routeIs('admin.batches*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        Bootcamp
                    </div>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-2 space-y-1">
                    <a href="{{ route('admin.bootcamps.index') }}" 
                       class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.bootcamps*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Kelola Bootcamp
                    </a>
                    <a href="{{ route('admin.batches.index') }}" 
                       class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.batches*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Kelola Batch
                    </a>
                </div>
            </div>

            <!-- User Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.users*') || request()->routeIs('admin.roles*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        User Management
                    </div>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-transition class="ml-6 mt-2 space-y-1">
                    <a href="{{ route('admin.users.index') }}" 
                       class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Kelola User
                    </a>
                    <a href="{{ route('admin.roles.index') }}" 
                       class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.roles*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-600 hover:bg-gray-50' }}">
                        Kelola Role
                    </a>
                </div>
            </div>

            <!-- Orders -->
            <a href="{{ route('admin.orders.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.orders*') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                Orders
            </a>

            <!-- Enrollments -->
            <a href="{{ route('admin.enrollments.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.enrollments*') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                Enrollments
            </a>

            <!-- Certificates -->
            <a href="{{ route('admin.certificates.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.certificates*') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                </svg>
                Certificates
            </a>
        </div>
    </nav>

    <!-- Sidebar footer -->
    <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
        <div class="flex items-center">
            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
            <div class="ml-3">
                <p class="text-sm font-medium text-gray-700">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">Administrator</p>
            </div>
        </div>
    </div>
</aside>