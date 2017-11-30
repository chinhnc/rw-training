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
                                    <input class="form-control keyword" name="keyword" value="{{ empty($keyword) ? '' : $keyword }}" placeholder="Enter Keyword" type="text">
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