<?php

namespace App\Http\Controllers;

use App\Models\FAQCategory;
use App\Models\FAQQuestion;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index(){
        $categories = FAQCategory::with('questions')->get();
        return view('faq.index', compact('categories'));
    }

    public function edit(FAQCategory $category){
        $categories = FAQCategory::with('questions')->get();
        return view('faq.edit', compact('categories', 'category'));
    }

    public function update(Request $request, FAQCategory $category){
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

        return redirect()->route('faq')->with('success', 'FAQ updated successfully!');

    }

    public function store() {

    }

    public function destroy(){

    }
}
