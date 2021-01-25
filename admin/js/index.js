let app = angular.module("app", [])
app.controller("appcont", function($scope){
    // $scope.durum = "none"
})

$(document).ready(function(){
    $(".close").click(function(){
        $(".alert").css("display", "none")
    })

    $("button").click(function(e){
        e.preventDefault()
        let username = $("input[name='username']").val()
        let password = $("input[name='password']").val()
        
        if(username != "" && password != ""){
            $.ajax({
                type: "POST",
                url: "login.php",
                data: "username="+username+"&password="+password,
                success: function(data){
                    if(data != ""){
                        if(data == "ok"){
                            location.href = "admin.php"
                        }
                        else{
                            $(".alert").css("display", "block")
                            $(".alert").find("span").html(data)
                        }
                        
                    }
                }
            })
        }else{
            $(".alert").css("display", "block")
            $(".alert").find("span").html("Username və ya Password doldurulmayıb!!!")
        }
    })
    

})