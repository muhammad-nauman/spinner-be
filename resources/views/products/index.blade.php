@extends('layouts.app')

@section('title') Products @endsection

@section('css')
<link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
<link href="{{ url('css/plugins/sweetalert/sweetalert.css')  }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
    <h1>All Products</h1>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid">
            <thead>
                <tr role="row">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Is Active?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr class="gradeA">
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->status === 1 ? 'Yes' : 'No' }}</td>
                    <td class="center">
                        <a href="{{ route('products.inventories.index', [ 'product' => $product->id ]) }}" class="btn btn-primary dim" >
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="{{ route('products.show', [ 'product' => $product->id ]) }}" class="btn btn-primary dim" >
                            <i class="fa fa-edit"></i>
                        </a>
                        <form id="{{ 'delete_form_' . $product->id }}" action="{{ route('products.destroy', [ 'product' => $product->id ]) }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        </form>
                        <a class="btn btn-danger dim" onclick="event.preventDefault(); onDelete(document.getElementById(`{{ 'delete_form_' . $product->id }}`))">
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
<script src="js/jquery-2.1.1.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>
<script src="js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="js/custom.js"></script>

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


    });
</script>
@endsection
</body>

</html>
