@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Categorias</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Nueva Categoria</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="ibox float-e-margins">
                    @if(session()->has('status'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="ibox-title">
                        <h5>Lista de categorias</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-info" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-category" data-id="{{ $category->id }}" title="Borrar">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <form action="{{ route('categories.destroy', $category) }}" id="delete_form_{{ $category->id }}" style="display: none" method="post">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('.delete-category').click(function(){
                if(confirm('Esta seguro que desea borrar la categoria? \n Todos los productos que contentan dicha categoria seran borrados con la misma.')) {
                    let id = $(this).data('id');
                    $('#delete_form_'+id).submit();
                }
            });
        });
    </script>
@endsection