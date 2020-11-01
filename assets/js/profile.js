$(document).ready(function () {
  //Profile Update Ajax Request
  $("#profile-update-form").submit(function (e) {
    e.preventDefault();

    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      processData: false,
      contentType: false,
      cache: false,
      data: new FormData(this),
      success: function (response) {
        location.reload();
      },
    });
  });

  //change pass ajax request
  $("#changePassBtn").click(function (e) {
    if ($("#change-pass-form")[0].checkValidity()) {
      e.preventDefault();
      $("#changePassBtn").val("Please wait...");

      if ($("#newpass").val() != $("#cnewpass").val()) {
        $("#changePassError").text("* Password did not matched!");
        $("#changePassBtn").val("Change Password");
      } else {
        $.ajax({
          url: "assets/php/process.php",
          method: "POST",
          data: $("#change-pass-form").serialize() + "&action=change_pass",
          success: function (response) {
            $("#changePassAlert").html(response);
            $("#changePassBtn").val("Change Password");
            $("#changePassError").text("");
            $("#change-pass-form")[0].reset();
          },
        });
      }
    }
  });

  //Verify E-MAIL ajax request
  $("#verify-email").click(function (e) {
    e.preventDefault();
    $(this).text("Please wait...");

    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { action: "verify_email" },
      success: function (response) {
        $("#verifyEmailAlert").html(response);
        $("#verify-email").text("Verify Now");
      },
    });
  });

  //CHECK NOTIFICATION
  checkNotification();
  function checkNotification() {
    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { action: "checkNotification" },
      success: function (response) {
        $("#checkNotification").html(response);
      },
    });
  }
});
