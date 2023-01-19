    $(document).ready(function (){
    //Data Table Initialization
    $('#sections').DataTable();
    //Remove active class from nav items
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    //Check Admin Password is correct or not
    $("#current_password").keyup(function (){
        var current_password = $("#current_password").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url: '/admin/check_current_password',
            data: {current_password:current_password},
            success: function (resp){
                if(resp == "false"){
                    $("#check_password").html("<font color='red'>Current Password is Incorrect!</font>")
                }
                else{
                    $("#check_password").html("<font color='green'>Current Password is Correct!</font>")
                }
            },error: function (){
                alert('Error');
            }
        })
    })

    //Update Admin Status
    $(document).on("click", '.updateAdminStatus', function (){
       var status = $(this).children("i").attr("status");
       var admin_id = $(this).attr("admin-id");
       $.ajax({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          type:'post',
          url:"/admin/update_admin_status",
          data:{status:status, admin_id:admin_id},
          success:function(resp){
              if(resp['status']===0){
                  $("#admin-"+admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>")
              }else if(resp['status']===1){
                  $("#admin-"+admin_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
              }
          },error:function (){
              alert("Error");
           }
       });
    });

    //Update Admin Status
    $(document).on("click", '.updateSectionStatus', function (){
        var status = $(this).children("i").attr("status");
        var section_id = $(this).attr("section-id");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:"/admin/sections/update_section_status",
            data:{status:status, section_id:section_id},
            success:function(resp){
                if(resp['status']===0){
                    $("#section-"+section_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>")
                }else if(resp['status']===1){
                    $("#section-"+section_id).html("<i style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
                }
            },error:function (){
                alert("Error");
            }
        });
    });
    // //Confirm Delete (Simple JavaScript)
    //     $(".confirm_delete").click(function (){
    //        var identifier = $(this).attr('identifier');
    //        if(confirm('Are you sure to delete this '+identifier+' ?'))
    //         {
    //             return true;
    //         }else{
    //             return false;
    //         }
    //     });

        //Confirm Delete (Sweet JavaScript)
        $(".confirm_delete").click(function (){
           var module = $(this).attr('module');
           var module_id = $(this).attr('module_id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    window.location = "/admin/sections/delete-"+module+"/"+module_id;
                }
            })
        });
});
