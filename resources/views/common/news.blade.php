<div class="head-faq text-center">
    <h2 class="section-title">お知らせ</h2>
</div>
<div class="panel-group" id="accordion">
    @foreach($news as $key => $value)
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $key }}" class="collapsed" aria-expanded="false">
                        【{{ $value->created_at }}】{{ $value->title }}
                    </a>
                </h4>
            </div>
            <div id="collapse{{ $key }}" class="panel-collapse collapse" aria-expanded="false">
                <div class="panel-body">
                    {!! $value->content !!}
                </div>
            </div>
        </div>
    @endforeach
</div>
