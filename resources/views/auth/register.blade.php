@extends('layouts.app')

@section('pageTitle', '会員登録')

@section('content')
    <!-- Page Header Start -->
    <div class="page-header" style="background: url(assets/img/banner1.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">会員登録</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Content section Start -->
    <section id="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <div class="page-login-form box">
                        <h3>
                            登録
                        </h3>
                        @if (session('message'))
                            <div class="alert alert-warning">
                                {{ session('message') }}
                            </div>
                        @endif
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="alert alert-danger">
                                {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif
                        <form role="form" class="login-form" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-user"></i>
                                    <input id="nickname" type="text" class="form-control" name="nickname" value="{{ old('nickname') }}" required autofocus placeholder="ニックネーム">
                                </div>
                                @if ($errors->has('nickname'))
                                    <span>
                                        <strong>{{ $errors->first('nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-align-left"></i>
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="名前">
                                </div>
                                @if ($errors->has('name'))
                                    <span>
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-envelope"></i>
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required placeholder="メール">
                                </div>
                                @if ($errors->has('email'))
                                    <span>
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('tel') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-mobile"></i>
                                    <input id="tel" type="text" class="form-control" name="tel" value="{{ old('tel') }}" required placeholder="電話番号">
                                </div>
                                @if ($errors->has('tel'))
                                    <span>
                                        <strong>{{ $errors->first('tel') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <i class="icon fa fa-birthday-cake"></i>
                                    <input id="birthday" type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" required>
                                </div>
                                @if ($errors->has('birthday'))
                                    <span>
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <div class="input-icon">
                                    <select name="gender" class="form-control">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                @if ($errors->has('gender'))
                                    <span>
                                        <strong>{{ $errors->first('gender') }}</strong>
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
                            <div class="form-group">
                                <div class="input-icon">
                                    <i class="icon fa fa-unlock-alt"></i>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="確認パスワード">
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                {!! app('captcha')->display(); !!}
                            </div>
                            <button class="btn btn-common log-btn" type="submit">登録</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Content section End -->
@endsection

@section('javascript')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection