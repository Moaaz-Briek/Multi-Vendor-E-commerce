    $(document).ready(function (){
    //Data Table Initialization
    $('#sections').DataTable();
    $('#categories').DataTable();
    $('#brands').DataTable();

    //Remove active class from nav items
    $(".nav-item").removeClass("active");
    $(".nav-link").removeClass("active");
    $('#delete_product_images').hide();

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

    //Check on selected product images to delete it ... http://127.0.0.1:8000/admin/products/add-image/1
    var selected = [];
    $('#checkbox input[type=checkbox]').change(function() {$("#delete_product_images").show();});
    $('#delete_product_images').click(function (){
        var $boxes = $('input[name=ids]:checked');
        //reset values
        selected = [];
        $boxes.each(function(){
            selected.push($(this).val());
        });
    });

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
            url = "/admin/categories/update_category_status";
        } else if(module === 'product'){
            url = "/admin/products/update_product_status";
        } else if(module === 'attribute'){
            url = "/admin/products/product_attributes/update_attribute_status";
        } else if(module === 'product_image') {
            url = "/admin/products/product_image_status";
        } else if(module === 'banner') {
            url = "/admin/banners/update_banner_status";
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:'post',
            url:url,
            data:{status:status, module_id:module_id},
            success:function(resp){
                console.log(resp);
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

    //Confirm Delete (Sweet JavaScript)
    $(".confirm_delete").click(function (){
       var module = $(this).attr('module');
       var module_id = $(this).attr('module_id');
       //Delete Selected product image ... http://127.0.0.1:8000/admin/products/add-image/1
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this " + module.replace(module.charAt(0), module.charAt(0).toUpperCase()) + "?!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your ' + module.replace(module.charAt(0), module.charAt(0).toUpperCase()) + ' has been deleted.',
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
                    case 'attribute':
                        window.location = "/admin/products/product_attributes/delete-"+module+"/"+module_id;
                        break;
                    case 'product_image':
                        window.location = "/admin/products/delete-"+module+"/"+module_id;
                        break;
                    case 'selected_images':
                        window.location = "/admin/products/delete-"+module+"/"+selected;
                        break;
                    case 'product_video':
                        window.location = "/admin/products/delete-"+module+"/"+module_id;
                        break;
                    case 'banner':
                        window.location = "/admin/banners/delete-"+module+"/"+module_id;
                        break;
                    case 'banner_image':
                        window.location = "/admin/banners/delete-"+module+"/"+module_id;
                        break;
                }
            }
        })
    });

    //Load Section Categories
    $(document).on("change", '#section_categories', function (){
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
                $('#sub-category').empty();
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

    //Load subCategories
    $(document).on("change", '#category', function (){
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

    //Add-Remove Product Attributes on the fly
    {
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><div style="height: 10px;"></div><input type="text" name="size[]" placeholder="Size" required>\n' +
            '<input type="text" name="sku[]" placeholder="SKU" required>\n' +
            '<input type="text" name="price[]" placeholder="Price" required>\n' +
            '<input type="text" name="stock[]" placeholder="Stock" required>' +
            '<a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function () {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    }
});
