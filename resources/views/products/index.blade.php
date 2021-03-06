@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Productos</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('products.create') }}" class="btn btn-primary">Nuevo Producto</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                @if(session()->has('status'))
                    <div class="alert alert-success alert-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ session('status') }}
                    </div>
                @endif
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Lista de productos</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>$ {{ $product->price }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-info" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-product"  data-id="{{ $product->id }}" title="Borrar">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form action="{{ route('products.destroy', $product) }}" id="delete_form_{{ $product->id }}" style="display: none" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.delete-product').click(function(){
                if(confirm('Esta seguro que desea borrar el producto?')) {
                    let id = $(this).data('id');
                    $('#delete_form_'+id).submit();
                }
            });
        });
    </script>
@endsection