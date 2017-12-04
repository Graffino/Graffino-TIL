<?php

namespace App\Http\Controllers;

use App\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Debugbar;

class DeveloperController extends Controller
{
    public function show(Developer $developer)
    {
      //
    }

    public function edit() {
        $authId= Auth::id();
        $developer = Developer::find($authId);
        Debugbar::info($developer);
        return view('profile.edit', ['developer' => $developer,]);
    }

    public function update(Request $request, Developer $developer) {
        //
    }

    public function destroy(Developer $developer) {
      //
    }
}
