$(document).ready(function () {
    $("#sort").on('change', function (){
        var sort = $("#sort").val();
        var url = $("#url").val();
        $.ajax({
            url: url,
            method: "POST",
            data: {sort:sort, url:url},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
               $(".filter_products").html(data);
            },
            error: function () {
                alert("Error");
            }
        });
    });
});
