<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ArticleController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::get();
        return view('articles.index',['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        return view('articles.add',['categories' => $categories,'article' => null]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'postImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            
        $user = Auth::user();
        if($file   =   $request->file('postImage')) {

            $name      =   $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            
            $target_path    =   public_path('/images/articles/');
            
                if($file->move($target_path, $name)) {
                   
                    // save file name in the database
                    Article::create([
                        'title' => $request->title,
                        'body' => $request->body,
                        'category' => $request->category,
                        'post_image' => $name,
                        'slug' => $request->title . uniqid(),
                        'user_id' => $user->id
                    ]);
                
                    return back()->with("success", "Artilce has been successfully inserted");
                }
            }
        
        return Redirect::to('article');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        $comments = Comment::where('article','=',$article->id)->orderBy('id','DESC')->get();
        return view('articles.show',['article' => $article,'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::get();
        return view('articles.add',['categories' => $categories, 'article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if($file   =   $request->file('postImage')) {

            $name      =   $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            
            $target_path    =   public_path('/images/articles/');
            
            $pastImage = $target_path . $article->post_image;
            if (file_exists($pastImage)) {
                unlink($pastImage);
            }
            if($file->move($target_path, $name)) {
                
                // save file name in the database
                $article->title = $request->title;
                $article->body = $request->body;
                $article->category = $request->category;
                $article->post_image = $name;
                $article->save();
            
                return back()->with("success", "Artilce has been successfully Updated");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $comments = Comment::where('article','=',$article->id)->get();
        if (count($comments)) {
            return back()->with('message','This Article have comments.. cant delete this');
        } else {
            $target_path    =   public_path('/images/articles/');            
            $pastImage = $target_path . $article->post_image;
            if (file_exists($pastImage)) {
                unlink($pastImage);
            }
            $article->delete();
            return Redirect::to('article');
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request){
        $user = Auth::user();
        Comment::create([
            'name' => 'anomous',
            'article' => $request->article,
            'body' => $request->comment,
            'user' => $user->id
        ]);
        return back();
    }
}
