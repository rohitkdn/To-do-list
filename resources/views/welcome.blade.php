@extends('app')

@section('body')
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-4 col-md-offset-4">
            <div class="card">
                <div class="card-header text-xs-center">
                    LOGIN
                </div>
                <div class="card-block">
                    <form class="form" action="/login" method="post">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input class="form-control" id="username" name="username" placeholder="username or email" value="{{old('username')}}">
                            @if($errors->has('username'))
                                <small class="text-danger">{{$errors->first('username')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="password">
                            @if($errors->has('password'))
                                <small class="text-danger">{{$errors->first('password')}}</small>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <a href="/signup" class="btn btn-secondary btn-block">Signup</a>
                            </div>
                            <div class="col-xs-6">
                                <button class="btn btn-primary btn-block" type="submit">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection