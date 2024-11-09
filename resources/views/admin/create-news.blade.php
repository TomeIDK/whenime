@extends('layouts.admin')

@section('title', 'Create News Item')

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="flex flex-col items-center gap-6 my-16 drawer-content">
            <!-- Page content -->
            <label for="my-drawer-2" class="btn btn-primary drawer-button lg:hidden">
                Open drawer
            </label>
            <form method="POST" action="{{ route('news.store') }}" class="w-5/6"
                enctype="multipart/form-data">
                @csrf

                {{-- Buttons --}}
                <div class="flex justify-end gap-2">
                    <button type="submit"
                        class="text-white border-none btn btn-sm bg-success hover:bg-success-hover">Save</button>
                    <a href="{{ route('news.admin') }}"
                        class="border-none btn btn-sm hover:bg-discard-hover hover:text-white">Discard</a>
                </div>

                {{-- Title --}}
                <div class="flex flex-col gap-2">
                    <span class="label-text">Title</span>
                    <input class="text-3xl font-bold input input-bordered" name="title"
                        value="{{ old('title') }}" required />
                    @error('title')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    {{-- Image --}}
                    <div class="relative w-1/2 mt-4">
                        <div class="relative overflow-hidden rounded">
                            <img src="https://placehold.co/700x400?text=Upload+Image" id="newsImage" class="object-cover">

                            <input type="file" id="news_image" name="image" accept="image/*" class="hidden"
                                onchange="previewImage(event)"/>

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
                    <textarea rows="25" name="content" class="textarea textarea-bordered" placeholder="Article content" required>{{ old('content') }}</textarea>
                    @error('content')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror
                </div>
            </form>
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