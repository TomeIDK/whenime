<form action="{{ route('settings.update') }}" method="POST" class="flex flex-col gap-5">
    @csrf
    @method('PATCH')
    <div class="flex flex-col gap-2">
        <span class="label-text">Theme</span>
        <select name="theme" class="w-full select select-bordered">
            <option value="light" {{ $settings->theme == 'light' ? 'selected' : '' }}>Light</option>
            <option value="dark" {{ $settings->theme == 'dark' ? 'selected' : '' }}>Dark</option>
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <span class="label-text">Timezone</span>
        <select name="timezone" class="w-full select select-bordered">
            @foreach ($timezones as $key => $timezone)
                @if ($key == $settings->timezone)
                    <option value="{{ $key }}" selected>{{ $key }} ({{ $timezone }})</option>
                @else
                    <option value="{{ $key }}">{{ $key }} ({{ $timezone }})</option>
                @endif
            @endforeach
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <span class="label-text">Time Format</span>
        <select name="time_format" class="w-full select select-bordered">
            <option value="24h" {{ $settings->time_format == '24h' ? 'selected' : '' }}>24-hour</option>
            <option value="12h" {{ $settings->time_format == '12h' ? 'selected' : '' }}>12-hour (AM/PM)</option>
        </select>
    </div>

    <div class="flex items-center justify-between gap-1 p-4 border rounded">
        <div>
            <h3 class="text-lg font-medium">Airing Notifications</h3>
            <h4 class="text-sm text-discard">Receive a notification when an anime on your list is about to air</h4>
        </div>
        <input type="checkbox" class="toggle toggle-primary" checked="checked" />
    </div>

    <div class="flex items-center justify-between gap-1 p-4 border rounded">
        <div>
            <h3 class="text-lg font-medium">News Notifications</h3>
            <h4 class="text-sm text-discard">Receive email notifications for important updates and reminders</h4>
        </div>
        <input type="checkbox" class="toggle toggle-primary" />
    </div>

    <button type="submit"
        class="self-end px-6 text-white border-none outline-none btn bg-primary hover:bg-primary-hover-dark w-fit btn-sm">Save
    </button>

    @if ($errors->any())
    <div class="alert alert-error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</form>
