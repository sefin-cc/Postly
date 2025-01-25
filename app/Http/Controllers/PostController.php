<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return[
            //All need to be an authenticated user except index and show
            //First check if the user is auth if not they are redirected to the login page
            new Middleware('auth', except:['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       

        //retrieve post descending by created_by
        //display only 6 posts
        $posts = Post::latest()->paginate(6);

        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //This is rendered by the dashboard
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:3000', 'mimes:webp,png,jpg']
        ]);

        // Store image if exists
        $path = null;
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_images', $request->image);
        }

        // Create a post
        $post = Auth::user()->posts()->create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);

        // Send email when users create a post 
        // Mail::to(Auth::user())->send(new WelcomeMail(Auth::user(), $post));

        // Redirect back to dashboard
        return back()->with('success', 'Your post was created.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //Add a policy from PostPolicy modify method
        Gate::authorize('modify', $post);

        //Go to edit view
       return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // Authorizing the action
        Gate::authorize('modify', $post);

        //validate
        $request->validate([
            'title' => ['required', 'max:255'],
            'body' => ['required'],
            'image' => ['nullable', 'file', 'max:1000', 'mimes:png,jpg'],
        ]);

        
        $path = $post->image ?? null;
        if($request->hasFile('image')){
            if($post->image){
                Storage::disk('public')->delete($post->image);
            }
            //Save to public folder and 'posts_images' folder
             $path =  Storage::disk('public')->put('posts_images', $request->image);
        }


        //Update post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $path
        ]);


        //redirect to dashboard
        return redirect()->route('dashboard')->with('updated', 'Your post was updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Authorizing the action
        Gate::authorize('modify', $post);

        //delete img if img exist
        if($post->image){
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return back()->with('delete', 'Your post was deleted!');

    }
}
