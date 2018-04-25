<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\User;
use Socialite;
use App\Developer;
use App\Post;

use Debugbar;

class DeveloperController extends Controller
{
  public function index() {
    return redirect()->action('DeveloperController@request');
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
    return redirect('/');
  }

  public function delete(Request $request) {
    Auth::logout();
    $request->session()->flash('info', 'Signed out');

    return redirect('/');
  }

  public function show($username) {
    $developer = Developer::where('username', $username)->first();
    $posts = Post::where("developer_id", $developer->id)->get();

    return view('posts.feed', ['posts' => $posts]);
  }

  public function edit() {
      $authId = Auth::id();
      $developer = Developer::find($authId);

      return view('profile.edit', ['developer' => $developer,]);
  }

  public function update(Request $request) {
    $authId = Auth::id();
    $developer = Developer::find($authId);

    $attr = request()->only('twitter_handle', 'editor');
    $attr['twitter_handle'] = Developer::cleanTwitterHandle($attr['twitter_handle']);

    $developer->update($attr);

    return view('profile.edit', ['developer' => $developer,]);
  }

  protected function authenticate(User $user) {
    Debugbar::info($user);
    $email = $user->email;
    $username = $user->nickname;

    if (stripos($email, '@graffino.com') !== false) {
      $attr = [
        'email' => $email,
        'username' => $username,
      ];

      return Developer::findOrCreate($attr);
    } else {
      throw new Exception($email);
    }
  }
}
