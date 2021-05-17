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