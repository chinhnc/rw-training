<div class="col-sm-3 page-sidebar">
    <aside>
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