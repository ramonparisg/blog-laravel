<?php

namespace App\Http\Controllers;

use App\post;
use App\channel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        //
        //$posts = Post::all();
        $channels = channel::all();
        $posts = post::with(['channel', 'user'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('post.index', compact('posts','channels'));
    }
    public function postChannel($slug){
        try{
        $channels = channel::all();
        $channel = channel::where('slug',$slug)->firstOrFail(['id']); //si son 3 parametros el del medio es la condicion
        $posts = post::where('channel_id',$channel->id)->with(['channel','user'])
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('post.index', compact('posts','channels'));
        }catch(ModelNotFoundException $ex){
            abort(404);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $channels=channel::all();

        return view('post.create',compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required'

        ],[
            'required' => 'Es requerido'
        ]);

        post::create($request->all());

       /* $post = new post();
        $post->title=$request->get('title');
        $post->body=$request->get('body');
        $post->channel_id=$request->get('channel-id');
        $post->user_id = Auth::user()->id;
        $post->
       $post->save();*/


        return response()->redirectTo('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
    }
}
