@extends('layouts.admin')
@section('adminContent')
<h1 class="lead text-uppercase">Mensajes</h1>

@foreach( $messages as $message)
<div class="row">
    <div class="col-lg-8 col-sm-12 pb-4 mx-lg-auto contactMessage mb-2">
        <h4 class="pt-2">{{$message->nombre}} {{$message->apellido}} <span class="ml-4 lead">{{date_format($message->created_at,'Y-m-d')}}</span><span class="ml-4 lead">{{date_format($message->created_at,'H:i:s')}}</span>
        </h4>
        <i class="fa fa-md @if($message->active == 0)fa-envelope-open @else fa-envelope @endif
"></i>
        <hr class="bg-dark">
        <p class="text-justify @if($message->active)font-weight-bold @endif">{{$message->mensaje}}</p>
        <span class="text-justify"><i class="fa fa-at fa-lg" style="color:black"></i> {{$message->email}}</span>

        @if($message->active == 1)
        <div class="d-flex flex-row mt-2 justify-content-end">
            <form method="POST" action="{{route('messages.update',$message->id)}}" class="text-right">
                @csrf
                {{ method_field('PUT') }}
                <button class="btn btn-dark bg-dark mr-4">Resuelto</button>
                <input type="hidden" value="true" name="active">
            </form>
            <form method="POST" action="{{route('messages.destroy',$message->id)}}" class="text-right">
                @csrf
                {{ method_field('DELETE') }}
                <button class="btn btn-dark bg-dark mr-4">Eliminar</button>
                <input type="hidden" value="true" name="active">
            </form>
        </div>
        @else
        <form method="POST" action="{{route('messages.destroy',$message->id)}}" class="text-right">
            @csrf
            {{ method_field('DELETE') }}
            <button class="btn btn-dark bg-dark m-4">Eliminar</button>
            <input type="hidden" value="true" name="active">
        </form>
        @endif
    </div>
</div>
@endforeach

@endsection