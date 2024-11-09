@extends('layouts.admin')

@section('title', 'Manage FAQ')

@section('content')
    <div class="flex flex-col self-start w-full gap-4 px-24">
        <h1 class="text-4xl font-bold">Manage FAQ</h1>
        <div class="flex items-center justify-between">
            <p class="stat-desc">Retrieved {{ $faqs->count() }} categories and {{ $faqs->sum('questions_count') }} questions
            </p>
            <div class="flex gap-2">
                {{-- Buttons --}}
                <a onclick="showAddCategoryModal()"
                    class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <p>Add new category</p>
                </a>
                <a onclick="showAddQuestionModal()"
                    class="flex items-center gap-1 text-white border-none shadow-none bg-primary btn btn-sm hover:bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <p>Add new question</p>
                </a>
            </div>
        </div>
        <div class="w-full join join-vertical">
            @foreach ($faqs as $category)
                <div class="border collapse collapse-arrow join-item border-base-300">
                    <input type="radio" name="my-accordion-4" />
                    <div class="flex items-center justify-between gap-2 text-xl font-medium collapse-title">
                        <p>
                            {{ $category->name }}
                            ({{ $category->questions_count }})
                        </p>
                        <div class="z-[998]">
                            {{-- Edit Category --}}
                            <a href="{{ route('faq.edit', $category->name) }}"
                                class="bg-transparent border-none shadow-none btn btn-sm hover:bg-primary-hover-dark w-fit z-[999]">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polygon points="16 3 21 8 8 21 3 21 3 16 16 3"></polygon>
                                </svg>
                            </a>
                            {{-- Delete Category --}}
                            <button
                                class="bg-transparent border-none shadow-none btn btn-sm hover:bg-delete-hover w-fit z-[999]"
                                onclick="showDeleteCategoryModal({{ $category->id }})">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path
                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                    </path>
                                    <line x1="10" y1="11" x2="10" y2="17">
                                    </line>
                                    <line x1="14" y1="11" x2="14" y2="17">
                                    </line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="collapse-content">
                        <div>
                            <table class="table">
                                <!-- head -->
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->questions as $question)
                                        <!-- row -->
                                        <tr>
                                            <td>
                                                <p class="text-xs text-discard">{{ $question->id }}</p>
                                            </td>
                                            {{-- Question --}}
                                            <td>
                                                <p>{{ $question->question }}</p>
                                            </td>
                                            <td>
                                                <p class="overflow-hidden max-w-prose text-nowrap text-ellipsis">
                                                    {{ $question->answer }}
                                                </p>
                                            </td>
                                            <td>{{-- Actions --}}
                                                <div class="dropdown dropdown-end">
                                                    <div tabindex="0" role="button">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24" fill="none"
                                                            stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="1"></circle>
                                                            <circle cx="19" cy="12" r="1"></circle>
                                                            <circle cx="5" cy="12" r="1"></circle>
                                                        </svg>
                                                    </div>
                                                    <ul tabindex="0"
                                                        class="p-2 mt-3 shadow menu menu-sm dropdown-content z-[999] bg-base-100 rounded-box w-52">
                                                        <li class="mb-2 font-bold">Actions</li>
                                                        <li>
                                                            <a onclick="showUpdateQuestionModal({{ $question->id }}, {{ $question->faq_category_id }})"
                                                                class="justify-between mb-1">
                                                                Change category
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('faq.edit', $category->name) }}"
                                                                class="justify-between mb-1">
                                                                Edit
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button onclick="showDeleteQuestionModal({{ $question->id }})"
                                                                class="justify-between mb-1 hover:bg-red-500 hover:text-white hover:font-bold">
                                                                Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create New Category Modal -->
    <dialog id="add_category_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold">Create new category</h3>

            <form method="POST" action="{{ route('faq.storeCategory') }}">
                @csrf
                <!-- Name -->
                <div class="flex flex-col w-3/4 gap-1 m-auto">
                    <div class="label">
                        <span class="label-text">Category</span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <input type="text" name="name" class="border-none grow focus:ring-transparent"
                            placeholder="Category" value="{{ old('name') }}" required autofocus />
                    </label>
                    @error('name')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <button type="submit"
                        class="mt-6 text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Create
                        Category</button>
            </form>
        </div>
    </dialog>

    <!-- Create New Question Modal -->
    <dialog id="add_question_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold">Add new question</h3>

            <form method="POST" action="{{ route('faq.storeQuestion') }}">
                @csrf
                <div class="flex flex-col w-3/4 gap-1 m-auto">
                    <!-- Category -->
                    <div class="label">
                        <span class="label-text">Category</span>
                    </div>
                    <select name="faq_category_id" class="w-full select select-bordered" required autofocus>
                        @foreach ($faqs as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('faq_category_id')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror
                    <!-- Question -->
                    <div class="label">
                        <span class="label-text">Question</span>
                    </div>
                    <label class="flex items-center gap-2 input input-bordered">
                        <input type="text" name="question" class="border-none grow focus:ring-transparent"
                            placeholder="Question" value="{{ old('question') }}" required />
                    </label>
                    @error('question')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <!-- Answer -->
                    <div class="label">
                        <span class="label-text">Answer</span>
                    </div>
                    <textarea rows="5" name="answer" class="resize-none textarea textarea-bordered" placeholder="Answer"
                        required>{{ old('answer') }}</textarea>
                    @error('answer')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <button type="submit"
                        class="mt-6 text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Add
                        Question</button>
            </form>
        </div>
    </dialog>

    <!-- Change Question Category Modal -->
    <dialog id="update_question_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <form method="dialog">
                <button class="absolute btn btn-sm btn-circle btn-ghost right-2 top-2">✕</button>
            </form>
            <h3 class="text-2xl font-bold">Change question's category</h3>

            <form method="POST" action="{{ route('faq.updateQuestion', ['questionId' => ':id']) }}"
                id="update_question_form">
                @csrf
                @method('PATCH')
                <div class="flex flex-col w-3/4 gap-1 m-auto">
                    <!-- Category -->
                    <div class="label">
                        <span class="label-text">Category</span>
                    </div>
                    <select name="faq_category_id" class="w-full select select-bordered" required autofocus>
                        @foreach ($faqs as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('faq_category_id')
                        <span class="mt-2 text-red-500 label-text-alt">{{ $message }}</span>
                    @enderror

                    <button type="submit"
                        class="mt-6 text-white border-none outline-none btn btn-sm bg-success hover:bg-success-hover">Update
                        Question</button>
            </form>
        </div>
    </dialog>

    <!-- Delete Category Modal -->
    <dialog id="delete_category_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this category and its questions?
            </h3>
            <p class="underline text-discard">This action cannot be undone!</p>
            <div class="flex justify-center gap-4 modal-action">
                {{-- Delete Schedule Item --}}
                <form method="POST" action="{{ route('faq.destroyCategory', ':id') }}" id="delete_category_form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-white border-none outline-none btn btn-sm bg-delete hover:bg-delete-hover">Yes,
                        delete</button>
                </form>
                <form method="dialog">
                    <button class="text-white border-none btn btn-sm bg-discard hover:bg-discard-hover">No,
                        don't
                        delete</button>
                </form>
            </div>
        </div>
    </dialog>

    <!-- Delete Question Modal -->
    <dialog id="delete_question_modal" class="text-center modal modal-bottom sm:modal-middle">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-balance">Are you sure you want to delete this question?
            </h3>
            <p class="underline text-discard">This action cannot be undone!</p>
            <div class="flex justify-center gap-4 modal-action">
                {{-- Delete Schedule Item --}}
                <form method="POST" action="{{ route('faq.destroyQuestion', ':id') }}" id="delete_question_form">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-white border-none outline-none btn btn-sm bg-delete hover:bg-delete-hover">Yes,
                        delete</button>
                </form>
                <form method="dialog">
                    <button class="text-white border-none btn btn-sm bg-discard hover:bg-discard-hover">No,
                        don't
                        delete</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function showAddCategoryModal() {
            // Show the modal
            const modal = document.getElementById('add_category_modal');
            modal.showModal();
        }

        function showAddQuestionModal() {
            // Show the modal
            const modal = document.getElementById('add_question_modal');
            modal.showModal();
        }

        function showUpdateQuestionModal(questionId, categoryId) {
            // Populate the fields in the modal
            document.querySelector('#update_question_form [name="faq_category_id"]').value = categoryId;

            // Select the update form directly without using Blade syntax in the selector
            const updateForm = document.getElementById('update_question_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            updateForm.action = updateForm.action.replace(':id', questionId); // Replace ':id' with the actual ID

            // Show the modal
            const modal = document.getElementById('update_question_modal');
            modal.showModal();
        }

        function showDeleteCategoryModal(id) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_category_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', id); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_category_modal');
            modal.showModal();
        }

        function showDeleteQuestionModal(id) {
            // Select the delete form directly without using Blade syntax in the selector
            const deleteForm = document.querySelector('#delete_question_form');

            // Ensure that the action URL contains the placeholder ':id' before replacing
            if (deleteForm.action.includes(':id')) {
                deleteForm.action = deleteForm.action.replace(':id', id); // Replace ':id' with the actual ID
            }

            // Show the modal
            const modal = document.getElementById('delete_question_modal');
            modal.showModal();
        }
    </script>
@endsection
