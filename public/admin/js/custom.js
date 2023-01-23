    $(document).ready(function (){
    //Data Table Initialization
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#brands').DataTable();
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

    //Update Status
    $(document).on("click", '.updateStatus', function (){
        var module = $(this).attr('module');
        var status = $(this).children("i").attr("status");
        var module_id = $(this).attr("module-id");
        if(module === 'admin'){
            var url = "/admin/update_admin_status";
        } else if(module === 'section') {
            url = "/admin/sections/update_section_status";
        } else if (module === 'brand') {
            url = "/admin/brands/update_brand_status";
        } else if (module === 'category') {
            url = "/admin/brands/update_brand_status";
        } else if(module === 'product'){
            url = "/admin/products/update_product_status";
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:url,
            data:{status:status, module_id:module_id},
            success:function(resp){
                if(resp['status']===0){
                    $("#module-"+module_id).html("<i style='font-size: 25px;' title='Inactive' class='mdi mdi-bookmark-outline' status='Inactive'></i>")
                }else if(resp['status']===1){
                    $("#module-"+module_id).html("<i style='font-size: 25px;' title='Active' class='mdi mdi-bookmark-check' status='Active'></i>")
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
                    switch (module){
                        case 'category':
                            window.location = "/admin/categories/delete-"+module+"/"+module_id;
                            break;
                        case 'section':
                            window.location = "/admin/sections/delete-"+module+"/"+module_id;
                            break;
                        case 'category-image':
                            window.location = "/admin/categories/delete-"+module+"/"+module_id;
                            break;
                        case 'brand':
                            window.location = "/admin/brands/delete-"+module+"/"+module_id;
                            break;
                        case 'product':
                            window.location = "/admin/products/delete-"+module+"/"+module_id;
                            break;
                    }
                }
            })
        });

        //Update category Status
        $(document).on("click", '.updateCategoryStatus', function (){
            var status = $(this).children("i").attr("status");
            var category_id = $(this).attr("category-id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'post',
                url:"/admin/categories/update_category_status",
                data:{status:status, category_id:category_id},
                success:function(resp){
                    if(resp['status']===0){
                        $("#category-"+category_id).html("<i title='Inactive' style='font-size: 25px;' class='mdi mdi-bookmark-outline' status='Inactive'></i>")
                    }else  if(resp['status']===1){
                        $("#category-"+category_id).html("<i title='Active' style='font-size: 25px;' class='mdi mdi-bookmark-check' status='Active'></i>")
                    }
                },error:function (){
                    alert("Error");
                }
            });
        });

        //Load Section Categories
        $(document).on("click", '#section_categories', function (){
            var SectionId = $(this).val();
            //Check if it's a product addition or editting category, if it's a product we don't need root, but if it's a category we need the root
            var Id = $(this).attr('module');
            var Root = (Id === 'product');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/categories/get-section-category",
                type: "post",
                data:{section_id: SectionId},
                success: function(resp) {
                    $('#category').empty();
                    // if it's a product we don't need root, but if it's a category we need the root
                    if(!Root){
                        $("#category").append('<option value="0">Root</option>');
                    }
                    if($.trim(resp)){
                        $.each(resp, function(key, value) {
                            $("#category").append('<option value="' + value + '">' + key + '</option>');
                        });
                    }else{
                    }
                },
            });
        });

        $(document).on("click", '#category', function (){
            var CategoryId = $(this).val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/admin/products/get-sub-categories",
                type: "post",
                data:{category_id: CategoryId},
                success: function(resp) {
                    $('#sub-category').empty();
                    if($.trim(resp)){
                        $.each(resp, function(key, value) {
                            $("#sub-category").append('<option value="' + value + '">' + key + '</option>');
                        });
                    }else{
                    }
                },
            });
        });
});
