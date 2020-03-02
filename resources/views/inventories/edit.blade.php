@extends('layouts.app')

@section('title') Edit Inventory @endsection

@section('css')
    <link href="{{ url('/css/plugins/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <a href="javascript:history.go(-1)" class="btn btn-primary">Go Back</a>
        <h2>Update Inventory for {{ $product->name }}</h2>
        <div class="ibox">
            <div class="ibox-content" style="background-color:#dbe0d6;border-radius:5px">
                <form class="form-horizontal" method="POST" action="{{ route('products.inventories.update', ['product' => $product->id, 'inventory' => $inventory]) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group @error('for_day') has-error @enderror"><label class="col-lg-2 control-label">Date</label>
                        <div class="col-lg-7">
                            <input readonly type="text" id="for_day" name="for_day" value="{{ $inventory->for_day }}" placeholder="Date of the day" class="form-control">
                            @error('for_day')
                            <span class="help-block text-red m-b-none">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('quantity') has-error @enderror"><label class="col-lg-2 control-label">Quantity</label>
                        <div class="col-lg-7">
                            <input type="number" name="quantity" value="{{ $inventory->quantity }}" class="form-control">
                            @error('quantity')
                            <span class="help-block text-red m-b-none">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
@endsection

@section('script_files')

<!-- Mainly scripts -->
<script src="{{ url('js/jquery-2.1.1.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ url('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ url('js/inspinia.js') }}"></script>
<script src="{{ url('js/plugins/pace/pace.min.js') }}"></script>

<!-- Steps -->
<script src="{{ url('js/plugins/staps/jquery.steps.min.js') }}"></script>

<!-- Jquery Validate -->
<script src="{{ url('js/plugins/validate/jquery.validate.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ url('/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ url('/js/plugins/jquery.datetimepicker.full.min.js') }}"></script>
@endsection
@section('script_code')


<script>
    $(document).ready(function() {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
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
