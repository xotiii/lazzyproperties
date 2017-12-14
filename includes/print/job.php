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
            include_once '../class/class.user.php';
            $user = new User($connection);

            if(isset($_GET['applied']))
            {

                $check_applied_query="SELECT * FROM job_submitted where j_id=:jid and u_id=:uid";
                $check_applied_stmt=$connection->prepare($check_applied_query);
                $check_applied_stmt->execute(array(':jid'=>$_GET['id'],
                                              ':uid'=>$_GET['candidateid']));
                $result = $check_applied_stmt->fetch(PDO::FETCH_ASSOC);

                if(empty($result))
                {
                        $check_profile_query="SELECT * FROM user_personal_information WHERE u_id=:uid";
                        $check_profile_stmt=$connection->prepare($check_profile_query);
                        $check_profile_stmt->execute(array(':uid'=>$_GET['candidateid']));
                        $result_profile = $check_profile_stmt->fetch(PDO::FETCH_ASSOC);
                 
                        if(!empty($result_profile))
                        {
                            if($user->apply_job($_GET['candidateid'],$_GET['id']))
                            {
                                   echo"<script>
                                    alert('Successfully Applied! Please Wait for the Employer Reply. Thank you');
                                    closeWindow();
                                    function closeWindow() {
                                        window.close();
                                    }
                                  </script>";
                              }
                        }
                        else
                        {
                              echo "<script>
                                        alert('Please Submit Profile first to Apply for this job. Thank you');
                                        location.href = '../index-candidate.php?source=addnew';
                                     </script>";
                        }

                }
                else
                {
                         echo "<script>
                               alert('Already Applied to This Job! Please Wait for the Employer Reply. Thank you');
                               location.href = 'job.php?id=".$_GET['id']."';
                              </script>";
                
                }  
            }
            
            if(isset($_GET['denied']))
            {
                  echo"<script>
                            alert('Please Register/Login to Apply for this Job. Thank you!');
                             closeWindow();
                            function closeWindow() {
                                window.close();
                                
                            }
                        </script>";
            }
            if (isset($_GET['id'])) 
            {
                
                $show_profile_query="SELECT *,  DATE_FORMAT(j_dateposted,'%M %d, %Y') as j_dateposted FROM job_description where j_id=:id";
                $show_profile_stmt=$connection->prepare($show_profile_query);
                $show_profile_stmt->execute(array(':id'=>$_GET['id']));
                $result = $show_profile_stmt->fetch(PDO::FETCH_ASSOC);
               
                
            
?>
<head>
  <title>LAZZY WORKS | Job Post</title>

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
        var printButton = document.getElementById("printpagebuttonjob");
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
          <img src="../assets/img/profilepicture/<?php echo $result['j_logo']; ?>" alt="lazzy picture" />
        </div>
     
      <div id="name">
	      
        <h1 class="quickFade delayTwo"><?php echo $result['j_jobtitle'];?></h1>
        <h2 class="quickFade delayThree"><?php echo $result['j_employertype']; ?></h2>
        <h3 class="quickFade delayThree"><?php echo $result['j_applicationemail']; ?></h3>
        <input id="printpagebuttonjob" type="button" value="PRINT JOB POST HERE" onclick="printpage()"/><br>
        
                                   <?php
                                       session_start();
                                      if(isset($_SESSION['user_session'])) 
                                         {
                                            

                                              if(isset($_SESSION['user_type']))
                                              {
                                                if($_SESSION['user_type']=='Candidate')
                                                {   
                                                  
                                                    ?>
                                                  <button  type="button" id="printpagebuttonjob";
                                                   onclick="location.href='job.php?id=<?php echo $_GET['id'] ?>&candidateid=<?php echo $_SESSION['user_session'] ?>&applied'">CLICK HERE TO APPLY&nbsp;</button>
                                               <?php }
                                              }
                                         }
                                         else
                                         {
                                            ?>
                                            <button type='button' id="printpagebuttonjob" class='btn btn-large btn-block btn-primary full-width';
                                                  onclick="location.href='job.php?id=<?php echo $_GET['id'] ?>&denied'">CLICK HERE TO APPLY&nbsp;</button>
                                         <?php }
                                         
                                    ?>
      </div>
    

      <div class="clear"></div>
    </div>

    <div id="mainArea" class="quickFade delayFive">
      

      <section>
        <article>
          <div class="sectionTitle">
            <h1>Details</h1>
          </div>

          <div class="sectionContent">
            
              <ul class="keySkills">
         
               <li><h2><?php echo $result['j_country']; ?></h2> <p class="subDetails">Country</p></li>       
               <li><h2><?php echo $result['j_type']; ?></h2> <p class="subDetails">Job Type</p></li>
               
              </ul>
               <ul class="keySkills">
         
               <li><h2><?php echo $result['j_category']; ?></h2> <p class="subDetails">Job Category</p></li>       
               <li><h2><?php echo $result['j_contact']; ?></h2> <p class="subDetails">Contact</p></li>
               
              </ul>
              <ul class="keySkills">
         
               <li><h2><?php echo $result['j_nationality']; ?></h2> <p class="subDetails">Nationality</p></li>       
               <li><h2><?php echo $result['j_familytype']; ?></h2> <p class="subDetails">Family Type</p></li>
               
              </ul>
                <ul class="keySkills">
         
               <li><h2><?php echo $result['j_startdate']; ?></h2> <p class="subDetails">Start Date</p></li>       
               <li><h2><?php echo $result['j_dateposted']; ?></h2> <p class="subDetails">Date Posted</p></li>    
               
              </ul>
              
            
      
          </div>
        </article>
        <div class="clear"></div>
      </section>

      <section>
        <div class="sectionTitle">
          <h1>Salary</h1>
        </div>

        <div class="sectionContent">
          <article>
            
            <h2><?php echo $result['j_monthlysalary']; ?></h2>
          </article>
          
        </div>
        <div class="clear"></div>
      </section>


      <section>
        <div class="sectionTitle">
          <h1>Main Duties</h1>
        </div>

        <div class="sectionContent">
          <ul class="keySkills">
               <?php 
                $string = preg_replace('/[\.,\s]/', '', $result['j_mainduties']); //Remove dot at end if exists
                $array = explode(',', $result['j_mainduties']); //split string into array seperated by ', '
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
                $string = preg_replace('/[\.,\s]/', '', $result['j_cookingskill']); //Remove dot at end if exists
                $array = explode(',', $result['j_cookingskill']); //split string into array seperated by ', '
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
          <h1>Required Languages</h1>
        </div>

        <div class="sectionContent">
          <ul class="keySkills">
              <?php 
                $string = preg_replace('/[\.,\s]/', '', $result['j_requiredlanguages']); //Remove dot at end if exists
                $array = explode(',', $result['j_requiredlanguages']); //split string into array seperated by ', '
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
          <h1>Description</h1>
        </div>

        <div class="sectionContent">
          <article>
            
            <p><?php echo $result['j_description']; ?>s</p>
          </article>
            <article>
       
          
       
        </div>
        <div class="clear"></div>
      </section>



    </div>
  </div>

</body>

</html>
<?php } ?>