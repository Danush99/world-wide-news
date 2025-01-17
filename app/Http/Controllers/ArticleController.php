<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StorearticleRequest;
use App\Http\Requests\UpdatearticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(Article::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorearticleRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorearticleRequest $request)
    {
        $data = new Article();

        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('/storage/article_images'), $filename);

        $data['image']= $filename;
        $data['headline'] = $request->input('headline');
        $data['report'] = $request->input('report');
        $data['category'] = $request->input('category');
        $data['reporter_id'] = $request->user()->id;
        $data->save();
        return redirect()->route('article.create')->with('success', 'Article is submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatearticleRequest  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatearticleRequest $request, Article $article)
    {
        $article['headline'] = $request->input('headline');
        $article['report'] = $request->input('report');
        $article['category'] = $request->input('category');
        DB::table('articles')->where(['id'=> $request->input('id')])->update([
            'headline'=> $request->input('headline'),
            'report' => $request->input('report'),
            'category' => $request->input('category')
        ]);
        return redirect()->route('article.create')->with('success', 'Article is edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
