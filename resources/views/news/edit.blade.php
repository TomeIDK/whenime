@extends('layouts.no-header')

@section('title', 'Edit News - ' . $currentNews->title)

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col gap-6 my-16 items-center">
            <!-- Page content -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
            <form method="POST" action="{{ route('news.update', $currentNews->id) }}" class="w-5/6"
                enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                {{-- Buttons --}}
                <div class="flex gap-2 justify-end">
                    <button type="submit"
                        class="btn btn-sm border-none bg-success hover:bg-success-hover text-white">Save</button>
                    <a href="{{ route('news.show', $currentNews->id) }}"
                        class="btn btn-sm border-none hover:bg-discard-hover hover:text-white">Discard</a>
                    <a class="btn btn-sm border-none bg-delete hover:bg-delete-hover text-white"
                        onclick="my_modal_5.showModal()">Delete</a>
                </div>

                {{-- Title --}}
                <div class="flex flex-col gap-2">
                    <span class="label-text">Title</span>
                    <input class="text-3xl input input-bordered font-bold" name="title"
                        value="{{ old('title', $currentNews->title) }}" required />
                    @error('title')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    {{-- Date Published --}}
                    <div class="text-discard text-xs flex gap-1">
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
                    <div class="relative mt-4 w-1/2">
                        <div class="rounded overflow-hidden relative">
                            <img src="{{ asset('storage/' . $currentNews->image) }}" id="newsImage" class="object-cover">

                            <input type="file" id="news_image" name="image" accept="image/*" class="hidden"
                                onchange="previewImage(event)" />

                            <label for="news_image"
                                class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 rounded transition-opacity duration-300 opacity-0 hover:opacity-100 cursor-pointer">
                                <span class="text-white text-sm">Upload New Image</span>
                            </label>

                            <div class="absolute top-2 right-2 bg-white rounded-full p-1 shadow">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror

                    {{-- Content --}}
                    <span class="label-text">Content</span>
                    <textarea rows="25" name="content" class="textarea textarea-bordered" placeholder="Article content" required>{{ old('content', $currentNews->content) }}</textarea>
                    @error('content')
                        <span class="text-red-500 mt-2 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>
            </form>

            <!-- Delete Confirmation Modal -->
            <dialog id="my_modal_5" class="modal modal-bottom sm:modal-middle text-center">
                <div class="modal-box">
                    <h3 class="text-lg font-bold">Are you sure you want to delete this news item?</h3>
                    <p class="text-discard underline">This action cannot be undone!</p>
                    <div class="modal-action flex gap-4 justify-center">
                        {{-- Delete News Item --}}
                        <form method="POST" action="{{ route('news.destroy', $currentNews->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="btn btn-sm border-none bg-delete hover:bg-delete-hover text-white outline-none">Yes,
                                delete</button>
                        </form>
                        <form method="dialog">
                            <button class="btn btn-sm border-none bg-discard text-white hover:bg-discard-hover">No, don't
                                delete</button>
                        </form>

                    </div>
                </div>
            </dialog>
            
        </div>
        <div class="drawer-side shadow-md border-t">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-background text-base-content min-h-full w-80 p-4">
                <!-- Sidebar  -->
                @foreach ($newsItems as $item)
                    @if ($item->id == $currentNews->id)
                        <li class="my-1"><a class="bg-primary text-white font-bold hover:bg-primary-hover-dark"
                                href="{{ route('news.edit', $item->id) }}">{{ $item->title }}</a></li>
                    @else
                        <li class="my-1"><a href="{{ route('news.edit', $item->id) }}">{{ $item->title }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const img = document.getElementById('newsImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    img.src = e.target.result; // Set the image source to the uploaded file
                }
                reader.readAsDataURL(file); // Read the file as a data URL
            }
        }
    </script>
@endsection
