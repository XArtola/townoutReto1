@extends('layouts.main')
@section('title','Index')
@section('content')
HOME de user no admin (no sé que hay que añadir aqui)
@endsection

@section('js')
    $(document).ready(function(){
        $('table form input[type="button"]').click(function(){
            $(this).parent('form').submit();
        });
    });
@endsection