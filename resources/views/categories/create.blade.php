@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Crear categoria</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ Illuminate\Support\Facades\URL::previous() }}" class="btn btn-danger">Volver</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Informacion categoria</h5>
                    </div>
                    <div class="ibox-content">
                        @if($errors->any())
                            <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                            </div>
                        @endif
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre">
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Propiedades</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-success" id="add-property">Agregar</button>
                                                </div>
                                                <div class="col-md-12 propertyDiv">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            let $propertyDiv = $(".propertyDiv");

            $("#add-property").click(function(){
                let html = '<div class="input-group">\n' +
                    '                                        <input type="text" class="form-control" name="property[]" placeholder="Nombre">\n' +
                    '                                        <span class="input-group-btn">\n' +
                    '                                            <button class="btn btn-danger" type="button" onclick="$(this).parents(\'.input-group\').remove();">\n' +
                    '                                                <i class="fa fa-trash delete-property"></i>\n' +
                    '                                            </button>\n' +
                    '                                        </span>\n' +
                    '                                    </div>';

                $propertyDiv.append(html);
                return false;
            });
        });
    </script>
@endsection