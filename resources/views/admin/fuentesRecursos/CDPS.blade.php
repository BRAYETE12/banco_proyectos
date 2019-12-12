@extends('layouts.admin')
@section('app', 'ng-app=AppPlanesAccion')
@section('controller','ng-controller=CDPsCtrl')
@section('title', 'Listado de CDPS' )

@section('content')

    <div class="row">
        <div class="col card m-3 p-3 bg-white">
            
            <div class="row mt-3">
                <div class="col-md-3 col-xs-12">
                    <button class="btn btn-success" ng-click="openModalCDP()" title="Crear CDP" >
                        <i class="fas fa-plus"></i>  Agregar
                    </button>
                    <a class="btn btn-primary" href="/ExcelCdps"  download title="Descargar Excel" >
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
                        <th>Fecha</th>
                        <th>Número</th>
                        <th>Fuente</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="item in (listado | filter:busqueda) | itemsPerPage: itemsPerPage " >
                        <th scope="row">@{{($index+1)+(__default__currentPage - 1) * cantidadItemsTable}}</th>
                        <td>@{{item.fecha}}</td>
                        <td>@{{item.numero}}</td>
                        <td>@{{item.fuente}}</td>
                        <td>
                            <a class="btn btn-xs btn-link" ng-show="item.soporte"  href="@{{item.soporte}}" title="Descargar soporte" >
                                <i class="fas fa-download"></i>
                            </a>
                            <button class="btn btn-xs btn-link" ng-click="openModalDetalles(item)" title="Editar CDP" >
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-xs btn-link" ng-click="openModalCDP(item,$index)" title="Editar CDP" >
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


<!-- Modal Para Crear Editar CDPS -->
<div class="modal fade" id="modalCDP" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CDPS</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="CDPForm" novalidate >
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="fuentes_id">Fuente</label>
                                <select class="form-control" name="fuentes_id" id="fuentes_id" ng-model="cdp.fuentes_id" ng-options="i.id as i.nombre for i in fuentes" required >
                                    <option selected disabled  value="" >Seleccionar</option>
                                </select>
                            </div>
                        </div>
                                             
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="numero">Número</label>
                                <input type="text" class="form-control" ng-model="cdp.numero" id="numero" name="numero" placeholder="Número CDP" required>
                            </div>
                        </div>  
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" ng-model="cdp.fecha" id="fecha" name="fecha" placeholder="yyyy/mm/dd" required>
                            </div>
                        </div>                       
                    </div>

                    <div class="row">                        
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="valor">Valor</label>
                                <input type="number" class="form-control" ng-model="cdp.valor" id="valor" name="valor" placeholder="Valor $" required>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group pt-4">
                                <h2 class="mt-1">@{{ (cdp.valor||0) | currency:'$ ':0 }}</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="concepto">Concepto</label>
                                <textarea  class="form-control" rows="5" name="concepto" id="concepto" ng-model="cdp.concepto" placeholder="Concepto del CDP" required></textarea>
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
                    <button type="submit" class="btn btn-success"ng-click="guardarCDP()" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Para ver detalles -->
