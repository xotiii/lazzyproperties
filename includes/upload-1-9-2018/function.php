<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
</style>

<?php
$prof_fname='a';
$prof_lname='a';
$prof_email='a';
$prof_mobile='a';

$servername = "localhost";
$username="lazzy";
$password="wonglazzy";


function reg_user()
{
	
	global $servername;
	global $username;
	global $password;
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['reg_submit'])) 
			{				
				try{
					//Insert User Details
					$stmt = $dbh->prepare("INSERT INTO User (email, User_Type, first_name, last_name, password, Hide) 
											VALUES (:email, :user_type, :firstname, :lastname, :password, :hide)");
					$stmt->bindParam(':email', $email);
					$stmt->bindParam(':user_type', $user_type);
					$stmt->bindParam(':firstname', $firstname);
					$stmt->bindParam(':lastname', $lastname);
					$stmt->bindParam(':password', $password);
					$stmt->bindParam(':hide', $hide);
					$email=$_POST['reg_email'];
					$user_type=$_POST['reg_user_type'];
					$lastname=$_POST['reg_lname'];
					$firstname=$_POST['reg_fname'];
					$password=$_POST['reg_password'];
					$hide=$_POST['reg_hide'];
					$stmt->execute();
					//Check last ID
					$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() FROM User");
					$stmt->execute();
					$result = $stmt->fetchColumn();
					//Insert Contact Details
					$stmt = $dbh->prepare("INSERT INTO User_Contact (User_ID, Mobile, Email) 
											VALUES (:user_id, :mobile, :email)");
					$stmt->bindParam(':user_id', $result);
					$stmt->bindParam(':mobile', $mobile);
					$stmt->bindParam(':email', $email);
					$mobile=$_POST['reg_mobile'];
					$stmt->execute();
					echo "Register Successful!";
					//echo "<script> location.href = 'index.php' </script>";
					//echo "Error Code: " . $stmt->errorCode();
					$_SESSION['ID'] = $result;
					$_SESSION['Email'] = $email;
					$_SESSION['FName'] = $firstname;
					$_SESSION['LName'] = $lastname;
					echo "<script> location.href = 'index.php?source=profile-success'; </script>";
				}
				catch(PDOException $e){
					if($e->getCode() === '23000')
					{
						echo "Email already taken.";
					}
					else
					{
					echo "Error: " . $e->getMessage();
					}
				}
			}


}

function login(){
	
	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	//global $dbh
	if (isset($_POST['login_submit'])) 
	{			
		try{
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("SELECT * FROM Log_In WHERE (Email=:email OR Mobile=:email) AND Password=:password");
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':password', $password);
			$email=$_POST['login_email'];
			$password=$_POST['login_password'];
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			if($count == 1 ){
				echo "Log In Successful!";
				
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$_SESSION['ID'] = $result->User_ID;
				$stmt = $dbh->prepare("SELECT * FROM User WHERE User_ID=:user_id");
				$stmt->bindParam(':user_id', $_SESSION['ID']);
				$stmt->execute();
				$result = $stmt->fetch(PDO::FETCH_OBJ);
				$_SESSION['Email'] = $result->Email;
				$_SESSION['FName'] = $result->First_Name;
				$_SESSION['LName'] = $result->Last_Name;
				header('Location: index.php');
				exit();
			}
			else if($count > 1){
				echo "Error occured. Please contact the administrator.";
			}
			else {
				echo "Incorrect email or password.";
			}
			
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
}

function edit_property(){
	
	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['edit_submit'])) 
	{				
		try{
			//Insert User Details
			$stmt = $dbh->prepare("UPDATE Property SET Title=:title, Type=:type, Price=:price, Description=:description, Status='Active' 
									WHERE Property_ID=:prop_ID");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':prop_ID',$prop_ID);
			$title = $_POST['post_title'];
			$type = $_POST['post_type'];
			$price = $_POST['post_price'];
			$description = htmlentities($_POST['post_description'], ENT_QUOTES, 'UTF-8');
			
			$prop_ID = $_GET['propId'];
			$stmt->execute();
			//Insert Contact Details
			$stmt = $dbh->prepare("UPDATE Property_Location SET Country=:country, Zip=:zip, State=:state, City=:city, StreetAddress=:streetaddress 
									WHERE Property_ID=:property_id");
			$stmt->bindParam(':property_id', $prop_ID);
			$stmt->bindParam(':country', $country);
			$stmt->bindParam(':zip', $zip);
			$stmt->bindParam(':state', $state);
			$stmt->bindParam('city', $city);
			$stmt->bindParam(':streetaddress', $route);
			$country = $_POST['post_country'];
			$zip = $_POST['post_zip'];
			$state = $_POST['post_state'];
			$city = $_POST['post_city'];
			$route = $_POST['post_route'];
			$stmt->execute();
			$stmt = $dbh->prepare("UPDATE Property_Features SET Stories=:stories, Bed=:bed, Bath=:bath, Garage=:garage 
									WHERE Property_ID=:property_id");
			$stmt->bindParam(':property_id', $prop_ID);
			$stmt->bindParam(':stories', $stories);
			$stmt->bindParam(':bed', $bed);
			$stmt->bindParam(':bath', $bath);
			$stmt->bindParam(':garage', $garage);
			$stories = $_POST['post_stories'];
			$bed = $_POST['post_bed'];
			$bath = $_POST['post_bath'];
			$garage = $_POST['post_garage'];
			$stmt->execute();
			$stmt = $dbh->prepare("UPDATE Property_Size SET Land=:land, Floor=:floor 
									WHERE Property_ID=:property_id");
			$stmt->bindParam(':property_id', $prop_ID);
			$stmt->bindParam(':land', $land);
			$stmt->bindParam(':floor', $floor);
			$land = $_POST['post_land'];
			$floor = $_POST['post_floor'];
			$stmt->execute();
			echo "Edited Post Saved!";
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			// Upload
			echo "<script> location.href = 'index.php?source=editproperty-success&prop_Id=".$prop_ID."' </script>";
		}
		catch(PDOException $e){
			if($e->getCode() === '23000')
			{
				echo "Email already taken.";
			}
			else
			{
			echo "Error: " . $e->getMessage();
			}
		}
	}
}


function property_list() {
	$type="";
	$country="";
	$zip="";
	$state="";
	$city="";
	$route="";
	$minprice="";
	$maxprice="";
	$size="";
	$bed="";
	$date="";


	if(isset($_GET['type'])){
		$type = $_GET['type'];
	}
	else {
		$type="";
	}
	if(isset($_GET['country'])){
		$country = $_GET['country'];
	}
	else {
		$country="";
	}
	if(isset($_GET['zip'])){
		$zip = $_GET['zip'];
	}
	else {
		$zip="";
	}
	if(isset($_GET['state'])){
		$state = $_GET['state'];
	}
	else {
		$state="";
	}
	if(isset($_GET['city'])){
		$city = $_GET['city'];
	}
	else {
		$city="";
	}
	if(isset($_GET['route'])){
		$route = $_GET['route'];
	}
	else {
		$route="";
	}
	if(isset($_GET['minprice'])){
		$minprice = $_GET['minprice'];
	}
	else {
		$minprice="";
	}
	if(isset($_GET['maxprice'])){
		$maxprice = $_GET['maxprice'];
	}
	else {
		$maxprice="";
	}
	if(isset($_GET['size'])){
		$size = $_GET['size'];
	}
	else {
		$size="";
	}
	if(isset($_GET['bed'])){
		$bed = $_GET['bed'];
	}
	else {
		$bed="";
	}
	if(isset($_GET['filter']))
	{
		$filter=$_GET['filter'];
		
	}
	else
	{
		$filter="";
	}
	
	
	
	
	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if($type=="forsale"){
		try{
			//Select User With Same Email && Pass
			$query="SELECT * FROM Property_List WHERE TYPE='a' ";
			if(!$country==''){
				$query .= " AND Country='".$country."'";
			}
			if(!$state==''){
				$query .= ' AND State="'.$state.'"';
			}
			if(!$city==''){
				$query .= ' AND City="'.$city.'"';
			}
			if(!$route==''){
				$query .= ' AND StreetAddress="'.$route.'"';
			}
			if(!$minprice=='' && !$maxprice==''){
				$query .= ' AND Price BETWEEN '.$minprice.' AND '.$maxprice;
			}
			else {
				if(!$minprice==''){
					$query .= ' AND Price>='.$minprice;
				}
				if(!$maxprice==''){
					$query .= ' AND Price<='.$maxprice;
				}
			}
			if(!$size==''){
				if($size=="a"){
					$query .=' AND Floor<=30';
				}
				else if($size=="b"){
					$query .=' AND Floor BETWEEN 31 AND 60';
				}
				else if($size=="c"){
					$query .=' AND Floor BETWEEN 61 AND 100';
				}
				else if($size=="d"){
					$query .=' AND Floor>=101';
				}
			}
			if(!$bed==''){
				if($bed=='4'){
					$query .=' AND BED>=4';
				}
				else{
					$query .=' AND BED='.$bed;
				}
			}
			if(!$filter=='')
			{
					if($filter=='cheapest' || $filter=='expensive')
					{
						if($filter=='cheapest')
						{
							$query .= " ORDER BY `Price` ASC";
						}
						else
						{
							$query .= " ORDER BY `Price` DESC";
						}
					}
					else
					{
						if($filter=='asc')
						{
							$query .= " ORDER BY `Property_ID` ASC";
						}
						else
						{
							$query .= " ORDER BY `Property_ID` ASC";
						}
					}
		    }
			
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				echo'
				<div class="sblogBox smoreBox" style="display: none;">
				<div class="col-sm-6 col-md-3 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .substr(htmlentities($row['Title']),0,50) . '</a></h5>
                                </div>
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <br/>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>
                                    
                                    <p style="display: none;">'. substr($desc,0,50) .'...</p>
                                <div class="property-icon">
                                <img src="assets/img/icon/bed.png">(' . htmlentities($row['Bed']) . ')|
                                <img src="assets/img/icon/shawer.png">(' . htmlentities($row['Bath']) . ')|
                                <img src="assets/img/icon/cars.png">(' . htmlentities($row['Garage']) . ')
												
                            </div>
                        </div> 
                    </div>
                </div>
				</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo $query;
			echo "Error: " . $e->getMessage();
		}
	}
	else if($type=="forrent"){
		try{
			//Select User With Same Email && Pass
			$query="SELECT * FROM Property_List WHERE TYPE='b' ";
			if(!$country==''){
				$query .= " AND Country='".$country."'";
			}
			if(!$state==''){
				$query .= ' AND State="'.$state.'"';
			}
			if(!$city==''){
				$query .= ' AND City="'.$city.'"';
			}
			if(!$route==''){
				$query .= ' AND StreetAddress="'.$route.'"';
			}
			if(!$minprice=='' && !$maxprice==''){
				$query .= ' AND Price BETWEEN '.$minprice.' AND '.$maxprice;
			}
			else {
				if(!$minprice==''){
					$query .= ' AND Price>='.$minprice;
				}
				if(!$maxprice==''){
					$query .= ' AND Price<='.$maxprice;
				}
			}
			if(!$size==''){
				if($size=="a"){
					$query .=' AND Floor<=30';
				}
				else if($size=="b"){
					$query .=' AND Floor BETWEEN 31 AND 60';
				}
				else if($size=="c"){
					$query .=' AND Floor BETWEEN 61 AND 100';
				}
				else if($size=="d"){
					$query .=' AND Floor>=101';
				}
			}
			if(!$bed==''){
				if($bed=='4'){
					$query .=' AND BED>=4';
				}
				else{
					$query .=' AND BED='.$bed;
				}
			}
			$query .= " ORDER BY `Property_ID` DESC  ";
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				echo'
				<div class="sblogBox smoreBox" style="display: none;">
				<div class="col-sm-6 col-md-3 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .substr(htmlentities($row['Title']),0,50) . '</a></h5>
                                </div>
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <br/>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>
                                    
                                    <p style="display: none;">'. substr($desc,0,50) .'...</p>
                                <div class="property-icon">
                                <img src="assets/img/icon/bed.png">(' . htmlentities($row['Bed']) . ')|
                                <img src="assets/img/icon/shawer.png">(' . htmlentities($row['Bath']) . ')|
                                <img src="assets/img/icon/cars.png">(' . htmlentities($row['Garage']) . ')
												
                            </div>
                        </div> 
                    </div>
                </div>
				</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	else if($type=="new"){
		try{
			//Select User With Same Email && Pass
			$query="SELECT * FROM Property_List WHERE TYPE='c' ";
			if(!$country==''){
				$query .= " AND Country='".$country."'";
			}
			if(!$state==''){
				$query .= ' AND State="'.$state.'"';
			}
			if(!$city==''){
				$query .= ' AND City="'.$city.'"';
			}
			if(!$route==''){
				$query .= ' AND StreetAddress="'.$route.'"';
			}
			if(!$minprice=='' && !$maxprice==''){
				$query .= ' AND Price BETWEEN '.$minprice.' AND '.$maxprice;
			}
			else {
				if(!$minprice==''){
					$query .= ' AND Price>='.$minprice;
				}
				if(!$maxprice==''){
					$query .= ' AND Price<='.$maxprice;
				}
			}
			if(!$size==''){
				if($size=="a"){
					$query .=' AND Floor<=30';
				}
				else if($size=="b"){
					$query .=' AND Floor BETWEEN 31 AND 60';
				}
				else if($size=="c"){
					$query .=' AND Floor BETWEEN 61 AND 100';
				}
				else if($size=="d"){
					$query .=' AND Floor>=101';
				}
			}
			if(!$bed==''){
				if($bed=='4'){
					$query .=' AND BED>=4';
				}
				else{
					$query .=' AND BED='.$bed;
				}
			}
			$query .= " ORDER BY `Property_ID` DESC  ";
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				
				echo'
				<div class="sblogBox smoreBox" style="display: none;">
				<div class="col-sm-6 col-md-4 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .substr(htmlentities($row['Title']),0,50) . '</a></h5>
                                </div>
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <br/>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>
                                    
                                    <p style="display: none;">'. substr($desc,0,50) .'...</p>
                                <div class="property-icon">
                                <img src="assets/img/icon/bed.png">(' . htmlentities($row['Bed']) . ')|
                                <img src="assets/img/icon/shawer.png">(' . htmlentities($row['Bath']) . ')|
                                <img src="assets/img/icon/cars.png">(' . htmlentities($row['Garage']) . ')
												
                            </div>
                        </div> 
                    </div>
                </div>
				</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	else if($type=="commercialland"){
		try{
			//Select User With Same Email && Pass
			$query="SELECT * FROM Property_List WHERE TYPE='d' ";
			if(!$country==''){
				$query .= " AND Country='".$country."'";
			}
			if(!$state==''){
				$query .= ' AND State="'.$state.'"';
			}
			if(!$city==''){
				$query .= ' AND City="'.$city.'"';
			}
			if(!$route==''){
				$query .= ' AND StreetAddress="'.$route.'"';
			}
			if(!$minprice=='' && !$maxprice==''){
				$query .= ' AND Price BETWEEN '.$minprice.' AND '.$maxprice;
			}
			else {
				if(!$minprice==''){
					$query .= ' AND Price>='.$minprice;
				}
				if(!$maxprice==''){
					$query .= ' AND Price<='.$maxprice;
				}
			}
			if(!$size==''){
				if($size=="a"){
					$query .=' AND Floor<=30';
				}
				else if($size=="b"){
					$query .=' AND Floor BETWEEN 31 AND 60';
				}
				else if($size=="c"){
					$query .=' AND Floor BETWEEN 61 AND 100';
				}
				else if($size=="d"){
					$query .=' AND Floor>=101';
				}
			}
			$query .= " ORDER BY `Property_ID` DESC  ";
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				echo'
				<div class="sblogBox smoreBox" style="display: none;">
				<div class="col-sm-6 col-md-4 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .substr(htmlentities($row['Title']),0,50) . '</a></h5>
                                </div>
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <br/>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>
                                    
                                    <p style="display: none;">'. substr($desc,0,50) .'...</p>
                                <div class="property-icon">
                                <img src="assets/img/icon/bed.png">(' . htmlentities($row['Bed']) . ')|
                                <img src="assets/img/icon/shawer.png">(' . htmlentities($row['Bath']) . ')|
                                <img src="assets/img/icon/cars.png">(' . htmlentities($row['Garage']) . ')
												
                            </div>
                        </div> 
                    </div>
                </div>
				</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	else {
		
		try{
			$query="SELECT * FROM Property_List";
			if(!$country==''){
				$query .= " WHERE Country='".$country."'";
			}
			if(!$state==''){
				$query .= ' AND State="'.$state.'"';
			}
			if(!$city==''){
				$query .= ' AND City="'.$city.'"';
			}
			if(!$route==''){
				$query .= ' AND StreetAddress="'.$route.'"';
			}
			$query .= " ORDER BY `Property_ID` DESC";
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				echo'
				<div class="sblogBox smoreBox" style="display: none;">
				<div class="col-sm-6 col-md-4 p0">
                    <div class="box-two proerty-item">
                        <div class="item-thumb">
                            <a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .substr(htmlentities($row['Title']),0,50) . '</a></h5>
                                </div>
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <br/>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>
                                    
                                    <p style="display: none;">'. substr($desc,0,50) .'...</p>
                                <div class="property-icon">
                                <img src="assets/img/icon/bed.png">(' . htmlentities($row['Bed']) . ')|
                                <img src="assets/img/icon/shawer.png">(' . htmlentities($row['Bath']) . ')|
                                <img src="assets/img/icon/cars.png">(' . htmlentities($row['Garage']) . ')
												
                            </div>
                        </div> 
                    </div>
                </div>
				</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
		
	}
	
}

function edit_property_data($selector){

	$Id='';
	$Status='';
	if(isset($_GET['propId'])){
		$Id = $_GET['propId'];
	}
	else {
		$Id='';
		// Go to error page
	}
	$uID='';
	if(isset($_SESSION['ID'])){
		$uID = $_SESSION['ID'];
	}
	else {
		$uID='';
	}
	
	global $servername;
	global $username;
	global $password;
	
	try{
	
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if(!$Id==''){
		try{
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("SELECT * FROM Property_Page WHERE Property_ID= :idd");
			$stmt->bindParam(':idd', $Id);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			foreach($results as $row) {
				
				if($selector=='Type1'){
					if(htmlentities($row['Type'])=='a'){
						echo 'selected';
					}
				}
				else if($selector=='Type2'){
					if(htmlentities($row['Type'])=='b'){
						echo 'selected';
					}
				}
				else {
					echo htmlentities($row[$selector]);
				}
			}
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	else {
		header('Location: index.php');
		exit;

	}
}

function property_page(){
	$Id='';
	$Status='';
	if(isset($_GET['propId'])){
		$Id = $_GET['propId'];
	}
	else {
		$Id='';
		// Go to error page
	}
	$uID='';
	if(isset($_SESSION['ID'])){
		$uID = $_SESSION['ID'];
	}
	else {
		$uID='';
	}
	
	global $servername;
	global $username;
	global $password;
	
	$i = '';
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	if(!$Id==''){
		try{
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("SELECT * FROM Property_Page WHERE Property_ID= :idd");
			$stmt->bindParam(':idd', $Id);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$m = "'map'";
			$user_type='';
			$user_contact='';
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			$link1 ='index.php?source=profile-view&User_ID=';
			$directory = 'includes/images/prop/'.$Id.'/';
				$filecount = 0;
				$files = glob($directory . "*");
				if ($files){
					$filecount = count($files);
				}
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				if(htmlentities($row['Type'])=='a'){
					$Status='For Sale';
				}
				else if (htmlentities($row['Type'])=='b'){
					$Status='For Rent';
				}
				else if (htmlentities($row['Type'])=='c'){
					$Status='New';
				}
				else if (htmlentities($row['Type'])=='d'){
					$Status='Commercial and Land';
				}
				if(htmlentities($row['User_ID'])==$uID){
					$link1='index.php?source=profile&User_ID=';
				}
				if(htmlentities($row['User_Type'])=='a'){
					$user_type='Real Estate Agent';
				}
				else if(htmlentities($row['User_Type'])=='b'){
					$user_type='Property Owner';
				}
				if(htmlentities($row['Hide'])==1){
					$user_contact='';
				}
				else{
					$user_contact='<li><i class="pe-7s-call strong"> </i> '.htmlentities($row['Mobile']).'</li>';
				}
				$profpic=htmlentities($row['User_ID']);
				$path='images/prop/'.htmlentities($row['User_ID']);
					if (!is_dir($path)) {
						$profpic='default';
					}
				
				
				
					
				echo '
				<div class="page-head"> 
            <div class="container">
                <div class="row">
                    <div class="page-head-content">
                        <h1 class="page-title">'.htmlentities($row['Title']).'</h1>               
                    </div>
                </div>
            </div>
        </div>
        <!-- End page header -->

        <!-- property area -->
        <div class="content-area single-property" style="background-color: #FCFCFC;">&nbsp;
            <div class="container">
				<div class="clearfix padding-top-40" >

                    <div class="col-md-8 single-property-content prp-style-1 ">
                     <div class="row">
                            <div class="light-slide-item">            
                                <div class="clearfix">
                                    <div class="favorite-and-print">
                                        <a class="add-to-fav" href="#login-modal" data-toggle="modal">
                                            <i class="fa fa-star-o"></i>
                                        </a>
                                        <a class="printer-icon " href="includes/print/profile.php?propId='.$Id.'">
                                            <i class="fa fa-print"></i> 
                                        </a>
                                    </div> 
                                    <ul id="image-gallery" class="gallery list-unstyled cS-hidden">';
                                        
										for($j=1;$j<$filecount+1;$j++){
											echo '<li data-thumb="./includes/images/prop/'.$Id.'/'.$j.'.jpg"> 
												<img src="includes/images/prop/'.$Id.'/'.$j.'.jpg" />
											</li>';
										}										
						echo			'</ul>
                                </div>
                            </div>
                        </div>
                        <div class="single-property-wrapper">
                            <div class="single-property-header">                                          
                                <h1 class="property-title pull-left">' . htmlentities($row['Title']) . '</h1>
                                <span class="property-price pull-right">&#8369 ' . htmlentities($row['Price']) . '</span>
                            </div>

                            <div class="property-meta entry-meta clearfix ">   

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-tag">                                        
                                        <img src="assets/img/icon/sale-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Status</span>
                                        <span class="property-info-value">' . $Status . '</span>
                                    </span>
                                </div>

                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bath">
                                        <img src="assets/img/icon/os-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Land</span>
                                        <span class="property-info-value">'.htmlentities($row['Land']).'<b class="property-info-unit">Sqm</b></span>
                                    </span>
                                </div>
								<div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info icon-area">
                                        <img src="assets/img/icon/room-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Floor</span>
                                        <span class="property-info-value">'.htmlentities($row['Floor']).'<b class="property-info-unit">Sqm</b></span>
                                    </span>
                                </div>


                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bed">
                                        <img src="assets/img/icon/bed-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Bedrooms</span>
                                        <span class="property-info-value">'.htmlentities($row['Bed']).'</span>
                                    </span>
                                </div>
                                
                                <div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-garage">
                                        <img src="assets/img/icon/shawer-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Bathroom</span>
                                        <span class="property-info-value">'.htmlentities($row['Bath']).'</span>
                                    </span>
                                </div>
								
								<div class="col-xs-6 col-sm-3 col-md-3 p-b-15">
                                    <span class="property-info-icon icon-bed">
                                        <img src="assets/img/icon/cars-orange.png">
                                    </span>
                                    <span class="property-info-entry">
                                        <span class="property-info-label">Garage</span>
                                        <span class="property-info-value">'.htmlentities($row['Garage']).'</span>
                                    </span>
                                </div>


                            </div>
                            <!-- .property-meta -->

                            <div class="section">
                                <h4 class="s-property-title">Description</h4>
                                <div class="s-property-content">
                                    <p>'.nl2br(htmlentities($row['Description'], ENT_QUOTES, 'UTF-8')).'</p>
                                </div>
                            </div>
							
			   <div class="section property-video" id="map2"> 
                                <h4 class="s-property-title">Property Map</h4> 
                                				<div class="video-thumb" id="map"></div>
								<script>
									function initMap() {
										var myLatLng1 = {lat: ' . htmlentities($row['Latitude']) . ', lng: ' . htmlentities($row['Longitude']) . '};
										var myLatLng = new google.maps.LatLng('. htmlentities($row['Latitude']) .',' . htmlentities($row['Longitude']) . ');

										// Create a map object and specify the DOM element for display.
										var map = new google.maps.Map(document.getElementById("'.$i.'map'.$i.'"), {
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
                            </div>
							
							<!-- Start share area -->
                            <div class="section property-share"> 
                                <h4 class="s-property-title">Share width your friends </h4> 
                                <div class="roperty-social">
                                    <ul> 
                                        <li><a title="Share this on dribbble " href="#"><img src="assets/img/social_big/dribbble_grey.png"></a></li>                                         
                                        <li><a title="Share this on facebok " href="#"><img src="assets/img/social_big/facebook_grey.png"></a></li> 
                                        <li><a title="Share this on delicious " href="#"><img src="assets/img/social_big/delicious_grey.png"></a></li> 
                                        <li><a title="Share this on tumblr " href="#"><img src="assets/img/social_big/tumblr_grey.png"></a></li> 
                                        <li><a title="Share this on digg " href="#"><img src="assets/img/social_big/digg_grey.png"></a></li> 
                                        <li><a title="Share this on twitter " href="#"><img src="assets/img/social_big/twitter_grey.png"></a></li> 
                                        <li><a title="Share this on linkedin " href="#"><img src="assets/img/social_big/linkedin_grey.png"></a></li>                                        
                                    </ul>
                                </div>
                            </div>
                            <!-- End share area  -->
                            
                        </div>
                    </div>


                    <div class="col-md-4 p0">
                        <aside class="sidebar sidebar-property blog-asside-right">
                            <div class="dealer-widget">
                                <div class="dealer-content">
                                    <div class="inner-wrapper">

                                        <div class="clear">
                                            <div class="col-xs-4 col-sm-4 dealer-face">
                                                <a href="'.$link1.htmlentities($row['User_ID']).'">
                                                    <img src="includes/images/user/'.$profpic.'/1.jpg" class="img-circle">
                                                </a>
                                            </div>
                                            <div class="col-xs-8 col-sm-8 ">
                                                <h3 class="dealer-name">
                                                    <a href="'.$link1.htmlentities($row['User_ID']).'">'.htmlentities($row['First_Name']) . ' ' . htmlentities($row['Last_Name']).'</a><br/>
                                                    <span>'.$user_type.'</span>        
                                                </h3>
                                                <div class="dealer-social-media">
                                                    <a class="twitter" target="_blank" href="">
                                                        <i class="fa fa-twitter"></i>
                                                    </a>
                                                    <a class="facebook" target="_blank" href="">
                                                        <i class="fa fa-facebook"></i>
                                                    </a>
                                                    <a class="gplus" target="_blank" href="">
                                                        <i class="fa fa-google-plus"></i>
                                                    </a>
                                                    <a class="linkedin" target="_blank" href="">
                                                        <i class="fa fa-linkedin"></i>
                                                    </a> 
                                                    <a class="instagram" target="_blank" href="">
                                                        <i class="fa fa-instagram"></i>
                                                    </a>       
                                                </div>

                                            </div>
                                        </div>

                                        <div class="clear">
											
                                            <ul class="dealer-contacts">                                       
                                                <!--<li><i class="pe-7s-map-marker strong"> </i> 9089 your adress her</li>-->
                                                <li><i class="pe-7s-mail strong"> </i> '.htmlentities($row['Email']).'</li>
                                                '.$user_contact.'
                                            </ul>
											<br/>
											
                                            <p>'.nl2br(htmlentities($row['Bio'])).'</p>
                                        </div>

                                    </div>
                                </div>
                            </div>';
				
				
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
	else {
		header('Location: includes/inactive-removed.php');
		exit;

	}
	
	
}

function home(){

	global $servername;
	global $username;
	global $password;
	
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
			$query="SELECT * FROM Property_List LIMIT 7";
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			foreach($results as $row) {
				
				$desc = htmlentities($row['Description']);
				
				
				echo'<div class="col-sm-6 col-md-3 p0">
						<div class="box-two proerty-item">
							<div class="item-thumb">
                            	<a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" ><img src="includes/images/prop/'.htmlentities($row['Property_ID']).'/1.jpg"></a>
                            </div>

                                <div class="item-entry overflow">
                                    <h5><a href="index.php?source=property-page&propId=' . htmlentities($row['Property_ID']) . '" >' .htmlentities($row['Title']) . '</a></h5>

                                </div> 
                                    <div class="dot-hr"></div>
                                <div class="item-entry">
                                    <span class="pull-left"><b> Land :</b>' . htmlentities($row['Land']) . 'sqm </span>
									<br/>
									<span class="pull-left"><b> Floor :</b> ' . htmlentities($row['Floor']) . 'sqm </span>
                                    <span class="proerty-price pull-right"> &#8369 ' . htmlentities($row['Price']) . '</span>
									<span class="pull-left"><b> ' . htmlentities($row['StreetAddress']) .', ' . htmlentities($row['City']) . ', ' . htmlentities($row['State']) . ', ' . htmlentities($row['Country']) . '</b> </span>    
								</div> 
						</div>
					</div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

}

function profile(){
	
	global $servername;
	global $username;
	global $password;
	
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
			$ID = $_GET['User_ID'];

			$query="SELECT * FROM User_Profile where User_ID =:User_ID ";
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':User_ID', $ID);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=profile';
			foreach($results as $row) {
				$profpic=htmlentities($row['User_ID']);
				$path='images/user/'.htmlentities($row['User_ID']);
				if (!is_dir($path)) {
					$profpic='default';
				}
				
				
				
				
				echo'
				
				<div class="panel panel-default">
					<img src="includes/images/user/'.$profpic.'/1.jpg" width="100px" height="100px" class="img-circle">
				</div>
				
				<ul class="list-group">
					<li class="list-group-item text-muted">Profile</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>First Name</strong></span> ' . htmlentities($row['First_Name']) . '</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Last Name</strong></span> ' . htmlentities($row['Last_Name']) . '</li>
				</ul>
				<ul class="list-group">
					<li class="list-group-item text-muted">Contact</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Email</strong></span> ' . htmlentities($row['Email']) . '</li>
					<li class="list-group-item text-right"><span class="pull-left"><strong>Mobile</strong></span> ' . htmlentities($row['Mobile']) . '</li>
				</ul>
				
				<ul class="list-group">
					<li class="list-group-item text-muted">Bio</li>
					<li class="list-group-item text-left"><p>'.nl2br(htmlentities($row['Bio'], ENT_QUOTES, 'UTF-8')).'<p></li>
				</ul>
				
				
				';
				$prof_fname=htmlentities($row['First_Name']);
				$prof_lname=htmlentities($row['Last_Name']);
				$prof_email=htmlentities($row['Email']);
				$prof_mobile=htmlentities($row['Mobile']);
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

}

function profile_settings($selector){
	
	global $servername;
	global $username;
	global $password;
	
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
			$ID = $_GET['User_ID'];

			$query="SELECT * FROM User_Profile where User_ID=:User_ID ";
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':User_ID', $ID);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=profile';
			foreach($results as $row) {
				
				
				
				
				if($selector=='fname'){
					echo htmlentities($row['First_Name']);
				}
				else if($selector=='lname'){
					echo htmlentities($row['Last_Name']);
				}
				else if($selector=='email'){
					echo htmlentities($row['Email']);
				}
				else if($selector=='mobile'){
					echo htmlentities($row['Mobile']);
				}
				else if($selector=='bio'){
					echo htmlentities($row['Bio'], ENT_QUOTES, 'UTF-8');
				}
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

}

function save_info(){
	
	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	if(isset($_POST['save_info'])){
		try{
			$ID = $_GET['User_ID'];

			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("UPDATE User SET Email=:email, First_Name=:fname, Last_Name=:lname, Bio=:bio, Hide=:hide WHERE User_ID=:User_ID");
			$stmt->bindParam(':User_ID', $ID);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':fname', $fname);
			$stmt->bindParam(':lname', $lname);
			$stmt->bindParam(':bio', $bio);
			$stmt->bindParam(':hide', $hide);
			$email = $_POST['email'];
			$fname = $_POST['first_name'];
			$lname = $_POST['last_name'];
			$bio = htmlentities($_POST['bio'], ENT_QUOTES, 'UTF-8');
			$hide = $_POST['hide'];
			$stmt->execute();
			$stmt = $dbh->prepare("UPDATE User_Contact SET Email=:email, Mobile=:mobile WHERE User_ID=:User_ID");
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':mobile', $mobile);
			$mobile = $_POST['mobile'];
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=profile';
			// Fetch data from query
			echo "<script> location.href = 'index.php?source=save-info-success'; </script>";
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}
	}
}


function propertylist(){
	
	global $servername;
	global $username;
	global $password;
	
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
			$ID = $_GET['User_ID'];

			$query="SELECT * FROM Property_Page where User_ID =:User_ID ";
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':User_ID', $ID);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			
			$i1 = "'";
			foreach($results as $row) {
				if($row['Status']=='Active'){
					$status='Available';
				}
				else{
					$status = $row['Status'];
				}
				
				
				echo'<tr href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'"><a href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'">
                      <td><a href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'">' . htmlentities($row['Title']) . '</a></td>
                      <td>P' . htmlentities($row['Price']) . '</td>
                      <td>'.$status.'</td>
                      <td>' . htmlentities($row['Country']) . '</td>
                    <td><form action="index.php" method="get"><input type="hidden" name="source" value="editproperty"><input type="hidden" name="propId" value="'.htmlentities($row['Property_ID']).'"><button type="submit" class="btn btn-primary">Edit</button></form></td>
                    </a></tr> ';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

}



function propertylistview(){
	
	global $servername;
	global $username;
	global $password;
	
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
			$ID = $_GET['User_ID'];

			$query="SELECT * FROM Property_Page where User_ID =:User_ID ";
			
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare($query);
			$stmt->bindParam(':User_ID', $ID);
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=profile';
			foreach($results as $row) {
				if($row['Status']=='Active'){
					$status='Available';
				}
				else{
					$status = $row['Status'];
				}
				
				
				
				echo'<tr href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'"><a href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'">
                      <td><a href="index.php?source=property-page&propId='.htmlentities($row['Property_ID']).'">' . htmlentities($row['Title']) . '</a></td>
                      <td>P' . htmlentities($row['Price']) . '</td>
                      <td>'.$status.'</td>
                      <td>' . htmlentities($row['Country']) . '</td>
                    
                    </a></tr> ';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
		}

}










function prop_list(){

	global $servername;
	global $username;
	global $password;
	
	$i = "'";
	$userID = $_GET['uId'];
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	try
	{
			
			//Select User With Same Email && Pass
			
			$stmt = $dbh->prepare("SELECT * FROM Property_Page WHERE User_ID= :uid");
			$stmt->bindParam(':uid',$userID);
			$stmt->execute();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page&propId=';
			$status='';
			$j=1;
			foreach($results as $row) {
				if($row['Status']=='Active'){
					$status='Available';
				}
				else{
					$status = $row['Status'];
				}
				
				
				
				echo'<tr>
                      <td>'.$j.'</td>
                      <td><a href="'.$link.htmlentities($row['Property_ID']).'">'.htmlentities($row['Title']).'</a></td>
                      <td>P'.htmlentities($row['Price']).'</td>
                      <td>'.$status.'</td>
                      <td>'.htmlentities($row['City']).'</td>
                    
                    </tr>';
				$j++;
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
	}
	catch(PDOException $e)
	{
			echo "Error: " . $e->getMessage();
	}

}

function send_new_message(){

	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['new_message'])) 
			{				
				try{
					//Insert User Details
					$stmt = $dbh->prepare("INSERT INTO conversation (User1, User2, Subject, Status1, Status2) 
											VALUES (:user1, :user2, :subject , :user1, :user2)");
					$stmt->bindParam(':user1', $user1);
					$stmt->bindParam(':user2', $user2);
					$stmt->bindParam(':subject', $subject);
					$user1=$_SESSION['ID'];
					$user2=$_GET['User_ID'];
					$subject=$_POST['subject'];
					$stmt->execute();
					//Check last ID
					$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() FROM conversation");
					$stmt->execute();
					$result = $stmt->fetchColumn();
					//Insert Contact Details
					$stmt = $dbh->prepare("INSERT INTO private_message (Conversation_ID, Message, TimeStamp, Sender, ReadNew, Status_1, Status_2) 
											VALUES (:conversation_id, :message, NOW(), :sender, 1, :user1, :user2)");
					$stmt->bindParam(':conversation_id', $result);
					$stmt->bindParam(':message', $message);
					$stmt->bindParam(':sender', $sender);
					$stmt->bindParam(':user1', $user1);
					$stmt->bindParam(':user2', $user2);
					$message=htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8');
					$sender=$_SESSION['ID'];
					$stmt->execute();
					echo "Message Sent!";
					//echo "<script> location.href = 'index.php' </script>";
					//echo "Error Code: " . $stmt->errorCode();
					echo "<script> location.href = 'index.php?source=message-success'; </script>";
				}
				catch(PDOException $e){
					
					echo "Error: " . $e->getMessage();

				}
			}

}

function inbox_list(){
	
	global $servername;
	global $username;
	global $password;
	
	$status='';
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	//global $dbh
				
		try{
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("SELECT * FROM convo_list WHERE (User1=:user_id OR User2=:user_id1) AND (Status_1=:user_id OR Status_2=:user_id) AND NOT Sender=:user_id2 ORDER BY PrivateMessage_ID DESC");
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':user_id1', $user_id1);
			$stmt->bindParam(':user_id2', $user_id2);
			$user_id=$_SESSION['ID'];
			$user_id1=$_SESSION['ID'];
			$user_id2=$_SESSION['ID'];
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			if($count==0){
				echo 'You have no messages.';
			}
			foreach($results as $row) {
				echo '<div class="blogBox moreBox" style="display: none;">
                <li class="list-group-item-mes text-right"><a style="color:black" href="#" class="pull-left">'.substr(htmlentities($row['Message']),0,30).'..</a> '.htmlentities($row['TimeStamp']).' <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal_'.htmlentities($row['PrivateMessage_ID']).'">view</button></li>
				<!-- Modal -->
				<div id="myModal_'.htmlentities($row['PrivateMessage_ID']).'" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button"  class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
							<!-- -->
								<div class="input-group"> 
									<h3>'.htmlentities($row['Subject']).'</h3>';
			if($_SESSION['ID']==htmlentities($row['User1'])){
				$status = '1';
			}
			else {
				$status = '2';
			}
			$stmt = $dbh->prepare("SELECT * FROM User WHERE User_ID=:sender");
			$stmt->bindParam(':sender',$sender_id);
			$sender_id=htmlentities($row['Sender']);
			$stmt->execute();
			$results1 = $stmt->fetchAll();
			$sender_email='';
			foreach($results1 as $row1){
				$sender_email=$row1['Email'];
			}
	echo	'<h4>Email: '.$sender_email.'</h4>
									<h5>'.nl2br(htmlentities($row['Message'], ENT_QUOTES, 'UTF-8')).'</h5>
									<h6>'.htmlentities($row['TimeStamp']).'</h6>
								</div>
								<form action="" onsubmit="deleteMessage();" method="post">
									<input type="hidden" name="convo_id" value="'.htmlentities($row['Conversation_ID']).'">
									<input type="hidden" name="pmid" value="'.htmlentities($row['PrivateMessage_ID']).'">
									<input type="hidden" name="sender_id" value="'.htmlentities($row['Sender']).'">
									<input type="hidden" name="status" value="'.$status.'">
									<div class="input-group">
										<button type="submit" name="reply_delete" class="btn btn-default">Delete</button>
									</div>
								</form>
								<br>
								
								<form action="" method="post">
									<input type="hidden" name="convo_id" value="'.htmlentities($row['Conversation_ID']).'">
									<input type="hidden" name="pmid" value="'.htmlentities($row['PrivateMessage_ID']).'">
									<input type="hidden" name="sender_id" value="'.htmlentities($row['Sender']).'">
									<input type="hidden" name="status" value="'.$status.'">
									<div class="input-group">
										<textarea class="form-control" rows="9" name="rep_message" id="comment" placeholder="Reply a message..."></textarea>
										<span class="input-group-addon" id="basic-addon2"></span>
									</div>
									<br>
									<div class="input-group">
										<button type="submit" name="reply_message1" class="btn btn-default">Reply</button>
									</div>
									
								</form>
								<br>
								<br>
							</div>
						</div>
					</div>
				</div>
                <h6></h6>
            </div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			echo $e;
		}
	
	
}

function delete_message(){

	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['reply_delete'])) {				
		try{
			$query="UPDATE private_message ";
			if($_POST['status']=='1'){
				$query .="SET Status_1=0";
			}
			else {
				$query .="SET Status_2=0";
			}
			$query .= " WHERE PrivateMessage_ID=".$_POST['pmid'];
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			//echo "<script> location.href = 'index.php?source=message-success'; </script>";
			echo "<script> location.href = 'index.php?source=profile&User_ID=".$_SESSION['ID']."'; </script>";
		}
		catch(PDOException $e){		
			echo "Error: " . $e->getMessage();
		}
	}

}

function reply_message(){

	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['reply_message1'])) 
			{				
				try{
					$stmt = $dbh->prepare("INSERT INTO private_message (Conversation_ID, Message, TimeStamp, Sender, ReadNew, Status_1, Status_2) 
											VALUES (:conversation_id, :message, NOW(), :sender, 1, :user1, :user2)");
					$stmt->bindParam(':conversation_id', $convo_id);
					$stmt->bindParam(':message', $message);
					$stmt->bindParam(':sender', $sender);
					$stmt->bindParam(':user1', $user1);
					$stmt->bindParam(':user2', $user2);
					$convo_id=$_POST['convo_id'];
					$message=htmlentities($_POST['rep_message'], ENT_QUOTES, 'UTF-8');
					$sender=$_SESSION['ID'];
					if($_POST['status']=='1'){
						$user1=$_SESSION['ID'];
						$user2=$_POST['sender_id'];
					}
					else {
						$user1=$_POST['sender_id'];
						$user2=$_SESSION['ID'];
					}
					$stmt->execute();
					echo "Message Sent!";
					//echo "<script> location.href = 'index.php' </script>";
					//echo "Error Code: " . $stmt->errorCode();
					echo "<script> location.href = 'index.php?source=message-success'; </script>";
				}
				catch(PDOException $e){
					
					echo "Error: " . $e->getMessage();

				}
			}

}

function contact_info(){
	
	global $servername;
	global $username;
	global $password;
	
	try{
			$dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
		catch(PDOException $ex){
			echo 'Connection failed: ' . $ex->getmessage();
		}
		$Id = $_GET['propId'];
			try{
				//Select User With Same Email && Pass
				$stmt = $dbh->prepare("SELECT * FROM Property_Page WHERE Property_ID= :idd");
				$stmt->bindParam(':idd', $Id);
				$stmt->execute();
				$count = (int)$stmt->rowCount();
				$results = $stmt->fetchAll();
				foreach($results as $row) {
					echo '<input type="hidden" name="cont_subj" value="'.htmlentities($row['Title']).'"><input type="hidden" name="cont_email" value="'.htmlentities($row['Email']).'">';
				}
				
			}
			catch(PDOException $e){
				echo $query;
				echo "Error: " . $e->getMessage();
			}
	
}

function sent_list(){

	global $servername;
	global $username;
	global $password;
	
	$indent='';
	$status='';
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	//global $dbh
				
		try{
			//Select User With Same Email && Pass
			$stmt = $dbh->prepare("SELECT * FROM convo_list WHERE (User1=:user_id OR User2=:user_id1) AND (Status_1=:user_id OR Status_2=:user_id) AND Sender=:user_id2 ORDER BY PrivateMessage_ID DESC");
			$stmt->bindParam(':user_id', $user_id);
			$stmt->bindParam(':user_id1', $user_id1);
			$stmt->bindParam(':user_id2', $user_id2);
			$user_id=$_SESSION['ID'];
			$user_id1=$_SESSION['ID'];
			$user_id2=$_SESSION['ID'];
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			$results = $stmt->fetchAll();
			$link = 'index.php?source=property-page';
			if($count==0){
				echo 'You have no messages.';
			}
			foreach($results as $row) {
				echo '
				<div class="sblogBox smoreBox" style="display: none;">
        <li class="list-group-item-mes text-right"><a style="color:black" href="#" class="pull-left">'.substr(htmlentities($row['Message']),0,30).'..</a> '.htmlentities($row['TimeStamp']).'
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#'.htmlentities($row['PrivateMessage_ID']).'_myModal">view</button>
		</li>
		<!-- Modal -->
		<div id="'.htmlentities($row['PrivateMessage_ID']).'_myModal" class="modal fade" role="dialog">
			<div class="modal-dialog">
			<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button"  class="close" data-dismiss="modal">&times;</button>
					</div>
					<div class="modal-body">
						<!-- -->
						<div class="input-group"> 
							<h3>'.htmlentities($row['Subject']).'</h3>';
							
							$stmt = $dbh->prepare("SELECT * FROM User WHERE User_ID=:sender");
							$stmt->bindParam(':sender',$sender_id);
							if($user_id==htmlentities($row['User1'])){
								$sender_id=htmlentities($row['User2']);
								$status='1';
							}else {
								$sender_id=htmlentities($row['User1']);
								$status='2';
							}
							$stmt->execute();
							$results1 = $stmt->fetchAll();
							$sender_email='';
							
							foreach($results1 as $row1){
								$sender_email=$row1['Email'];
							}
			echo '			<h4>Recipient: '.$sender_email.'</h4>
							<h5>'.nl2br(htmlentities($row['Message'], ENT_QUOTES, 'UTF-8')).'</h5>
							<h6>'.htmlentities($row['TimeStamp']).'</h6>
						</div>
						<br>
						<br>
						<form action="" onsubmit="deleteMessage();" method="post">
						<input type="hidden" name="pmid2" value="'.htmlentities($row['PrivateMessage_ID']).'">
						<input type="hidden" name="status" value="'.$status.'">
						<div class="input-group">
							<button type="submit" name="sent_delete"  class="btn btn-default">Delete</button>
						</div>
						</form>
						<br>
						<br>
					</div>      
				</div>
			</div>
		</div> 
        <h6></h6>   
    </div>';
				
			}
			// Fetch data from query
			
			//Start PHP Session
			//$_SESSION['ID'] = $result->
			//echo "Log In Successful!";
			//echo "<script> location.href = 'index.php' </script>";
		}
		catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			echo $e;
		}

}

function delete_sent(){

	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['sent_delete'])) {				
		try{
			$query="UPDATE private_message ";
			if($_POST['status']=='1'){
				$query .="SET Status_1=0";
			}
			else {
				$query .="SET Status_2=0";
			}
			$query .= " WHERE PrivateMessage_ID=".$_POST['pmid2'];
			$stmt = $dbh->prepare($query);
			$stmt->execute();
			
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			echo "<script> location.href = 'index.php?source=profile&User_ID=".$_SESSION['ID']."'; </script>";
		}
		catch(PDOException $e){		
			echo "Error: " . $e->getMessage();
		}
	}

}

function change_pass(){

	global $servername;
	global $username;
	global $password;
	
	try{
    $dbh = new pdo( "mysql:host=localhost;dbname=lazzypropertiesdb",
                    $username,
                    $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo 'Connection failed: ' . $ex->getmessage();
	}
	
	if (isset($_POST['change_pass'])) {				
		try{
			$stmt = $dbh->prepare("SELECT * FROM User WHERE User_ID=:user_id AND Password=:pass");
			$stmt->bindParam(':user_id',$user_id);
			$stmt->bindParam(':pass', $pass);
			$user_id = $_SESSION['ID'];
			$pass = $_POST['old_pass'];
			$stmt->execute();
			$count = (int)$stmt->rowCount();
			if($count==1){
				$stmt = $dbh->prepare("UPDATE User SET Password=:npass WHERE User_ID=:user_id");
				$stmt->bindParam(':user_id', $user_id);
				$stmt->bindParam(':npass', $npass);
				$npass = $_POST['ver_pass'];
				$stmt->execute();
				echo "<script> location.href = 'index.php?source=change-pass-success'; </script>";
			}
			else {
				echo "Incorrect password";
			}
			
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			
		}
		catch(PDOException $e){		
			echo "Error: " . $e->getMessage();
		}
	}
}

function contact_seller(){

	if(isset($_POST['contact_seller'])){
				$to = $_POST['cont_email'];
                $subject = "INQUIRY: " . $_POST['cont_subj'];
                $txt = "Name: " . $_POST['name'] . "\nEmail: " . $_POST['email'] . "\nMobile Number: " . $_POST['mobile'] . "\n\n\t" . $_POST['message'] ;
                $headers = "From: noreply@lazzyproperty.com";

                mail($to,$subject,$txt,$headers);
$success = mail($to,$subject,$txt,$headers);
if (!$success) {
    $errorMessage = error_get_last()['message'];
}
else{
			echo 'Message successfully sent3!';
}
	}

}








?>