<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class userAreaController extends Controller
{

    // activate the key
    public function activeKey()
    {
        if (Auth::user()->expire_date!=null && Auth::user()->expire_date >= Carbon::now()) {
            return redirect()->route('home');
        }
        return view('activeKey');
    }

    // seeting the expire date
    public function setExpireDate(Request $request)
    {
        $request->validate([
            'licence_key' => 'required'
        ]);

        if (Hash::check($request->licence_key, Auth::user()->licence_key) && Auth::user()->duration!=null) {
            $expire_date = Carbon::now()->addMonth(Auth::user()->duration)->format('Y-m-d');
            Auth::user()->update(['expire_date' => $expire_date]);
            return redirect()->route('home')->with('success', "Congratulation!! Yor License Has Been Activated. It will work till {$expire_date}");
        } else {
            return back()->with('error', 'invalid Key');
        }
    }

    public function getKey(){
        Gate::authorize('generate.key');
        return view('licenceKey');
    }



    public function generateLicenceKey()
    {
        Gate::authorize('generate.key');
        $key = generate_string(5) . '-' .generate_string(5) . '-' .generate_string(5) . '-' .generate_string(5);
        $user = Auth::user();
        if ($user) {
            $user->update(['licence_key' => $key]);
            return  response()->json(['key' => $key, 'success' => 'Key Generated']);
        } else {
            return abort(404);
        }
    }



    public function licenceKeySave(Request $request)
    {
        Gate::authorize('generate.key');
        $request->validate([
            'duration' => 'required'
        ]);
        $user = Auth::user();
        if ($user && $user->hasKey()) {
            $user->update(['duration' => $request->duration]);
            return  redirect()->route('active.key')->with('success', 'Key saved Please use the key to active your account');
        } else {
            return abort(404);
        }
    }
}
