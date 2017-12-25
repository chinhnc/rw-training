@extends('layouts.app')

@section('pageTitle', 'ホームページ')

@section('content')
    @include('common.search_form', ['keyword' => empty($keyword) ? '' : $keyword])
    @include('common.top_items')
    <div style="padding-bottom: 80px;">
        <div class="container">
            <div class="row">
                @include('common.categories_bar')
                <div class="col-sm-9 page-content">
                    <div class="adds-wrapper">
                        @foreach($items as $item)
                            <div class="item-list make-grid">
                                <div class="col-sm-2 no-padding photobox">
                                    <div class="add-image">
                                        <a href="{{ route('item.show', $item->id) }}"><img src="{{ asset('uploads/'.$item->image) }}" alt="" style="width:230px;height:192px;"></a>
                                    </div>
                                </div>
                                <div class="col-sm-7 add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title"><a href="{{ route('item.show', $item->id) }}">{!! str_limit($item->title, $limit = 50, $end = '...') !!}</a></h5>
                                        <div class="info">
                                            @foreach($item->categories as $category)
                                                <a href="{{ route('show_items_by_category', $category->id) }}" class="btn btn-common btn-sm"><span>{{ $category->name }}</span> </a>
                                            @endforeach
                                        </div>
                                        <div class="item_desc">
                                            <a href="{{ route('item.show', $item->id) }}">{!! str_limit($item->description, $limit = 100, $end = '...') !!}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right  price-box">
                                    <h2 class="item-price" style="color: red"> {{ $item->point_num }}P </h2>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{ $items->links() }}
                    <div class="inner-box">
                        @include('common.news')
                        <span><a href="{{ route('news') }}">もっとみる＞＞</a></span>
                    </div>
                </div>
            </div>
            <aside id="sidebar" class="sm-sidebar">
                @include('common.ranking')
            </aside>
        </div>
    </div>
@endsection
