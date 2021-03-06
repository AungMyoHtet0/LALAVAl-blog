<?php

namespace App\Http\Controllers;


use App\Models\Post;
use App\Http\Requests\MyRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function index()
    {   
        //Auth::attempt(['email'=> 'mgmg@gmail.com','password'=> '12345']);
        
             $posts = Post::where('title','like','%'.request('search').'%')->OrderBy('id','desc')->simplepaginate(5);
            // reuquest('search');
            // $posts = Post::select('posts.*','users.name as author')
            // ->join('users', 'users.id', '=', 'posts.user_id')->OrderBy('id','desc')->simplePaginate(3);
            // ->orderBy('id','desc');
            // ->first();

            return view('posts.index', compact('posts'));
    
            
        
       
    }



    public function store(MyRequest $request)
    {
        //$request->all();
        //$post = new Post();
        //$post->title = $request->title;
        //$post->body = $request->body;
        //$post->created_at = now();
        //$post->updated_at = now();
        //$post->save();

        Post::create([
            'title'=> $request->title,
            'body'=> $request->body,
            'user_id'=>auth()->id(),
            'category_id'=>Category::first()->id
        ]);

        //session()->flash('postCreate','Post Created Successfuly');
        return redirect('/post')->with('postCreate','Post Created Successfuly');
    }



    public function create()
    {   
        return view('posts.create');
    }



    public function show($id)
    {
        //$post = Post::find($id);
        $post = Post::select(['posts.*','users.name as author'])->join('users','users.id','posts.user_id')->where('posts.id',$id)->first();
        return view('posts.show', ['post' => $post]);
    }



    public function edit($id)
    {
        $post = POST::find($id);
        return view('posts.edit', compact('post'));
    }



    public function update(MyRequest $request, $id)
    {
        //$request->all();
        $post = Post::find($id);
        //$post->title = $request->title;
        //$post->body = $request->body;
        //$post->updated_at = now();
        //$post->save();

        //Post::updated([
        //    'titele'=>$request->title,
        //    'body'=> $request->body
        //]);

        $post->update($request->except([]));
        //session()->flash('postEdit','Post Updated Successfuly');
        return redirect('/post')->with('postEdit','Post Updated Successfuly');
    }



    public function destroy($id)
    {

        Post::destroy($id);
        return redirect('/post')->with('postDelete',"Post Delected Successfuly");
    }

}
