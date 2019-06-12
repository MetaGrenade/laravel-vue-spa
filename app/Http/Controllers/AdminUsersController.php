<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AdminUsersController extends Controller
{
    //
    public function __construct()
    {
        // make everything require login except index() & show
        $this->middleware('auth:api');
        $this->middleware('admin:api')->only(['index', 'show', 'create', 'store', 'edit', 'update', 'delete']);
        $this->middleware('super:api')->only(['forceDelete']); // permanent delete (removes row from db completely vs flagging as deleted)
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

    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    public function show(User $user)
    {
        return response()->json($user, 200);
    }

    public function store(Request $request)
    {
        $data = self::formValidation($request);

        $user = User::create($data);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $data = self::formValidation($request, $user);

        $user->update($data);
        return response()->json($user, 200);
    }

    public function delete(User $user)
    {
        try 
        {
            $user->delete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function forceDelete(User $user)
    {
        try 
        {
            $user->forceDelete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
