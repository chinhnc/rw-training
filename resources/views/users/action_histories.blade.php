@extends('layouts.app')

@section('content')
    <div id="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-md-8 search-form">
                    <form action="{{ route('passbook_search') }}" method="POST">
                        {{ csrf_field() }}

                        <select name="year">
                            @for ($i = now()->format('Y'); $i >= now()->format('Y') - 1; $i--)
                                <option value="{{ $i }}">{{ $i }}年</option>
                            @endfor
                        </select>

                        <select name="month">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ now()->format('m') != $i?: 'selected' }}>{{ $i }}月</option>
                            @endfor
                        </select>

                        <button class="refine_btn" type="submit">絞り込む</button>
                    </form>
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
                            <td>{{ $action->item->title }}</td>
                            <td style="color: {{ $action->status == "approval" ? 'blue' : $action->status == "pending" ?: 'red' }};">{{ $action->status }}</td>
                            <td class="numeric">{{ $action->point_num }}</td>
                        </tr>
                    @endforeach
                    @else
                        該当の履歴がありません！
                    @endif
                    </tbody>
                </table>
            </div>
            <div class="text-center" style="margin-top: 20px">
                {{ $actions->links() }}
            </div>
        </div>
    </div>
@endsection

