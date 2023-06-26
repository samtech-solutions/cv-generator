
$(document).ready(function(){

  function showWindow(e){
	event.preventDefault();
    $('#pop-up').show();
    $('#container').show();
     //stop scroll
    $('html body').css('overflow','hidden');
     
      //auto hide after 10sec
    // setTimeout(hideWindow,10000);
  }

  showWindow();
  
  function hideWindow(e){
	event.preventDefault();
    $('#pop-up').hide();
    //allow scroll
    $('html body').css('overflow','scroll');
  }

   hideWindow();
 //auto open after 5sec
   setTimeout(showWindow,5000);
   
   $("#close-btn").click(function(){

    hideWindow();
   
   });

});
 