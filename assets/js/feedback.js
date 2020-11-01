$(document).ready(function () {
  //enviar el feedback al admin
  $("#feedbackBtn").click(function (e) {
    if ($("#feedback-form")[0].checkValidity()) {
      e.preventDefault();
      $(this).val("Please wait...");

      $.ajax({
        url: "assets/php/process.php",
        method: "POST",
        data: $("#feedback-form").serialize() + "&action=feedback",
        success: function (response) {
          $("#feedback-form")[0].reset();
          $("#feedbackBtn").val("Send Feedback");
          Swal.fire({
            title: "Feedback successfully sent to the Admin",
            icon: "success",
          });
        },
      });
    }
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
