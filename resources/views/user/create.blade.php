@extends ('backend.app.base')
@section('Create Producto', 'Coza Store Admin')

@section ('content')


<div class="container mt-4">
    <div class="mb-3">
        <div class="card-body">
            <form action="{{ url('user') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre del usuario</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email del usuario</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipo" class="form-label">Tipo de usuario</label>
                            <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror">
                                <option disabled value="" selected>Selecciona el tipo</option>
                                <option value="admin">Admin</option>
                                <option value="basico">Usuario Basico</option>
                            </select>
                            @error('tipo')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror      
                        </div>
                    </div>
                </div>
                <div class="d-flex mt-4">
                    <a href="{{ url('user')}}" class="btn btn-danger mx-3">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Crear Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
