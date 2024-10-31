<div class="flex flex-col w-5/6 gap-2">
    @admin
        <x-link route="{{ route('news.edit', $id) }}" class="bg-white my-auto w-fit" text="Edit" />
    @endadmin
    <h1 class="text-3xl font-bold">{{ $title }}</h1>
    <div class="text-discard text-xs flex gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
        </svg>
        {{ $publishedDate }}
    </div>
    <img src="{{ $src }}" class="rounded object-cover w-1/2 mt-4">
    <p class="text-pretty">{{ $content }}</p>
</div>
