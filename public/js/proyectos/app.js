angular.module('AppProyectos', [ 'dirPagination', 'ng.ckeditor', 'ADM-dateTimePicker', 'ServiciosWeb' ])

.controller('configurarCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    var proyecto_id = $("#id").val();

    $scope.optionsDate = {
        calType: 'gregorian',
        format: 'YYYY/MM/DD',
        default: 'today',
        zIndex:10000,
        multiple:false,
        gregorianDic: {
            title: '',
            monthsNames: ['Enero', 'Febrero', 'Maroz', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            daysNames: ['Dom', 'Lun', 'Mar', 'Mer', 'Jue', 'Vie', 'Sab'],
            todayBtn: "Hoy"
        }
    };

    if( proyecto_id ){
        Servi.getDataProyecto(proyecto_id)
        .then(function (data) {
            $scope.proyecto = data.proyecto;
            $scope.documentos = data.documentos;
            $scope.bitacoras = data.bitacoras;
            $scope.integrantes = data.integrantes;
            $scope.presupuesto = data.presupuesto;
            $scope.ejecucion = data.ejecucion;
            $scope.roles = data.roles;
            $scope.cdps = data.cdps;
            $scope.tiposDocumentos = data.tiposDocumentos;
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    }

    
    $scope.guardarGeneral = function () {

        if (!$scope.formGenral.$valid) { return; }

        $scope.errores = null;

        Servi.guardarGeneralProyecto($scope.proyecto)
        .then(function (data) {
            if (data.success) {
                swal("Guardado", "Datos guardados exitosamente.", "success");
                window.location.href= "/proyectos/editar/" + data.id;
            }
            else {
                $scope.errores = data.errores;
            }
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })
    }

    $scope.guarPresupuesto = function () {

        if (!$scope.presupuestoForm.$valid) { return; }

        Servi.guardarPresupuestoProyecto($scope.itemPresupuesto)
        .then(function (data) {
            if (data.success) {
                swal("Guardado", "Datos guardados exitosamente.", "success");
                if($scope.itemPresupuesto.id){ $scope.presupuesto[$scope.index] = data.item; }
                 else{ $scope.presupuesto.push(data.item); }
                 $(".modal").modal("hide");
            }
            else {
                $scope.errores = data.errores;
            }
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })
    }

    $scope.guardarDocumento = function () {

        var fl = $("#fileDoc")[0];
        if(fl.files.length==0){ return; }
 
        var fd = new FormData(); 
        fd.append("id", $scope.idDocumento );
        fd.append("proyecto_id", proyecto_id );
        fd.append("nombre", $scope.descripcionDocumento );
        fd.append("archivo", fl.files[0] );
 
         Servi.guardarDocumentoProyecto(fd)
         .then(function (data) {
             if (data.success) {
                 swal("Guardado", "Datos guardados exitosamente.", "success");
                 if($scope.idDocumento){ $scope.documentos[$scope.index] = data.documento; }
                 else{ $scope.documentos.push(data.documento); }
                 $(".modal").modal("hide");
             }
             else {
                 $scope.errores = data.errores;
             }
         }).catch(function () {
             swal("Error", "Error en la carga, por favor recarga la página.", "error");
         })
    }

    $scope.guardarBitacora = function () {

        var fl = $("#fileDocBitacora")[0];
        if(fl.files.length==0){ return; }
 
        var fd = new FormData(); 
        fd.append("id", $scope.idBitacora );
        fd.append("proyecto_id", proyecto_id );
        fd.append("descripcion", $scope.bitacora );
        fd.append("archivo", fl.files[0] );
 
         Servi.guardarBitacoraProyecto(fd)
         .then(function (data) {
             if (data.success) {
                 swal("Guardado", "Datos guardados exitosamente.", "success");
                 if($scope.idBitacora){ $scope.bitacoras[$scope.index] = data.bitacora; }
                 else{ $scope.bitacoras.push(data.bitacora); }
                 $(".modal").modal("hide");
             }
             else {
                 $scope.errores = data.errores;
             }
         }).catch(function () {
             swal("Error", "Error en la carga, por favor recarga la página.", "error");
         })
    }

    $scope.guardarIntegrante = function () {

        if (!$scope.formGenral.$valid) { return; }

        Servi.guardarIntegranteProyecto($scope.integrante)
        .then(function (data) {
            if (data.success) {
                $scope.integrantes = data.integrantes; 
                swal("Guardado", "Datos guardados exitosamente.", "success"); 
                $(".modal").modal("hide");       
            }
            else {
                $scope.errores = data.errores;
            }
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        })
    }

    
    $scope.guardarEjecucion = function () {

        if (!$scope.ejecucionForm.$valid) { return; }

        var fl = $("#fileDocEjecucion")[0];
        if(fl.files.length==0){ return; }
    
        var fd = new FormData(); 
        for(var item in $scope.itemEjecucion){
            if($scope.itemEjecucion[item]){
                fd.append( item , $scope.itemEjecucion[item] );
            }
        }

        fd.append("archivo", fl.files[0] );
    
        Servi.guardarEjecucionProyecto(fd)
            .then(function (data) {
                if (data.success) {
                    swal("Guardado", "Datos guardados exitosamente.", "success");
                    if($scope.itemEjecucion.id){ $scope.ejecucion[$scope.index] = data.item; }
                    else{ $scope.ejecucion.push(data.item); }
                    $(".modal").modal("hide");
                }
                else {
                    $scope.errores = data.errores;
                }
            }).catch(function () {
                swal("Error", "Error en la carga, por favor recarga la página.", "error");
            })
    }


    $scope.eliminarBitacora = function(id, index){
                    
        var dt = { id : id };
        $scope.eliminarElemento('eliminarBitacoraProyecto', dt, 'bitacoras', index);
    } 
    
    $scope.eliminarDocumento = function(id, index){
                   
        var dt = { id : id };
        $scope.eliminarElemento('eliminarDocumentoProyecto', dt, 'documentos', index);            
    }

    $scope.eliminarIntegrante = function(item, index){

        var dt = { persona_id : item.persona_id, proyecto_id: item.proyecto_id, rol_id: item.rol_id };
        $scope.eliminarElemento('eliminarIntegranteProyecto', dt, 'integrantes', index);
    }  

    $scope.eliminarItemPresupuesto = function(id, index){
                    
        var dt = { id : id };
        $scope.eliminarElemento('eliminarItemPresupuestoProyecto', dt, 'presupuesto', index);
    } 

    $scope.eliminarElemento = function(metodo, data, array, index){
        swal({
         title: "Eliminar elemento",
         text: "¿Esta seguro de eliminar el elemento seleccionado?",
         type: "warning",
         showCancelButton: true,
         cancelButtonText: "Cancelar",
         confirmButtonColor: "#DD6B55",
         confirmButtonText: "Si",
         closeOnConfirm: false,
         showLoaderOnConfirm: true
        },
        function () {
            
            Servi[metodo](data)
                .then(function (data) {
                    
                    if (data.success) {
                        swal("Elemento eliminado", "El elemento se ha eliminado exitosamente.", "success");
                        $scope[array].splice(index,1);
                    } else {
                        swal("Error","Data Error","error");
                        $scope.errores = data.errores;
                    }
                }).catch(function () {
                    swal("Error", "Error en la carga, por favor recarga la pagina", "error");
                })
        });

    }  


    $scope.buscarPersona = function () {
        
        if( !$scope.integrante.persona.tipo_documento_id ||  !$scope.integrante.persona.numero_documento){
            return;
        }
 
        Servi.buscarPersona($scope.integrante.persona)
         .then(function (data) {
             if(data){
                $scope.integrante.persona = data;
             }                
         }).catch(function () {
             swal("Error", "Error en la carga, por favor recarga la página.", "error");
         })
    }


    $scope.openModalIntegrantes = function (item) {
        $scope.integrante = item ?  angular.copy(item) : { proyecto_id: proyecto_id };
        openModal($scope.integranteForm, 'modalIntegrantes');
    }

    $scope.openModalDocumentos = function (item,index ) {
        $scope.descripcionDocumento = item ? item.nombre : null;
        $scope.rutaArchivo = item ? item.ruta : null;
        $scope.idDocumento = item ? item.id : null;
        $scope.index = index;
        openModal($scope.documentoForm, 'modalDocumentos');
    }

    $scope.openModalBitacora = function (item,index) {
        $scope.bitacora = item ? item.descripcion : null;
        $scope.rutaArchivo = item ? item.ruta : null;
        $scope.idBitacora = item ? item.id : null;
        $scope.index = index;
        openModal(null, 'modalBitacora');
    }

    $scope.openModalPresupuesto = function (item,index) {
        $scope.itemPresupuesto = item ? angular.copy(item) : { proyecto_id: proyecto_id };
        $scope.index = index;
        openModal($scope.presupuestoForm, 'modalPresupuesto');
    }

    $scope.openModalEjecucion = function (item,index) {
        $scope.itemEjecucion = item ? angular.copy(item) : { proyecto_id: proyecto_id };
        $scope.rutaArchivo = item ? item.soporte : null;
        $scope.index = index;
        openModal($scope.ejecucionForm, 'modalEjecucion');
    }

    function openModal(form, modal){
        if(form){
            form.$setPristine();
            form.$setUntouched();
            form.$submitted = false;
        }        
        $('#'+modal).modal({ keyboard: false });
   }
   
}])

.controller('listadoCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    Servi.getListadoProyectos()
        .then(function (data) {
            $scope.proyectos = data.proyectos;
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    


}])
