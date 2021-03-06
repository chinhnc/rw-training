@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.theme.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.structure.min.css') }}" type="text/css">
@endsection

<section id="intro" class="section-intro">
    <div class="overlay">
        <div class="container">
            <div class="main-text">
                <div class="row search-bar">
                    <div class="col-lg-offset-2">
                        <form class="search-form" method="POST" action="{{ route('item_search') }}">
                            {{ csrf_field() }}

                            <div class="col-md-6 col-sm-6 search-col">
                                <div class="form-group is-empty">
                                    <input id="search-input" class="form-control keyword"
                                           name="keyword" value="{{ empty($keyword) ? '' : $keyword }}"
                                           placeholder="キーワード入力…" type="text" autocomplete="off">
                                    <span class="material-input"></span>
                                </div>
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="col-md-3 col-sm-6 search-col">
                                <button type="submit" class="btn btn-common btn-search btn-block"><strong>検索</strong></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@section('javascript')
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script type="application/javascript">
        $(function() {
            $( "#search-input" ).autocomplete({
                source: "/search/autocomplete",
                minLength: 3,
                select: function(event, ui) {
                    $('#search-input').val(ui.item.value);
                }
            }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
                var inner_html = '<a href="' + item.url + '" >' +
                    '<div class="list_item_container">' +
                    '<div class="image">' +
                    '<img src="' + item.image + '" >' +
                    '</div>' +
                    '<div class="label-search truncate">' +
                    '<h4><b>' + item.title + '</b></h4>' +
                    '</div>' +
                    '</div>' +
                    '</a>';
                return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
            };
        });
    </script>
@endsection