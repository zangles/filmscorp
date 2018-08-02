@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Nuevo Productos</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
                <a href="{{ Illuminate\Support\Facades\URL::previous() }}" class="btn btn-danger">Volver</a>
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="ibox float-e-margins">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        </div>
                    @endif
                    <div class="ibox-title">
                        <h5>Informacion del producto</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ route('products.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="name" placeholder="Nombre" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Precio</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">$</div>
                                            <input type="number" class="form-control" name="price" id="exampleInputAmount" placeholder="Precio" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category">Categoria</label>
                                        <select class="form-control" id="category" name="category">
                                            <option value="0">- Seleccione -</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Propiedades de categoria</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="sk-spinner sk-spinner-cube-grid" style="display: none">
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                                <div class="sk-cube"></div>
                                            </div>
                                            <div class="propertyDiv">

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
            $("#category").change(function(){
                var categoryId = $(this).val();
                if (categoryId !== 0) {
                    let $spiner = $(".sk-spinner");
                    $spiner.show();
                    $.getJSON('/api/category/'+$(this).val()+'/property', { }, function(data) {
                        $.each(data, function(index, element) {
                            $('.propertyDiv').html('');
                            $spiner.hide();
                            $.each(element.properties, function(index2, property) {
                                createProperty(property);
                            });
                        });
                    });
                }
            });
        });

        function createProperty(property){
            let divProperty = $('.propertyDiv');
            let html = '<div class="form-group">\n' +
                '                                <label for="property_'+property.id+'">'+property.name+'</label>\n' +
                '                                <input type="text" name="property['+property.id+']" class="form-control" id="property_'+property.id+'" placeholder="'+property.name+'">\n' +
                '                            </div>';

            divProperty.append(html);
        }
    </script>
@endsection