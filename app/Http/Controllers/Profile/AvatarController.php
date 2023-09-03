<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAvatarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function response_sample()
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

    public function update(UpdateAvatarRequest $request) 
    {

        // $path = $request->file('avatar')->store('avatars', 'public');
        $path = Storage::disk('public')->put('avatars', $request->file('avatar'));
        
        if($oldAvatar = $request->user()->avatar)
        {
            Storage::disk('public')->delete($oldAvatar);
        }
        auth()->user()->update(['avatar' => $path]);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
