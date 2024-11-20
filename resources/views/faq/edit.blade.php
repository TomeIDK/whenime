@extends('layouts.no-header')

@section('title', 'FAQ')




@section('content')
    <div class="flex flex-col items-center max-w-2xl gap-8 p-4 mx-auto mt-32 mb-12">
        <div class="flex flex-col gap-12 mb-16">
            <h1 class="text-6xl font-bold text-center">Whenime's frequently asked questions</h1>
            <p></p>
        </div>

        {{-- Generate FAQ's --}}
        @foreach ($categories as $current)
            {{-- Make selected category editable --}}
            @if (Str::is($current->name, $category->name))
                <form method="POST" action="{{ route('faq.update', $category->name) }}">
                    @csrf
                    @method('PATCH')
                    <div class="flex flex-col gap-4" id="faqEditor"
                        data-original-state="{{ json_encode([
                            'category' => $current->name,
                            'questions' => $current->questions->map(
                                fn($q) => ['question' => $q->question, 'answer' => $q->answer], // store original data in data attribute as kvp for managing save button state
                            ),
                        ]) }}">
                        <span class="label-text">Category</span>
                        <div class="flex justify-between">
                            <input id="faqCategory" class="text-2xl input input-bordered" name="category_name"
                                value="{{ old('category_name', $current->name) }}" required />
                        </div>
                        @foreach ($current->questions as $question)
                            <x-accordion-item-edit questionId="{{ $question->id }}" title="{{ $question->question }}"
                                content="{{ $question->answer }}" />
                        @endforeach
                        <div class="flex justify-end gap-2">
                            <button type="submit" id="btnSave"
                                class="text-white border-none btn btn-sm bg-success hover:bg-success-hover"
                                disabled>Save</button>
                            <a href="{{ route('faq') }}"
                                class="border-none btn btn-sm hover:bg-discard-hover hover:text-white">Discard</a>
                        </div>
                    </div>
                </form>
            @else
                {{-- Generate rest --}}
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <h1 class="text-2xl">{{ $current->name }}</h1>
                        @admin
                            <x-link route="{{ route('faq.edit', $current->name) }}" class="my-auto bg-white" text="Edit" />
                        @endadmin
                    </div>
                    @foreach ($current->questions as $question)
                        <x-accordion-item title="{{ $question->question }}" content="{{ $question->answer }}" />
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const faqEditor = document.getElementById("faqEditor");
            const btnSave = document.getElementById("btnSave");

            if (faqEditor) {
                const original = JSON.parse(faqEditor.dataset.originalState);

                const category = document.getElementById("faqCategory");
                const questions = document.querySelectorAll(".faq-question");
                const answers = document.querySelectorAll(".faq-answer");

                const hasChanges = () => {
                    // Check if category has changed
                    if (category.value !== original.category) {
                        return true;
                    }

                    // Check if at least 1 q/a field has changed
                    return Array.from(questions).some((input, index) => {
                        return (
                            input.value !== original.questions[index].question ||
                            answers[index].value !== original.questions[index].answer
                        );
                    });
                };

                const inputs = [category, ...questions, ...answers];
                inputs.forEach((input) => {
                    input.addEventListener("input", () => {
                        btnSave.disabled = !hasChanges();
                    })
                });
            }
        });
    </script>
@endsection
