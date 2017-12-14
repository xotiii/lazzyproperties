<!DOCTYPE html>
<?php   ob_start() ?>
<html>
 <?php 
            //   $host = 'localhost';
            //   $user = 'root';
            //   $password = '';
            //   $dbname='lazzypropertiesdb';
            //     try 
            //     {
            //         $dsn = 'mysql:host='.$host.';dbname='.$dbname;
            //         $connection = new PDO($dsn,$user,$password);
            //         $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            //     } 
            //     catch (PDOException $e) 
            //     {
            //         echo 'Connection failed: '.$e->getMessage();
            //     }

            // if (isset($_GET['propId'])) 
            // {
            //             try
            //               {
            //               $show_profile_query="SELECT * FROM property_page WHERE Property_ID:id";
            //               $show_profile_stmt=$connection->prepare($show_profile_query);
            //               $show_profile_stmt->execute(array(':id'=>$_GET['propId']));
            //               $result = $show_profile_stmt->fetch(PDO::FETCH_ASSOC);
            //             }catch(PDOException $e)
            //             {
            //                echo 'Connection failed: '.$e->getMessage();
            //             }
              
            //   echo $result['Title']."afwfawefwefacergaerfawdaqdaqwdaqwdawefaervjoaierjoiajeroigjaoierjgiaovaerjfanoievjjoifjoijioajifjijijoa";
            // }

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
        <article>
          <div class="sectionTitle">
            <h1>Basic Details</h1>
          </div>

            <!--PETMALU-->
            <div class="sectionContent">
              <article>
            
               <h2><?php echo htmlentities($row['Title']); ?></h2>
               <p class="subDetails">Title</p>
                </article>
          
            </div>
            <!--PETMALU-->
               <!--PETMALU-->
            <div class="sectionContent">
              <article>
            
               <h2><?php echo htmlentities($row['Type']); ?></h2>
               <p class="subDetails">Title</p>
                </article>
          
            </div>
            <!--PETMALU-->


         
        </article>
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