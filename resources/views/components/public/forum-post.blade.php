<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg p-6 shadow-sm hover:shadow-md transition-shadow duration-300">
    <div class="flex items-start">
        <img class="h-10 w-10 rounded-full" src="{{ $avatar }}" alt="{{ $author }}">
        <div class="ml-4">
            <div class="flex items-center">
                <h4 class="text-lg font-medium text-foreground">{{ $author }}</h4>
                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                    {{ $category }}
                </span>
            </div>
            <p class="text-sm text-muted-foreground">{{ $postedAt }}</p>
            <h3 class="mt-2 text-xl font-semibold text-foreground">{{ $title }}</h3>
            <p class="mt-2 text-muted-foreground">
                {{ $excerpt }}
            </p>
            <div class="mt-4 flex items-center">
                <span class="inline-flex items-center text-sm text-muted-foreground">
                    <svg class="mr-1.5 h-5 w-5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                        <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                    </svg>
                    {{ $replies }} replies
                </span>
                <span class="ml-4 inline-flex items-center text-sm text-muted-foreground">
                    <svg class="mr-1.5 h-5 w-5 text-muted-foreground" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                    </svg>
                    {{ $likes }} likes
                </span>
            </div>
        </div>
    </div>
</div>