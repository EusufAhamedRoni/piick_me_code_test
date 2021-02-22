@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('layouts.partials.message')
            <div class="card">
                <div class="card-header">Active Key</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('apply.key') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="licence_key" class="col-md-4 col-form-label text-md-right">Key</label>

                            <div class="col-md-6">
                                <input id="licence_key" type="text" class="form-control @error('licence_key') is-invalid @enderror" name="licence_key" value="{{ old('licence_key') }}" required autocomplete="licence_key" autofocus>

                                @error('licence_key')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Apply Key
                                </button>
                            </div>
                            @if(Auth::user()->isSuperUser()||Auth::user()->hasPermission('generate.key'))
                            <div class="col-md-6 offset-md-4">
                                <a href="{{route('get.key')}}">Get Key</a>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
