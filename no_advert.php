<style>

/*-----------------Viewport less than or equal to 1200px----------------*/

@media (max-width: 1200px) {
  body,
  p,
  h2,
  h1 {
    margin: 5px;
    padding: 2px;
  }
  #container {
    width: 50%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    display: absolute;
  }
  #pop-up {
    width: 320px;
    height: 230px;
    background: #ffb;
    box-sizing: border-box;
    padding: 10px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
  }
  #close-btn {
    cursor: pointer;
    font-size: 20px;
    outline: none;
    color: red;
  }
  #pop-up h1 {
    font-size: 18px;
    text-align: center !important;
  }
  #pop-up h4 {
    font-size: 18px;
    text-align:left;
	color:blue;
  }
   #pop-up a{
    font-size: 18px;
    text-align: left !important;
	text-decoration:none !important;
  }
  #pop-up p {
    font-size: 18px;
    text-align: left !important;
  }
}

/*-----------------Viewport less than or equal to 520px----------------*/

@media (max-width: 520px) {
  body,
  p,
  h2,
  h1 {
    margin: 5px;
    padding: 2px;
  }
  #container {
    width: 50%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    display: absolute;
  }
  #pop-up {
    width: 300px;
    height: 230px;
    background: #ffb;
    box-sizing: border-box;
    padding: 10px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
  }
  #close-btn {
    cursor: pointer;
    font-size: 20px;
    outline: none;
    color: red;
  }
  #pop-up h1 {
    font-size: 15px;
    text-align: center !important;
  }
  #pop-up h4 {
    font-size: 15px;
    text-align:left;
	color:blue;
  }
   #pop-up a{
    font-size: 15px;
    text-align: left !important;
	text-decoration:none !important;
  }
  #pop-up p {
    font-size: 15px;
    text-align: left !important;
  }
}

/*-----------------Viewport less than or equal to 375px----------------*/

@media (max-width: 375px) {
  body,
  p,
  h2,
  h1 {
    margin: 2px;
    padding: 2px;
  }
  #container {
    width: 50%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    display: absolute;
  }
  #pop-up {
    width: 250px;
    height: 220px;
    background: #ffb;
    box-sizing: border-box;
    padding: 10px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
  }
  #close-btn {
    cursor: pointer;
    font-size: 20px;
    outline: none;
    color: red;
  }
  #pop-up h1 {
    font-size: 12px;
    text-align: center !important;
  }
  #pop-up h4 {
    font-size: 12px;
    text-align:left;
	color:blue;
  }
   #pop-up a{
    font-size: 12px;
    text-align: left !important;
	text-decoration:none !important;
  }
  #pop-up p {
    font-size: 12px;
    text-align: left !important;
  }
}
/*-----------------Viewport less than or equal to 325px----------------*/

@media (max-width: 325px) {
 body,
  p,
  h2,
  h1 {
    margin: 1px;
    padding: 1px;
  }
  #container {
    width: 50%;
    height: 100vh;
    position: absolute;
    top: 0;
    left: 0;
    display: none;
  }
  #pop-up {
    width: 250px;
    height: 210px;
    background: #ffb;
    box-sizing: border-box;
    padding: 10px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    border-radius: 10px;
  }
  #close-btn {
    cursor: pointer;
    font-size: 20px;
    outline: none;
    color: red;
  }
  #pop-up h1 {
    font-size: 10px;
    text-align: center !important;
  }
  #pop-up h4 {
    font-size: 10px;
    text-align:left;
	color:blue;
  }
   #pop-up a{
    font-size: 10px;
    text-align: left !important;
	text-decoration:none !important;
  }
  #pop-up p {
    font-size: 10px;
    text-align: left !important;
  }
}

</style>



<script>
    $(document).ready(function() {

        function showWindow() {
            $('#pop-up').show();
            $('#container').show();
            //stop scroll
            $('html body').css('overflow', 'hidden');

            //auto hide after 10sec
            // setTimeout(hideWindow,10000);
        }

        showWindow();

        function hideWindow() {
            $('#pop-up').hide();
            //allow scroll
            $('html body').css('overflow', 'scroll');
        }

        hideWindow();
        //auto open after 2sec
        setTimeout(showWindow, 2000);

        $("#close-btn").click(function() {

            hideWindow();

        });

    });
</script>