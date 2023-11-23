<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all data post and return to view
        // order by desc/asc
        // desc by id will ordering your data from the highest id
        // asc will ordering from the lowest id
        $posts = Post::orderBy('id', 'ASC')->get();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // catch all array data except token
        $postData = $request->except(['_token']);

        // if the request has file with image name, execute uploading image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $postData['image'] = $imageName;
        }

        // store to database
        Post::create($postData);

        // return view
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find data post by id (primary key) and return view
        $post = Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find data post by id (primary key) and return view
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate user request
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // catch all array data except token and method
        $postData = $request->except(['_token', '_method']);

        // if request has image file, execute the image upload function
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $postData['image'] = $imageName;

            // Delete the old image file if it exists
            $oldImagePath = public_path('images/' . $request->input('old_image'));
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }
        }

        // update data post by id
        Post::whereId($id)->update($postData);

        // return view
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // find post by id
        $post = Post::findOrFail($id);

        // get image path
        $imagePath = public_path('images/' . $post->image);

        // Delete the post record
        $post->delete();

        // Delete the associated image file
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // return to view
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
