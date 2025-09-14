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
                    <g fill="none" stroke="currentColor" stroke-width="1"><rect width="18.5" height="18.5" x="2.75" y="2.75" stroke-width="1.5" rx="6"/><path stroke-linecap="round" stroke-width="1.6" d="M7.672 16.222v-5.099m4.451 5.099V7.778m4.205 8.444V9.82"/></g>
                </svg>
                Dashboard
            </a>

            <!-- Bootcamp Management -->
            <div x-data="{ open: {{ request()->routeIs('admin.bootcamps*') || request()->routeIs('admin.batches*') ? 'true' : 'false' }} }">
                <button @click="open = !open" 
                        class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                    <div class="flex items-center">
                        <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                           <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M20 15c0 1.864 0 2.796-.304 3.53a4 4 0 0 1-2.165 2.165C16.796 21 15.864 21 14 21h-3c-3.772 0-5.658 0-6.83-1.172C3 18.657 3 16.771 3 13V7a4 4 0 0 1 4-4"/><path d="m10 8.5l.434 3.969a.94.94 0 0 0 .552.753c.686.295 1.971.778 3.014.778s2.328-.483 3.014-.778a.94.94 0 0 0 .553-.753L18 8.5m2.5-1v3.77M14 4L7 7l7 3l7-3z"/></g>
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
                                <g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="6" r="4"/><path stroke-linecap="round" d="M19.998 18q.002-.246.002-.5c0-2.485-3.582-4.5-8-4.5s-8 2.015-8 4.5S4 22 12 22c2.231 0 3.84-.157 5-.437"/></g>
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
                   <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007M8.625 10.5a.375.375 0 1 1-.75 0a.375.375 0 0 1 .75 0m7.5 0a.375.375 0 1 1-.75 0a.375.375 0 0 1 .75 0"/>
                </svg>
                Orders
            </a>

            <!-- Enrollments -->
            <a href="{{ route('admin.enrollments.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.enrollments*') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"><path d="M16.5 4H8a4 4 0 0 0-4 4v8.5a4 4 0 0 0 4 4h6.843a4 4 0 0 0 2.829-1.172l1.656-1.656a4 4 0 0 0 1.172-2.829V8a4 4 0 0 0-4-4"/><path d="M20.5 14H17a3 3 0 0 0-3 3v3.5M8 8h7.5M8 12h5"/></g>
                </svg>
                Enrollments
            </a>

            <!-- Certificates -->
            <a href="{{ route('admin.certificates.index') }}" 
               class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.certificates*') ? 'bg-indigo-100 text-indigo-700 border-r-2 border-indigo-500' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                   <g fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.5 22c-4.007 0-6.01 0-7.255-1.465C3 19.072 3 16.714 3 12s0-7.071 1.245-8.536S7.493 2 11.5 2s6.01 0 7.255 1.464c1.002 1.18 1.198 2.937 1.236 6.036M8 8h7m-7 5h3"/><path d="M19.61 18.105A3.375 3.375 0 0 0 17.625 12h-.251a3.375 3.375 0 0 0-1.984 6.105m4.218 0a3.36 3.36 0 0 1-1.984.645h-.25a3.36 3.36 0 0 1-1.984-.645m4.218 0l.583 1.835c.222.7.334 1.05.303 1.268c-.063.454-.433.79-.87.792c-.21 0-.524-.164-1.153-.494c-.27-.142-.404-.212-.542-.254a1.5 1.5 0 0 0-.86 0c-.138.042-.273.112-.542.254c-.629.33-.943.495-1.153.494c-.437-.002-.807-.338-.87-.792c-.03-.218.08-.568.303-1.268l.583-1.835"/></g>
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