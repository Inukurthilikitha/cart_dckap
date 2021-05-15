$(document).ready(function(){
    $(document).on("blur",'.update_qty',function(e){
        updateproduct($(this).attr('p_id'));
    });
})
function deleteproduct(rowid)
{
  var answer = confirm ("Are you sure you want to delete?");
  if (answer)
  {
      $.ajax({
          type: "POST",
          url: site_url+"welcome/remove",
          data: "rowid="+rowid,
          success: function (response) {
              $(".rowid"+rowid).remove(".rowid"+rowid); 
              $(".cartcount").text(response);  
              if(parseInt($(".cartcount").text()) == 0){
                  $(".orderplace").attr('disabled','disabled');
              }else{
                  $(".orderplace").removeAttr('disabled');
              }  
              var total = 0;
              $('.subtotal').each(function(){
                  total += parseInt($(this).text().replace(/,/g, ''));
                  var grandtotal = new Intl.NumberFormat('en-IN', {
                      currency: 'INR'
                  }).format(total);
                  $('.grandtotal').text(grandtotal);
              }); 
              if($('.subtotal').length <= 0){
                $('.grandtotal').text('0');
                $(".place_order").attr('disabled','disabled');
              }else{
                $(".place_order").removeAttr('disabled');
              }          
          }
      });
    }
}

var total = 0;
$('.subtotal').each(function(){
    total += parseInt($(this).text().replace(/,/g, ''));
    var grandtotal = new Intl.NumberFormat('en-IN', {
        currency: 'INR'
    }).format(total);
    $('.grandtotal').text(grandtotal);
});
if($('.subtotal').length <= 0){
  $('.grandtotal').text('0');
  $(".place_order").attr('disabled','disabled');
}else{
  $(".place_order").removeAttr('disabled');
}   

function updateproduct(rowid)
{
var qty = $('.qty'+rowid).val();
var price = $('.price'+rowid).text().replace(/,/g, '');
var subtotal = $('.subtotal'+rowid).text();
  $.ajax({
    type: "POST",
    url: site_url + "welcome/update_cart",
    data: "rowid="+rowid+"&qty="+qty+"&price="+price+"&subtotal="+subtotal,
    success: function (response) {
      var subtotal = new Intl.NumberFormat('en-IN', {
          currency: 'INR'
      }).format(response);
      $('.subtotal'+rowid).text(subtotal);
      var total = 0;
      $('.subtotal').each(function(){
          total += parseInt($(this).text().replace(/,/g, ''));
          var grandtotal = new Intl.NumberFormat('en-IN', {
              currency: 'INR'
          }).format(total);
          $('.grandtotal').text(grandtotal);
      });     
    }
  });
}
