<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    // MIDDLEWARE @ Controller Level
    public function __construct()
    {
        // make everything require login except index()
        $this->middleware('auth:api')->except(['index', 'show']);
        $this->middleware('admin:api')->only(['create', 'store', 'edit', 'update', 'delete']);

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
    public function index()
    {
        return Blog::where('published', true)->get();
    }

    public function show(Article $blog)
    {
        return $blog;
    }

    public function store(Request $request)
    {
        $blog = Blog::create($request->all());

        return response()->json($blog, 201);
    }

    public function update(Request $request, Article $blog)
    {
        $blog->update($request->all());

        return response()->json($blog, 200);
    }

    public function delete(Article $blog)
    {
        $blog->delete();

        return response()->json(null, 204);
    }
}
