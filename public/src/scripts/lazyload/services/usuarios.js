var service = angular.module('app.service.usuarios', ['app.constants']);

service.service('UsuariosService', ['$http', 'WS_URL', function($http, WS_URL)  {
    delete $http.defaults.headers.common['X-Requested-With'];

    this.index = function(params){
        return $http.get(WS_URL+'usuarios');
    };

    this.store = function(params) {
        console.log(params);
        return $http.post(WS_URL+'usuarios', params);
    };

    this.update = function(params) {
        return $http.put(WS_URL+'usuarios/' + params.id, params);
    };

    this.destroy = function(id) {
        return $http.delete(WS_URL+'usuarios/' + id);
    };

     this.clienteUsuario = function(params) {
        return $http.post(WS_URL+'crear/usuario/cliente', params);
    };

    this.rolesUsuarios = function(id) {
        return $http.get(WS_URL+'roles/usuarios');
    };
    
    this.reset = function(id) {
        return $http.get(WS_URL+'resetear/'+id);
    };

}]);