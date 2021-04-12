<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\Blog;
use App\Http\Requests\BlogReviewRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
use Illuminate\Http\Request;

class BlogReviewController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\BlogCollection
     */
    public function index(Blog $blog)
    {
        $blogComments = $blog->reviews()::get();

        return new BlogCollection($blogs);
    }

    /**
     * @param \App\Http\Requests\BlogCommentRequest $request
     * @return \App\Http\Resources\BlogResource
     */
    public function store(BlogCommentRequest $request, Blog $blog)
    {

        $blogComment = $blog->reviews()->create($request->validated());

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
}
