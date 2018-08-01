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
                    <div class="ibox-title">
                        <h5>Informacion del producto</h5>
                    </div>
                    <div class="ibox-content">
                        <form action="">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Categoria</label>
                                <select class="form-control" id="category">
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
                                    <div class="propertyDiv">

                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="exampleInputEmail1">Precio</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="number" class="form-control" id="exampleInputAmount" placeholder="Precio">
                                </div>
                            </div>
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
                    $.getJSON('/api/category/'+$(this).val()+'/property', { }, function(data) {
                        $.each(data, function(index, element) {
                            $('.propertyDiv').html('');
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
                '                                <label for="exampleInputEmail1">'+property.name+'</label>\n' +
                '                                <input type="email" class="form-control" id="property_'+property.id+'" placeholder="'+property.name+'">\n' +
                '                            </div>';

            divProperty.append(html);
        }
    </script>
@endsection