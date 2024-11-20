@extends('layouts.no-header')

@section('title', 'Edit ' . $user->username . (strtolower(substr($user->username, strlen($user->username) - 1)) == 's' ?
    "'" : "'s") . ' profile')

@section('content')
    <form method="POST" action="{{ route('profile.update', $user->username) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div id="editor" class="flex flex-row justify-center w-full h-full gap-16 p-8 grow"
            data-original-state="{{ json_encode(['about' => $user->about]) }}">
            <div class="flex flex-col gap-2">
                <div class="relative avatar">
                    <div class="relative overflow-hidden rounded w-96">

                        <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/profile_pictures/default-profile-picture.jpg') }}"
                            id="profileImage" class="object-cover w-full h-full" />

                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden"
                            onchange="previewImage(event)" />

                        <label for="profile_picture"
                            class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 bg-black bg-opacity-50 rounded opacity-0 cursor-pointer hover:opacity-100">
                            <span class="text-sm text-white">Upload New Profile Picture</span>
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
                @error('profile_picture')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
                <div class="flex justify-between text-discard">
                    @if ($user->date_of_birth)
                        <div class="flex items-center gap-1">

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-balloon" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 9.984C10.403 9.506 12 7.48 12 5a4 4 0 0 0-8 0c0 2.48 1.597 4.506 4 4.984M13 5c0 2.837-1.789 5.227-4.52 5.901l.244.487a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3 3 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.244-.487C4.789 10.227 3 7.837 3 5a5 5 0 0 1 10 0m-6.938-.495a2 2 0 0 1 1.443-1.443C7.773 2.994 8 2.776 8 2.5s-.226-.504-.498-.459a3 3 0 0 0-2.46 2.461c-.046.272.182.498.458.498s.494-.227.562-.495" />
                            </svg>
                            <p>{{ date('F j', strtotime($user->date_of_birth)) }}</p>
                        </div>
                    @endif
                    <div class="flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="#6b7280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <p>
                            Joined {{ date('F j, Y', strtotime($user->created_at)) }}
                        </p>
                    </div>
                </div>

                <x-cta-button id="btnSave" class="self-center w-full mt-3 text-white bg-success hover:bg-success-hover"
                    text="Save Profile" />
                <a href="{{ route('profile', $user->username) }}"
                    class="border-none btn hover:bg-discard-hover hover:text-white">Discard</a>
            </div>

            <div class="flex flex-col w-1/2 gap-2">
                <h1 class="text-2xl font-bold text-primary">
                    {{ $user->username . (strtolower(substr($user->username, strlen($user->username) - 1)) == 's' ? "'" : "'s") }}
                    profile</h1>
                <div class="label">
                    <span class="label-text">About {{ $user->username }}</span>
                    <span id="char-track" class="label-text-alt text-primary"><span
                            id="char-count">{{ 2000 - strlen($user->about) }}</span> characters left</span>
                </div>
                <textarea id="about" rows="25" name="about" class="resize-none textarea textarea-bordered"
                    placeholder="Write something about yourself" oninput="updateCharacterCount()">{{ old('about', $user->about) }}</textarea>
                @error('about')
                    <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </form>
    <script>
        const btnSave = document.getElementById("btnSave");
        btnSave.disabled = true;
        let imageChanged = false;

        function previewImage(event) {
            const file = event.target.files[0];
            const img = document.getElementById('profileImage');
            const inputImage = document.getElementById("profile_picture");

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

        function updateCharacterCount() {
            const aboutInput = document.getElementById("about").value;
            const charCount = document.getElementById("char-count");
            const charTrack = document.getElementById("char-track");

            const remainingCharacters = 2000 - aboutInput.length;
            charCount.textContent = remainingCharacters;

            if (remainingCharacters < 0) {
                charTrack.style.color = "#EF4444";
            } else if (remainingCharacters <= 200 && remainingCharacters > 0) {
                charTrack.style.color = "#FFA500";
            } else {
                charTrack.style.color = "#4A90E2";
            }

            btnSave.disabled = !hasChanged();

        }

        function hasChanged() {
            const editor = document.getElementById("editor")
            const original = JSON.parse(editor.dataset.originalState);

            const about = document.getElementById("about");

            if (imageChanged) {
                return true;
            }

            if (about.value !== original.about) {
                return true;
            }
        }
    </script>
@endsection
