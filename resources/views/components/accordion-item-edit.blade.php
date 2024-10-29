<span>Question</span>
<div class="collapse collapse-open rounded bg-blue-100">
    <input type="hidden" name="questions[{{ $questionId }}][id]" value="{{ $questionId }}">
    <input name="questions[{{ $questionId }}][question]" class="text-xl font-medium input input-bordered rounded"
        value="{{ old('questions.' . $questionId . '.question', $title) }}" required " />
    <div class="collapse-content flex flex-col">
        <span>Answer:</span>
        <textarea cols="69" rows="5" name="questions[{{ $questionId }}][answer]"
            class="textarea textarea-bordered resize-none" required>{{ old('questions.' . $questionId . '.answer', $content) }}</textarea>
    </div>
</div>
