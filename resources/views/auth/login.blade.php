@extends('layouts.app')

@section('pageTitle', 'ログイン')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">ログイン</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-4 col-md-4 col-md-offset-4">
                    <div class="page-login-form box">
                        <h3>
                            ログイン
                        </h3>
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="alert alert-danger">
                                {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif
                        @if (session('activationStatus'))
                            <div class="alert alert-success">
                                {{ session('activationStatus') }}
                            </div>
                        @endif

                        @if (session('activationWarning'))
                            <div class="alert alert-warning">
                                {{ session('activationWarning') }}
                            </div>
                        @endif
                        <form role="form" class="login-form" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('emailOrNickname') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-user"></i>
                                    <input id="email" type="text" class="form-control" name="emailOrNickname" value="{{ old('emailOrNickname') }}" required autofocu placeholder="メールかニックネーム">
                                </div>
                                @if ($errors->has('emailOrNickname'))
                                    <span>
                                        <strong>{{ $errors->first('emailOrNickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-unlock-alt"></i>
                                    <input id="password" type="password" class="form-control" name="password" required placeholder="パスワード">
                                </div>
                                @if ($errors->has('password'))
                                    <span>
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="checkbox">
                                <input id="remember" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="float: left;">
                                <label for="remember">次回から自動的にログイン</label>
                            </div>
                            <div>
                                {!! app('captcha')->display(); !!}
                            </div>
                            <br>
                            <button type="submit" class="btn btn-common log-btn">
                                ログイン
                            </button>
                        </form>
                        <ul class="form-links">
                            <li class="pull-left"><a href="{{ route('register') }}">会員を登録しましょう?</a></li>
                            <li class="pull-right"><a href="{{ route('password.request') }}">パズワード忘れ？</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection