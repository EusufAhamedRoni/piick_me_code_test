<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }


    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function createPermission($request){
        $this->permissions()->sync($request->permission);
        
    }

    public function hasPermission($permission){
        // dd($this->permissions);
         if($this->permissions->where('slug',$permission)->first()){
             return true;
         }
 
     } 
     public function hasPermissions($permissions){
         if (is_array($permissions)){
             foreach($permissions as $permission){
                 $this->hasPermission($permission);
             }
         }else{
             $this->hasPermission($permissions);
         }
     }
}
