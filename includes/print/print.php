<!DOCTYPE html>
<?php   ob_start() ?>
<html>
 <?php 
              $host = 'localhost';
              $user = 'root';
              $password = '';
              $dbname='lazycorporation-ofwdatabase';
                try 
                {
                    $dsn = 'mysql:host='.$host.';dbname='.$dbname;
                    $connection = new PDO($dsn,$user,$password);
                    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
                } 
                catch (PDOException $e) 
                {
                    echo 'Connection failed: '.$e->getMessage();
                }

            if (isset($_GET['id'])) 
            {
                
                $show_profile_query="SELECT 
                                      a.*,
                                      b.*,
                                      c.*,
                                      d.*,
                                      e.* 
                                    FROM
                                      user_details AS a 
                                      JOIN user_personal_information AS b 
                                        ON a.u_id = b.u_id 
                                      JOIN user_professional_information AS c 
                                        ON b.u_id = c.u_id 
                                      LEFT JOIN user_experience AS d 
                                        ON c.u_id = d.u_id 
                                      LEFT JOIN user_question AS e 
                                        ON d.u_id = e.u_id 
                                    where a.u_id=:id";
                $show_profile_stmt=$connection->prepare($show_profile_query);
                $show_profile_stmt->execute(array(':id'=>$_GET['id']));
                $result = $show_profile_stmt->fetch(PDO::FETCH_ASSOC);

                
            
?>
<head>
  <title>LAZZY PROPERTY | PROPERTY</title>

  <meta name="viewport" content="width=device-width" />
  <meta charset="UTF-8">

  <link type="text/css" rel="stylesheet" href="design.css">
  <link href='https://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>

  <!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
    }
</script>
<body id="top">
  <div id="cv" class="instaFade">
    <div class="mainDetails">

<div class="sectionTitle" align="CENTER">
            <h1>HOUSE NAME</h1> <!-- property title -->
          </div>    
<div  class="quickFade" align="CENTER">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;"><BR>
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>"  style="width: 180px; height: 140px;">
</div>
    
      <div id="name">
        <input id="printpagebutton" type="button" value="PRINT HOUSE DETAILS" onclick="printpage()"/>
      </div>    

      <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">
      

      <section>
        <article>
          <div class="sectionTitle">
            <h1>Basic Details</h1> <!-- property title -->
          </div>

          <div class="sectionContent">
            
              <ul class="keySkills">
         
               <li><h2><?php echo $result['up_address']; ?></h2> <p class="subDetails">Status</p></li>       
               <li><h2><?php echo $result['up_address']; ?></h2> <p class="subDetails">Land Size</p></li>
               
              </ul>
             
              <ul class="keySkills">
         
               <li><h2><?php echo $result['up_religion']; ?></h2> <p class="subDetails">Floor Size</p></li>       
               <li><h2><?php echo $result['up_education']; ?></h2> <p class="subDetails">Bed Room</p></li>
               
              </ul>
                <ul class="keySkills">
         
               <li><h2><?php echo $result['up_maritalstatus']; ?></h2> <p class="subDetails">Bathroom</p></li>       
               <li><h2><?php echo $result['u_gender']; ?></h2> <p class="subDetails">Garage</p></li>
               
              </ul>
                </ul>
            
      
          </div>
        </article>
        <div class="clear"></div>
      </section>

       <section>
        <div class="sectionTitle">
          <h1>Description</h1>
        </div>
        <div class="sectionContent">
          <ul class="keySkills">

            <?php 
                $string = preg_replace('/[\.,\s]/', '', $result['up_languages']); //Remove dot at end if exists
                $array = explode(',', $result['up_languages']); //split string into array seperated by ', '
                foreach($array as $value) //loop over values
                {
                    echo "<li>".$value.PHP_EOL."</li>";//print value
                }
             ?>
          
          </ul>
        </div>
        <div class="clear"></div>
      </section>



      <section>
        <div class="sectionTitle">
          <h1>Property Map</h1>
        </div>

        <div class="sectionContent">
          <ul class="keySkills">
            <?php 
                $string = preg_replace('/[\.,\s]/', '', $result['upi_skillsexp']); //Remove dot at end if exists
                $array = explode(',', $result['upi_skillsexp']); //split string into array seperated by ', '
                foreach($array as $value) //loop over values
                {
                    echo "<li>".$value.PHP_EOL."</li>";//print value
                }
             ?>
          </ul>
        </div>
        <div class="clear"></div>
      </section>


      <div id="name">
        <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>" alt="Lazzy Picture" />
        <h1 class="quickFade delayTwo"><?php echo $result['u_fname']." ".$result['u_lname'];?></h1>
        <h2 class="quickFade delayThree"><?php echo $result['up_nationality']; ?></h2>
        <h3 class="quickFade delayThree"><?php echo $result['up_email']; ?></h3>
      </div>


    </div>
  </div>

</body>

</html>
<?php } ?>