$(document).ready(function(){

    //LISTADO DE USUARIOS AJAX REQUEST
    fetchAllUsers();

    function fetchAllUsers(){
        $.ajax({
            url:"assets/php/admin-action.php",
            method:"POST",
            data:{ action:'fetchAllUsers' },
            success:function(response){
                $("#showAllUsers").html(response);
                $("table").DataTable({
                    order:[0,'desc']
                });
            }
        });
    }

    //MOSTRAR DETALLES DEL USUARIO EN EL MODAL
    $("body").on("click",".userDetailsIcon",function(e){
        e.preventDefault();
        details_id = $(this).attr("id");
        $.ajax({
            url:"assets/php/admin-action.php",
            type:"POST",
            data:{ details_id: details_id },
            success:function(response){
                data = JSON.parse(response);
                $("#getName").text(data.name);
                $("#getEmail").text('Email: '+data.email);
                $("#getPhone").text('Phone: '+data.phone);
                $("#getGender").text('Gender: '+data.gender);
                $("#getDob").text('Date of Birth: '+data.dob);
                $("#getCreated").text('Joined On: '+data.created_at);
                $("#getVerified").text('Verified: '+data.verified);

                if(data.photo != ""){
                    $("#getImage").html('<img src="../assets/php/'+data.photo+'" class="img-thumbnail img-fluid align-self-center" width="280px" />');
                }else{
                    $("#getImage").html('<img src="../assets/img/avatar2.png" class="img-thumbnail img-fluid align-self-center" width="280px" />');
                }
            }
        });
    });

    //ELIMINAR UN USUARIO AJAX REQUEST
    $("body").on("click", ".deleteUserIcon", function (e) {
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