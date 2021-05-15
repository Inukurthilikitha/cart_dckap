$(document).ready(function () {
	var user_id;
	$(document).on('click', '#sign_in', function(e) {
        e.preventDefault();
        $("#login_form").submit();
    });
    $("#login_form").validate({
        rules: {
            email: {
                required: true
            },
            password: {
                required: true,
            }
        },
        messages: {
            email: {
                required: "Please enter User Name"
            },
            password: {
                required: "Please enter Password",
            }
        },
        errorPlacement: function(error, element) {
            $(error).css({
                'color': '#FF0000'
            });
            error.insertAfter($('[name="' + element.attr('name') + '"]'));
        },
        submitHandler: function (form) { 
           var email = $('#email').val();
           var password = $("#password").val();
            $.ajax({
                url: site_url + "user/login_user",
                type: 'POST',
               // async: true,
                dataType: 'json',
                data: { email: email,password: password},
                success: function(resp) {
                	if(resp.res == 1){
            		    window.location.href = site_url+ "product_list";
                	}else{
                		window.location.reload();
                	}
                },
            });
        }
    });
    $(document).on('click','.user_edit',function(e){
    	e.preventDefault();
    	user_id = $(this).attr('id');
    	 $.ajax({
            url: site_url + "User/edit_user",
            type: 'POST',
            async: true,
            dataType: 'json',
            data: { user_id: user_id},
            success: function(resp) {
            	$("#edit_name").val(resp.data.Name);
            	$("#edit_email").val(resp.data.Email);
            	$("#edit_mobile").val(resp.data.Phone);
            	$("#edit_modal").modal();
            },
        });
    })
     $(document).on('click','.user_delete',function(e){
    	e.preventDefault();
    	user_id = $(this).attr('id');
    	 $.ajax({
            url: site_url + "User/delete_user",
            type: 'POST',
            async: true,
            dataType: 'json',
            data: { user_id: user_id},
            success: function() {
            	window.location.reload();
            },
        });
    })
     $(document).on('click','#add_user',function(){
     	$("#add_user_form")[0].reset();
        $("#add_user_form").validate().resetForm();
     	$("#add_modal").modal();
     })
      $(document).on('click', '#create_user', function(e) {
        e.preventDefault();
        $("#add_user_form").submit();
    });
    $("#add_user_form").validate({
        rules: {
            add_name: {
                required: true
            },
            add_email: {
                required: true,
            },
            add_mobile: {
                required: true,
            }
        },
        messages: {
            add_name: {
                required: "Please enter Name"
            },
            add_email: {
                required: "Please enter Email",
            },
            add_mobile: {
                required: "Please enter Phone Number",
            }
        },
        errorPlacement: function(error, element) {
            $(error).css({
                'color': '#FF0000'
            });
            error.insertAfter($('[name="' + element.attr('name') + '"]'));
        },
        submitHandler: function (form) { 
           var name = $('#add_name').val();
           var email = $("#add_email").val();
           var phone = $("#add_mobile").val();
            $.ajax({
                url: site_url + "User/add_details",
                type: 'POST',
                async: true,
                dataType: 'json',
                data: { name: name,email: email,phone: phone},
                success: function() {
                	window.location.reload();
                },
            });
        }
    });
    $(document).on('click', '#user_update', function(e) {
        e.preventDefault();
        $("#update_user_form").submit();
    });
    $("#update_user_form").validate({
        rules: {
            edit_name: {
                required: true
            },
            edit_email: {
                required: true,
            },
            edit_mobile: {
                required: true,
            }
        },
        messages: {
            edit_name: {
                required: "Please enter Name"
            },
            edit_email: {
                required: "Please enter Email",
            },
            edit_mobile: {
                required: "Please enter Phone Number",
            }
        },
        errorPlacement: function(error, element) {
            $(error).css({
                'color': '#FF0000'
            });
            error.insertAfter($('[name="' + element.attr('name') + '"]'));
        },
        submitHandler: function (form) { 
           var name = $('#edit_name').val();
           var email = $("#edit_email").val();
           var phone = $("#edit_mobile").val();
            $.ajax({
                url: site_url + "User/update_details",
                type: 'POST',
                async: true,
                dataType: 'json',
                data: { name: name,email: email,phone: phone,user_id:user_id},
                success: function() {
                	window.location.reload();
                },
            });
        }
    });

});