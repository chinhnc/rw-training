@extends('layouts.app')

@section('pageTitle', '案件詳細')

@section('content')
    <div class="main-container">
        <div class="container">
            <div class="row">
                @if (session('error-msg'))
                    <div class="alert alert-danger">
                        {{ session('error-msg') }}
                    </div>
                @endif
                @if (session('success-msg'))
                    <div class="alert alert-success">
                        {{ session('success-msg') }}
                    </div>
                @endif
                @include('common.categories_bar', ['categories' => $categories])
                <div class="col-sm-9 page-content">
                    <div class="box">
                        <h2 class="title-2">
                            <strong>{{ $item->title }}</strong>
                            <div style="font-size: 40px;">
                                <strong style="color: red;">({{ $item->point_num }}) <span style="font-size: 30px;">ポイント</span></strong>
                            </div>
                        </h2>
                        <div class="row">
                            <div class="ads-details-info col-md-8">
                                <p class="mb15">{{ $item->description }}</p>
                            </div>
                            <div class="col-md-4">
                                <aside class="panel panel-body panel-details">
                                    <img src="{{ asset('uploads/' . $item->image) }}" alt="">
                                </aside>
                            </div>
                            <div class="text-center">
                                <form role="form" method="POST" action="{{ route('action_item', $item->id) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">サービスを利用して{{ $item->point_num }}ポイントゲット！</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <br><br>

                    <div id="comments">
                        <div class="inner-box">
                            <h3 id="review-title">レビュー（{{ sizeof($item->ratings) }}）
                                <div class="stars">
                                    @for ($i =1 ; $i <= 5; $i++)
                                        <label class="star-avg{{ ($i <= $item->averageRating) ? ' star-checked' : '' }}"></label>
                                    @endfor
                                </div>
                            </h3>

                            <ol class="comments-list">
                                @if(sizeof($item->ratings) > 0)
                                    @foreach($item->ratings as $rating)
                                        <li>
                                            <div class="media">
                                                <div class="info-body">
                                                    <div class="media-heading">
                                                        <h4 class="name">{{ $rating->user->name }}</h4> |
                                                        <span class="comment-date">{{ $rating->created_at }}</span>
                                                    </div>
                                                    <div class="stars">
                                                        @for ($i =1 ; $i <= 5; $i++)
                                                            <label class="star-avg{{ ($i <= $rating->rating) ? ' star-checked' : '' }}"></label>
                                                        @endfor
                                                    </div>
                                                    <p>{{ $rating->review }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                @endif
                            </ol>
                            @guest
                                <div class="alert alert-warning">
                                    レビューをつけるためにログインは必要です！
                                </div>
                            @else
                                <div id="respond">
                                    <h4 class="respond-title">評価</h4>
                                    <form action="{{ route('item-review', $item->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            @if ($errors->has('star') || $errors->has('review'))
                                                <div class="alert alert-danger">
                                                    {{ $errors->first('star') }}
                                                    {{ $errors->first('review') }}
                                                </div>
                                            @endif
                                            <div class="col-md-6">
                                                <div class="form-group is-empty">
                                                    <div class="stars">
                                                        <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                                                        <label class="star star-5" for="star-5"></label>
                                                        <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                                                        <label class="star star-4" for="star-4"></label>
                                                        <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                                                        <label class="star star-3" for="star-3"></label>
                                                        <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                                                        <label class="star star-2" for="star-2"></label>
                                                        <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                                                        <label class="star star-1" for="star-1"></label>
                                                    </div>
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group is-empty">
                                                    <textarea id="review" class="form-control" name="review" cols="45" rows="8" placeholder="内容"></textarea>
                                                    <span class="material-input"></span></div>
                                                <button type="submit" id="submit" class="btn btn-common">レビューを送る</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
