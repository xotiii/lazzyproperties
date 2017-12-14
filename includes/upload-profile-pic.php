<?php 
session_start();

if(isset($_POST["save_prof_pic"])) {
		$target_dir = 'images/user/'.$_SESSION['ID'];
		if (!is_dir($target_dir)) {
			mkdir($target_dir);
		}
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$extension = pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		
		// Check if file already exists
		/**if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}**/
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			
			$maxDimW = 300;
			$maxDimH = 300;
			list($width, $height, $type, $attr) = getimagesize( $_FILES["fileToUpload"]["tmp_name"] );
			//if ( $width > $maxDimW || $height > $maxDimH ) {
				$target_filename = $_FILES["fileToUpload"]["tmp_name"];
				$fn = $_FILES["fileToUpload"]["tmp_name"];
				$size = getimagesize( $fn );
				$ratio = $size[0]/$size[1]; // width/height
				
				if( $ratio > 1) {
					$width = $maxDimW;
					$height = $maxDimH;
				} else {
					$width = $maxDimW;
					$height = $maxDimH;
				}
				$src = imagecreatefromstring(file_get_contents($fn));
				$dst = imagecreatetruecolor( $width, $height );
				imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1] );

				imagejpeg($dst, $target_filename); // adjust format as needed
			//}
			
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.'/1.'.$extension.'')) {
				echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				echo "<script> location.href = '../index.php?source=prof-pic-success'; </script>";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	
	}

	?>