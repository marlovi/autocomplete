var myapp = angular.module('myapp', ["ui.router"])
myapp.config(function($stateProvider, $urlRouterProvider) {

    $urlRouterProvider.when("", "/contacts/list");
    $urlRouterProvider.when("/", "/contacts/list");

    // For any unmatched url, send to /route1
    $urlRouterProvider.otherwise("/contacts/list");

    $stateProvider
        .state('contacts', {
            abstract: true,
            url: '/contacts',
            templateUrl: 'contacts.html',
            controller: function($scope) {
                $scope.contacts = [{ id: 0, name: "Alice" }, { id: 1, name: "Bob" }, { id: 2, name: "Marlus" }];
            },
            onEnter: function() {
                console.log("enter contacts");
            }

        })
        .state('contacts.list', {
            url: '/list',
            // loaded into ui-view of parent's template
            templateUrl: 'contacts.list.html',
            onEnter: function() {
                console.log("enter contacts.list");
            }
        })
        .state('contacts.detail', {
            url: '/:id',
            // loaded into ui-view of parent's template
            templateUrl: 'contacts.detail.html',
            controller: function($scope, $stateParams) {
                $scope.person = $scope.contacts[$stateParams.id];
            },
            onEnter: function() {
                console.log("enter contacts.detail");
            }
        })
})