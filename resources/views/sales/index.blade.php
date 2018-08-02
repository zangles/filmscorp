@extends('layouts.base')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-4">
            <h2>Ventas</h2>
        </div>
        <div class="col-sm-8">
            <div class="title-action">
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
                        <h5>Lista de Ventas por categoria</h5>
                    </div>
                    <div class="ibox-content">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Categoria</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $lastCategory = ""
                            @endphp
                            @foreach($sales as $sale)

                                <tr>
                                    <td>
                                        @if ($lastCategory != $sale->category)
                                            {{ $sale->category }}
                                            @php
                                                $lastCategory = $sale->category;
                                            @endphp
                                        @endif
                                    </td>
                                    <td>{{ $sale->name }}</td>
                                    <td>{{ $sale->cantidad }}</td>
                                    <td>$ {{ $sale->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection