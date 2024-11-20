@extends('layouts.no-header')

@section('title', 'Edit News - ' . $currentNews->title)

@section('content')
    <div id="editor" class="drawer lg:drawer-open" data-original-state="{{ json_encode(['title' => $currentNews->title, 'content' => $currentNews->content]) }}">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col items-center gap-6 my-16 drawer-content">
            <!-- Page content -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
            <form method="POST" action="{{ route('news.update', $currentNews->id) }}" class="w-5/6"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Buttons --}}
                <div class="flex justify-end gap-2">
                    <button id="btnSave" type="submit" class="text-white border-none btn btn-sm bg-success hover:bg-success-hover"
                        disabled>Save</button>
                    <a href="{{ route('news.show', $currentNews->id) }}"
                        class="border-none btn btn-sm hover:bg-discard-hover hover:text-white">Discard</a>
                </div>

                {{-- Title --}}
                <div class="flex flex-col gap-2">
                    <span class="label-text">Title</span>
                    <input id="title" class="text-3xl font-bold input input-bordered" name="title"
                        value="{{ old('title', $currentNews->title) }}" required />
                    @error('title')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    {{-- Date Published --}}
                    <div class="flex gap-1 text-xs text-discard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        {{ date('d/m/Y', strtotime($currentNews->created_at)) }}
                    </div>

                    {{-- Image --}}
                    <div class="relative w-1/2 mt-4">
                        <div class="relative overflow-hidden rounded">
                            <img src="{{ $currentNews->image ? asset('storage/' . $currentNews->image) : 'https://placehold.co/700x400?text=Upload+Image' }}"
                                id="newsImage" class="object-cover">

                            <input type="file" id="news_image" name="image" accept="image/*" class="hidden"
                                onchange="previewImage(event)" />

                            <label for="news_image"
                                class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 rounded opacity-0 cursor-pointer hover:opacity-100">
                                <span class="text-sm text-white">Upload New Image</span>
                            </label>

                            <div class="absolute p-1 bg-white rounded-full shadow top-2 right-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    {{-- Content --}}
                    <span class="label-text">Content</span>
                    <textarea id="content" rows="25" name="content" class="textarea textarea-bordered" placeholder="Article content"
                        required>{{ old('content', $currentNews->content) }}</textarea>
                    @error('content')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </div>
        <div class="border-t shadow-md drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="min-h-full p-4 menu bg-background text-base-content w-80">
                <!-- Sidebar  -->
                @foreach ($newsItems as $item)
                    @if ($item->id == $currentNews->id)
                        <li class="my-1"><a class="font-bold text-white bg-primary hover:bg-primary-hover-dark"
                                href="{{ route('news.edit', $item->id) }}">{{ $item->title }}</a></li>
                    @else
                        <li class="my-1"><a href="{{ route('news.edit', $item->id) }}">{{ $item->title }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        const btnSave = document.getElementById("btnSave");
        const inputTitle = document.getElementById("title");
        const inputContent = document.getElementById("content");
        let imageChanged = false;

        inputTitle.addEventListener('input', () => {
            btnSave.disabled = !hasChanged();
        });

        inputContent.addEventListener('input', () => {
            btnSave.disabled = !hasChanged();
        });

        function previewImage(event) {
            const file = event.target.files[0];
            const img = document.getElementById('newsImage');
            const inputImage = document.getElementById("news_image");

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result; // Set the image source to the uploaded file
                }
                reader.readAsDataURL(file); // Read the file as a data URL
            }

            imageChanged = inputImage.files.length > 0;
            btnSave.disabled = !hasChanged();
        }

        function hasChanged() {
            const editor = document.getElementById("editor")
            const original = JSON.parse(editor.dataset.originalState);

            const title = document.getElementById("title");
            const content = document.getElementById("content");

            if (imageChanged) {
                return true;
            }

            if (title.value !== original.title) {
                return true;
            }
            if (content.value !== original.content) {
                return true;
            }
        }
    </script>
@endsection
