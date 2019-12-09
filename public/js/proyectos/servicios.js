(function(){
 
    angular.module("ServiciosWeb", [])
    .factory('Servi', ['$http', '$q', function ($http, $q) {
      
      
      var http = {
          
            post: function (url,data) { return this.peticion("POST",url,data); },
             
            get: function(url){ return this.peticion("GET",url,null); },
            
            peticion: function(metodo, url, data){
                $("#loading").addClass("showLoading");
                var defered = $q.defer();
                var promise = defered.promise;
                $http({  method : metodo,  url : url,  data : data })
                .success(function (data) { $("#loading").removeClass("showLoading"); defered.resolve(data); })
                .error(function(err){ $("#loading").removeClass("showLoading");  });  
                return promise; 
            },
            
            postFile: function (url,data) {
                $("#loading").addClass("showLoading");
                var defered = $q.defer();
                var promise = defered.promise;    
                $http.post(url, data, { transformRequest: angular.identity, headers: { 'Content-Type': undefined } } )
                .success(function (data) { $("#loading").removeClass("showLoading"); defered.resolve(data); })
                .error(function(err){ $("#loading").removeClass("showLoading");  });  
                return promise; 
            },
      };
      
      return {            
        
        getListadoProyectos: function (id) { return http.get('/proyectos/getDataListado'); },
        getDataProyecto: function (id) { return http.get('/proyectos/getData/' + id); },
        guardarGeneralProyecto: function (data) { return http.post('/proyectos/guardarGeneral', data); },
        guardarPresupuestoProyecto: function (data) { return http.post('/proyectos/guardarPresupuesto', data); },
        guardarEjecucionProyecto: function (data) { return http.postFile('/proyectos/guardarEjecucion', data); },
        guardarDocumentoProyecto: function (data) { return http.postFile('/proyectos/guardarDocumento', data); },
        guardarBitacoraProyecto: function (data) { return http.postFile('/proyectos/guardarBitacora', data); },
        guardarIntegranteProyecto: function (data) { return http.post('/proyectos/guardarIntegrante', data); },
        buscarPersona: function (data) { return http.post('/proyectos/buscarPersona', data); },

        eliminarBitacoraProyecto: function (data) { return http.post('/proyectos/eliminarBitacora', data); },
        eliminarDocumentoProyecto: function (data) { return http.post('/proyectos/eliminarDocumento', data); },
        eliminarIntegranteProyecto: function (data) { return http.post('/proyectos/eliminarIntegrante', data); },
        eliminarItemPresupuestoProyecto: function (data) { return http.post('/proyectos/eliminarItemPresupuesto', data); },
          
      };
      
    }]);
    
    
}())