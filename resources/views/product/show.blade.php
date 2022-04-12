@extends('layouts.app')

@section('template_title')
    {{ $product->name ?? 'Show Product' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar producto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('products.index') }}"> Atrás</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $product->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $product->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Preciosiniva:</strong>
                            {{ $product->precioSinIva }}
                        </div>
                        <div class="form-group">
                            <strong>Stock:</strong>
                            {{ $product->stock }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $product->codigo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
