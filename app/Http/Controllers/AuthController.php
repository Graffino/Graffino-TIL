<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Two\User;

use App\Developer;

use Socialite;
use Debugbar;

class AuthController extends Controller
{
  public function index() {
    return redirect()->action('AuthController@request');
  }

  public function request() {
    return Socialite::driver('github')->redirect();
  }

  public function callback(Request $request) {
    Debugbar::info($request);
    $auth = Socialite::driver('github')->user();
    Debugbar::info($auth);

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
