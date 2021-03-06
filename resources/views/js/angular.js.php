'use strict';

(function () {
    var app = angular.module('ccu', [
        'ui.router', 'angular-loading-bar',
        'angulartics', 'angulartics.google.analytics',
        'ngFileUpload', 'ephox.textboxio',
        'toaster', 'ngAnimate'
    ]);

    app.config(['$httpProvider', function($httpProvider) {
        $httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }]);

    app.run(['$http', '$rootScope', function ($http, $rootScope) {
        $http.get('{{ route("api.auth.rolesPermissions") }}')
            .then(function (response) {
                $rootScope.user = {
                    signIn: response.data.signIn,
                    email: (response.data.signIn) ? response.data.email  : null,
                    nickname: (response.data.signIn) ? response.data.nickname  : null,
                    roles: response.data.roles,
                    permissions: response.data.permissions,
                    hasRole: function (role) {
                        var type = typeof role;

                        if (('object' !== type) && ('string' !== type)) {
                            return false;
                        }
                        else if ('string' === type) {
                            role = [role];
                        }

                        for (var i in role) {
                            if (role.hasOwnProperty(i) && (-1 !== this.roles.indexOf(role[i]))) {
                                return true;
                            }
                        }

                        return false;
                    },
                    can: function (action) {return -1 !== this.permissions.indexOf(action)}
                };
            });
    }]);
})();