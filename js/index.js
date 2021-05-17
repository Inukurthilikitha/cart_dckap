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
});