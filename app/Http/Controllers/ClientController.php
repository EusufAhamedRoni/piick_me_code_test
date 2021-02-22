<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Permission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
  // get client info
  public function getClient($clientId)
  {
    $client = User::select('first_name','last_name', 'organization_name', 'street', 'city', 'email', 'mobile', 'licence_key')->where('client_id', $clientId)->first();
    if ($client) {
      return response()->json($client);
    } else {
      abort(404);
    }
  }

  // generate the key
  public function licenceKeyGenerate(Request $request)
  {
    $key = generate_string(5) . '-' .generate_string(5) . '-' .generate_string(5) . '-' .generate_string(5);
    $user = User::where('client_id', $request->client_id)->first();
    if ($user) {
      $user->update(['licence_key' => $key]);
      return  response()->json(['key'=>$key,'success'=>'Key Generated']);
    } else {
      return abort(404);
    }
  }

  // save the generated key
  public function licenceKeySave(Request $request)
  {
    $request->validate([
      'client_id' => 'required',
      'duration'=>'required'
    ]);
    $user = User::where('client_id', $request->client_id)->first();
    if ($user && $user->hasKey()) {
        $user->update(['duration'=>$request->duration]);
        return  redirect()->route('homeView')->with('success', 'something went wrong');
    } else {
      return abort(404);
    }
  }

  // user permission
  public function createPermission(){
    return view('permission',[
      'role'=>Role::where('slug','user')->first(),
      'permissions'=>Permission::all()
    ]);
  }


  // update the permission
  public function updatePermission(Request $request){
    $role=Role::where('slug','user')->first();
    $role->permissions()->sync($request->permissions??[]);
    return back()->with('success','Permission updated');
  }


}
