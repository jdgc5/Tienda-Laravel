@extends('backend.app.base')
@section('title', 'Coza Store')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
            @else
                <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid" alt="{{ $producto->nombre }}">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <h5 class="card-title">{{ $producto->name }}</h5>
                </div>
                <ul class="list-group">
                    <li class="list-group-item"><span class="fw-bold">Nombre:</span> {{ $producto->nombre }}</li>
                    <li class="list-group-item"><span class="fw-bold">Descripción:</span> {{ $producto->descripcion }}</li>
                    <li class="list-group-item"><span class="fw-bold">Género:</span> {{ $producto->genero }}</li>
                    <li class="list-group-item"><span class="fw-bold">Talla:</span> {{ $producto->talla }}</li>
                    <li class="list-group-item"><span class="fw-bold">Color:</span> {{ $producto->color }}</li>
                    <li class="list-group-item"><span class="fw-bold">Precio:</span> {{ $producto->precio }}€</li>
                    <li class="list-group-item"><span class="fw-bold">Stock:</span> {{ $producto->stock }}</li>
                </ul>
                </ul>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-center">
            <a href="{{ url('admin') }}" class="btn btn-primary mt-3 me-2">Volver</a>
            <a class="btn btn-secondary mt-3 me-2" href="{{url('admin/' . $producto->id . '/edit')}}">Editar</a>
            <form class="formDelete" action="{{ url('admin/' . $producto->id) }}" method="post" style="display: inline-block">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger mt-3">Eliminar</button>
            </form>
        </div>
    </div>
</div>

@endsection
