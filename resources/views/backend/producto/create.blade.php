@extends ('backend.app.base')
@section('Create Producto', 'Coza Store Admin')

@section ('content')


<div class="container mt-4">
    <div class="mb-3">
        <div class="card-body">
            <form action="{{ url('admin') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="nombre" class="form-label">Nombre del producto</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" required value="{{ old('nombre') }}">
                            @error('nombre')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="descripcion" class="form-label">Descripción del producto</label>
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required>{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="genero" class="form-label">Género</label>
                            <select name="genero" id="genero" class="form-select @error('genero') is-invalid @enderror">
                                <option disabled value="" selected>Selecciona el género</option>
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                            </select>
                            @error('genero')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="talla" class="form-label">Talla</label>
                            <input type="text" class="form-control @error('talla') is-invalid @enderror" id="talla" name="talla" required value="{{ old('talla') }}">
                            @error('talla')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror      
                        </div>
                        <div class="form-group">
                            <label for="color" class="form-label">Color</label>
                            <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" required value="{{ old('color') }}">
                            @error('color')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror      
                        </div>
                        <div class="form-group">
                            <label for="precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio" required value="{{ old('precio') }}">
                            @error('precio')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" required value="{{ old('stock') }}">
                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="imagen" class="form-label">Imagen del producto</label>
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen">
                            @error('imagen')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('admin.index')}}" class="btn btn-danger mx-3">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Crear Producto</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
