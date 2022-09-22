<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','DESC' )->paginate(6);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'image' => 'nullable',
            'description' => 'required',
        ]);

        $new_post = new Post();
        $new_post->fill($request->all());
        $new_post->save();


        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'image' => 'nullable',
            'description' => 'required',
        ]);

        $post->update($request->all());

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }


    public function checkTodo($id)
    {
        //prendi il singolo post
        $post = Post::findOrFail($id);
        //se il valore di checked è diverso
        $toggle = !($post->is_checked);
        //aggiornalo
        $post->update(['is_checked' => $toggle]);

        return back();
    }

    public function getCompleted()
    {
        $posts = Post::where('is_checked', '=', 1)->paginate(5);
      
        return view('posts.index', compact('posts'));
    }

    public function getIncompleted()
    {
        $posts = Post::where('is_checked', '=', 0)->paginate(5);
      
        return view('posts.index', compact('posts'));
    }

    public function selectAll(){

        $posts = DB::table('posts');
        $posts->update(['is_checked' => true]);
        
        return back();
    }

    public function deselectAll(){

        $posts = DB::table('posts');
        $posts->update(['is_checked' => false]);

        return back();
    }
}

