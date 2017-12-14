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
  <title>LAZZY WORKS | Candidate Profile</title>

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

     
  <div id="headshot" class="quickFade">
          <img src="../assets/img/profilepicture/<?php echo $result['up_picture']; ?>" alt="Lazzy Picture" />
        </div>
      <div id="name">
         
        <h1 class="quickFade delayTwo"><?php echo $result['u_fname']." ".$result['u_lname'];?></h1>
        <h2 class="quickFade delayThree"><?php echo $result['up_nationality']; ?></h2>
        <h3 class="quickFade delayThree"><?php echo $result['up_email']; ?></h3>
        <input id="printpagebutton" type="button" value="PRINT RESUME HERE" onclick="printpage()"/>
      </div>
    

      <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">
      

      <section>
        <article>
          <div class="sectionTitle">
            <h1>Basic Details</h1>
          </div>

          <div class="sectionContent">
            
              <ul class="keySkills">
         
               <li><h2><?php echo $result['up_address']; ?></h2> <p class="subDetails">Location Now</p></li>       
               <li><h2>23</h2> <p class="subDetails">Age</p></li>
               
              </ul>
             
              <ul class="keySkills">
         
               <li><h2><?php echo $result['up_religion']; ?></h2> <p class="subDetails">Religion</p></li>       
               <li><h2><?php echo $result['up_education']; ?></h2> <p class="subDetails">Highest Education</p></li>
               
              </ul>
                <ul class="keySkills">
         
               <li><h2><?php echo $result['up_maritalstatus']; ?></h2> <p class="subDetails">Marital Status</p></li>       
               <li><h2><?php echo $result['u_gender']; ?></h2> <p class="subDetails">Gender</p></li>
               
              </ul>
                </ul>
                <ul class="keySkills">
         
               <li><h2><?php if($result['up_mobile']=="")echo "N/A";else echo $result['up_mobile']; ?></h2> <p class="subDetails">Mobile Number</p></li>       
               <li><h2><?php if($result['up_telephone']=="")echo "N/A";else echo $result['up_telephone']; ?></h2> <p class="subDetails">Telephone Number</p></li>
               
              </ul>
            
      
          </div>
        </article>
        <div class="clear"></div>
      </section>

       <section>
        <div class="sectionTitle">
          <h1>Languages</h1>
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
          <h1>Skills/Expertise</h1>
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

        <section>
        <div class="sectionTitle">
          <h1>Cooking Skills</h1>
        </div>

        <div class="sectionContent">
          <ul class="keySkills">
            <?php 
                $string = preg_replace('/[\.,\s]/', '', $result['upi_cookingskills']); //Remove dot at end if exists
                $array = explode(',', $result['upi_cookingskills']); //split string into array seperated by ', '
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
          <h1>Work Experience</h1>
        </div>

        <div class="sectionContent">
          <article>
          <?php 

              if($result['ue_jd']!="") 
                {
                  echo "<h2>".$result['ue_jd']."</h2>";
                  echo  "<p class='subDetails'>".$result['ue_from']."-".$result['ue_to']."</p>";
                  echo  "<p>". $result['ue_jdlocation']."</p>";
                }
                else
                {
                  echo "N/A";
                }
          
          ?>
         </article>
        </div>
        <div class="clear"></div>
      </section>


      <section>
        <div class="sectionTitle">
          <h1>Suplementary Questions</h1>
        </div>

        <div class="sectionContent">
          <article>
            
            <p>If Your employer asked you to work on holiday and willing to pay as compensation, are you willing to do so?<h2><?php if($result['uq_1']=="")echo "N/A";else echo $result['uq_1']; ?></h2></p>
          </article>
            <article>
       
            <p>Would You Agree To do Extra Work?<h2><?php if($result['uq_2']=="")echo "N/A";else echo $result['uq_2']; ?></h2></p>
          </article>
            <article>
            
            <p>Are you willing to work for a family without your own servant room?<h2><?php if($result['uq_3']=="")echo "N/A";else echo $result['uq_3']; ?></h2></p>
          </article>
            <article>
          
           
            <p>Are you willing to take care of children no matter how many the family has?<h2><?php if($result['uq_4']=="")echo "N/A";else echo $result['uq_4']; ?></h2></p>
          </article>
            <article>
           
            
            <p>Living with elderly person?<h2><?php if($result['uq_5']=="")echo "N/A";else echo $result['uq_5']; ?></h2></p>
          </article>
            <article>
          
            
            <p>Are you willing to take care of disable elderly?<h2><?php if($result['uq_6']=="")echo "N/A";else echo $result['uq_6']; ?></h2></p>
          </article>
            <article>
         
            
            <p>Do you got experience to take care of dogs and pets?<h2><?php if($result['uq_7']=="")echo "N/A";else echo $result['uq_7']; ?></h2></p>
          </article>
            <article>
          
            <p>Have you suffered from health problems in your nervous system, eyes, feet, legs, or any other parts of your body?<h2><?php if($result['uq_8']=="")echo "N/A";else echo $result['uq_8']; ?></h2></p>
          </article>
            <article>
           
           
            <p>Can you drive<h2><?php if($result['uq_9']=="")echo "N/A";else echo $result['uq_9']; ?></h2></p>
          </article>
            <article>
         
        
            <p>Are you willing to work with other person?<h2><?php if($result['uq_10']=="")echo "N/A";else echo $result['uq_10']; ?></h2></p>
          </article>
       
        </div>
        <div class="clear"></div>
      </section>

    </div>
  </div>

</body>

</html>
<?php } ?>