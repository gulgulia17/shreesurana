<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function index()
    {
        ini_set("memory_limit", -1);
        return view('auth.users', [
            'users' => User::all(),
            'roles' => Role::all(),
        ]);
    }

    public function create()
    {
        return view('auth.create', ['roles' => Role::all()]);
    }

    public function show(User $user)
    {
        Auth::loginUsingId($user->id);
        return redirect(route('home'));
    }

    public function profileUpdate(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "number" => "required|string|max:10|unique:users,number,{$this->user->id},id"
        ]);

        $this->user->update($request->all());

        return back()->with('success', 'Updated Successfully.');
    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            "old_password" => ['required', 'string', 'different:password', function ($attribute, $value, $fail) {
                if (!Hash::check($value, $this->user->password)) {
                    $fail('Old password is wrong.');
                }
            }],
            "password" => 'required|string|min:8|confirmed',
        ]);

        $this->user->update($request->all());

        return back()->with('success', 'Updated Successfully.');
    }

    public function validateProfileRequest($request)
    {
        return $request->validate([
            "name" => "required|string",
            "number" => "required|string|max:10|unique:users,number,{$this->user->id},id",
            "email" => "required|string|email|unique:users,email,{$this->user->id},id",
        ]);
    }

    public function new(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'username' => ['sometimes', 'max:255', 'unique:users,username'],
            'role' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'number' => ['required', 'string', 'max:10', 'unique:users,number'],
        ]);

        $role = Role::findById($request->role);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'type' => 'User',
            'username' => $data['username'] ?? '',
            'password' => Hash::make($data['password']),
            'number' => $data['number'],
        ]);
        $user->assignRole($role);
        return redirect(route('user.index'))->with('success', 'User added successfully');
    }

    public function store(Request $request)
    {
        $user = User::findById($request->user);
        $role = Role::findById($request->roles);
        if (isset($request->role) && !empty($request->role)) {
            $user->assignRole($role);
        } else {
            $user->removeRole($role);
        }

        return back();
    }

    public function destroy(User $user)
    {
        $user->data()->detach();
        $user->files()->detach();
        $user->data()->forceDelete();
        $user->files()->delete();
        $user->leads()->delete();
        $user->delete();
        return back()->with('success', 'Deleted Successfully');
    }

    public function profile()
    {
        return view('pages.profile.index', ['user' => $this->user]);
    }
}
