@extends('layouts.app')

@section('pageTitle', 'パスワード再設定')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-4 col-md-4 col-md-offset-4">
                <div class="page-login-form box">
                    <h3>
                        パスワード再設定
                    </h3>
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login-form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}
                        <div class="form-group is-empty">
                            <div class="input-icon">
                                <i class="icon fa fa-user"></i>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="メールアドレスを入力してください">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-common log-btn">
                            パスワード再設定リンクを送る
                        </button>
                    </form>
                    <ul class="form-links">
                        <li class="pull-left"><a href="{{ route('register') }}">会員を登録しましょう?</a></li>
                        <li class="pull-right"><a href="{{ route('login') }}">ログイン</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
