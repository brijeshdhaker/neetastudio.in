/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function () {
    'use strict';
    var commonsApps = angular.module('commonsApps', ['diceTechPro']);
    
    //
    //
    commonsApps.factory('CommonActionClient', ['DiceApiClient', function (DiceApiClient) {
        var CommonActionClient = {};
        
        CommonActionClient.saveDemoRequest = function (request, params) {
            return DiceApiClient({
                method: 'POST',
                router:'commonServiceRouter',
                path:'/domo/request?sTgt=site',
                params: params,
                data: request,
                cache: false,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };
        //
        CommonActionClient.saveContactUs = function (request, params) {
            return DiceApiClient({
                method: 'POST',
                router:'commonServiceRouter',
                path:'/site/contactus?sTgt=site',
                params: params,
                data: request,
                cache: false,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };
        //
        CommonActionClient.saveFeedback = function (request, params) {
            return DiceApiClient({
                method: 'POST',
                router:'commonServiceRouter',
                path:'/site/feedback?sTgt=site',
                params: params,
                data: request,
                cache: false,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };
        //
        CommonActionClient.unsubscribe = function (request, params) {
            return DiceApiClient({
                method: 'POST',
                router:'commonServiceRouter',
                path:'/site/unsubscription?sTgt=site',
                params: params,
                data: request,
                cache: false,
                headers: {
                    'Content-Type': 'application/json'
                }
            });
        };
        //
        return CommonActionClient;
    }]);
    
    /**
     * @required $rootScope.peopleId
     * @required $rootScope.profileApiTimeout
     */
    commonsApps.factory('CommonActionService', CommonActionService);
    CommonActionService.$inject = ['$rootScope', '$q', '$filter', 'CommonActionClient'];
    function CommonActionService($rootScope, $q, $filter, CommonActionClient) {
        var CommonActionService = {};
        //
        CommonActionService.saveDemoRequest = function (request,params) {
            params = params || {};
            return CommonActionClient.saveDemoRequest(request,params);
        };
        //
        CommonActionService.saveContactUs = function (request,params) {
            params = params || {};
            return CommonActionClient.saveContactUs(request,params);
        };
        //
        CommonActionService.saveFeedback = function (request,params) {
            params = params || {};
            return CommonActionClient.saveFeedback(request,params);
        };
        //
        CommonActionService.unsubscribe = function (request,params) {
            params = params || {};
            return CommonActionClient.unsubscribe(request,params);
        };
        //
        return CommonActionService;
    }
    
    
    //
    commonsApps.controller('CommonActionController',CommonActionController);
    CommonActionController.$inject = ['$scope','$log','$q','$filter','CommonActionService'];
    function CommonActionController($scope,$log,$q,$filter,CommonActionService){
        //
        $scope.master ={};
        $scope.messages = [];
        $scope.iscomplete = false;
        $scope.$log = $log;
        $scope.message = 'Hello World!';
        $log.info($scope.message);
        console.log($scope.message);
        $scope.demoreq = {
            message:'Thank You for contact us .Our Representative will meet to you shortly.',
            status:0
        };
        $scope.conreq = {
            message:'Thank You for contact us .Our Representative will meet to you shortly.',
            status:0
        };
        $scope.feedreq = {
            message:'Thank You for contact us .Our Representative will meet to you shortly.',
            status:0
        };
        
        $scope.req = {
            message:'Thank You for contact us .Our Representative will meet to you shortly.',
            selection:'N',
            serviceType:'1',
            status:0
        };
        //$scope.req['serviceType'] = $filter('number')('1', 0);
        //
        console.log($scope.master);
        $scope.showDemoModel = function(){
            $scope.iscomplete = false;
            $('#domoRequestModel').modal('show');
            //$('#sales-form').hide();
            //$('#drmessage').show();
        };
        
        $scope.requestDemo = function(){
            var _request = $scope.demoreq;
            CommonActionService.saveDemoRequest(_request,{}).then(function (response) {
                $scope.messages = [];
                if (response.status == 404) {
                    var msg = {code:'404000', type:'danger', userMessage:'We couldn\'t save your demo request. Please try refreshing the page..', properties:[]};
                    $scope.messages = [msg];
                }else{
                    var oResponse = response.data;
                    $scope.messages = oResponse['messages'];
                    if(oResponse.status){
                       $scope.iscomplete = true;
                       $('.modal-footer').hide();
                    }
                }
            });
        };
        
        $scope.processContactUs = function(){
            var _request = $scope.conreq;
            _request = angular.extend({},$scope.conreq,$scope.master);
            CommonActionService.saveContactUs(_request,{}).then(function (response) {
                //$scope.messages = [];
                if (response.status == 404) {
                    var msg = {code:'404000', type:'danger', userMessage:'We couldn\'t save your request. Please try again later .', properties:[]};
                    $scope.messages = [msg];
                }else{
                    var oResponse = response.data;
                    $scope.messages = oResponse['messages'];
                    if(oResponse.status){
                        $scope.reset('contactusForm');
                    }
                }
            });
        };
        
        //
        $scope.saveFeedback = function(){
            var _request = $scope.feedreq;
            _request = angular.extend({},$scope.feedreq,$scope.master);
            CommonActionService.saveFeedback(_request,{}).then(function (response) {
                $scope.messages = [];
                if (response.status == 404) {
                    var msg = {code:'404000', type:'danger', userMessage:'We couldn\'t save your feedback. Please try again later.', properties:[]};
                    $scope.messages = [msg];
                }else{
                    var oResponse = response.data;
                    $scope.messages = oResponse['messages'];
                    if(oResponse.status){
                        $scope.reset('feedback-form');
                    }
                }
            });
        };
        
        //
        $scope.unsubscribe = function(){
            var _request = $scope.req;
            _request = angular.extend({},$scope.req,$scope.master);
            CommonActionService.unsubscribe(_request,{}).then(function (response) {
                $scope.messages = [];
                if (response.status == 404) {
                    var msg = {code:'404000', type:'danger', userMessage:'We couldn\'t save your request. Please try again later.', properties:[]};
                    $scope.messages = [msg];
                }else{
                    var oResponse = response.data;
                    $scope.messages = oResponse['messages'];
                    if(oResponse.status){
                        $scope.reset('feedback-form');
                    }
                }
            });
        };
        
        //
        $scope.reset = function reset(form){
            var _form = "#"+form;
            $(_form)[0].reset();
        };
        
    }
    
}());

