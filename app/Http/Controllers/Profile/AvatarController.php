<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    public function update()
    {

        // return redirect(route('profile.edit'));
        // return response()->redirectTo(route('profile.edit'));
        // return back(); // can also do this
        return back()->with('message', 'Avatar is changed'); // can give response

        /**
         * Add this to blade template if you're usnig back()->with();
         *
         * 
         */

        // @if (session('message'))
        //     <div class="text-red-600">
        //         {{ session('message') }}
        //     </div>
        // @endif
    }
}
