@extends('layouts.app')

@push('headers')
    <link rel="stylesheet" href="http://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@section('template_title')
    Productos
@endsection
@php
    $producTotal=[];
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Productos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo producto') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id='tablaproducts'>
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
										<th>Nombre</th>
										<th>Descripcion</th>
										<th>Precio sin iva</th>
										<th>Stock</th>
										<th>Codigo</th>
                                        <th>Precio con iva</th>
                                        <th> Monto total sin iva</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $product->nombre }}</td>
											<td>{{ $product->descripcion }}</td>
											<td class="moneda">{{ $product->precioSinIva }}</td>
											<td>{{ $product->stock }}</td>
											<td>{{ $product->codigo }}</td>
                                            <td class="moneda">{{ ($product->precioSinIva * 0.19) + $product->precioSinIva }}</td>
                                            @php
                                              $producTotal[$key] = $product->precioSinIva * $product->stock;
                                            @endphp
                                            <td class="moneda">{{ $producTotal[$key] }}</td>
                                            <td>
                                                <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                                    <div class="btn">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('products.show',$product->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('products.edit',$product->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                    </div>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $products->links() !!}
            </div>
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">Suma de montos totales de productos sin iva</div>
                    <div class="card-body">
                        <span class="moneda" style='color:black;font-size:15px;'>
                            <b>
                              {{collect($producTotal)->sum()}}
                            </b>
                        </span></div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
        $(document).ready( function () {
    $('#tablaproducts').DataTable();

    $("td.moneda").each(function(index, el) {
            let valor = $(this).html();
            if(!isNaN(valor)){
                let valorMoneda = formatCurrency("es-CO", "COP", 0, valor);
              $(this).html(valorMoneda);
            }
         });

         $("span.moneda b").each(function(index, el) {
            let valor = $(this).html();
            if(!isNaN(valor)){
                let valorMoneda = formatCurrency("es-CO", "COP", 0, valor);
              $(this).html(valorMoneda);
            }
         });
} );
    </script>
    @endpush
@endsection
