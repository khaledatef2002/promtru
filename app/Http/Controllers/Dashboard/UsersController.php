<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rules;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\AutoEncoder;
use Intervention\Image\ImageManager;

class UsersController extends Controller implements HasMiddleware
{
    public static function Middleware()
    {
        return [
            new Middleware('can:users_show', only: ['index']),
            new Middleware('can:users_create', only: ['create', 'store']),
            new Middleware('can:users_edit', only: ['edit', 'update']),
            new Middleware('can:users_delete', only: ['destroy']),
        ];
    }
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $quotes = User::get();
            return DataTables::of($quotes)
            ->rawColumns(['action'])
            ->addColumn('action', function(User $user){
                return 
                "<div class='d-flex align-items-center justify-content-center gap-2'>"
                .
                (Auth::user()->hasPermissionTo('users_edit') ?
                "<a href='" . route('dashboard.users.edit', $user) . "'><i class='ri-settings-5-line fs-4' type='submit'></i></a>"
                : "")
                .
                (Auth::id() != $user->id ?
                    (Auth::user()->hasPermissionTo('users_delete') ?
                    "
                        <form data-id='".$user->id."'>
                            <input type='hidden' name='_method' value='DELETE'>
                            <input type='hidden' name='_token' value='" . csrf_token() . "'>
                            <button class='remove_button remove_button_action' type='button'><i class='ri-delete-bin-5-line text-danger fs-4'></i></button>
                        </form>
                    "
                    : "")
                : '')
                .
                "</div>";
            })
            ->editColumn('role', function(User $user){
                return '<span class="badge bg-primary">'. $user->getRoleNames()[0] .'</span>';
            })
            ->rawColumns(['user', 'role', 'action'])
            ->make(true);
        }
        return view('dashboard.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            'role' => ['required', 'exists:roles,id']
        ]);

        $user = User::create($data);
        $role= Role::find($request->role);
        $user->assignRole($role);

        return response()->json([
            'message' => __('response.user-created'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',id,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'role' => ['required', 'exists:roles,id'],
        ]);

        if(!$request->password)
        {
            unset($data['password']);
        }

        $user->update($data);

        if($request->role)
        {
            $role = Role::find($request->role);
    
            $user->syncRoles([$role->name]);
        }

        return response()->json([
            'message' => __('response.user-updated'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Storage::disk('public')->exists(str_replace('storage/', '', $user->image) ?? ''))
        {
            Storage::disk('public')->delete(str_replace('storage/', '', $user->image) ?? '');
        }
        $user->delete();

        return response()->json([
            'message' => __('response.user-deleted'),
        ]);
    }
}
