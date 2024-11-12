@extends('layouts.base')

@section('title', 'FAQ')




@section('content')
    <div class="flex flex-col gap-8 max-w-2xl items-center p-4 mx-auto mb-12 mt-32">
        <div class="flex flex-col gap-12 mb-16">
            <h1 class="text-6xl font-bold text-center">Whenime's frequently asked questions</h1>
            <div class="flex gap-12 justify-center">
                <x-cta-nav-link route="{{ route('contact') }}" class="font-bold"
                    text='Contact us<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="4 0 24 20" fill="none" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="bevel"><path d="M9 18l6-6-6-6"/></svg>' />
            </div>
        </div>

        {{-- Generate FAQ's --}}
        @foreach ($categories as $category)
            <div class="flex flex-col gap-4">
                <div class="flex justify-between">
                    <h1 class="text-2xl">{{ $category->name }}</h1>
                    @admin
                        <x-link route="{{ route('faq.edit', $category->name) }}" class="bg-white my-auto" text="Edit" />
                    @endadmin
                </div>
                @foreach ($category->questions as $question)
                    <x-accordion-item title="{{ $question->question }}" content="{{ $question->answer }}" />
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
