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
                </div>
            </div>
        </div>
    </div>
@endsection
