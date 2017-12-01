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
                                    <input id="search-input" class="form-control keyword" name="keyword" value="{{ empty($keyword) ? '' : $keyword }}" placeholder="Enter Keyword" type="text">
                                    <span class="material-input"></span>
                                </div>
                                <i class="fa fa-search"></i>
                            </div>
                            <div class="col-md-3 col-sm-6 search-col">
                                <button type="submit" class="btn btn-common btn-search btn-block"><strong>Search</strong></button>
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
            });
        });
    </script>
@endsection