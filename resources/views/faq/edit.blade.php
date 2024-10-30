@extends('layouts.no-header')

@section('title', 'FAQ')




@section('content')
    <div class="flex flex-col gap-8 max-w-2xl items-center p-4 mx-auto mb-12 mt-32">
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
                    <div class="flex flex-col gap-4">
                        <span class="label-text">Category</span>
                        <div class="flex justify-between">
                            <input class="text-2xl input input-bordered" name="category_name"
                                value="{{ old('category_name', $current->name) }}" required/>
                        </div>
                        @foreach ($current->questions as $question)
                            <x-accordion-item-edit questionId="{{ $question->id }}" title="{{ $question->question }}"
                                content="{{ $question->answer }}" />
                        @endforeach
                        <div class="flex gap-2 justify-end">
                            <button type="submit"
                                class="btn btn-sm border-none bg-success hover:bg-success-hover text-white">Save</button>
                            <a href="{{ route('faq') }}" class="btn btn-sm border-none hover:bg-discard-hover hover:text-white">Discard</a>
                        </div>
                    </div>
                </form>
            @else
                {{-- Generate rest --}}
                <div class="flex flex-col gap-4">
                    <div class="flex justify-between">
                        <h1 class="text-2xl">{{ $current->name }}</h1>
                        @admin
                            <x-link route="{{ route('faq.edit', $current->name) }}" class="bg-white my-auto" text="Edit" />
                        @endadmin
                    </div>
                    @foreach ($current->questions as $question)
                        <x-accordion-item title="{{ $question->question }}" content="{{ $question->answer }}" />
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>
@endsection
