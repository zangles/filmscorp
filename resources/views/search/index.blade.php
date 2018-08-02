@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Busqueda</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Cuadro de busqueda</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
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
                                            <div class="form-group">
                                                <label for="category">Propiedad</label>
                                                <select class="form-control" id="propertySelect">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Valor</label>
                                            <input type="text" class="form-control" id="valor" name="value" placeholder="Valor" value="">
                                        </div>
                                        <button class="btn btn-primary">Buscar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
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
                let $spiner = $(".sk-spinner");
                $spiner.show();
                var categoryId = $(this).val();
                if (categoryId !== 0) {
                    $('.propertyDiv')
                        .find('option')
                        .remove();
                    $.getJSON('/api/category/'+$(this).val()+'/property', { }, function(data) {
                        $.each(data, function(index, element) {
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
            let propertySelect = $('#propertySelect');
            propertySelect
                .append($("<option></option>")
                    .attr("value",property.id)
                    .text(property.name));
        }
    </script>
@endsection