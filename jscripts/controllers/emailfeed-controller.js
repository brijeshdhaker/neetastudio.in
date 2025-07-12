/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var emailFeedApp = angular.module('emailFeedApp',['diceTechPro']);
//
emailFeedApp.constant('onclickApiPath', '/onclickresume/rest/emailfeed-service-router.php');
emailFeedApp.constant('onclickApiTimeoutPath', '/onclickresume/service/timeout.json?path=');

//
emailFeedApp.filter('toTrustedHTML', ['$sce', function ($sce) {
    return function toTrustedHTML(text) {
        return $sce.trustAsHtml(text);
    };
}]);

//
emailFeedApp.factory('OnclickApiClient', ['$http', 'onclickApiPath', 'onclickApiTimeoutPath', function ($http, onclickApiPath, onclickApiTimeoutPath) {
    var OnclickApiClient = function (config, timeout) {
        var queryStringPairs = [],keys,value,i;
        if (angular.isObject(config.params)) {
            keys = Object.keys(config.params);
            if (keys.length > 0) {
                for (i = 0; i < keys.length; i++) {
                    value = config.params[keys[i]];
                    queryStringPairs.push(encodeURIComponent(keys[0]) + '=' + encodeURIComponent(typeof value === 'string' ? value : angular.toJson()));
                }
                config.path += config.path.indexOf('?') === -1 ? '?' : '&';
                config.path += queryStringPairs.join('&');
            }
        }
        if (timeout) {
            config.path += (config.path.indexOf('?') === -1 ? '?' : '&') + 'timeout=' + encodeURIComponent(timeout);
        }
        //config.url = onclickApiPath + encodeURIComponent(config.path);
        config.url = onclickApiPath + config.path;
        delete config.path;
        return $http(config);
    };
    return OnclickApiClient;
}]);

