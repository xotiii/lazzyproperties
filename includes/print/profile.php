<!DOCTYPE html>
<?php   ob_start() ?>
<html>
 <?php      
  $servername = "localhost";
  $username = "root";
  $password = "";
  try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $ex){
    echo 'Connection failed: ' . $ex->getmessage();
  }
  
  try{
      $query="SELECT * FROM property_page WHERE Property_ID=:id ";
      $stmt = $dbh->prepare($query);
      $stmt->bindParam(':id', $_GET['propId']);
      $stmt->execute();
      $count = (int)$stmt->rowCount();
      $results = $stmt->fetchAll();
      $link = 'index.php?source=profile';
      foreach($results as $row) 
      {
             
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

        


        <section>
        <div class="sectionTitle">
          <h1><?php echo htmlentities($row['Title'])." Picture"; ?></h1>
          <input id="printpagebutton" type="button" value="PRINT PROPERTY POST HERE" onclick="printpage()"/>
        </div>
              <?php 
                $Id= htmlentities($row['Property_ID']);
                $directory = '../images/prop/'.$Id.'/';
                $filecount = 0;
                $files = glob($directory . "*");
                if ($files)
                {
                    $filecount = count($files);
                }

                for($j=1;$j<$filecount+1;$j++)
                {


                    echo "<br><br><br><br><br> <div id='headshot' class='quickFade'>
                          <img src='../images/prop/".$Id."/".$j.".jpg' />
                           </div>
                          <br><br><br><br><br>";
                }    
            ?>
        <div class="clear"></div>
      </section>
          
<br><br><br><br><br><br><br><br><br><br>
           
          <article>
          <div class="sectionTitle">
            <h1>Property Map</h1>
          </div>
            <!--PETMALU-->
           <div id="googleMap" style="width:100%;height:300px;"></div>

              <script>
                  function initMap() {
                    var myLatLng = new google.maps.LatLng(<?php echo htmlentities($row['Latitude']); ?>,<?php echo htmlentities($row['Longitude']); ?>);

                    // Create a map object and specify the DOM element for display.
                    var map = new google.maps.Map(document.getElementById("googleMap"), {
                      center: myLatLng,
                      zoom: 17
                    });

                    // Create a marker and set its position.
                    var marker = new google.maps.Marker({
                      map: map,
                      position: myLatLng,
                      title: ""
                    });
                  }

                </script>
                
                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4EFKbbWeDCGWiH4VHV6aQTDVI0op9bP8&callback=initMap"
                async defer></script>
           
         
        </article>
        <div class="clear"></div>
      
            <section>
              <div class="sectionTitle">
                <h1>Details</h1>
              </div>

              <div class="sectionContent">
                <article>
                  
                      <h2><?php echo htmlentities($row['StreetAddress'])." ".htmlentities($row['City'])." ".htmlentities($row['Country']) ?></h2> <p class="subDetails">Location</p>
                </article>
                  <article>
            
              </div>
              <div class="sectionContent">
                <article>
                  
                      <h2><?php echo htmlentities($row['Status']) ?></h2> <p class="subDetails">Status</p>
                </article>
                  <article>
            
              </div>
                    <div class="sectionContent">
                <article>
                  
                      <h2><?php echo htmlentities($row['Price']) ?></h2> <p class="subDetails">Price</p>
                </article>
                  <article>
            
              </div>


              <div class="clear"></div>
            </section>

                  <section>
        <article>
          <div class="sectionTitle">
            <h1>Features</h1>
          </div>

          <div class="sectionContent">
            
              <ul class="keySkills">
         
               <li><h2><?php echo htmlentities($row['Floor']) ?></h2> <p class="subDetails">Floor Size</p></li>       
               <li><h2><?php echo htmlentities($row['Bed']) ?></h2> <p class="subDetails">Bedroom</p></li>
               
              </ul>
             
              <ul class="keySkills">
         
               <li><h2><?php echo htmlentities($row['Land']) ?></h2> <p class="subDetails">Landsize</p></li>       
               <li><h2><?php echo htmlentities($row['Bath']) ?></h2> <p class="subDetails">Bathroom</p></li>
               
              </ul>
                <ul class="keySkills">
         
               <li><h2><?php echo htmlentities($row['Garage']) ?></h2> <p class="subDetails">Garage</p></li>       
               <li><h2><?php echo htmlentities($row['Stories']) ?></h2> <p class="subDetails">Storeys</p></li>
               
              </ul>
                </ul>
             
            
      
          </div>
        </article>
        <div class="clear"></div>
      </section>

        <article>
          <div class="sectionTitle">
            <h1>Property Description</h1>
          </div>
            <!--PETMALU-->
            <p><?php echo htmlentities($row['Description']) ?></p>
  
           
           <div class="clear"></div>
        </article>


           <section>
              <div class="sectionTitle">
                <h1>Seller Information</h1>
              </div>

              <div class="sectionContent">
                <article>
                  
                      <h2><?php echo htmlentities($row['First_Name'])." ".htmlentities($row['Last_Name']) ?></h2> <p class="subDetails">Location</p>
                </article>
                  <article>
            
              </div>
              <div class="sectionContent">
                <article>
                  
                      <h2><?php echo if(htmlentities($row['Hide']=="1")){htmlentities($row['Email']);}else{echo "N/A";} ?></h2> <p class="subDetails">Email</p>
                </article>
                  <article>
            
              </div>
                    <div class="sectionContent">
                <article>
                  
                      <h2><?php echo htmlentities($row['Mobile']) ?></h2> <p class="subDetails">Mobile</p>
                </article>
                  <article>
            
              </div>


              <div class="clear"></div>
            </section>

      </div>
      </div>

</body>

</html>
<?php    }
                 
                  }
                  catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
                  }        ?>