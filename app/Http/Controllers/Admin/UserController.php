<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Center;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users', [
          'registrated_users' => User::orderBy('status', 'desc')
                                      ->where('registrated', '=', 1)
                                      ->paginate(10),
          'invited_users'     => User::orderBy('status', 'desc')
                                      ->where('registrated', '=', 0)
                                      ->paginate(10)
      ]);
    }

    public function create()
    {
        return view('admin.user-create', ['centers' => Center::all()]);
    }

    public function store(Request $request)
    {
      User::create($request->all());
      return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        return view('admin.user-edit', ['user' => $user, 'centers' => Center::all()]);
    }

    public function update(Request $request, User $user)
    {
      $user->update($request->all());
      return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