//
emailFeedApp.factory('emailFeedApiClient', ['OnclickApiClient', function (OnclickApiClient) {
    var emailFeedApiClient = {};
    var servicePath = '/emailfeed';

    emailFeedApiClient.register = function (feeddata, params) {
        params['action']='register';
        params['sTgt']='site';
        return OnclickApiClient({
            method: 'POST',
            path: servicePath +'/register?sTgt=site',
            params: params,
            cache: false,
            data: feeddata,
            headers: {
                'Content-Type': 'application/json'
            }
        });
    };
    
    emailFeedApiClient.details = function (emailid, params) {
        params['action']='details';
        params['sTgt']='site';
        return OnclickApiClient({
            method: 'GET',
            path: servicePath +'/details?emailid='+emailid,
            params: params,
            cache: false,
            headers: {
                'Content-Type': 'application/json'
            }
        });
    };
    
    return emailFeedApiClient;
}]);
//
emailFeedApp.factory('emailFeedService', emailFeedService);
emailFeedService.$inject = ['$rootScope', '$q', '$filter', 'emailFeedApiClient'];
function emailFeedService($rootScope, $q, $filter, emailFeedApiClient){
    var emailFeedService = {};
    
    function getTodaysDate(formatString) {
        return $filter('date')(new Date(), formatString);
    }
    
    emailFeedService.register = function(feeddata, params){
        params = params || {};
        return emailFeedApiClient.register(feeddata, params);
    }
    
    emailFeedService.details = function(postid, params){
        params = params || {};
        return emailFeedApiClient.details(postid, params);
    }
    
    return emailFeedService;
}
//
emailFeedApp.controller('emailFeedCtrl',['$scope','$q','$filter','emailFeedService','staticDataService', function ($scope,$q,$filter,emailFeedService,staticDataService) {
    //
    $scope.feedData = {};
    $scope.master = {};
    $scope.errorMessage  = '';
    $scope.openPosErrMsg = '';
    $scope.alerts=[];
    
    $scope.allLocations = staticDataService.getCheckList('locations');
    $scope.allFunctions = staticDataService.getCheckList('functions');
    $scope.allIndustries = staticDataService.getCheckList('industries');
    $scope.allRoles = staticDataService.getCheckList('roles');
    $scope.allEmpTypes = staticDataService.getCheckList('empTypes');
    $scope.allEduTypes = staticDataService.getCheckList('eduTypes');
    $scope.updatesSlection = updatesSlection;
    
    
    var experienceArr = [0, 3, 6, 9, 12, 15, 18, 21, 24, 27, 30];
    $('#experienceS').slider({value:0, min: 0, max: experienceArr.length - 1, step: 1, slide: function (event, ui) {
            $("#experience").val(experienceArr[ui.value]);
            $scope.feedData.experience = experienceArr[ui.value];
        }
    });

    var salarieArr = [0, 5, 10, 15, 20, 25, 30, 35, 40, 45, 50];
    $("#salarieS").slider({value:0, min: 0, max: salarieArr.length - 1, step: 1, slide: function (event, ui) {
            $("#salary").val(salarieArr[ui.value]);
            $scope.feedData.salary = salarieArr[ui.value];
        }
    });
    
    /**
     * 
     * @returns {undefined}
     */
    $scope.save = function(){
        
        var hiddenParams = formHiddenParams('feedForm');
        $scope.master = angular.extend({}, hiddenParams);
        var _request = angular.extend({}, $scope.master, $scope.feedData);
        
        $scope.messages = [];
        emailFeedService.register(_request,{}).then(function (response) {
            if (response.status == 404) {
                var msg = {code:'404000', type:'danger', userMessage:'We couldn\'t process your request.', properties:[]};
                $scope.messages = [msg];
            }else{
                var oResponse = response.data;
                $scope.messages = oResponse.messages;
            }
        });
        
    };
    
    $scope.reset = function(){
        //$scope.feedData = {};
        $scope.feedForm.$invalid = true;
        $scope.feedForm.$setUntouched();
        $('#feedForm')[0].reset();
        var groups = $('.form-group');
        if(groups && groups.length > 0){
            groups.each(function(i,g){
                var blocks = $(this).find('.help-block');
                blocks.each(function(i,b){
                    $(b).html('');
                });
                var feedbacks = $(this).find('.form-control-feedback');
                feedbacks.each(function(i,f){
                    $(f).removeClass('glyphicon-warning-sign glyphicon-ok');
                });
                $(this).removeClass('has-success has-error');
            });
        }
        
        $scope.messages = [];
    };
    
    function updatesSlection(type) {
        var selections = '';
        var i = 0;
        switch (type) {
            case 'location' :
                $scope.feedData.desiredLocations = [];
                angular.forEach($scope.allLocations, function (value) {
                    if (value.checked && i < 5) {
                        i++;
                        if (selections) {
                            selections += ', ';
                        }
                        selections += value.value;
                        $scope.feedData.desiredLocations.push({type: 10, key: value.key, value: value.value});
                    }
                });
                $scope.feedData.locations = selections;
                break;
            case 'function' :
                $scope.feedData.desiredFunctions = [];
                angular.forEach($scope.allFunctions, function (value) {
                    if (value.checked && i < 5) {
                        i++;
                        if (selections) {
                            selections += ', ';
                        }
                        selections += value.value;
                        $scope.feedData.desiredFunctions.push({type: 20, key: value.key, value: value.value});
                    }
                });
                $scope.feedData.functions = selections;
                break;
            case 'industry' :
                $scope.feedData.desiredIndustries = [];
                angular.forEach($scope.allIndustries, function (value) {
                    if (value.checked && i < 5) {
                        i++;
                        if (selections) {
                            selections += ', ';
                        }
                        selections += value.value;
                        $scope.feedData.desiredIndustries.push({type: 30, key: value.key, value: value.value});
                    }
                });
                $scope.feedData.industries = selections;
                break;
            case 'role' :
                $scope.feedData.desiredRoles = [];
                angular.forEach($scope.allRoles, function (value) {
                    if (value.checked && i < 5) {
                        i++;
                        if (selections) {
                            selections += ', ';
                        }
                        selections += value.value;
                        $scope.feedData.desiredRoles.push({type: 40, key: value.key, value: value.value});
                    }
                });
                $scope.feedData.roles = selections;
                break;
            case 'emptype' :
                $scope.feedData.desiredEmpTypes = [];
                angular.forEach($scope.allEmpTypes, function (value) {
                    if (value.checked && i < 5) {
                        i++;
                        if (selections) {
                            selections += ', ';
                        }
                        selections += value.value;
                        $scope.feedData.desiredEmpTypes.push({type: 50, key: value.key, value: value.value});
                    }
                });
                $scope.feedData.emptypes = selections;
                break;
        }
    }
    
    function formHiddenParams(form){
        //
        var hiddenParams = {};
        var _form = "#"+form;
        var values = $(_form).serialize();
        values.replace(/([^&]+)=([^&]*)/g, function (match, name, value) {
            hiddenParams[name] = value;
        });
        return hiddenParams;
    }
    
    //
    /*
    emailFeedService.getPostDetail($scope.postid).then(function (response) {
        if (response.status == 404) {
            $scope.errorMessage = 'We couldn\'t load company profile. Please try refreshing the page.';
        }else{
            var oResponse = response.data;
            $scope.postDetail = oResponse.data;
        }
    });
    */
    //
    /*
    emailFeedService.getSimilerJobs($scope.postid).then(function (response) {
        if (response.status == 404) {
            $scope.openPosErrMsg = 'We couldn\'t load open positions.';
        }else{
            var oResponse = response.data;
            $scope.similerOpenings = oResponse.data;
        }
    });
    */
}]);


