<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class NewsController extends Controller
{
    public function index(){
        $latestNews = News::latest()->first();

        return redirect()->route('news.show', ['id' => $latestNews->id]);
    }

    public function show($id){
        $currentNews = News::findOrFail($id);
        $newsItems = News::all('id', 'title');

        return view('news.news', compact('currentNews', 'newsItems'));
    }

    public function edit($id){
        $currentNews = News::findOrFail($id);
        $newsItems = News::all('id', 'title');

        return view('news.edit', compact('currentNews', 'newsItems'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => [
                'required', 
                'string',
                'min:3', 
                'max:50'
            ],
            'content' => [
                'required'
            ],
            'image' => [
                'nullable', 
                'image', 
                'mimes:jpg,jpeg,png', 
                'max:2048'
            ],
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('news_images', 'public');
        }

        News::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return Redirect::route('news')->with('success', 'News item successfully created');
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => [
                'required', 
                'string',
                'min:3', 
                'max:100'
            ],
            'content' => [
                'required'
            ],
            'image' => [
                'nullable', 
                'image', 
                'mimes:jpg,jpeg,png', 
                'max:2048'
            ],
        ]);

        $newsItem = News::findOrFail($id);
        $newsItem->title = $request->title;
        $newsItem->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('news_images', 'public');
            $newsItem->image = $path;
        }

        $newsItem->save();

        return Redirect::route('news.show', $newsItem->id)->with('success', 'News item updated successfully!');
    }

    public function destroy($id): RedirectResponse
    {
        $newsItem = News::findOrFail($id);
        $newsItem->delete();

        return Redirect::route('news.latest')->with('success', 'News item deleted successfully!');

    }
}
