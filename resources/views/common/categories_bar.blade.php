<div class="col-sm-3 page-sidebar">
    <aside>
        <div class="inner-box">
            <div class="categories">
                <div class="widget-title">
                    <i class="fa fa-align-justify"></i>
                    <h4>全てカテゴリー</h4>
                </div>
                <div class="categories-list">
                    <ul>
                        @foreach ($categories as $category)
                            <li>
                                <a href="{{ route('show_items_by_category', $category->id) }}">
                                    {{ $category->name }} <span class="category-counter">({{ sizeof($category->items) }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </aside>
</div>