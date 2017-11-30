@extends('layouts.app')

@section('pageTitle', '通帳')

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-md-8 search-form">
                    <h2 class="text-center">通帳</h2>
                    <div class="center" style="margin: 20px auto 20px;">
                        <form action="{{ route('passbook_search') }}" method="POST">
                            {{ csrf_field() }}

                            <select name="year">
                                @for ($i = now()->format('Y'); $i >= now()->format('Y') - 1; $i--)
                                    <option value="{{ $i }}" {{ !empty($year) && ($year == $i) ? 'selected' : '' }}>{{ $i }}年</option>
                                @endfor
                            </select>

                            <select name="month">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ !empty($month) && ($month == $i) ? 'selected' : '' }}>{{ $i }}月</option>
                                @endfor
                            </select>

                            <button class="refine_btn" type="submit">絞り込む</button>
                        </form>
                    </div>
                </div>
                <table class="col-lg-offset-2 col-md-8 table-bordered table-striped table-condensed cf">
                    <thead class="cf">
                        <tr>
                            <th class="col-md-2">利用日</th>
                            <th class="col-md-6">内容</th>
                            <th class="col-md-1">状態</th>
                            <th class="numeric col-md-1">ポイント数</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(sizeof($actions) > 0)
                        @foreach($actions as $action)
                        <tr>
                            <td>{{ $action->created_at }}</td>
                            <td><a href="{{ route('item.show', $action->item->id) }}">{{ $action->item->title }}</a></td>
                            <td style="color: {{ $action->status == "approval" ? 'blue' : $action->status == "pending" ?: 'red' }};">{{ $action->showStatus() }}</td>
                            <td class="numeric">{{ $action->point_num }}P</td>
                        </tr>
                    @endforeach
                    @else
                        該当の履歴がありません！
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center" style="margin-top: 20px">
                @if(!empty($year) && !empty($month))
                    {!! $actions->appends(['month' => $month, 'year' => $year])->render() !!}
                @else
                    {!! $actions->links() !!}
                @endif
            </div>
        </div>
    </div>
@endsection

