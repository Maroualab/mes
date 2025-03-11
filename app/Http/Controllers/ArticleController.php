<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();  
        $tags = Tag::all();  
        return view('home', compact('articles','tags'));  
    }

    public function create()
    {
    }
    public function edit(Article $article)
    {
        $articles = Article::all();  
        $tags = Tag::all();  
        return view('home', compact('article','articles','tags')); 
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',  
            'content' => 'required|string',  
            'tags' => 'nullable|array',  
        ]);
    
        $article = Article::create($request->all());
    
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);  
        }
    
        return redirect()->route('articles.index')->with('success', 'Article created successfully!');
    }
    
    
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'tags' => 'array',
        ]);
    
        $article->update($request->only('name', 'content'));
    
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }
    
        return redirect()->route('articles.index');
    }
    
    public function destroy(Article $article)
    {
        $article->tags()->detach(); 
        $article->delete(); 
        return redirect()->route('articles.index');
    }
    
}
