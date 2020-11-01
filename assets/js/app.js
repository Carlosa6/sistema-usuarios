$(document).ready(function () {
  $("#register-link").click(function () {
    //cuando presiona el botón de Sign Up
    //ocultar la caja de login
    $("#login-box").hide();
    //mostrar la caja de registro
    $("#register-box").show();
  });

  $("#login-link").click(function () {
    //cuando presiona el botón de Sign In
    //ocultar la caja de registro
    $("#register-box").hide();
    //mostrar la caja de login
    $("#login-box").show();
  });

  $("#forgot-link").click(function () {
    //cuando presiona el enlace de olvidé contraseña
    //ocultar la caja de login
    $("#login-box").hide();
    //mostrar la caja de forgot password
    $("#forgot-box").show();
  });

  $("#back-link").click(function () {
    //cuando presiona el botón de Back en Forgot Password
    //ocultar la caja de forgot password
    $("#forgot-box").hide();
    //mostrar la caja de login
    $("#login-box").show();
  });

  //Register AJAX Request
  $("#register-btn").click(function (e) {
    if ($("#register-form")[0].checkValidity()) {
      e.preventDefault();
      $("#register-btn").val("Please wait...");
      //si las contraseñas no coinciden
      if ($("#rpassword").val() != $("#cpassword").val()) {
        $("#passError").text("* Password did not matched!");
        $("#register-btn").val("Sign Up");
      } else {
        $("#passError").text("");
        $.ajax({
          url: "assets/php/action.php",
          method: "post",
          data: $("#register-form").serialize() + "&action=register",
          success: function (response) {
            $("#register-btn").val("Sign Up");
            if (response === "register") {
              window.location = "home.php";
            } else {
              $("#regAlert").html(response);
            }
          },
        });
      }
    }
  });

  //LOGIN AJAX REQUEST
  $("#login-btn").click(function (e) {
    if ($("#login-form")[0].checkValidity()) {
      e.preventDefault();
      $("#login-btn").val("Please wait...");
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data: $("#login-form").serialize() + "&action=login",
        success: function (response) {
          $("#login-btn").val("Sign In");
          if (response === "login") {
            window.location = "home.php";
          } else {
            $("#loginAlert").html(response);
          }
        },
      });
    }
  });

  //FORGOT PASSWORD AJAX REQUEST
  $("#forgot-btn").click(function (e) {
    if ($("#forgot-form")[0].checkValidity()) {
      e.preventDefault();

      $("#forgot-btn").val("Please wait...");
      $.ajax({
        url: "assets/php/action.php",
        method: "POST",
        data: $("#forgot-form").serialize() + "&action=forgot",
        success: function (response) {
          $("#forgot-btn").val("Reset Password");
          $("#forgot-form")[0].reset();
          $("#forgotAlert").html(response);
        },
      });
    }
  });

});
