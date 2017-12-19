@extends('layouts.app')

@section('pageTitle', 'プロフィール')

@section('content')
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8 page-content">
                <div class="inner-box">
                    <div class="usearadmin">
                        <h3><a href="#"><img class="userimg" src="assets/img/user.png" alt="">{{ $user->nickname }}</a></h3>
                    </div>
                </div>
                <div class="inner-box">
                    <div class="welcome-msg">
                        <h3 class="page-sub-header2 clearfix no-padding">こんにちは！ <span style="color: #0ab1fc">{{ $user->name }}</span></h3>
                        <span class="page-sub-header-sub small">前回情報をアップデートした時刻: {{ $user->updated_at }}</span>
                    </div>
                    <div id="accordion" class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a href="#collapseB1" data-toggle="collapse"> 個人情報 </a> </h4>
                            </div>
                            @if (session('error-mess'))
                                <div class="alert alert-danger">
                                    {{ session('error-mess') }}
                                </div>
                            @endif
                            @if (session('success-mess'))
                                <div class="alert alert-success">
                                    {{ session('success-mess') }}
                                </div>
                            @endif
                            <div class="panel-collapse collapse in" id="collapseB1">
                                <div class="panel-body">
                                    <form role="form" class="update-user-info-form" method="POST" action="{{ route('user_update') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group is-empty{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="control-label">名前</label>
                                            <input class="form-control" placeholder="{{ $user->name }}" type="text" value="{{ old('name') ? old('name') : $user->name }}" name="name">
                                            <span class="material-input"></span>
                                            @if ($errors->has('name'))
                                                <span>
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('nickname') ? ' has-error' : '' }}">
                                            <label class="control-label">ニックネーム</label>
                                            <input class="form-control" placeholder="{{ $user->nickname }}" type="text" value="{{ old('nickname') ? old('nickname') : $user->nickname }}" name="nickname">
                                            <span class="material-input"></span>
                                            @if ($errors->has('nickname'))
                                                <span>
                                                    <strong>{{ $errors->first('nickname') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label">メール</label>
                                            <input class="form-control" placeholder="{{ $user->email }}" type="email" value="{{ old('email') ? old('email') : $user->email }}" name="email">
                                            <span class="material-input"></span>
                                            @if ($errors->has('email'))
                                                <span>
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('tel') ? ' has-error' : '' }}">
                                            <label for="Phone" class="control-label">電話番号</label>
                                            <input class="form-control" id="Phone" placeholder="{{ $user->tel }}" type="text" value="{{ old('tel') ? old('tel') : $user->tel }}" name="tel">
                                            <span class="material-input"></span>
                                            @if ($errors->has('tel'))
                                                <span>
                                                    <strong>{{ $errors->first('tel') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('birthday') ? ' has-error' : '' }}">
                                            <label for="birthday" class="control-label">生年月日</label>
                                            <input class="form-control" id="birthday" type="date" value="{{ old('birthday') ? old('birthday') : $user->birthday }}" name="birthday">
                                            <span class="material-input"></span>
                                            @if ($errors->has('birthday'))
                                                <span>
                                                    <strong>{{ $errors->first('birthday') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                            <label for="gender" class="control-label">性別</label>
                                            <select name="gender"class="form-control">
                                                <option value="Male" {{ $user->gender !== 'Male' ?: 'selected' }}>Male</option>
                                                <option value="Female"{{ $user->gender !== 'Female' ?: 'selected' }}>Female</option>
                                            </select>
                                            <span class="material-input"></span>
                                            @if ($errors->has('gender'))
                                                <span>
                                                    <strong>{{ $errors->first('gender') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-common">アップデート</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"> <a aria-expanded="false" class="collapsed" href="#collapseB2" data-toggle="collapse"> パスワードセッティング </a> </h4>
                            </div>
                            <div style="height: 0px;" aria-expanded="false" class="panel-collapse collapse" id="collapseB2">
                                <div class="panel-body">
                                    <form role="form" class="update-password-form" method="POST" action="{{ route('password_update') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group is-empty{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                            <label class="control-label">現在のパスワード</label>
                                            <input class="form-control" placeholder="現在のパスワードを入力してください" type="password" name="old_password">
                                            <span class="material-input"></span>
                                            @if ($errors->has('old_password'))
                                                <span>
                                                    <strong>{{ $errors->first('old_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="control-label">新しパスワード</label>
                                            <input class="form-control" placeholder="新しパスワードを入力してください" type="password" name="password">
                                            <span class="material-input"></span>
                                            @if ($errors->has('password'))
                                                <span>
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group is-empty{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label class="control-label">確認パスワード</label>
                                            <input class="form-control" placeholder="もう一度新しパスワードを入力してください" type="password" name="password_confirmation">
                                            <span class="material-input"></span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-common">アップデート</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

