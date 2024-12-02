<form action="" class="flex flex-col gap-5">
    <div class="flex flex-col gap-2">
        <span class="label-text">Theme</span>
        <select class="w-full select select-bordered">
            <option selected>Light</option>
            <option>Dark</option>
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <span class="label-text">Timezone</span>
        <select class="w-full select select-bordered">
            <option selected>UTC</option>
            <option>GMT+1</option>
        </select>
    </div>

    <div class="flex flex-col gap-2">
        <span class="label-text">Time Format</span>
        <select class="w-full select select-bordered">
            <option selected>24-hour</option>
            <option>12-hour (AM/PM)</option>
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
</form>
