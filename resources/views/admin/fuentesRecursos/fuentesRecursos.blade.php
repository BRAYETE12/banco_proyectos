@extends('layouts.admin')
@section('app', 'ng-app=AppPlanesAccion')
@section('controller','ng-controller=listadoCtrl')
@section('title', 'Listado de fuentes de recursos' )

@section('content')

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            <div class="row mt-3">
                <div class="col-md-3 col-xs-12">
                    <button class="btn btn-success" ng-click="openModalPlanAccion()" title="Crear fuente de recursos" >
                        <i class="fas fa-plus"></i>  Agregar
                    </button>
                    <a class="btn btn-primary" href="/ExcelFuentes"  download title="Descargar Excel" >
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
                    <span class="chip">@{{( listado |filter: busqueda).length}} Resultados</span>
                </div>
            </div>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Año</th>
                        <th>Tipo fuente</th>
                        <th>Nobre</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="item in (listado | filter:busqueda) | itemsPerPage: itemsPerPage " >
                        <th scope="row">@{{($index+1)+(__default__currentPage - 1) * cantidadItemsTable}}</th>
                        <td>@{{item.anio}}</td>
                        <td>@{{item.tipo.nombre}}</td>
                        <td>@{{item.nombre}}</td>
                        <td>@{{item.valor | currency: '$ ':0}}</td>
                        <td>
                            <button class="btn btn-xs btn-link" ng-click="openModalPlanAccion(item,$index)" title="Editar proyecto" >
                                    <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="text-center">
                <dir-pagination-controls></dir-pagination-controls>
            </div>

            <div class="alert alert-info" ng-show="listado.length==0" >
                No hay elementos en la lista
            </div>


        </div>
    </div>


<!-- Modal Para Crear Editar Plan de Acción -->
<div class="modal fade" id="modalPlanAccion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Fuentes de recursos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="PlanAccionForm" novalidate >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="tipo_fuente">Tipo fuente</label>
                                <select class="form-control" name="tipo_fuente" id="tipo_fuente" ng-model="plan.tipos_fuentes_id" ng-options="i.id as i.nombre for i in tipos" required >
                                    <option selected disabled  value="" >Seleccionar</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-8">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" ng-model="plan.nombre" id="nombre" name="nombre" placeholder="Nombre del plan de acción" required>
                            </div>
                        </div>                       
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="numero_documento">Año</label>
                                <input type="number" class="form-control" ng-model="plan.anio" id="anio" name="anio" placeholder="Año" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="number" class="form-control" ng-model="plan.valor" id="valor" name="valor" placeholder="Valor $" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group pt-4">
                                <h2 class="mt-1">@{{ (plan.valor||0) | currency:'$ ':0 }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label >Soporte <a href="@{{rutaArchivo}}" download class="btn btn-link" ng-show="rutaArchivo" >Descargar archivo</a> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileDoc" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="fileDoc">Click para seleccionar un archivo file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"ng-click="guardarPlanAccion()" >Guardar</button>
                </div>
            </form>
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
    <script src="{{ asset('js/framework/ADM-dateTimePicker.min.js') }}"></script>

    <script src="{{ asset('js/fuentesRecursos/app.js') }}"></script>
    <script src="{{ asset('js/fuentesRecursos/servicios.js') }}"></script>
@endsection