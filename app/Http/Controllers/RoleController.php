<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('roles.roles',['roles'=>Role::all()]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->roleValidator($request);
        Role::create(['title'=>$request->title]);
        return redirect()->route('roles')->with('success','Role created sucessfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
        return view('roles.update',['role'=>$role]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
        $this->roleValidator($request);
        $role->update(
            [
                'title'=>$request->title,
            ]
        );
        $role->createAbility($request);
        return redirect()->route('edit_role',$role->id)->with('success','Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
        $role->delete();
        return redirect()->route('roles')->with('success','role deleted successfully');
    }

    public function abilities(Role $role){
        $abilities=Ability::all();
        return view('roles.abilities',['role'=>$role,'abilities'=>$abilities]);
    }

    public function updateAbilities(request $request ,Role $role){
        
        $role->createAbility($request);
        return redirect()->route('abilities_role',$role->id)->with('success','Role abilities updated successfully ');
    }

    protected function roleValidator(Request $request){
        $request->validate([
            'title'=>['required','string','unique:roles']
        ]);
    }
}