<div class="modal fade" id="modalCDPdetalle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="min-width: 90%;">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> CDP N° @{{detalle.numero}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Información general</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Moviminetos</a>
                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Proyectos</a>
                    </div>
                </nav>
                <div class="tab-content p-2" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                        <div class="row">
                            <div class="col-xs-12 col-md-8">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Fuente</label>
                                            <p class="form-control">@{{detalle.fuente}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <div class="form-group">
                                            <label>Número</label>
                                            <p class="form-control">@{{detalle.numero}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <div class="form-group">
                                            <label>Fecha</label>
                                            <p class="form-control">@{{detalle.fecha}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <div class="form-group">
                                            <label>Soporte</label>
                                            <a class="form-control" download href="@{{detalle.soporte}}">Descargar</a>    
                                        </div>
                                    </div>          
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Concepto</label>
                                            <p class="form-control" style="height: auto;" >@{{detalle.concepto}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="row">
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Disponible</label>
                                            <p class="form-control">@{{ detalle.total | currency: '$ ':0}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Valor inicial</label>
                                            <p class="form-control">@{{detalle.valor_inicial | currency: '$ ':0}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Valor adiciones</label>
                                            <p class="form-control">@{{detalle.valor_adiccion | currency: '$ ':0}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Valor disminuciones</label>
                                            <p class="form-control">@{{detalle.valor_disminucion | currency: '$ ':0}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-12">
                                        <div class="form-group">
                                            <label>Valor asignado a proyectos</label>
                                            <p class="form-control">@{{detalle.valor_proyectos | currency: '$ ':0}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        
                        <div class="row mt-3">
                            <div class="col-md-6 col-xs-12">
                                <button class="btn btn-success" ng-click="openModalMovimiento()" title="Crear proyecto" >
                                    <i class="fas fa-plus"></i>  Añadir movimiento
                                </button>
                            </div>
                            <div class="col-md-6  col-xs-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" ng-model="busquedaM" placeholder="Búsqueda general">
                                </div>
                            </div>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Tipo movimiento</th>
                                    <th>Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in movimientos | filter:busquedaM" >
                                    <th scope="row">@{{$index+1}}</th>
                                    <td>@{{item.fecha}}</td>
                                    <td>@{{item.tipo ? 'Adición' : 'Disminución'}}</td>
                                    <td>@{{item.valor | currency: '$ ':0}}</td>
                                    <td>
                                        <button class="btn btn-xs btn-link" ng-click="openModalMovimiento(item,true)" title="Editar CDP" >
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="alert alert-info" ng-show="movimientos.length==0" >
                            No hay elementos en la lista
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        
                            <div class="row mt-3">
                                <div class="col-md-6 col-xs-12">
                                    <button class="btn btn-success" ng-click="openModalProyecto()" title="Agregar proyecto proyecto" >
                                        <i class="fas fa-plus"></i>  Añadir proyecto
                                    </button>
                                </div>
                                <div class="col-md-6  col-xs-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" ng-model="busquedaP" placeholder="Búsqueda general">
                                    </div>
                                </div>
                            </div>
        
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Proyecto</th>
                                        <th>Valor</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr ng-repeat="item in proyectos_financiados | filter:busquedaP" >
                                        <th scope="row">@{{$index+1}}</th>
                                        <td>@{{item.pivot.fecha}}</td>
                                        <td>@{{item.nombre}}</td>
                                        <td>@{{item.pivot.valor | currency: '$ ':0}}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="alert alert-info" ng-show="proyectos_financiados.length==0" >
                                No hay elementos en la lista
                            </div>

                    </div>
                </div>


            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Movimientos CDPS -->
<div class="modal fade" id="modalMovimientoCDP" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" ng-class="{ 'VER' : es_ver }" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Movimiento CDP N° @{{detalle.numero}}</h5>
                <button type="button" class="close" ng-click="cerrarModal1()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="CDPmovimientoForm" novalidate >
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="fuentes_id">Tipo movimeinto: </label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" ng-model="movimiento.tipo" name="tipoM" id="tm1" value="1" >
                                    <label class="form-check-label" for="tm1">Adición</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" ng-model="movimiento.tipo" name="tipoM" id="tm2" value="0" >
                                    <label class="form-check-label" for="tm2">Disminución</label>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="fechaMv">Fecha</label>
                                <input type="date" class="form-control" ng-model="movimiento.fecha" id="fechaMv" name="fechaMv" placeholder="yyyy/mm/dd" required>
                            </div>
                        </div>                                 
                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="valor">Valor  @{{ (movimiento.valor||0) | currency:'$ ':0 }}</label>
                                <input type="number" class="form-control" ng-model="movimiento.valor" id="valor" name="valor" placeholder="Valor $" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea  class="form-control" rows="5" name="observaciones" id="observaciones" ng-model="movimiento.observaciones" placeholder="Observaciones del movimiento" required></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label >Soporte <a href="@{{movimiento.soporte}}" ng-show="movimiento.soporte" >Descargar</a> </label>
                                <div class="input-group file">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon02" for="fileDocMv">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileDocMv" aria-describedby="inputGroupFileAddon02">
                                        <label class="custom-file-label" for="fileDocMv">Click para seleccionar un archivo file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" ng-click="cerrarModal1()" >@{{es_ver ? 'Cerrar': 'Cancelar'}}</button>
                    <button type="submit" class="btn btn-success" ng-click="guardarMovimientoCDP()" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal agregar proyecto CDPS -->
<div class="modal fade" id="modalProyectoCDP" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Movimiento CDP N° @{{detalle.numero}}</h5>
                <button type="button" class="close" ng-click="cerrarModal1()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form name="ProyectoForm" novalidate >
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-12 col-md-12">
                            <div class="form-group">
                                <label for="proyectos_id">Proyecto </label>
                                <select class="form-control" name="fuenteproyectos_ids_id" id="proyectos_id" ng-model="financiacion.proyectos_id" ng-options="i.id as i.nombre for i in proyectos" required >
                                    <option selected disabled  value="" >Seleccionar</option>
                                </select>
                            </div>
                        </div> 
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="fechaP">Fecha</label>
                                <input type="date" class="form-control" ng-model="financiacion.fecha" id="fechaP" name="fechaP" placeholder="yyyy/mm/dd" required>
                            </div>
                        </div>                                 
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="valorP">Valor  @{{ (financiacion.valor||0) | currency:'$ ':0 }}</label>
                                <input type="number" class="form-control" ng-model="financiacion.valor" id="valorP" name="valorP" placeholder="Valor $" required>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" ng-click="cerrarModal1()" >Cancelar</button>
                    <button type="submit" class="btn btn-success" ng-click="guardarProyectoCDP()" >Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection

@section('style')
    <style> 
        .VER .form-control, .VER .form-check-label{
            pointer-events: none;
        }
        .VER .btn-success, .VER .file{
            display: none;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('js/framework/dirPagination.js') }}"></script>
    <script src="{{ asset('js/framework/ADM-dateTimePicker.min.js') }}"></script>

    <script src="{{ asset('js/fuentesRecursos/app.js') }}"></script>
    <script src="{{ asset('js/fuentesRecursos/servicios.js') }}"></script>
@endsection