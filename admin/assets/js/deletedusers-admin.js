$(document).ready(function () {
  fetchAllDeletedUsers();

  //TOTAL DE USUARIOS ELIMINADOS
  function fetchAllDeletedUsers() {
    $.ajax({
      url: "assets/php/admin-action.php",
      method: "POST",
      data: {
        action: "fetchAllDeletedUsers",
      },
      success: function (response) {
        $("#showAllDeletedUsers").html(response);
        $("table").DataTable({
          order: [0, "desc"],
        });
      },
    });
  }

  //RESTAURAR EL USUARIO
  $("body").on("click", ".restoreUserIcon", function (e) {
    e.preventDefault();
    del_id = $(this).attr("id");

    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "assets/php/admin-action.php",
          method: "POST",
          data: { del_id: del_id },
          success: function (response) {
            Swal.fire("Deleted!", "User deleted successfully!", "success");
            fetchAllUsers();
          },
        });
      }
    });
  });
});
