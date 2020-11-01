$(document).ready(function () {
  $("table").DataTable();

  //Add New Note Ajax Request
  $("#addNoteBtn").click(function (e) {
    if ($("#add-note-form")[0].checkValidity()) {
      e.preventDefault();
      $("#addNoteBtn").val("Please wait...");
      $.ajax({
        url: "assets/php/process.php",
        method: "POST",
        data: $("#add-note-form").serialize() + "&action=add_note",
        success: function (response) {
          $("#addNoteBtn").val("Add Note");
          $("#add-note-form")[0].reset();
          $("#addNoteModal").modal("hide");
          Swal.fire({
            title: "Note added successfully!",
            icon: "success",
          });
          displayAllNotes();
        },
      });
    }
  });

  //Edit Note of an user ajax request.Buscar la info en la BD y mostrarla en el form
  $("body").on("click", ".editBtn", function (e) {
    e.preventDefault();
    edit_id = $(this).attr("id");
    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { edit_id: edit_id },
      success: function (response) {
        data = JSON.parse(response);
        $("#id").val(data.id);
        $("#title").val(data.title);
        $("#note").val(data.note);
      },
    });
  });

  //Actualizar la nota del usuario
  $("#editNoteBtn").click(function (e) {
    if ($("#edit-note-form")[0].checkValidity()) {
      e.preventDefault();
      $.ajax({
        url: "assets/php/process.php",
        method: "POST",
        data: $("#edit-note-form").serialize() + "&action=update_note",
        success: function (response) {
          Swal.fire({
            title: "Note updated successfully!",
            icon: "success",
          });
          $("#edit-note-form")[0].reset();
          $("#editNoteModal").modal("hide");
          //actualizar la tabla
          displayAllNotes();
        },
      });
    }
  });

  //Delete note of an user
  $("body").on("click", ".deleteBtn", function (e) {
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
          url: "assets/php/process.php",
          method: "POST",
          data: { del_id: del_id },
          success: function (response) {
            Swal.fire("Deleted!", "Note deleted successfully!", "success");
            displayAllNotes();
          },
        });
      }
    });
  });

  //mostrar info de la nota
  $("body").on("click", ".infoBtn", function (e) {
    e.preventDefault();
    info_id = $(this).attr("id");

    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { info_id: info_id },
      success: function (response) {
        data = JSON.parse(response);
        Swal.fire({
          title: "<strong>Note Information</strong>",
          icon: "info",
          html:
            "<b>Title: </b>" +
            data.title +
            "<br><b>Note: </b>" +
            data.note +
            "<br><br><b>Written On: </b>" +
            data.created_at +
            "<br><br><b>Updated On: </b>" +
            data.updated_at,
          showCloseButton: true,
        });
      },
    });
  });

  displayAllNotes();
  //Display All notes of an User
  function displayAllNotes() {
    $.ajax({
      url: "assets/php/process.php",
      method: "POST",
      data: { action: "display_notes" },
      success: function (response) {
        $("#showNote").html(response);
        $("table").DataTable({
          order: [0, "desc"],
        });
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
});
