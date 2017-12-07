<?php

namespace App\Http\Controllers;

use App\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Debugbar;

class DeveloperController extends Controller
{
    public function show(Developer $developer) {
      //
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
}
