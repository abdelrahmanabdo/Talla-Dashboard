<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
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
     * @param \App\Http\Requests\BlogRequest $request
     * @return \App\Http\Resources\BlogResource
     */
    public function store(BlogRequest $request)
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
    public function update(Request $request, Blog $blog)
    {
        $blog->update($request->all());

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

        return response()->json([
            'success' => true,
            'message' => 'Deleted successfully'
        ]);
    }

    /**
     * Add blog comment
     * @param \App\Http\Requests\BlogCommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function postBlogComment (BlogCommentRequest $request) {
        $comment = BlogComment::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Blog comment added successfully',
            'data' => $comment
        ]);;
    }

    /**
     * Add blog comment
     * @param \App\Http\Requests\BlogCommentRequest $request
     * @return \Illuminate\Http\Response
     */
}
