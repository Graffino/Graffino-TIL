<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\User;
use Socialite;
use App\Developer;
use App\Post;
use Validator;

class DeveloperController extends Controller
{
  public function index() {
    return redirect()->route('auth.request');
  }

  public function request() {
    return Socialite::driver('github')->redirect();
  }

  public function callback(Request $request) {
    $auth = Socialite::driver('github')->user();

    try {
      $developer = $this->authenticate($auth);
      Auth::login($developer, true);
      $request->session()->flash('info', 'Signed in with '.$developer->email);

    } catch (Exception $e) {
      $request->session()->flash('info', $developer->email.' is not a valid email address');
    }
    return redirect()->route('posts');
  }

  public function delete(Request $request) {
    Auth::logout();
    $request->session()->flash('info', 'Signed out');

    return redirect()->route('posts');
  }

  public function show($username) {
    $developer = Developer::where('username', $username)->first();

    $posts = Post::orderBy('created_at', 'desc')
      ->where("developer_id", $developer->id)
      ->with(['channel', 'developer'])
      ->paginate(15);

    return view('posts.feed')->with('posts', $posts);
  }

  public function edit() {
      $authId = Auth::id();
      $developer = Developer::find($authId);
      $editorOptions = ['Text Field', 'Vim', 'Code Editor'];

      return view('profile.edit')
        ->with('developer', $developer)
        ->with('editorOptions', $editorOptions);
  }

  public function update(Request $request) {
    $developer = Developer::find(Auth::id());

    Validator::make($request->all(), [
      'twitter_handle' => 'required|string|max:15',
      'editor' => 'required',
    ])->validate();

    $developer->twitter_handle = Developer::cleanTwitterHandle($request->input('twitter_handle'));
    $developer->editor = $request->input('editor');

    if ($developer->update()) {
      $request->session()->flash('info', 'Profile updated!');
    } else {
      $request->session()->flash('info', 'Couldn\'t update your profile!');
    }

    return redirect()->route('profile.edit', $developer->id);
  }

  protected function authenticate(User $user) {
    if (stripos($user->email, '@graffino.com') !== false) {
      return Developer::firstOrCreate([
        'email' => $user->email, 'username' => $user->nickname
      ]);
    } else {
      return abort(404);
    }
  }
}
