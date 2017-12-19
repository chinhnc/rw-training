<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">New Users</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @foreach($new_users as $user)
                <li class="item">
                    <div class="product-img">
                        <i class="fa fa-user fa-2x ext-icon"></i>
                    </div>
                    <div class="product-info">
                        <a href="{{ route('users.show', $user->id) }}" target="_blank" class="product-title">
                            {{ $user->nickname }}
                        </a>
                        @if($user->activated)
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
        <a href="{{ route('users.index') }}" target="_blank" class="uppercase">View All Users</a>
    </div>
    <!-- /.box-footer -->
</div>