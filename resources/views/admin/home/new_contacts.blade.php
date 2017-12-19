<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">New Contacts</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-striped">

                @foreach($new_contacts as $contact)
                    <tr>
                        <td width="120px">
                            <a {{ $contact->user['nickname'] ? 'href=' . route('users.edit', $contact->user['id']) : '' }}>
                                {{ $contact->user['nickname'] ? $contact->user['nickname'] : 'Unknown' }}</a>
                        </td>
                        <td>{{ $contact->subject }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <!-- /.table-responsive -->
    </div>
    <!-- /.box-body -->
</div>