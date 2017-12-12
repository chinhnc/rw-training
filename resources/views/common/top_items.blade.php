<!-- Featured Listings Start -->
<section class="featured-lis" >
    <div class="container">
        <div class="row">
            <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
                <h3 class="section-title">人気案件</h3>
                <div id="new-products" class="owl-carousel">
                    @foreach($top_items as $top_item)
                        <div class="item">
                            <div class="product-item">
                                <div class="carousel-thumb">
                                    <img src="{{ asset('uploads/' . $top_item->item->image) }}" alt="" style="width:196px;height:147px;">
                                    <div class="overlay">
                                        <a href="{{ route('item.show', $top_item->item->id) }}"><i class="fa fa-link"></i></a>
                                    </div>
                                </div>
                                <a href="{{ route('item.show', $top_item->item->id) }}" class="item-name">{{ str_limit($top_item->item->title, $limit = 20, $end = '...') }}</a>
                                <span class="price">{{ $top_item->item->point_num }}P</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Featured Listings End -->