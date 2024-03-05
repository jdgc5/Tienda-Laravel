@extends('backend.app.base')

@section('title', 'Coza Store Admin')

@section('content')

@include('backend.modal.deletecarta')

<div class="row">
  <div class="col-md-2">
    <form class="d-flex">
      <input type="hidden" value="{{$orderBy}}" name="orderBy">
      <input type="hidden" value="{{$orderType}}" name="orderType">
      <input type="hidden" value="{{$q}}" name="q">
      <select name="rowsPerPage" id="" class="form-select">
        @foreach($rpps as $index => $value)
          <option value="{{$index}}" @if($rpp == $index) selected @endif>{{$index}}</option>
        @endforeach
      </select>
      <button type="submit" class="btn btn-primary mx-4">View</button>
    </form>
  </div>
<div class="col-md-6 justify-content-center text-center">
  <a class="btn btn-primary mb-3" href="{{ route('admin.create') }}">Crear Producto</a>
</div>
  <div class="col-md-4">
    <div class="d-flex justify-content-end">
      <form action="" class="d-flex mx-3">
        <input type="hidden" value="{{$orderBy}}" name="orderBy">
        <input type="hidden" value="{{$orderType}}" name="orderType">
        <input type="hidden" value="{{$q}}" name="q">
        <input type="hidden" value="{{$rpp}}" name="rowsPerPage">
        <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search" value="{{$q}}">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</div>


<div class="table-responsive small">
    <table class="table table-bordered">
        <thead>
            <tr>
              <th scope="col">Nombre
                <a href="?rowsPerPage={{$rpp}}&orderBy=productos.nombre&orderType=desc&q={{$q}}"><i class="bi bi-arrow-down-short"></i></a>
                <a href="?rowsPerPage={{$rpp}}&orderBy=productos.nombre&orderType=asc&q={{$q}}"><i class="bi bi-arrow-up-short"></i></a>
              </th>
              <th scope="col">Stock
                <a href="?rowsPerPage={{$rpp}}&orderBy=productos.stock&orderType=desc&q={{$q}}"><i class="bi bi-arrow-down-short"></i></a>
                <a href="?rowsPerPage={{$rpp}}&orderBy=productos.stock&orderType=asc&q={{$q}}"><i class="bi bi-arrow-up-short"></i></a>
               </th>
               <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid" alt="{{ $producto->nombre }}" width="100px">
                        @else
                        <img src="{{ asset('uploads/No_Picture.jpg') }}" class="img-fluid" alt="{{ $producto->nombre }}" width="100px">
                        @endif
                        <span class="ms-3">{{ $producto->nombre }}</span>
                    </div>
                </td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-primary" href="{{ url('admin/' . $producto->id) }}"><i class="fa-regular fa-eye"></i></a>
                        <a class="btn btn-warning" href="{{ url('admin/' . $producto->id . '/edit') }}"><i class="fa-solid fa-pen"></i></a>
                        <button data-url="{{ url('admin/' . $producto->id) }}" data-title="{{ $producto->title }}" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteCartaModal">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div>
  {{ $productos->appends(['orderBy' => $orderBy ,'orderType' => $orderType, 'q' => $q, 'rowsPerPage' => $rpp])->onEachSide(2)->links() }}
</div>



<script>
  const deleteCartaModal = document.getElementById('deleteCartaModal');
  const cartaTitle = document.getElementById('cartaTitle');
  const formDeleteV3 = document.getElementById('formDeleteV3');
  deleteCartaModal.addEventListener('show.bs.modal', event => {
  cartaTitle.innerHTML = event.relatedTarget.dataset.title;
  formDeleteV3.action = event.relatedTarget.dataset.url;
  });
</script>
@endsection