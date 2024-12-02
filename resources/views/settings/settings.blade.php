@extends('layouts.base')

@section('title', 'Settings')

@section('content')
    <div class="mx-64 my-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-bold">Settings</h1>
            <h2 class="text-base text-discard">Manage your account settings and preferences</h2>
            <form method="GET" action="{{ route('settings') }}"
                class="flex p-1 my-4 rounded justify-evenly text-text bg-muted bg-opacity-10">
                <button type="submit" name="section" value="preferences"
                    class="w-full p-1 font-medium {{ $section == 'preferences' ? 'settings-active' : 'text-muted' }}">
                    Preferences
                </button>
                <button type="submit" name="section" value="account"
                    class="w-full p-1 font-medium {{ $section == 'account' ? 'settings-active' : 'text-muted' }}">
                    Account
                </button>
            </form>

            @if ($section == 'account')
                @include('settings.account')
            @elseif ($section == 'preferences')
                @include('settings.preferences')
            @endif
        </div>
    </div>
@endsection
