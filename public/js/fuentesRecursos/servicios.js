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
        
        getListado: function () { return http.get('/FuentesRecursos/getDataListado'); },
        guardarPlanAccion: function (data) { return http.postFile('/FuentesRecursos/guardar', data); },
        
        getListadoCDP: function () { return http.get('/cdps/getDataListado'); },
        guardarCDP: function (data) { return http.postFile('/cdps/guardar', data); },
        getDataRecursosCDPS: function (id) { return http.get('/cdps/getDataRecursosCDPS/'+id); },
        guardarMovimientoCDP: function (data) { return http.postFile('/cdps/guardarMovimiento', data); },
        guardarProyectoCDP: function (data) { return http.postFile('/cdps/guardarProyecto', data); },
      };
      
    }]);
    
    
}())