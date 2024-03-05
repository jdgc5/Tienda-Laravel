@extends('backend.app.base')
@section('title', 'Coza Store')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h5 class="card-title">Ficha de Usuario}</h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><span class="fw-bold">Nombre Usuario: </span> {{ $user->name }}</li>
                    <li class="list-group-item"><span class="fw-bold">Email Usuario: </span> {{ $user->email }}</li>
                    <li class="list-group-item"><span class="fw-bold">Tipo de Usuario: </span> {{ $user->tipo }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <a href="{{ url('user') }}" class="btn btn-primary mt-3 me-3">Volver</a>
            <a class="btn btn-secondary mt-3 me-3" href="{{url('user/' . $user->id . '/edit')}}">Editar</a>
            <form class="formDelete" action="{{ url('user/' . $user->id) }}" method="post" style="display: inline-block">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger mt-3">Eliminar</button>
            </form>
        </div>
    </div>
</div>


@endsection


