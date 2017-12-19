<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">New Items</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">

            @foreach($new_items as $item)
                <li class="item">
                    <div class="product-img">
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="">
                    </div>
                    <div class="product-info">
                        <a href="{{ route('items.show', $item->id) }}" target="_blank" class="product-title">
                            {{ str_limit($item->title, 50, '...') }}
                        </a>
                        @if($item->is_active)
                            <span class="pull-right installed"><i class="fa fa-check"></i></span>
                        @endif
                    </div>
                </li>
        @endforeach

        <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        <a href="{{ route('items.index') }}" target="_blank" class="uppercase">View All Items</a>
    </div>
    <!-- /.box-footer -->
</div>