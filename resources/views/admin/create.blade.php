@extends('layouts.admin')
@section('title','Creación')
@section('adminContent')
<div class="row">
    <h1 class="lead text-uppercase col-12 pt-2">@lang('admin.newAdminMessage')</h1>
    <div class="alert alert-warning col-lg-4 col-sm-12 p-2 mx-auto text-justify" role="alert">
    <h4 class="alert-heading p-2">@lang('admin.warning')</h4>
        <p class="mx-2">@lang('admin.warningP1')</p>
        <p class="mx-2">@lang('admin.warningP2')</p>
    </div>
    <form action="{{route('admin.store')}}" method="POST" id="create_form" class="col-lg-6 col-sm-12 mb-4 py-2" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <h5>@lang('admin.username')</h5>
            <input type="text" name="username" class="form-control">
            <label class="error" for="username"></label>
            @isset($username_error)
            <span class="error">@lang('main.username_error')</span>
            @endisset
        </div>
        <div class="form-group">
            <h5>@lang('admin.name')</h5>
            <input type="text" name="name" class="form-control">
            <label class="error" for="name"></label>
        </div>
        <div class="form-group">
            <h5>@lang('admin.surname')</h5>
            <input type="text" name="surname" class="form-control">
            <label class="error" for="surname"></label>
        </div>
        <div class="form-group">
            <h5>@lang('admin.email')</h5>
            <input type="email" name="email" class="form-control">
            <label class="error" for="email"></label>
        </div>
        <div class="col text-right">
            <input type="button" id="submit_create" value="@lang('admin.create')" class="btn btn-dark text-right mx-auto">
        </div>

    </form>
    @if($errors->any())
    <div id="errors">
        @foreach($errors as $error)
        <span class="error">{{$error}}</span>
        @endforeach
    </div>
    @endif
</div>

<script>
$('.active').removeClass('active');
$('#nuevoAdmin').addClass('active');
</script>


@endsection