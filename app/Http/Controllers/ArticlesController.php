<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;
// use App\Http\Requests\Articles\CreateArticlesRequest;
// use App\Http\Requests\Articles\UpdateArticlesRequest;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('articles.index')->with('articles', Article::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'title' => 'required|unique:articles',
            'description' => 'required',
            'category' => 'required'
        ]);
        Article::create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category
        ]);
        session()->flash('success', "Article created successfully");
        return redirect(route('articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.create')->with('article', $article)->with('categories', Category::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $this->validate(request(), [
            'title' => 'required|unique:articles',
            'description' => 'required',
            'category' => 'required'
        ]);
        $article->update([
            'title' => $request->title,
            'description' => $request->description
        ]);
        session()->flash('success', "Article updated successfully");

        return redirect(route('articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        session()->flash('success', "Article deleted successfully");
        return redirect(route('articles.index'));
    }
}
