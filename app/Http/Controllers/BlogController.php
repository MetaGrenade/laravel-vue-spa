<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\BlogCategories;

class BlogController extends Controller
{
    // MIDDLEWARE @ Controller Level
    public function __construct()
    {
        // make everything require login except index()
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('admin:api')->only(['adminIndex', 'create', 'store', 'edit', 'update', 'delete', 'publish', 'unpublish']);
        $this->middleware('super:api')->only(['forceDelete']); // permanent delete (removes row from db completely vs flagging as deleted)

        //INVERSE Example
        // $this->middleware('auth')->only(['index']);
    }

    // RESPONSE CODES
        // 200: OK. The standard success code and default option.
        // 201: Object created. Useful for the store actions.
        // 204: No content. When an action was executed successfully, but there is no content to return.
        // 206: Partial content. Useful when you have to return a paginated list of resources.
        // 400: Bad request. The standard option for requests that fail to pass validation.
        // 401: Unauthorized. The user needs to be authenticated.
        // 403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
        // 404: Not found. This will be returned automatically by Laravel when the resource is not found.
        // 500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
        // 503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.


    //
    public function adminIndex()
    {
        $b = Blog::orderBy('id', 'DESC')->get();

        $blogs = array();
        foreach($b as $blog){
            $blogs[] = $blog;
        }

        $results = array(
            'blogs' => $blogs
        );
        
        return response()->json($results, 200);
    }

    public function index()
    {
        $blogs = Blog::where('published', true)->get();
        $blog_categories = BlogCategories::where('published', true)->get();
        $results = array(
            'blogs' => $blogs,
            'blog_categories' => $blog_categories
        );
        return response()->json($results, 200);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        
        $results = array(
            'blog' => $blog,
            'author' => $blog->user,
            'related_blogs' => array(),
            'recently_posted_blogs' => array(),
        );

        return response()->json($results, 200);
    }

    public function store(Request $request)
    {
        $data = self::formValidation($request);
        $data['user_id'] = $request->user()->id;

        $blog = Blog::create($data);

        return response()->json($blog, 201);
    }

    public function edit(Blog $blog)
    {
        $blog_categories = BlogCategories::all();

        $results = array(
            'blog' => $blog,
            'blog_categories' => $blog_categories
        );

        return response()->json($results, 200);
    }

    public function update(Request $request, Blog $blog)
    {
        $user = $request->user();

        $request['user_id'] = $user->id;

        $data = self::formValidation($request, $blog);

        // return tap($blog)->update($data);

        $blog->update($data);
        return response()->json($blog, 200);
    }

    public function delete(Blog $blog)
    {
        try 
        {
            $blog->delete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function forceDelete(Blog $blog)
    {
        try 
        {
            $blog->forceDelete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function publish(Blog $blog)
    {
        $blog->update(['published' => true]);
        return response()->json($blog, 200);
    }

    public function unpublish(Blog $blog)
    {
        $blog->update(['published' => false]);
        return response()->json($blog, 200);
    }

    public function categories()
    {
        $blog_categories = BlogCategories::where('published', true)->get();
        $results = array(
            'blog_categories' => $blog_categories
        );
        return response()->json($results, 200);
    }

    function formValidation($data)
    {
        $validated = $this->validate($data, [
            'title' => 'required',
            'slug' => 'required|unique:blogs,slug',
            'category_id' => 'required|integer',
            'published' => 'required',
            'image' => 'nullable|image|mimes:jpeg,bmp,png,jpg,svg|max:2048',
            'intro' => 'required|min:50|max:500',
            'content' => 'required',
        ]);

        return $validated;
    }
}
