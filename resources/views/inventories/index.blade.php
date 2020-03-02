@extends('layouts.app')

@section('title') Categories @endsection

@section('css')
<link href="{{ url('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
<link href="{{ url('/css/plugins/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <a href="{{ route('products.index') }}" class="btn btn-primary">All Products</a>
    <h1>Create new inventory for {{ $product->name }}</h1>
    <form class="form-horizontal" method="POST" action="{{ route('products.inventories.store', ['product' => $product->id]) }}">
        {{ csrf_field() }}
        <div class="form-group @error('machine_id') has-error @enderror"><label class="col-lg-2 control-label">Machine</label>
            <div class="col-lg-7">
                <select name="machine_id" class="form-control">
                    <option value="">Select Machine</option>
                    @foreach($machines as $machine)
                        <option value="{{ $machine->id }}">{{ $machine->name .'-'. $machine->location }}</option>
                    @endforeach
                </select>
                @error('machine_id')
                <span class="help-block text-red m-b-none">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group @error('for_day') has-error @enderror"><label class="col-lg-2 control-label">Date</label>
            <div class="col-lg-7">
                <input readonly type="text" id="for_day" name="for_day" value="{{ old('for_day') }}" placeholder="Date of the day" class="form-control">
                @error('for_day')
                <span class="help-block text-red m-b-none">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group @error('quantity') has-error @enderror"><label class="col-lg-2 control-label">Quantity</label>
            <div class="col-lg-7">
                <input type="number" name="quantity" value="{{ old('quantity')  }}" class="form-control">
                @error('quantity')
                <span class="help-block text-red m-b-none">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <h1>All inventories for {{ $product->name }}</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
                <tr role="row">
                    <th>ID</th>
                    <th>Date</th>
                    <th>Inventory</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                <tr class="gradeA">
                    <td>{{ $inventory->id }}</td>
                    <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $inventory->for_day)->toFormattedDateString() }}</td>
                    <td>{{ $inventory->quantity }}</td>
                    <td class="center">
                        <a href="{{ route('products.inventories.edit', [ 'product' => $product->id, 'inventory' => $inventory->id ]) }}" class="btn btn-primary dim" >
                            <i class="fa fa-edit"></i>
                        </a>

                        <form id="delete_form" action="{{ route('products.inventories.destroy', [ 'product' => $product->id, 'inventory' => $inventory ]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <a class="btn btn-danger dim" onclick="document.getElementById('delete_form').submit();">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('script_files')

<!-- Mainly scripts -->
<script src="{{ url('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ url('/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ url('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('/js/plugins/jeditable/jquery.jeditable.js') }}"></script>

<script src="{{ url('/js/plugins/dataTables/datatables.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ url('/js/inspinia.js') }}"></script>
<script src="{{ url('/js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ url('/js/plugins/jquery.datetimepicker.full.min.js') }}"></script>
<script src="{{ url('/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ url('/js/custom.js') }}"></script>

@endsection

@section('script_code')

<script>
    $(document).ready(function() {
        $('#DataTables_Table_0').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'excel',
                    title: 'Categories'
                },
                {
                    extend: 'pdf',
                    title: 'Categories'
                },
                {
                    extend: 'print',
                    customize: function(win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });
        $('#for_day').datetimepicker({
            timepicker:false,
            minDate: new Date(),
            format: 'Y-m-d',
            theme: 'dark'
        });


    });
</script>
@endsection
</body>

</html>
