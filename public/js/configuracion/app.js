angular.module('AppConfiguracion', [ 'dirPagination', 'ADM-dateTimePicker', 'ServiciosWeb' ])


.controller('usuariosCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    Servi.getDataUsuarios()
        .then(function (data) {
            $scope.listado = data.listado;
            $scope.roles = data.roles;
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    

    $scope.guardar = function () {

    
        Servi.guardarUsuario($scope.user)
        .then(function (data) {
            if (data.success) {
                swal("Guardado", "Datos guardados exitosamente.", "success");
                $scope.listado =  data.listado;
                $(".modal").modal("hide");
            }
            else {
                $scope.errores = data.errores;
            }
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    }
    
    $scope.openModalPlanAccion = function (item,index ) {
        $scope.user = item ? angular.copy(item) : {};
        $scope.rutaArchivo = item ? item.soporte : null;
        $scope.index = index;
        openModal($scope.PlanAccionForm, 'modalPlanAccion');
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


.controller('dependenciasCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    Servi.getDependencias()
        .then(function (data) {
            $scope.listado = data;
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    

    $scope.guardar = function () {

    
        Servi.guardarDependencia($scope.dependencia)
        .then(function (data) {
            if (data.success) {
                swal("Guardado", "Datos guardados exitosamente.", "success");
                $scope.listado =  data.listado;
                $(".modal").modal("hide");
            }
            else {
                $scope.errores = data.errores;
            }
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    }
    
    $scope.openModalPlanAccion = function (item,index ) {
        $scope.dependencia = item ? angular.copy(item) : {};
        $scope.index = index;
        openModal($scope.PlanAccionForm, 'modalPlanAccion');
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

.controller('CDPsCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    Servi.getListadoCDP()
        .then(function (data) {
            $scope.listado = data.cdps;
            $scope.fuentes = data.fuentes;
        }).catch(function () {
            swal("Error", "Error en la carga, por favor recarga la página.", "error");
        });
    

    $scope.guardarCDP = function () {

        var fl = $("#fileDoc")[0];
        if(fl.files.length==0){ return; }
    
        var fd = new FormData(); 
        for(var item in $scope.cdp){
            if($scope.cdp[item]){
                if(item=="fecha"){
                    fd.append( item , $("#fecha").val() );
                }
                else{ fd.append( item , $scope.cdp[item] ); }
            }
        }

        fd.append("archivo", fl.files[0] );
    
        Servi.guardarCDP(fd)
            .then(function (data) {
                if (data.success) {
                    swal("Guardado", "Datos guardados exitosamente.", "success");
                    if($scope.cdp.id){ $scope.listado[$scope.index] = data.cdp; }
                    else{ $scope.listado.push(data.cdp); }
                    $(".modal").modal("hide");
                }
                else {
                    $scope.errores = data.errores;
                }
            }).catch(function () {
                swal("Error", "Error en la carga, por favor recarga la página.", "error");
            })
    }

    $scope.guardarMovimientoCDP = function () {

        var fl = $("#fileDocMv")[0];
        if(fl.files.length==0){ return; }
    
        var fd = new FormData(); 
        for(var item in $scope.movimiento){
            if($scope.movimiento[item]){
                fd.append( item , $scope.movimiento[item] );
            }
        }

        fd.append("fecha", $("#fechaMv").val() );
        fd.append("archivo", fl.files[0] );
    
        Servi.guardarMovimientoCDP(fd)
            .then(function (data) {
                if (data.success) {
                    swal("Guardado", "Datos guardados exitosamente.", "success");
                    $scope.movimientos.push(data.movimiento);
                    $("#modalMovimientoCDP").modal("hide");
                    $("#modalCDPdetalle").modal("show");
                }
                else {
                    $scope.errores = data.errores;
                }
            }).catch(function () {
                swal("Error", "Error en la carga, por favor recarga la página.", "error");
            })
    }

    $scope.guardarProyectoCDP = function () {

        
        var fd = new FormData(); 
        for(var item in $scope.financiacion){
            if($scope.financiacion[item]){
                fd.append( item , $scope.financiacion[item] );
            }
        }

        fd.append("fecha", $("#fechaP").val() );
    
        Servi.guardarProyectoCDP(fd)
            .then(function (data) {
                if (data.success) {
                    swal("Guardado", "Datos guardados exitosamente.", "success");
                    $scope.proyectos_financiados = data.proyectos;
                    $("#modalProyectoCDP").modal("hide");
                    $("#modalCDPdetalle").modal("show");
                }
                else {
                    $scope.errores = data.errores;
                }
            }).catch(function () {
                swal("Error", "Error en la carga, por favor recarga la página.", "error");
            })
    }
    
    $scope.openModalCDP = function (item,index ) {
       
        $scope.cdp = {};
        $scope.rutaArchivo = null;

        if(item){
            $scope.cdp = angular.copy(item);
            $scope.rutaArchivo = item.soporte;
            if($scope.cdp.fecha_creacion){  $scope.cdp.fecha = new Date($scope.cdp.fecha_creacion+"T12:00:00Z"); }
            
            if(item.valor_inicial){
               $scope.cdp.valor = parseInt(item.valor_inicial);
            }
        }

        $scope.index = index;
        openModal($scope.CDPForm, 'modalCDP');
    }

    $scope.openModalDetalles = function (item ) {

        Servi.getDataRecursosCDPS(item.id)
            .then(function (data) {
                $scope.movimientos = data.movimientos;
                $scope.proyectos_financiados = data.proyectos_financiados;
                $scope.proyectos = data.proyectos;
            }).catch(function () {
                swal("Error", "Error en la carga, por favor recarga la página.", "error");
            });

        item.total = parseFloat(item.valor_inicial)+parseFloat(item.valor_adiccion)-parseFloat(item.valor_disminucion)-parseFloat(item.valor_proyectos);
        $scope.detalle = item;
        openModal(null, 'modalCDPdetalle');
    }

    $scope.openModalMovimiento = function (item, es_ver ) {
        $scope.movimiento = item ? angular.copy(item) : { cdps_id : $scope.detalle.id };
        if($scope.movimiento.fecha){  $scope.movimiento.fecha = new Date($scope.movimiento.fecha+"T12:00:00Z"); }
        if($scope.movimiento.valor){  $scope.movimiento.valor = parseInt($scope.movimiento.valor); }

        $scope.es_ver = es_ver;
        $("#modalCDPdetalle").modal("hide");
        openModal($scope.CDPmovimientoForm, 'modalMovimientoCDP');
    }

    $scope.openModalProyecto = function (item ) {
        $scope.financiacion = item ? angular.copy(item) : { cdps_id : $scope.detalle.id };
        $("#modalCDPdetalle").modal("hide");
        openModal($scope.ProyectoForm, 'modalProyectoCDP');
    }

    function openModal(form, modal){
        if(form){
            form.$setPristine();
            form.$setUntouched();
            form.$submitted = false;
        }        
        $('#'+modal).modal({ keyboard: false });
    }

    $scope.cerrarModal1 = function (item,index ) {
        $(".modal").modal("hide");
        $("#modalCDPdetalle").modal("show");
    }

}])