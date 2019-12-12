@extends('layouts.admin')
@section('app', 'ng-app=AppProyectos')
@section('controller','ng-controller=configurarCtrl')
@section('title', $titulo  )

@section('content')

<input type="hidden" id="id" value="{{$id}}">

    <div class="row">
        <div class="col card m-3 p-3 bg-white">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="datosgenrales-tab" data-toggle="tab" href="#datosgenrales" role="tab" aria-controls="datosgenrales" aria-selected="true">
                      Datos generales
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="integrantes-tab" data-toggle="tab" href="#integrantes" role="tab" aria-controls="integrantes" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                      Integrantes
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="integrantes-tab" data-toggle="tab" href="#presupuesto" role="tab" aria-controls="presupuesto" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                        Presupuesto
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="integrantes-tab" data-toggle="tab" href="#ejecuacion" role="tab" aria-controls="ejecuacion" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                        Ejecución
                    </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="documentos-tab" data-toggle="tab" href="#documentos" role="tab" aria-controls="documentos" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                      Documentos
                  </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="bitacora-tab" data-toggle="tab" href="#bitacora" role="tab" aria-controls="bitacora" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                        Bitácora
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cdps-tab" data-toggle="tab" href="#cdps" role="tab" aria-controls="cdps" aria-selected="false" ng-class="{'disabled': {{$id}}==0 }" >
                        CDPS asociados
                    </a>
                </li>
              </ul>
              <div class="tab-content p-4" id="myTabContent">
                <div class="tab-pane fade show active" id="datosgenrales" role="tabpanel" aria-labelledby="datosgenrales-tab" ng-class="{'disabled': {{$id}}==0 }" >

                    <form name="formGenral" novalidate >

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" ng-model="proyecto.nombre" id="nombre" name="nombre" placeholder="Nombre del proyecto" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group has-feedback">
                                    <label class="control-label" for="cuerpo"><span class="asterisk" aria-hidden="true">*</span> Description </label>
                                    <ng-ckeditor ng-model="proyecto.cuerpo" #editor1 config="{}" debounce="500" height="300px" > </ng-ckeditor>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col">
                                <div class="form-group">
                                    <label for="fecha_radicacion">Fecha radicación</label>
                                    <adm-dtp ng-model="proyecto.fecha_radicacion" name="fecha_radicacion" ng-required="true" options="optionsDate" ></adm-dtp>
                                </div>
                            </div>
                            <div class="col-xs-12 col">
                                <div class="form-group">
                                    <label for="fecha_inicio">Fecha inicio</label>
                                    <adm-dtp ng-model="proyecto.fecha_inicio" name="fecha_inicio" ng-required="true" options="optionsDate" ></adm-dtp>
                                </div>
                            </div>
                            <div class="col-xs-12 col">
                                <div class="form-group">
                                    <label for="fecha_fin">Fecha fin</label>
                                    <adm-dtp ng-model="proyecto.fecha_fin" name="fecha_fin" ng-required="true" options="optionsDate" ></adm-dtp>
                                </div>
                            </div>
                            <div class="col-xs-12 col">
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="number" class="form-control" ng-model="proyecto.valor" id="valor" name="valor" placeholder="Valor proyecto" required>                                    
                                </div>
                            </div>
                            <div class="col-xs-12 col pt-2">
                                <div class="form-group">
                                    <label for=""> </label>
                                    <input type="text" class="form-control" value="@{{ (proyecto.valor||0) | currency: '$ ':0}}" readonly >
                                </div>
                            </div>                            
                        </div>

                        
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-success" ng-click="guardarGeneral()" >Guardar</button>
                        </div>                        
                        
                    </form>

                </div>
                <div class="tab-pane fade" id="integrantes" role="tabpanel" aria-labelledby="integrantes-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12">
                            <button class="btn btn-success" ng-click="openModalIntegrantes()" >
                                <i class="fas fa-plus"></i>  Agregar integrante
                            </button>
                        </div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaIntegrante" ng-model="busquedaIntegrante" placeholder="Búsqueda general">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Documento</th>
                                <th>Nombres</th>
                                <th>Rol</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in integrantes | filter:busquedaIntegrante as filtradoIntegrantes" >
                                <th scope="row">@{{$index+1}}</th>
                                <td><b>@{{item.persona.tipo_documento.abreviatura}}:</b> @{{item.persona.numero_documento}}</td>
                                <td>@{{item.persona.nombres}} @{{item.persona.apellidos}}</td>
                                <td>@{{item.rol.nombre}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="openModalIntegrantes(item)" >
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="eliminarIntegrante(item,$index)" >
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   
                    <div class="alert alert-info" ng-show="integrantes.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="integrantes.length>0 && filtradoIntegrantes.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
                <div class="tab-pane fade" id="presupuesto" role="tabpanel" aria-labelledby="presupuesto-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12">
                            <button class="btn btn-success" ng-click="openModalPresupuesto()" >
                                <i class="fas fa-plus"></i>  Agregar item de presupuesto
                            </button>
                        </div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaPresupuesto" ng-model="busquedaPresupuesto" placeholder="Búsqueda general">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in presupuesto | filter:busquedaPresupuesto as filtradoPresupuesto" >
                                <th scope="row">@{{$index+1}}</th>
                                <td>@{{item.nombre}}</td>
                                <td>@{{item.valor | currency : '$ ': 0}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="openModalPresupuesto(item)" >
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="eliminarItemPresupuesto(item.id,$index)" >
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   
                    <div class="alert alert-info" ng-show="presupuesto.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="presupuesto.length>0 && filtradoPresupuesto.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
                <div class="tab-pane fade" id="ejecuacion" role="tabpanel" aria-labelledby="ejecuacion-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12">
                            <button class="btn btn-success" ng-click="openModalEjecucion()" >
                                <i class="fas fa-plus"></i>  Agregar item de ejecuación
                            </button>
                        </div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaPresupuesto" ng-model="busquedaEjecuacion" placeholder="Búsqueda general">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in ejecucion | filter:busquedaEjecuacion as filtradoEjecucion" >
                                <th scope="row">@{{$index+1}}</th>
                                <td>@{{item.nombre}}</td>
                                <td>@{{item.valor | currency : '$ ': 0}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="openModalEjecucion(item, $index)" >
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="eliminarItemPresupuesto(item.id,$index)" >
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   
                    <div class="alert alert-info" ng-show="ejecucion.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="ejecucion.length>0 && filtradoEjecucion.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
                <div class="tab-pane fade" id="documentos" role="tabpanel" aria-labelledby="documentos-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12">
                            <button class="btn btn-success" ng-click="openModalDocumentos()" >
                                <i class="fas fa-plus"></i>  Agregar documento
                            </button>
                        </div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaDocumento" ng-model="busquedaDocumento" placeholder="Búsqueda general">
                            </div>
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
                        <tbody>
                            <tr ng-repeat="item in documentos | filter:busquedaDocumento as filtradoDocumentos" >
                                <th scope="row">@{{$index+1}}</th>
                                <td>@{{item.nombre}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="openModalDocumentos(item,$index)" >
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="eliminarDocumento(item.id,$index)" >
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="alert alert-info" ng-show="documentos.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="documentos.length>0 && filtradoDocumentos.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
                <div class="tab-pane fade" id="bitacora" role="tabpanel" aria-labelledby="bitacora-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12">
                            <button class="btn btn-success" ng-click="openModalBitacora()" >
                                <i class="fas fa-plus"></i>  Agregar bitácora
                            </button>
                        </div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaBitacora" ng-model="busquedaBitacora" placeholder="Búsqueda general">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in bitacoras | filter:busquedaBitacora as filtradoBitacoras" >
                                <th scope="row">@{{$index+1}}</th>
                                <td>@{{item.created_at}}</td>
                                <td>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="openModalBitacora(item,$index)" >
                                            <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-xs btn-link" ng-click="eliminarBitacora(item.id,$index)" >
                                            <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="alert alert-info" ng-show="bitacoras.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="bitacoras.length>0 && filtradoBitacoras.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
                <div class="tab-pane fade" id="cdps" role="tabpanel" aria-labelledby="cdp-tab">

                    <div class="row mt-3">
                        <div class="col-md-6 col-xs-12"></div>
                        <div class="col-md-6  col-xs-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="busquedaCDP" ng-model="busquedaCDP" placeholder="Búsqueda general">
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Número</th>
                                <th>Valor asignado</th>
                                <th>Fecha de asignación</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="item in cdps | filter:busquedaCDP as filtradoCDP" >
                                <th scope="row">@{{$index+1}}</th>
                                <td>@{{item.numero}}</td>
                                <td>@{{item.valor | currency:'$ ':0}}</td>
                                <td>@{{item.fecha}}</td>
                                <td>
                                    <a class="btn btn-xs btn-link" ng-show="item.soporte" href="@{{item.soporte}}" title="Descargar soporte" >
                                        <i class="fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="alert alert-info" ng-show="cdps.length==0" >
                        No hay elementos en la lista
                    </div>
                    <div class="alert alert-info" ng-show="cdps.length>0 && filtradoCDP.length==0" >
                        No hay resultados en la búsqueda
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- Modal Para Integrantes -->
    <div class="modal fade" id="modalIntegrantes" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Integrante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="integranteForm" novalidate >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5 col-xs-12">
                                <div class="form-group">
                                    <label for="nombre">Tipo documento</label>
                                    <select name="tipocDoc" id="tipocDoc" class="form-control" ng-model="integrante.persona.tipo_documento_id" ng-options="it.id as it.nombre for it in tiposDocumentos" required>
                                        <option value="" selected disabled >Selecione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-xs-12">
                                <div class="form-group">
                                    <label for="numero_documento">Número documento</label>
                                    <input type="text" class="form-control" ng-model="integrante.persona.numero_documento" id="numero_documento" name="numero_documento" placeholder="Número documento" required>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 pt-2">
                                <button type="button" class="btn btn-primary btn-block mt-4" ng-click="buscarPersona()" >
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="nombresI">Nombres</label>
                                    <input type="text" class="form-control" ng-model="integrante.persona.nombres" id="nombresI" name="nombresI" placeholder="Nombres" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" ng-model="integrante.persona.apellidos" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="nombresI">Email</label>
                                    <input type="email" class="form-control" ng-model="integrante.persona.email" id="email" name="email" placeholder="Email" >
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="telefono">Teléfono</label>
                                    <input type="tel" class="form-control" ng-model="integrante.persona.telefono" id="telefono" name="telefono" placeholder="Teléfono" >
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="direccion">Direción</label>
                                    <input type="text" class="form-control" ng-model="integrante.persona.direccion" id="direccion" name="direccion" placeholder="Direción" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-4">
                                <div class="form-group">
                                    <label for="rol_id">Rol</label>
                                    <select name="rol_id" id="rol_id" class="form-control" ng-model="integrante.rol_id" ng-options="it.id as it.nombre for it in roles" required>
                                        <option value="" selected disabled >Selecione una opción</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="col-xs-12 col">
                                    <div class="form-group">
                                        <label for="fecha_inicio">Fecha inicio</label>
                                        <adm-dtp ng-model="integrante.fecha_inicio" name="fecha_inicio2" ng-required="true" options="optionsDate" ></adm-dtp>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <div class="col-xs-12 col">
                                    <div class="form-group">
                                        <label for="fecha_fin">Fecha fin</label>
                                        <adm-dtp ng-model="integrante.fecha_fin" name="fecha_fin2" ng-required="true" options="optionsDate" ></adm-dtp>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success" ng-click="guardarIntegrante()" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Para Documentos -->
    <div class="modal fade" id="modalDocumentos" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Documentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="documentoForm" novalidate >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="numero_documento">Descripción del documento</label>
                                    <input type="text" class="form-control" ng-model="descripcionDocumento" id="descripcionDocumento" name="descripcionDocumento" placeholder="Descripción del documento" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label >Archivo <a href="@{{rutaArchivo}}" download class="btn btn-link" ng-show="rutaArchivo" >Descargar archivo</a> </label>
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
                        <button type="submit" class="btn btn-success"ng-click="guardarDocumento()" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Para Bitácora -->
    <div class="modal fade" id="modalBitacora" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bitácora</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group has-feedback">
                                <label class="control-label"><span class="asterisk" aria-hidden="true">*</span> Observaciones </label>
                                <ng-ckeditor ng-model="bitacora" #editor2 config="{}" debounce="500" height="250px" > </ng-ckeditor>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label >Adjunto (opcional)  <a href="@{{rutaArchivo}}" download class="btn btn-link" ng-show="rutaArchivo" >Descargar archivo</a> </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileDocBitacora" aria-describedby="inputGroupFileAddon02">
                                        <label class="custom-file-label" for="fileDocBitacora">Click para seleccionar un archivo file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success"ng-click="guardarBitacora()" >Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Para Presupuesto  -->
    <div class="modal fade" id="modalPresupuesto" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Item de presupuesto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="presupuestoForm" novalidate >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemNombre">Nombre</label>
                                    <input type="text" class="form-control" ng-model="itemPresupuesto.nombre" id="itemNombre" name="itemNombre" placeholder="Nombre del item por presupuesto" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemValor">Valor</label>
                                    <input type="number" class="form-control" ng-model="itemPresupuesto.valor" id="itemValor" name="itemValor" placeholder="Valor del item" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h2 class="pt-4 mt-1" >@{{ (itemPresupuesto.valor||0) | currency :'$ ':0}}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemDescripcion">Descripción</label>
                                    <textarea type="text" class="form-control" ng-model="itemPresupuesto.descripcion" id="itemDescripcion" name="itemDescripcion" rows="5" placeholder="Descripción (opcional)" >
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"ng-click="guarPresupuesto()" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

     <!-- Modal Para Ejecución  -->
     <div class="modal fade" id="modalEjecucion" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ejecución</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form name="ejecucionForm" novalidate >
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemNombreE">Nombre</label>
                                    <input type="text" class="form-control" ng-model="itemEjecucion.nombre" id="itemNombreE" name="itemNombreE" placeholder="Nombre de la ejecución" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemValorE">Valor</label>
                                    <input type="number" class="form-control" ng-model="itemEjecucion.valor" id="itemValorE" name="itemValorE" placeholder="Valor $" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <h2 class="pt-4 mt-1" >@{{ (itemEjecucion.valor||0) | currency :'$ ':0}}</h2>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="itemDescripcion">Descripción</label>
                                    <textarea type="text" class="form-control" ng-model="itemEjecucion.descripcion" id="itemDescripcion" name="itemDescripcion" rows="5" placeholder="Descripción (opcional)" >
                                    </textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label >Adjunto (opcional)  <a href="@{{rutaArchivo}}" download class="btn btn-link" ng-show="rutaArchivo" >Descargar archivo</a> </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupFileAddon015">Upload</span>
                                        </div>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="fileDocEjecucion" aria-describedby="inputGroupFileAddon015">
                                            <label class="custom-file-label" for="fileDocEjecucion">Click para seleccionar un archivo file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        
                    </div>
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success"ng-click="guardarEjecucion()" >Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('style')
    <style> 
        .text-valor{
            background: #f8f8f8;
            padding: .2rem;
            text-align: center;
            border: 1.5px solid #edeff2;
            margin-top: -2px;
        } 
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