<?php 
require "php/class.uploadImages.php";

function post(){
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
	
	if ($uploadImages->countImages() > 0) 
	{				
		try{
			//Insert User Details
			$stmt = $dbh->prepare("INSERT INTO property (Title, Type, Price, Description, User_ID) 
									VALUES (:title, :type, :price, :description, :user_id)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':user_id',$user_id);
			$title = $_POST['post_title'];
			$type = $_POST['post_type'];
			$price = $_POST['post_price'];
			$description = $_POST['post_description'];
			$user_id = $_SESSION['ID'];
			$stmt->execute();
			//Check last ID
			$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() FROM property");
			$stmt->execute();
			$result = $stmt->fetchColumn();
			//Insert Contact Details
			$stmt = $dbh->prepare("INSERT INTO property_location (Property_ID, Country, Zip, State, City, StreetAddress) 
									VALUES (:property_id, :country, :zip, :state, :city, :streetaddress)");
			$stmt->bindParam(':property_id', $result);
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
			$stmt = $dbh->prepare("INSERT INTO property_features (Property_ID, Stories, Bed, Bath, Garage) 
									VALUES (:property_id, :stories, :bed, :bath, :garage)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':stories', $stories);
			$stmt->bindParam(':bed', $bed);
			$stmt->bindParam(':bath', $bath);
			$stmt->bindParam(':garage', $garage);
			$stories = $_POST['post_stories'];
			$bed = $_POST['post_bed'];
			$bath = $_POST['post_bath'];
			$garage = $_POST['post_garage'];
			$stmt->execute();
			$stmt = $dbh->prepare("INSERT INTO property_size (Property_ID, Land, Floor) 
									VALUES (:property_id, :land, :floor)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':land', $land);
			$stmt->bindParam(':floor', $floor);
			$land = $_POST['post_land'];
			$floor = $_POST['post_floor'];
			$stmt->execute();
			echo "Property Posted!";
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			$uploadImages = new uploadImages();

			/* Images are required */
			if ($uploadImages->countImages() > 0)
			{
				
				/* Default validation:
					$uploadImages->image_type = "jpg|jpeg|png|gif";
					$uploadImages->min_size = "";
					$uploadImages->min_size = 24;
					$uploadImages->max_size = (1024*1024*3);
					$uploadImages->max_files = 10;
				*/
				
				/* Validate */
				if ($uploadImages->validateImages())
				{
					$i=1;
					print("<h3 class='text-info'>IMAGES</h3>");
					/* images array */
					$images = $uploadImages->getImages();
					$path="images/prop".$result;
					if (!file_exists($path)) {
						mkdir($path, 0700);
					}
					foreach ($images as $image)
					{
						/* save the image */
						if ($uploadImages->saveImage($image["tmp_name"], "images/prop/".$result."/", $i))
						{
							print ("<p class='text-success'>· <strong>" . $image["name"] . "</strong> saved in images folder</p>");
						}
						else
						{
							print("<p class='text-danger'>· " . $image["name"] . " error to saved</p>");
						}
						$i++;
					}
					/* GET EXTRA PARAMETERS */
				}
				else /* Show errors array */
				{
					print_r($uploadImages->error);
				}
			}
			else
			{
				print("<p class='text-danger'>images required</p>");
			}
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


$uploadImages = new uploadImages();

/** if ($uploadImages->countImages() > 0) 
	{**/				
		$params = $uploadImages->getParams();
		try{
			//Insert User Details
			$stmt = $dbh->prepare("INSERT INTO property (Title, Type, Price, Description, User_ID, Status) 
									VALUES (:title, :type, :price, :description, :user_id, :status)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':user_id',$user_id);
			$stmt->bindParam(':status', $status);
			$status = 'Active';
			$title = $params["title"];
			$type = $params['type'];
			$price = $params['price'];
			$description = htmlentities($params['desc'], ENT_QUOTES, 'UTF-8');
			$user_id = $params['id'];
			$stmt->execute();
			//Check last ID
			$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() FROM property");
			$stmt->execute();
			$result = $stmt->fetchColumn();
			//Insert Contact Details
			$stmt = $dbh->prepare("INSERT INTO property_location (Property_ID, Country, Zip, State, City, StreetAddress, Latitude, Longitude) 
									VALUES (:property_id, :country, :zip, :state, :city, :streetaddress, :lat, :long)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':country', $country);
			$stmt->bindParam(':zip', $zip);
			$stmt->bindParam(':state', $state);
			$stmt->bindParam('city', $city);
			$stmt->bindParam(':streetaddress', $route);
			$stmt->bindParam(':lat', $lat);
			$stmt->bindParam(':long', $long);
			$country = $params['country'];
			$zip = $params['zip'];
			$state = $params['state'];
			$city = $params['city'];
			$route = $params['route'];
			$lat = $params['p_lat'];
			$long = $params['p_long'];
			$stmt->execute();
			$stmt = $dbh->prepare("INSERT INTO property_features (Property_ID, Stories, Bed, Bath, Garage) 
									VALUES (:property_id, :stories, :bed, :bath, :garage)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':stories', $stories);
			$stmt->bindParam(':bed', $bed);
			$stmt->bindParam(':bath', $bath);
			$stmt->bindParam(':garage', $garage);
			$stories = $params['stories'];
			$bed = $params['bed'];
			$bath = $params['bath'];
			$garage = $params['garage'];
			$stmt->execute();
			$stmt = $dbh->prepare("INSERT INTO property_size (Property_ID, Land, Floor) 
									VALUES (:property_id, :land, :floor)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':land', $land);
			$stmt->bindParam(':floor', $floor);
			$land = $params['land'];
			$floor = $params['floor'];
			$stmt->execute();
			echo "Property Posted!";
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			

			/* Images are required */
			if ($uploadImages->countImages() > 0)
			{
				
				/* Default validation:
					$uploadImages->image_type = "jpg|jpeg|png|gif";
					$uploadImages->min_size = "";
					$uploadImages->min_size = 24;
					$uploadImages->max_size = (1024*1024*3);
					$uploadImages->max_files = 10;
				*/
				
				/* Validate */
				if ($uploadImages->validateImages())
				{
					$i=1;
					print("<h3 class='text-info'>IMAGES</h3>");
					/* images array */
					$images = $uploadImages->getImages();
					$path='images/prop/'.$result;
					if (!is_dir($path)) {
						mkdir($path);
					}
					foreach ($images as $image)
					{
						$filename = explode(".", $image["name"]);
						$key = end($filename);
						/* save the image */
						if ($uploadImages->saveImage($image["tmp_name"], $path."/", $i.".".end($filename)))
						{
							print ("<p class='text-success'>· <strong>" . $image["name"] . "</strong> saved in images folder</p>");
						}
						else
						{
							print("<p class='text-danger'>· " . $image["name"] . " error to saved</p>");
						}
						$i++;
					}
					/* GET EXTRA PARAMETERS */
				}
				else /* Show errors array */
				{
					print_r($uploadImages->error);
				}
			}
			else
			{
				print("<p class='text-danger'>images required</p>");
			}
			echo "<script> location.href = 'index.php?source=property-success'; </script>";
		}
		catch(PDOException $e){
			echo "<script> location.href = 'index.php' </script>";
			if($e->getCode() === '23000')
			{
				echo "Email already taken.";
			}
			else
			{
			echo "Error: " . $e->getMessage();
			}
		}
	/**}**/
	
	
	//try{
			//Insert User Details
	/**		$stmt = $dbh->prepare("INSERT INTO Property (Title, Type, Price, Description, User_ID) 
									VALUES (:title, :type, :price, :description, :user_id)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':type', $type);
			$stmt->bindParam(':price', $price);
			$stmt->bindParam(':description', $description);
			$stmt->bindParam(':user_id',$user_id);
			$title = $_POST['post_title'];
			$type = $_POST['post_type'];
			$price = $_POST['post_price'];
			$description = $_POST['post_description'];
			$user_id = $_SESSION['ID'];
			$stmt->execute();
			//Check last ID
			$stmt = $dbh->prepare("SELECT LAST_INSERT_ID() FROM Property");
			$stmt->execute();
			$result = $stmt->fetchColumn();
			//Insert Contact Details
			$stmt = $dbh->prepare("INSERT INTO Property_Location (Property_ID, Country, Zip, State, City, StreetAddress) 
									VALUES (:property_id, :country, :zip, :state, :city, :streetaddress)");
			$stmt->bindParam(':property_id', $result);
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
			$stmt = $dbh->prepare("INSERT INTO Property_Features (Property_ID, Stories, Bed, Bath, Garage) 
									VALUES (:property_id, :stories, :bed, :bath, :garage)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':stories', $stories);
			$stmt->bindParam(':bed', $bed);
			$stmt->bindParam(':bath', $bath);
			$stmt->bindParam(':garage', $garage);
			$stories = $_POST['post_stories'];
			$bed = $_POST['post_bed'];
			$bath = $_POST['post_bath'];
			$garage = $_POST['post_garage'];
			$stmt->execute();
			$stmt = $dbh->prepare("INSERT INTO Property_Size (Property_ID, Land, Floor) 
									VALUES (:property_id, :land, :floor)");
			$stmt->bindParam(':property_id', $result);
			$stmt->bindParam(':land', $land);
			$stmt->bindParam(':floor', $floor);
			$land = $_POST['post_land'];
			$floor = $_POST['post_floor'];
			$stmt->execute();
			echo "Property Posted!";
			//echo "<script> location.href = 'index.php' </script>";
			//echo "Error Code: " . $stmt->errorCode();
			$uploadImages = new uploadImages();

			/* Images are required */
		//	if ($uploadImages->countImages() > 0)
		//	{
				
				/* Default validation:
					$uploadImages->image_type = "jpg|jpeg|png|gif";
					$uploadImages->min_size = "";
					$uploadImages->min_size = 24;
					$uploadImages->max_size = (1024*1024*3);
					$uploadImages->max_files = 10;
				*/
				
				/* Validate */
		/**		if ($uploadImages->validateImages())
				{
					$i=1;
					print("<h3 class='text-info'>IMAGES</h3>");
					/* images array */
		/**			$images = $uploadImages->getImages();
					$path="images/prop".$result;
					if (!file_exists($path)) {
						mkdir($path, 0700);
					}
					foreach ($images as $image)
					{
						/* save the image */
		/**				if ($uploadImages->saveImage($image["tmp_name"], "images/prop/".$result."/", $i))
						{
							print ("<p class='text-success'>· <strong>" . $image["name"] . "</strong> saved in images folder</p>");
						}
						else
						{
							print("<p class='text-danger'>· " . $image["name"] . " error to saved</p>");
						}
						$i++;
					}
					/* GET EXTRA PARAMETERS */
		//		}
		//		else /* Show errors array */
		/**		{
					print_r($uploadImages->error);
				}
			}
			else
			{
				print("<p class='text-danger'>images required</p>");
			}
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
	

//$uploadImages = new uploadImages();

/* Images are required */
//if ($uploadImages->countImages() > 0)
//{
	
	/* Default validation:
		$uploadImages->image_type = "jpg|jpeg|png|gif";
		$uploadImages->min_size = "";
		$uploadImages->min_size = 24;
		$uploadImages->max_size = (1024*1024*3);
		$uploadImages->max_files = 10;
	*/
	
	/* Validate */
//	if ($uploadImages->validateImages())
//	{
//		print("<h3 class='text-info'>IMAGES</h3>");
		/* images array */
/**		$images = $uploadImages->getImages();
		$path="images/asd";
		if (!file_exists($path)) {
			mkdir($path, 0700);
		}
		foreach ($images as $image)
		{  **/
			/* save the image */
/**			if ($uploadImages->saveImage($image["tmp_name"], "images/prop/", $image["name"]))
			{
				print ("<p class='text-success'>· <strong>" . $image["name"] . "</strong> saved in images folder</p>");
			}
			else
			{
				print("<p class='text-danger'>· " . $image["name"] . " error to saved</p>");
			}
		} **/
		/* GET EXTRA PARAMETERS */
//	}
//	else /* Show errors array */
/**	{
		print_r($uploadImages->error);
	}
}
else
{
	print("<p class='text-danger'>images required</p>");
}  **/