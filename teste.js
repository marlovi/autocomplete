(function() {
    'use strict';
    angular
        .module('autocompleteCustomTemplateDemo', ['ngMaterial'])
        .controller('DemoCtrl', DemoCtrl);

    function DemoCtrl($timeout, $q, $log) {
        var self = this;
// deu ruim
// pasta correta
        self.simulateQuery = false;
        self.isDisabled = false;

        self.repos = loadAll();
        self.querySearch = querySearch;
        self.selectedItemChange = selectedItemChange;
        self.searchTextChange = searchTextChange;

        // ******************************
        // Internal methods
        // ******************************

        /**
         * Search for repos... use $timeout to simulate
         * remote dataservice call.
         */
        function querySearch(query) {
            var results = query ? self.repos.filter(createFilterFor(query)) : self.repos,
                deferred;
            if (self.simulateQuery) {
                deferred = $q.defer();
                $timeout(function() { deferred.resolve(results); }, Math.random() * 1000, false);
                return deferred.promise;
            } else {
                return results;
            }
        }

        function searchTextChange(text) {
            $log.info('Text changed to ' + text);
        }

        function selectedItemChange(item) {
            $log.info('Item changed to ' + JSON.stringify(item));
        }

        /**
         * Build `components` list of key/value pairs
         */
        function loadAll() {
            var repos = [{
                    'name': 'AngularJS',
                    'url': 'https://github.com/angular/angular.js',
                    'watchers': '3,623',
                    'forks': '16,175',
                },
                {
                    'name': 'Angular',
                    'telefone': '3621-5623',
                    'watchers': '469',
                    'forks': '760',
                },
                {
                    'name': 'AngularJS Material',

                    'watchers': '727',
                    'forks': '1,241',
                },
                {
                    'name': 'Angular Material',

                    'watchers': '727',
                    'forks': '1,241',
                },
                {
                    'name': 'Bower Material',

                    'watchers': '42',
                    'forks': '84',
                },
                {
                    'name': 'Material Start',

                    'watchers': '81',
                    'forks': '303',
                }
            ];
            return repos.map(function(repo) {
                repo.value = repo.name.toLowerCase();
                return repo;
            });
        }

        /**
         * Create filter function for a query string
         */
        function createFilterFor(query) {
            var lowercaseQuery = angular.lowercase(query);

            return function filterFn(item) {
                return (item.value.indexOf(lowercaseQuery) === 0);
            };

        }
    }
})();