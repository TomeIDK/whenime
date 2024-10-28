@extends('layouts.guest')

@section('title', 'FAQ')

@section('header')
    @include('components.menu')
@endsection


@section('content')
    <div class="flex flex-col gap-8 max-w-2xl items-center p-4 mx-auto mb-12 mt-32">
        <div class="flex flex-col gap-12 mb-16">
            <h1 class="text-6xl font-bold text-center">Whenime's frequently asked questions</h1>
        </div>


        {{-- General Information --}}
        <div class="flex flex-col gap-4">
            <span class="label-text">Category</span>
            <div class="flex justify-between">
                <input class="text-2xl input input-bordered" value="General Information" value="{{ old('question') }}" />
                @admin
                    <x-link route="{{ route('faq') }}" class="bg-white my-auto" text="Edit" />
                @endadmin
            </div>
            <x-accordion-item-edit questionId="1" title="What is Whenime?"
                content="Whenime is a personalized anime tracking website that helps users keep track of their favorite anime series, including airing times and streaming platforms. Users can create their own weekly calendars to stay updated on their anime schedule." />
            <x-accordion-item-edit questionId="2" title="Is Whenime free to use?"
                content="Yes, Whenime is completely free to use. You can track your anime without any subscription fees or hidden costs." />
            <div class="flex gap-2 justify-end">
                <button class="btn btn-sm border-none bg-success hover:bg-success-hover text-white btn-disabled">Save</button>
                <button class="btn btn-sm border-none hover:bg-discard-hover hover:text-white">Discard</button>
            </div>
        </div>

        {{-- Account Management --}}
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <h1 class="text-2xl">Account Management</h1>
                @admin
                    <x-link route="{{ route('faq') }}" class="bg-white my-auto" text="Edit" />
                @endadmin
            </div>

            <x-accordion-item title="How do I create an account on Whenime?"
                content="To create an account, click on the 'Get Started' or 'Register' button on the homepage. Fill out the registration form with your details, including your username, email address, and password. Once you submit the form, you'll receive a confirmation email to verify your account." />
            <x-accordion-item title="Can I reset my password?"
                content="Yes, if you forget your password, you can click on the 'Forgot Password?' link on the login page. Enter your account's email address, and you'll receive instructions to reset your password." />
        </div>

        {{-- Using the Platform --}}
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <h1 class="text-2xl">Using the Platform</h1>
                @admin
                    <x-link route="{{ route('faq') }}" class="bg-white my-auto" text="Edit" />
                @endadmin
            </div>
            <x-accordion-item title="How do I add anime to my calendar?"
                content="You can add anime to your calendar by searching for a title using the search bar. If the anime is found, you can customize the airing time and streaming platform. If the anime is not available, you can manually add it, and it will only be visible to you." />
            <x-accordion-item title="Can I edit the airing time or streaming platform of an anime?"
                content="Yes, if you have added an anime from the search results, you can modify the airing time to match your timezone and select the streaming platform. The title, description, and cover image will remain unchanged." />
        </div>

        {{-- Functionality and Features --}}
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <h1 class="text-2xl">Functionality and Features</h1>
                @admin
                    <x-link route="{{ route('faq') }}" class="bg-white my-auto" text="Edit" />
                @endadmin
            </div>
            <x-accordion-item title="Can I share my calendar with others?"
                content="Currently, Whenime does not support sharing calendars with other users. However, you can manually share your schedule by exporting it or taking screenshots." />
            <x-accordion-item title="What should I do if I encounter an issue?"
                content="If you experience any issues while using Whenime, please contact support through the 'Contact Us' page. Provide as much detail as possible, and I will assist you as soon as I can." />
        </div>

        {{-- User Experience --}}
        <div class="flex flex-col gap-4">
            <div class="flex justify-between">
                <h1 class="text-2xl">User Experience</h1>
                @admin
                    <x-link route="{{ route('faq') }}" class="bg-white my-auto" text="Edit" />
                @endadmin
            </div>
            <x-accordion-item title="Will Whenime have mobile support?"
                content="Yes, Whenime is designed to be responsive and can be accessed on mobile devices. You can track your anime on the go from your smartphone or tablet." />
            <x-accordion-item title="How can I provide feedback or suggestions?"
                content="We welcome your feedback! You can provide suggestions through the 'Feedback' section on our website, or contact us directly via email. Your input helps us improve Whenime for all users." />
        </div>
    </div>
@endsection
