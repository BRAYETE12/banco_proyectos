@extends('layouts.admin')
@section('app', 'ng-app=AppProyectos')
@section('controller','ng-controller=listadoCtrl')
@section('title', 'Listado de proyectos' )

@section('content')

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            
            <div class="row mt-3">
                <div class="col-md-3 col-xs-12">
                    <a class="btn btn-success" href="/proyectos/crear" title="Crear proyecto" >
                        <i class="fas fa-plus"></i>  Agregar
                    </a>
                    <a class="btn btn-primary" href="/ExcelProyectos"  download title="Descargar Excel" >
                        <i class="fas fa-download"></i>  Excel
                    </a>
                </div>
                <div class="col-md-5 col-xs-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="busqueda" ng-model="busqueda" placeholder="Búsqueda general">
                    </div>
                </div>
                <div class="col-md col-xs-12" ng-init="cantidadItemsTable='15'" >
                    <select class="form-control" ng-model="cantidadItemsTable">
                        <option value="15" selected >Items: 15</option>
                        <option value="20">Items: 20</option>
                        <option value="30">Items: 30</option>
                        <option value="40">Items: 40</option>
                        <option value="50">Items: 50</option>
                    </select>
                </div>
                <div class="col-md col-xs-12">
                    <span class="chip">@{{( proyectos |filter: busqueda).length}} Resultados</span>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody >
                    <tr dir-paginate="item in (proyectos | filter:busqueda) | itemsPerPage: itemsPerPage " >
                        <th scope="row">@{{($index+1)+(__default__currentPage - 1) * cantidadItemsTable}}</th>
                        <td>@{{item.codigo}}</td>
                        <td>@{{item.nombre}}</td>
                        <td>@{{item.fecha_inicio}}</td>
                        <td>@{{item.fecha_fin}}</td>
                        <td>@{{item.valor | currency: '$ ':0}}</td>
                        <td>
                            <a class="btn btn-xs btn-link" href="/proyectos/editar/@{{item.id}}" title="Editar proyecto" >
                                    <i class="fas fa-edit"></i>
                            </a>
                            <!--
                            <button type="button" class="btn btn-xs btn-link" ng-click="eliminarIntegrante(item,$index)" >
                                    <i class="fas fa-trash-alt"></i>
                            </button>
                             -->
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center">
                <dir-pagination-controls></dir-pagination-controls>
            </div>
            
            <div class="alert alert-info" ng-show="proyectos.length==0" >
                No hay elementos en la lista
            </div>


        </div>
    </div>


@endsection

@section('style')
    <style> 
    </style>
@endsection

@section('script')

    <script src="{{ asset('js/framework/dirPagination.js') }}"></script>
    <script src="{{ asset('js/framework/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/framework/ng-ckeditor.js') }}"></script>
    <script src="{{ asset('js/framework/ADM-dateTimePicker.min.js') }}"></script>

    <script src="{{ asset('js/proyectos/app.js') }}"></script>
    <script src="{{ asset('js/proyectos/servicios.js') }}"></script>
@endsection