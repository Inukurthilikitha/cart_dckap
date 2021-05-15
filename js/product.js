$(document).ready(function () {
	var product_id;
    $(document).on("click",'.add_cart',function(e){
        p_id = $(this).attr('p_id');
        //$(this).attr('disabled','disabled');
        var price = $('.price'+p_id).attr('rel');
        var image = $('.image'+p_id).attr('rel');
        var name  = $('.name'+p_id).text();
        $.ajax({
            type: "POST",
            url: site_url + "Welcome/add",
            data: "id="+p_id+"&image="+image+"&name="+name+"&price="+price,
            success: function (response) {
                $(".cartcount").text(response);
                if(parseInt($(".cartcount").text()) == 0){
                    $(".orderplace").attr('disabled','disabled');
                }else{
                    $(".orderplace").removeAttr('disabled');
                }  
            }
        });
    })

    $(document).on('click','.product_edit',function(e){
    	e.preventDefault();
    	product_id = $(this).attr('id');
    	 $.ajax({
            url: site_url + "Product/edit_product",
            type: 'POST',
            async: true,
            dataType: 'json',
            data: { product_id: product_id},
            success: function(resp) {
            	$("#edit_name").val(resp.data.ProductName);
            	$("#edit_description").val(resp.data.Description);;
            	$("#edit_modal").modal();
            },
        });
    })
     $(document).on('click','.product_delete',function(e){
    	e.preventDefault();
    	product_id = $(this).attr('id');
    	 $.ajax({
            url: site_url + "Product/delete_product",
            type: 'POST',
            async: true,
            dataType: 'json',
            data: { product_id: product_id},
            success: function() {
            	window.location.reload();
            },
        });
    })
     $(document).on('click','#add_product',function(){
     	$("#add_product_form")[0].reset();
        $("#add_product_form").validate().resetForm();
     	$("#add_modal").modal();
     })
      $(document).on('click', '#create_product', function(e) {
        e.preventDefault();
        $("#add_product_form").submit();
    });
    $("#add_product_form").validate({
        rules: {
            add_name: {
                required: true
            },
            add_description: {
                required: true,
            }
        },
        messages: {
            add_name: {
                required: "Please enter Name"
            },
            add_description: {
                required: "Please enter Description",
            }
        },
        errorPlacement: function(error, element) {
            $(error).css({
                'color': '#FF0000'
            });
            error.insertAfter($('[name="' + element.attr('name') + '"]'));
        },
        submitHandler: function (form) { 
           var name        = $('#add_name').val();
           var description = $("#add_description").val();
            $.ajax({
                url: site_url + "Product/add_details",
                type: 'POST',
                async: true,
                dataType: 'json',
                data: { name: name,description: description},
                success: function() {
                	window.location.reload();
                },
            });
        }
    });
    $(document).on('click', '#product_update', function(e) {
        e.preventDefault();
        $("#update_product_form").submit();
    });
    $("#update_product_form").validate({
        rules: {
            edit_name: {
                required: true
            },
            edit_description: {
                required: true,
            }
        },
        messages: {
            edit_name: {
                required: "Please enter Name"
            },
            edit_email: {
                required: "Please enter Description",
            }
        },
        errorPlacement: function(error, element) {
            $(error).css({
                'color': '#FF0000'
            });
            error.insertAfter($('[name="' + element.attr('name') + '"]'));
        },
        submitHandler: function (form) { 
           var name         = $('#edit_name').val();
           var description  = $("#edit_description").val();
            $.ajax({
                url: site_url + "Product/update_details",
                type: 'POST',
                async: true,
                dataType: 'json',
                data: { name: name,description: description,product_id:product_id},
                success: function() {
                	window.location.reload();
                },
            });
        }
    });

});
function opencart()
{
    $.ajax({
        type: "POST",
        url: site_url +"welcome/opencart",
        data: "",
        success: function (response) {
          $(".displaycontent").html(response);
        }
    });
}