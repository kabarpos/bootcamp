<section class="py-12 bg-background">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <x-public.section-title 
                subtitle="Community"
                title="Discussion Forum"
                description="Connect with fellow students and instructors."
            />
            <x-public.button href="#" variant="secondary">
                New Post
            </x-public.button>
        </div>
        
        <div class="mt-10">
            <div class="space-y-6">
                {{ $slot }}
            </div>
        </div>
    </div>
</section>