<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\BlogImage;
use App\Http\Requests\BlogRequest;
use App\Http\Requests\BlogCommentRequest;
use App\Http\Resources\BlogResource;
use App\Http\Resources\BlogCollection;
use Illuminate\Http\Request;
use App\Traits\StoreImageTrait;

class BlogController extends Controller
{
    use StoreImageTrait;

    /**
     * @param \Illuminate\Http\Request $request
     * @return \App\Http\Resources\BlogCollection
     */
    public function index(Request $request)
    {
      $category = $request->category;
      $featured = $request->featured;
      $latest = $request->latest;

      $blogs = Blog::with(['user:id,name', 'user.profile:user_id,avatar', 'comments'])
                      ->when($category, function($query) use($category) {
                        return $query->where('hashtags', 'like', '%'.$category.'%');
                      })
                      ->when($featured, function($query) {
                        return $query->where('is_featured', 1);
                      })
                      ->when($latest, function($query) {
                        return $query->limit(3)->orderBy('created_at','Desc');
                      })
                      ->where(['is_reviewed' => 1, 'active' => 1])
                      ->orderBy('likes','Desc')
                      ->get();

        return new BlogCollection($blogs);
    }

    /**
     * @param \App\Http\Requests\BlogRequest $request
     * @return \App\Http\Resources\BlogResource
     */
    public function store(BlogRequest $request)
    {
        $blog = Blog::create($request->validated());

        /**
         * Store blog images
         */
        if ($request->images) {
            foreach ($request->images as $key => $image) {
                $imagePath = $this->verifyAndStoreImage($image, $request->user_id .'-'. $request->title . '-' . $key , 'blogs');
                BlogImage::create([
                  'blog_id' => $blog->id,
                  'image'   => $imagePath
                ]);
            }
        }

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

        /**
         * Store blog images
         */
        if ($request->images) {
            foreach ($request->images as $key => $image) {
                $imagePath = $this->verifyAndStoreImage($image, $blog->user_id .'-'. $request->title . '-' . $key , 'blogs');
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'image'   => $imagePath
                ]);
            }
        }

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
