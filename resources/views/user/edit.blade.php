@extends ('backend.app.base')
@section('edit', 'Coza Store')

@section ('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">
            <div class="">
                <div class="card-body">
                    <form action="{{ url('user/' . $user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name" class="form-label">Nombre del usuario</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $user->name }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email del usuario</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $user->email }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select name="tipo" id="tipo" class="form-select @error('tipo') is-invalid @enderror">
                                <option disabled value="">Selecciona el rol</option>
                                <option value="admin" {{ old('tipo', $user->tipo) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="basico" {{ old('tipo', $user->tipo) == 'basico' ? 'selected' : '' }}>Basico</option>
                            </select>
                            @error('tipo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('user') }}" class="btn btn-danger m-3">Cancelar</a>
                            <button class="btn btn-primary m-3" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

