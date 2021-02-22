@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Set permission for user</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update.permission') }}">
                        @csrf

                        @foreach ($permissions as $permission)
                        <div class="form-check">
                            <input
                                name="permissions[]" 
                                class="form-check-input"
                                type="checkbox"
                                value="{{$permission->id}}" 
                                @if($role->hasPermission($permission->slug))
                                checked
                                @endif
                                id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                             {{$permission->name}}
                            </label>
                          </div> 
                        @endforeach
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
