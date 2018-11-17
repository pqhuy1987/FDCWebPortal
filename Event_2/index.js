var app = angular.module('timesheet', [
    'ngRoute',
    'timesheet.projects',
    'timesheet.people']);

app.config(['$routeProvider',
    function($routeProvider) {
      $routeProvider.
        when('/people', {
          templateUrl: 'people.html',
          controller: 'PeopleCtrl',
          reloadOnSearch: false
        }).
        when('/projects', {
          templateUrl: 'projects.html',
          controller: 'ProjectsCtrl',
          reloadOnSearch: false
        }).
        otherwise({
          redirectTo: '/people'
        });
    }]);

app.controller('MainCtrl', function($scope, $timeout, $http) {

});
