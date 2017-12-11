<div class="col-sm-3 page-sidebar">
    <aside id="sidebar">
        <div class="inner-box">
            <div class="categories">
                <div id="categories-bar" class="widget-title">
                    <i class="fa fa-align-justify"></i>
                    <h4>全てカテゴリー</h4>
                </div>
                <div class="categories-list">
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('show_items_by_category', $category->id) }}">
                                    {{ $category->name }} <span class="category-counter">({{ sizeof($category->activeItems) }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
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
    </aside>
</div>

@section('categories-bar-js')
    <script type="application/javascript">
        $(document).ready(function () {
            $("#categories-bar").click(function () {
                if ($(".categories-list").hasClass("hide")) {
                    $(".categories-list").removeClass("hide");
                } else {
                    $(".categories-list").addClass("hide");
                }
            });
        });
    </script>
@endsection