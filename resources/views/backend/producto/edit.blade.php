@extends ('backend.app.base')
@section('edit', 'Coza Store')

@section ('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}">
            @else
                <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid" alt="{{ $producto->name }}">
            @endif
            <form action="{{ url('admin/' . $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="image" class="mb-3">Edit Image</label>
                    <input type="file" class="form-control btn btn-warning" id="imagen" name="imagen">
                </div>
                <button class="btn btn-primary mt-3" type="submit">Actualiza Imagen</button>
        </div>
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                   
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nombre" class="mb-1">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" maxlength="60" required value="{{ old('nombre', $producto->nombre) }}">
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="mb-1">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="255" value="{{ old('descripcion', $producto->descripcion) }}">
                        </div>
                        <div class="form-group">
                            <label for="genero" class="mb-1">Género</label>
                            <select name="genero" id="genero" class="form-select">
                                <option disabled value="" selected>Selecciona el género</option>
                                <option value="Hombre" @if($producto->genero == 'hombre') selected @endif>Hombre</option>
                                <option value="Mujer" @if($producto->genero == 'mujer') selected @endif>Mujer</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="talla" class="mb-1">Talla</label>
                            <input type="text" class="form-control" id="talla" name="talla" maxlength="20" required value="{{ old('talla', $producto->talla) }}">
                        </div>
                        <div class="form-group">
                            <label for="color" class="mb-1">Color</label>
                            <input type="text" class="form-control" id="color" name="color" maxlength="20" required value="{{ old('color', $producto->color) }}">
                        </div>
                        <div class="form-group">
                            <label for="precio" class="mb-1">Precio</label>
                            <input type="number" class="form-control" id="precio" name="precio" min="0" required value="{{ old('precio', $producto->precio) }}">
                        </div>
                        <div class="form-group">
                            <label for="stock" class="mb-1">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" min="0" required value="{{ old('stock', $producto->stock) }}">
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('admin') }}" class="btn btn-danger m-3">Cancelar</a>
                            <button class="btn btn-primary m-3" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

