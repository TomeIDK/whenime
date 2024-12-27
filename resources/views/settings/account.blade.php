<div class="flex flex-col gap-6">

    {{-- Email --}}
    <div class="flex flex-col gap-3">
        <span class="pb-2 border-b label-text text-muted">Email</span>
        <div class="flex justify-between">
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
            <a href="{{ route('settings.change-email') }}" class="btn btn-sm w-fit">Change Email</a>
        </div>
    </div>

    {{-- Password --}}
    <div class="flex flex-col gap-3">
        <span class="pb-2 border-b label-text text-muted">Password</span>
        <a href="{{ route('settings.change-password') }}" class="btn w-fit">
            Change Password</a>
    </div>
</div>
