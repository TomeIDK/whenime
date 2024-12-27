    <div class="flex items-center gap-1 ml-2">
        <img src="{{ asset('images/streaming_services/' . strtolower(str_replace('+', '', $service)) . '-logo.png') }}"
            class="w-4">
        <a href="{{ route('anime.show', $animeid) }}" class="hover:underline">{{ $name }}</a>
    </div>
