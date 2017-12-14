<?php ob_start();
session_start();?>
<?php include "includes/header.php" ?>
<?php include "includes/navigation.php" ?>

<?php include "includes/connection.php" ?>
<?php include "includes/function.php" ?>

<?php include "includes/connect.php" ?>


<?php 
    
    if (isset($_GET['source'])) {
        
        $source=$_GET['source'];
    }
    else
    {
        $source="";
    }

    switch ($source) 
    {
       
        case 'property-forsale':
             include "includes/property-main.php"; 
            break;
        case 'property-forrent':
             include "includes/property-main.php"; 
            break;
        case 'property-foreclosure':
             include "includes/property-main.php"; 
            break;
        case 'property-newdevelopment':
             include "includes/property-main.php"; 
            break;
		case 'news':
             include "includes/news.php"; 
            break;
        case 'viewnews':
             include "includes/viewnews.php"; 
            break;
        case 'viewnews2':
             include "includes/viewnews2.php"; 
            break;
        case 'agsatbrkr':
             include "includes/agencyandbroker.php"; 
            break;
        case 'property-page':
             include "includes/property-page.php"; 
            break;
        case 'loginandregister':
             include "includes/login-register.php"; 
            break;
        case 'propertyadvertise':
             include "includes/propertyadvertise.php"; 
            break;
        case 'postproperty':
             include "includes/post-property.php";
             break;
        case 'property-success':
             include "includes/property-success.php"; 
            break;
		case 'prof-pic-success':
             include "includes/prof-pic-success.php"; 
            break;
        case 'message-success':
             include "includes/message-success.php"; 
            break;
		case 'save-info-success':
             include "includes/save-info-success.php"; 
            break;
        case 'profile':
		if(isset($_SESSION['ID'])){
             include "includes/profile.php"; 
		}
		else {
			include "includes/profile-view.php";
		}
            break; 
        case 'profile-view':
             include "includes/profile-view.php"; 
            break; 
            case 'contact':
             include "includes/contact.php"; 
            break; 
        case 'profile-success':
             include "includes/profile-success.php"; 
            break;
		case 'change-pass-success';
			include "includes/change-pass-success.php";
			break;

          
        default:
            include "includes/homepage-search.php";
             
             include "includes/homepage-countarea.php"; 
             include "includes/homepage-buyandsell.php";
             
        break;
    } 
?>




<?php include "includes/footer.php" ?>
     
      

    

      