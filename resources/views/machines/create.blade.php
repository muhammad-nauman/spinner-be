@extends('layouts.app')

@section('title') Add Machine @endsection
@section('css')
<link href="{{ url('/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
<link href="{{ url('/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
<link href="{{ url('/css/plugins/summernote/summernote.css') }}" rel="stylesheet">
<link href="{{ url('/css/plugins/summernote/summernote-bs3.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-md-12">
    <a href="{{ route('machines.index') }}" class="btn btn-primary">All Machines</a>
    <h1>New Machine</h1>
    <form class="form-horizontal" method="POST" action="{{ route('machines.store') }}">

        {{ csrf_field() }}
        <div class="form-group @error('name') has-error @enderror"><label class="col-lg-2 control-label">Name</label>
            <div class="col-lg-7">
                <input type="text" name="name" placeholder="Name of Machine" class="form-control" value="{{ old('name') }}">
                @error('name')
                <span class="help-block text-red m-b-none">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group @error('location') has-error @enderror"><label class="col-lg-2 control-label">Location</label>
            <div class="col-lg-7">
                <input type="text" name="location" placeholder="Location of the Machine" class="form-control" value="{{ old('location') }}">
                @error('location')
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
</div>

@endsection

@section('script_files')

<!-- Mainly scripts -->
<script src="{{ url('/js/jquery-2.1.1.js') }}"></script>
<script src="{{ url('/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ url('/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ url('/js/inspinia.js') }}"></script>
<script src="{{ url('/js/plugins/pace/pace.min.js') }}"></script>

<!-- iCheck -->
<script src="{{ url('/js/plugins/iCheck/icheck.min.js') }}"></script>
<script src="{{ url('/js/plugins/summernote/summernote.min.js') }}"></script>

@endsection

@section('script_code')

<script>
    function checkSelectedTypeOption() {
        const selected = $('#content_type option:selected').val()
        if(selected === 'audio') {
            $('div.audio').removeClass('pace-inactive')
            $('div.article').addClass('pace-inactive')
        }
        if(selected === 'article') {
            $('div.audio').addClass('pace-inactive')
            $('div.article').removeClass('pace-inactive')
        }
        if(selected === '') {
            $('div.audio').addClass('pace-inactive')
            $('div.article').addClass('pace-inactive')
        }
    }
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Write Article Content here',
        });

        checkSelectedTypeOption();
        $(document).on('change', '#content_type', function() {
            checkSelectedTypeOption();
        });
    });
</script>
@endsection
</body>

</html>
