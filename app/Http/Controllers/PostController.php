<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at' , 'DESC')->get();
        // Post::all();
        return view('posts.index')->with('posts',$posts);
    }

    public function postsTrashed()
    {
        $posts = Post::onlyTrashed()->where('user_id',Auth::id())->get();
        // get();
        return view('posts.trashed')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        if($tags->count() == 0)
        {
            return redirect()->route('tag.create');
        }
        return view('posts.create')->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'photo' => 'required | image '
        ]);

        $photo = $request->photo;
        $newPhoto = time().$photo->getClientOriginalName();
        $photo->move('Uploads/posts',$newPhoto);

        $post = Post::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'photo' => 'Uploads/posts/'.$newPhoto,
            'slug' => Str::slug($request->title)
        ]);
            // Tags Function
        $post->tag()->attach($request->tags);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tags = Tag::all();
        $post = Post::where('slug' , $slug )->first();
        // dd($post);
        // if($post === null)
        // {
        //     return redirect()->back();
        // }

        return view('posts.show')->with('post',$post)
        ->with('tags',$tags);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::all();
        $post = Post::find($id);
        $post = Post::where('id',$id)->where('user_id',Auth::id())->get()->first();

        if($post === null)
        {
            return redirect()->back();
        }

        return view('posts.edit')->with('post',$post)
        ->with('tags',$tags);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request,[
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required | image '
        ]);

        // dd($request->all());

        if ($request->has('photo'))
        {

            $photo = $request->photo;
            $newPhoto = time().$photo->getClientOriginalName();
            $photo->move('uploads/posts',$newPhoto);
            $post->photo ='uploads/posts/'.$newPhoto ;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        $post->tag()->sync($request->tags);
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $post = Post::find($id);

        $post = Post::where('id',$id)->where('user_id',Auth::id())->get()->first();

        if($post === null)
        {
            return redirect()->back();
        }

        $post->delete();
        return redirect()->back();
    }

    public function hdelete($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        return redirect()->back();

    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->first();
        // dd($post);
        $post->restore();
        $post->save();
        return redirect()->back();


  }
}