@extends('layouts.app')

@section('pageTitle', '案件検索')

@section('content')
    @include('common.search_form', ['keyword' => empty($keyword) ? '' : $keyword])
    <div class="main-container">
        <div class="container">
            <div class="row">
                @include('common.categories_bar')
                <div class="col-sm-9 page-content">
                    <div class="caption text-center">
                        <h2>検索結果</h2>
                    </div>
                    <div class="adds-wrapper">
                        @forelse($items as $item)
                            <div class="item-list make-grid">
                                <div class="col-sm-2 no-padding photobox">
                                    <div class="add-image">
                                        <a href="{{ route('item.show', $item->id) }}"><img src="{{ asset('uploads/'.$item->image) }}" alt="" style="width:230px;height:192px"></a>
                                    </div>
                                </div>
                                <div class="col-sm-7 add-desc-box">
                                    <div class="add-details">
                                        <h5 class="add-title"><a href="{{ route('item.show', $item->id) }}">{{ str_limit($item->title, $limit = 50, $end = '...') }}</a></h5>
                                        <div class="info">
                                            @foreach($item->categories as $category)
                                                <a href="{{ route('show_items_by_category', $category->id) }}" class="btn btn-common btn-sm"><span>{{ $category->name }}</span> </a>
                                            @endforeach
                                        </div>
                                        <div class="item_desc">
                                            <a href="{{ route('item.show', $item->id) }}">{{ str_limit($item->description, $limit = 100, $end = '...') }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 text-right  price-box">
                                    <h2 class="item-price" style="color: red"> {{ $item->point_num }}P </h2>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning text-center">
                                該当する案件がございません!
                            </div>
                        @endforelse
                    </div>
                    <div class="text-center" style="margin-top: 20px">
                        @if(!empty($keyword))
                            {!! $items->appends(['keyword' => $keyword])->render() !!}
                        @else
                            {{ $items->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
