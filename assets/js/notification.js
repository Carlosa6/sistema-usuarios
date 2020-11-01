$(document).ready(function () {
  
  fetchNotification();
  //fetch notification of an user
  function fetchNotification() {
    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { action: "fetchNotification" },
      success: function (response) {
        $("#showAllNotification").html(response);
      },
    });
  }

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

  //REMOVE NOTIFICATION
  $("body").on('click',".close",function(e){
    e.preventDefault();
    notification_id = $(this).attr('id');
    $.ajax({
      url:"assets/php/process.php",
      method:"POST",
      data:{ notification_id:notification_id },
      success:function(response){
        checkNotification();
        fetchNotification();
      }
    });
  });

});
