<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends AsdhController
{
  public function index()
  {
    $users = User::paginate($this->default_pagination_limit);
    return view('admin.user.index', compact('users'));
  }

  public function create()
  {
    $roles = Role::all();
    return view('admin.user.create', compact('roles'));
  }

  public function store(UserRequest $request)
  {
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->twitter_username = $request->twitter_username;
    $user->facebook_profile_url = $request->facebook_profile_url;
    $user->facebook_page_url = $request->facebook_page_url;
    $user->role_id = $request->role;

    if ($user->save()) {
      return redirect()->to(route('user.index'))->with('success_message', 'User successfully created');
    } else {
      return redirect()->to(route('user.index'))->with('failure_message', 'Sorry, user could not be created. Please try again later');
    }
  }

  public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $user = User::find($id);
    $roles = Role::all();
    return view('admin.user.edit', compact('user', 'roles'));
  }

  public function update(UserRequest $request, $id)
  {
    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password !== "") {
      $user->password = Hash::make($request->password);
    }
    $user->twitter_username = $request->twitter_username;
    $user->facebook_profile_url = $request->facebook_profile_url;
    $user->facebook_page_url = $request->facebook_page_url;
    $user->role_id = $request->role;

    if ($user->save()) {
      return redirect()->to(route('user.index'))->with('success_message', 'User successfully updated');
    } else {
      return redirect()->to(route('user.index'))->with('failure_message', 'Sorry, user could not be updated. Please try again later');
    }
  }

  public function destroy($id)
  {
    $user = User::findOrFail($id);
    if ($user->delete()) {
      return "User successfully deleted";
    } else {
      return 'no';
    }
  }

  public function delete(Request $request)
  {
    $core_user = User::findOrFail(1);
    if (isset($request->deleteMultiple)) {
      $users = User::findOrFail($request->deleteMultiple);
      foreach ($users as $user) {
        foreach ($user->posts as $post) {
          $post->user()->associate($core_user);
          $post->save();
        }
      }
      User::destroy($request->deleteMultiple);
      return redirect(route('user.index'))->with('success_message', 'Users successfully deleted.');
    } else if (isset($request->delete)) {
      $user = User::findOrFail($request->delete);
      // dd($core_user->name);
      foreach ($user->posts as $post) {
        $post->user()->associate($core_user);
        $post->save();
      }
      $user->delete();
      return redirect(route('user.index'))->with('success_message', 'User successfully deleted.');
    }
    return redirect(route('user.index'))->with('failure_message', 'To delete, you need to select at least one user.');
  }

  public function change_password_form()
  {
    return view('admin.user.change_password');
  }

  public function change_password(Request $request)
  {
    $user = Auth::user();
    $this->validate($request, [
        'old_password' => 'bail|required|string|min:6',
        'new_password' => 'bail|required|string|min:6|same:new_password_confirmation',
        'new_password_confirmation' => 'bail|required|string|min:6',
    ]);
    if (Hash::check($request->old_password, $user->password)) {

      $user->password = Hash::make($request->new_password);
      if ($user->save()) {
        return redirect()->back()->with('success_message', 'Your password has been changed successfully');
      } else {
        return redirect()->back()->with('failure_message', 'Sorry, your password could not be changed. Please try again later.');
      }
    }
    return redirect()->back()->with('failure_message', 'Your old password did not match. Try again.');
  }

}
