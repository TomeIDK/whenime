<div class="flex flex-col gap-8">

    {{-- Password --}}
    <div class="flex flex-col gap-3">
        <span class="pb-2 border-b label-text text-muted">Password</span>
        <a href="{{ route('settings.change-password') }}" class="rounded-md btn w-fit">
            Change Password</a>
    </div>

    {{-- Email --}}
    <div class="flex flex-col gap-3">
        <span class="pb-2 border-b label-text text-muted">Email</span>
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <p>{{ Auth::user()->email }}</p>
                @if (Auth::user()->email_verified_at)
                    <div class="text-white badge badge-primary bg-primary">Verified</div>
                @else
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit">
                            <div class="badge badge-neutral">Verify Email</div>
                        </button>
                    </form>
                @endif
            </div>
            <button class="border border-black rounded-md btn-sm w-fit">Change Email</button>
        </div>
    </div>

    {{-- Delete Account --}}
        <button class="self-end justify-end text-white border rounded-md bg-delete btn w-fit">Delete Account</button>
</div>
