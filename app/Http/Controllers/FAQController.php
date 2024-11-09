<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use App\Models\FAQQuestion;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class FAQController extends Controller
{
    public function index(){
        $categories = FAQCategory::with('questions')->get();
        return view('faq.index', compact('categories'));
    }

    public function indexAdmin() {
        $faqs = FAQCategory::with('questions')->withCount('questions')->get();
        return view('admin.faq', compact('faqs'));
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required', 'string', 'max:255'
        ]);

        FAQCategory::create([
            'name' => $request->name
        ]);

        return Redirect::route('faq.admin')->with('success', 'Category created successfully');
    }

    public function storeQuestion(Request $request): RedirectResponse
    {
        $request->validate([
            'faq_category_id' => 'required', 'integer', 'exists:faq_categories,id',
            'question' => 'required', 'string', 'min:5', 'max:255',
            'answer' => 'required', 'string', 'min:2'
        ]);

        FAQQuestion::create([
            'faq_category_id' => $request->faq_category_id,
            'question' => $request->question,
            'answer' => $request->answer
        ]);

        return Redirect::route('faq.admin')->with('success', 'Question added successfully');
    }

    public function edit(FAQCategory $category){
        $categories = FAQCategory::with('questions')->get();
        return view('faq.edit', compact('categories', 'category'));
    }

    public function update(Request $request, FAQCategory $category): RedirectResponse
    {
        // Validate request
        $request->validate([
            "category_name" => "required", "string", "max:255",
            "questions.*.question" => "required", "string", "min:5", "max:255",
            "questions.*.answer" => "required", "string", "min:2"
        ]);

        $category->name = $request->input('category_name');
        $category->save();

        // Update questions
        foreach ($request->input('questions') as $questionData) {
            $question = FAQQuestion::find($questionData['id']);
            if ($question) {
                $question->question = $questionData['question'];
                $question->answer = $questionData['answer'];
                $question->save();
            }
        }

        return Redirect::route('faq')->with('success', 'FAQ updated successfully!');

    }

    public function updateQuestion(Request $request, $questionId): RedirectResponse
    {
        $request->validate([
            'faq_category_id' => 'required', 'integer', 'exists:faq_categories,id'
        ]);
        $question = FAQQuestion::findOrFail($questionId);
        $question->faq_category_id = $request->faq_category_id;

        $question->save();

        return Redirect::route('faq.admin')->with('success', 'Question category updated successfully');
    }

    public function destroyCategory($id): RedirectResponse
    {
        $category = FAQCategory::findOrFail($id);
        $category->delete();

        return Redirect::route('faq.admin')->with('success', 'Category deleted successfully');
    }

        public function destroyQuestion($id): RedirectResponse
    {
        $question = FAQQuestion::findOrFail($id);
        $question->delete();
        
        return Redirect::route('faq.admin')->with('success', 'Question deleted successfully');
    }
}
