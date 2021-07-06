@extends('layouts.admin')
@section('app', 'ng-app=AppConfiguracion')
@section('controller','ng-controller=dependenciasCtrl')
@section('title', 'Listado de dependencias' )

@section('content')

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            <div class="row mt-3">
                <div class="col-md-3 col-xs-12">
                    <button class="btn btn-success" ng-click="openModalPlanAccion()" title="Crear fuente de recursos" >
                        <i class="fas fa-plus"></i>  Agregar
                    </button>
                    
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
                        <th>Nombre</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody ng-init="currentPage=1" >
                    <tr dir-paginate="item in (listado | filter:busqueda) | itemsPerPage: cantidadItemsTable" current-page="currentPage" >
                        <th scope="row">@{{($index+1)+(currentPage - 1) * cantidadItemsTable}}</th>
                        <td>@{{item.nombre}}</td>
                        <td>                            
                            <button class="btn btn-xs btn-link" ng-click="openModalPlanAccion(item,$index)" title="Editar dependencia" >
                                    <i class="fas fa-edit"></i>
                            </button>                            
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="text-center" style="margin: 0 auto;" >
                <dir-pagination-controls></dir-pagination-controls>
            </div>

            <div class="alert alert-info" ng-show="listado.length==0" >
                No hay elementos en la lista
            </div>


        </div>
    </div>


<!-- Modal Para Crear Editar Plan de Acción -->
<div class="modal fade" id="modalPlanAccion" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dependencias</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="PlanAccionForm" novalidate >
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" ng-model="dependencia.nombre" id="nombre" name="nombre" placeholder="Nombre de la dependencia" required>
                            </div>
                        </div>                       
                    </div>                    
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"ng-click="guardar()" >Guardar</button>
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

    <script src="{{ asset('js/configuracion/app.js') }}"></script>
    <script src="{{ asset('js/configuracion/servicios.js') }}"></script>
@endsection