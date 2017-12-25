<div class="widget widget-popular-posts">
    <div class="widget-title">
        <h4>ランキング</h4>
    </div>
    <ul class="posts-list">
        @for($i = 0; $i < sizeof($top_users); $i++)
            <li>
                <div class="widget-thumb">
                    <a href="#"><img src="{{ asset('/assets/img/rank' . ($i + 1) . '.png') }}" alt=""></a>
                </div>
                <div class="widget-content">
                    <a>{{ $top_users->get($i)->user->nickname }}さん</a>
                    <div style="color: red">{{ $top_users->get($i)->sum_point }}pt</div>
                </div>
                <div class="clearfix"></div>
            </li>
        @endfor
    </ul>
</div>