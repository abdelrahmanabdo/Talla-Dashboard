<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Http\Requests\BlogStoreRequest;
use App\Http\Requests\BlogUpdateRequest;
use App\Http\Resources\BlogCollection;
use App\Http\Resources\BlogResource;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\BlogCollection
     */
    public function index(Request $request)
    {
        $blogs = Blog::all();

        return new BlogCollection($blogs);
    }

    /**
     * @param \App\Http\Requests\BlogStoreRequest $request
     * @return \App\Http\Resources\BlogResource
     */
    public function store(BlogStoreRequest $request)
    {
        $blog = Blog::create($request->validated());

        return new BlogResource($blog);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\blog $blog
     * @return \App\Http\Resources\BlogResource
     */
    public function show(Request $request, Blog $blog)
    {
        return new BlogResource($blog);
    }

    /**
     * @param \App\Http\Requests\BlogUpdateRequest $request
     * @param \App\blog $blog
     * @return \App\Http\Resources\BlogResource
     */
    public function update(BlogUpdateRequest $request, Blog $blog)
    {
        $blog->update($request->validated());

        return new BlogResource($blog);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\blog $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Blog $blog)
    {
        $blog->delete();

        return response()->noContent();
    }
}
