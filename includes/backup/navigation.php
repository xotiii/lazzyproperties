


<nav class="navbar navbar-default navbar-static-top ">

            <div class="container">
             
              <a class="navbar-brand" href="index.php">Lazzy Properties</a>
              
              
				<?php  if(isset($_SESSION['ID'])){
                          echo '
      <div id="p-acc">
        <li class="dropdown ymm-sw " data-wow-delay="0.1s">
            <a  href=index.php?source=profile&User_ID='. $_SESSION['ID'] .' class="dropdown-toggle" data-toggle="dropdown">  '. $_SESSION['Email'] .'</a>
            <ul class="dropdown-menu navbar-nav">
               <li>
                    <a href="index.php">Home</a>
                </li> 
                <li>    
                    <a href=index.php?source=profile&User_ID='. $_SESSION['ID'] .'>PROFILE</a>
                </li>
                <li>
                    <a href="index.php?source=profile&User_ID='. $_SESSION['ID'] .'#messages"">Messages</a>
                </li>
                <li>
                    <a href="logout.php">Sign Out </a>
                </li>                          
            </ul>
        </li>
      </div> 

              <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   
                </div>

                

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    
                      


                   
                    <ul class="main-nav nav navbar-nav navbar-right">
                     
      ';
						}
						else {

              echo ' 

<div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                   
                </div>

                

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse yamm" id="navigation">
                    
                      


                   
                    <ul class="main-nav nav navbar-nav navbar-right">
                      


              <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a id="prop"  href="includes /value.php"><span id="plus" class="glyphicon glyphicon-user"></span> Login/Register</a>
 </li>';
							
						}
				?>
                  

                <!-- Brand and toggle get grouped for better mobile display -->
                
                

                       
                <div id="google_translate_element" class="translator"></div><script type="text/javascript">
              function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'ceb,tl', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
              }
              </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

                 <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a id="prop"  href="includes /value.php"><span id="plus" class="glyphicon glyphicon-plus"></span> <strong>Post a Property!</strong></a></li>
               <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a href="index.php?source=guide">Guide</a></li>
			   <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a href="index.php?source=news">News</a></li>
               <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a href="index.php?source=agsatbrkr">Agencies & Brokers</a></li>
               <li class="dropdown ymm-sw " data-wow-delay="0.1s"><a href="index.php?source=contact">Contact Us </a></li>

               
<?php
               if(isset($_SESSION['ID'])){ 

}
 ?>             

       <?php                      
echo '';
        
  

?>


                       


                        
                        

                        
                    </ul>


                </div><!-- /.navbar-collapse -->
     
    </div><!-- /.container-fluid -->

        </nav>
        <!-- End of nav bar -->