<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RolesController extends Controller
{
    //
    public function __construct()
    {
        // make everything require login except index() & show
        $this->middleware('auth:api');
        $this->middleware('admin:api')->only(['index', 'show', 'create', 'store', 'edit', 'update', 'delete', 'forceDelete']);
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
        $roles = Role::all();
        return response()->json($roles, 200);
    }

    public function show(Role $role)
    {
        return response()->json($role, 200);
    }

    public function store(Request $request)
    {
        $data = self::formValidation($request);

        $role = Role::create($data);

        return response()->json($role, 201);
    }

    public function update(Request $request, Role $role)
    {
        $data = self::formValidation($request, $role);

        $role->update($data);
        return response()->json($role, 200);
    }

    public function delete(Role $role)
    {
        try 
        {
            $role->delete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function forceDelete(Role $role)
    {
        try 
        {
            $role->forceDelete();
            return response()->json(null, 204);
        }
        catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
}
