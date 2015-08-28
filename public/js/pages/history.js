
$(document).ready(function(){

  var reseller_history_page = 1;
  $('a#load_resller_history').click(function(){
      reseller_history_page++;
     $.ajax({                
      type: "get",
      url: "load_resller_history/"+reseller_history_page,       
      success: function(res){
        $('#table_reseller_history tbody').append(res.data);
        if(!res.next) {
          $('#nav_reseller_history').hide();
        }
      }                 
    });

    return false;
  });
  
});
