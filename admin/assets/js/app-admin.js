$(document).ready(function(){

    $("#adminLoginBtn").click(function(e){
        if($("#admin-login-form")[0].checkValidity()){
            e.preventDefault();
            $(this).val("Please wait...");
            $.ajax({
                url:"assets/php/admin-action.php",
                method:"POST",
                data:$("#admin-login-form").serialize()+"&action=adminLogin",
                success:function(response){
                    if(response === "admin_login"){
                        window.location = "admin-dashboard.php";
                    }else{
                        $("#adminLoginAlert").html(response);
                    }
                    $("#adminLoginBtn").val("Login");
                }
            });
        }
    });

});