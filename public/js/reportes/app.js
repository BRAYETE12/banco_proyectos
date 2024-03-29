﻿angular.module('AppReportes', [ ])

.controller('ReporteCtrl', ['$scope', 'Servi', function ($scope, Servi) {

    var reporte = $("#reporte").val();

    var derivers = $.pivotUtilities.derivers;
    var renderers = $.extend($.pivotUtilities.renderers, $.pivotUtilities.plotly_renderers);
    var opcionesPivo = { rows: [], cols: [], renderers: renderers, hiddenAttributes: ["id", "soporte", "fuentes_id"], };

    Servi.get(reporte)
    .then(function (data) {        
        $("#output").pivotUI( data, opcionesPivo );
    }).catch(function () {
        swal("Error", "Error en la carga, por favor recarga la página.", "error");
    });
  
}])

.factory('Servi', ['$http', '$q', function ($http, $q) {
          
    return {            
        get: function(id){
            $("#loading").addClass("showLoading");
            var defered = $q.defer();
            var promise = defered.promise;
            $http({  method : "GET",  url : "/GetDataReporte/"+id })
            .success(function (data) { $("#loading").removeClass("showLoading"); defered.resolve(data); })
            .error(function(err){ $("#loading").removeClass("showLoading");  });  
            return promise; 
        },        
    };
    
  }]);
