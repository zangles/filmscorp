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
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                            </div>
                        @endif
                        <form action="{{ route('search.result') }}" method="post">
                            @csrf
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
                                                    <select class="form-control" id="propertySelect" name="property">
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre">Valor</label>
                                                <input type="text" class="form-control" id="valor" name="value" placeholder="Valor">
                                            </div>
                                            <button class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if(isset($result))
                                        <h2><strong>Resultado</strong></h2>
                                        <hr>
                                        @foreach($result as $item)
                                            <div class="contact-box">
                                                <a href="#">
                                                    <div class="col-sm-8">
                                                        <h3><strong>{{ $item->name }}</strong></h3>
                                                        <p><i class="fa fa-dollar"></i>  Precio: {{ $item->price }}</p>
                                                        <address>
                                                            @foreach( $item->property as $property)
                                                                - {{ $property->name }}: {{ $property->pivot->value }} <br>
                                                            @endforeach
                                                        </address>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
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