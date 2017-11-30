<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use Laravel\Socialite\Two\User;

use Socialite;
use Debugbar;

class AuthController extends Controller
{
/**
  * Redirect to authentication request action.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    return redirect()->action('AuthController@request');
  }

  /**
  * Redirect the user to the GitHub authentication page.
  *
  * @return \Illuminate\Http\Response
  */
  public function request()
  {
    return Socialite::driver('github')->redirect();
  }

  /**
  * Obtain the user information from GitHub.
  *
  * @return \Illuminate\Http\Response
  */
  public function callback(Request $request)
  {
    $auth = Socialite::driver('github')->user();

    try {
      $developer = $this->authenticate($auth);
      Auth::login($developer, true);
      $request->session()->flash('info', 'Signed in with '.$developer->email);

    } catch (Exception $e) {
      $request->session()->flash('info', $developer->email.' is not a valid email address');
    }

    return redirect()->action('DeveloperController@show');
  }

  private function authenticate(User $user) {
    $email = $user->email;
    $name = Developer::formatName($user->name);

    if (stripos($email, '@graffino.com') !== false) {
      $attributes = [
        "email" => $email,
        "username" => $username,
      ];

      Developer::findOrCreate()
    } else {
      throw new Exception($email);
    }
  }
}
