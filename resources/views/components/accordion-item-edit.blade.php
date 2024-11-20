<span>Question</span>
<div class="bg-blue-100 rounded collapse collapse-open">
    <input type="hidden" name="questions[{{ $questionId }}][id]" value="{{ $questionId }}">
    <input name="questions[{{ $questionId }}][question]" class="text-xl font-medium rounded faq-question input input-bordered"
        value="{{ old('questions.' . $questionId . '.question', $title) }}" required " />
    <div class="flex flex-col collapse-content">
        <span>Answer:</span>
        <textarea cols="69" rows="5" name="questions[{{ $questionId }}][answer]"
            class="resize-none faq-answer textarea textarea-bordered" required>{{ old('questions.' . $questionId . '.answer', $content) }}</textarea>
    </div>
</div>
