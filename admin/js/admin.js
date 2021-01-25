let app = angular.module("admin", ["ngAnimate"])
app.controller("adminCont", function($scope){
    $scope.durum=true
    $scope.panel=false
    $scope.angle="left"
    $scope.eylem = function(){
        $scope.panel=!$scope.panel
        if($scope.panel == true){
            $scope.angle="down"
        }
        else{
            $scope.angle="left"
        }
    }
    
})