<?php
class images_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "images_controller construct called<br><br>";
    } 

    public function index() {
    
    echo "This is the index page";
    
    }
    
    /*-------------------------------------------------------------------------------------------------
	Upload File create a temporary copy of the uploaded files in the PHP temp folder on the server
	Upload code came from: http://www.w3schools.com/php/php_file_upload.asp
	-------------------------------------------------------------------------------------------------*/
		/* By using the global PHP $_FILES array you can upload files from a client computer to the remote server.

		The first parameter is the form's input name and the second index can be either 
		"name", "type", "size", "tmp_name" or "error". 
		
		Like this:
		$_FILES["file"]["name"] - the name of the uploaded file
		$_FILES["file"]["type"] - the type of the uploaded file
		$_FILES["file"]["size"] - the size in bytes of the uploaded file
		$_FILES["file"]["tmp_name"] - the name of the temporary copy of the file stored on the server
		$_FILES["file"]["error"] - the error code resulting from the file upload
		
		This is a very simple way of uploading files. For security reasons, you should add restrictions 
		on what the user is allowed to upload. 
		*/

    public function upload_file1() {
    
        # Setup view
        $this->template->content = View::instance('v_images_upload');
        $this->template->title   = "Upload A File";
        #$this->template->body_id = 'upload_file';

        # Render template
        echo $this->template;
    }
    
    public function p_upload_file1() {
    
		if ($_FILES["file"]["error"] > 0) {
  		echo "Error: " . $_FILES["file"]["error"] . "<br>";
  		}
		else
  		{
  		echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  		echo "Type: " . $_FILES["file"]["type"] . "<br>";
  		echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  		echo "Stored in: " . $_FILES["file"]["tmp_name"];
  		}
    
    }
    
    /*-------------------------------------------------------------------------------------------------
	Upload Image create a temporary copy of the uploaded files in the PHP temp folder on the server
	-------------------------------------------------------------------------------------------------*/
	
		/* 
		In this script we add some restrictions to the file upload. 
		The user may upload .gif, .jpeg, and .png files; and 
		the file size must be under 20 kB:
		*/
		
    public function upload_image() {
    
        # Setup view
        $this->template->content = View::instance('v_images_upload');
        $this->template->title   = "Upload An Image";
        #$this->template->body_id = 'upload_image';

        # Render template
        echo $this->template;
    }
    public function p_upload_image() {
    
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts)) {
  			if ($_FILES["file"]["error"] > 0)
    			{
    			echo "Error: " . $_FILES["file"]["error"] . "<br>";
    			}
  			else
    			{
    			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    			echo "Stored in: " . $_FILES["file"]["tmp_name"];
    		}
  		}
		else
  		{
  		echo "Invalid file";
  		}
    
    }
    
    /*-------------------------------------------------------------------------------------------------
	Upload Image store the uploaded file we need to copy it to a different location:
	-------------------------------------------------------------------------------------------------*/
	
		/* 
		The examples above create a temporary copy of the uploaded files in 
		the PHP temp folder on the server.

		The temporary copied files disappears when the script ends. 
		To store the uploaded file we need to copy it to a different location.
		
		This script checks if the file already exists, 
		if it does not, it copies the file to a folder called "upload".
		*/
		
    public function upload_file() {
    
        # Setup view
        $this->template->content = View::instance('v_images_upload');
        $this->template->title   = "Upload And Save An Image";
        #$this->template->body_id = 'upload_save';

        # Render template
        echo $this->template;
    }
    public function p_upload_file() {
    
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg")
		|| ($_FILES["file"]["type"] == "image/x-png")
		|| ($_FILES["file"]["type"] == "image/png"))
		&& ($_FILES["file"]["size"] < 20000)
		&& in_array($extension, $allowedExts))
  			{
  			if ($_FILES["file"]["error"] > 0)
    			{
    			echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    			}
  			else
    			{
    			echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    			echo "Type: " . $_FILES["file"]["type"] . "<br>";
    			echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    			echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    			if (file_exists("upload/" . $_FILES["file"]["name"]))
      				{
      				echo $_FILES["file"]["name"] . " already exists. ";
      				}
    			else
      				{
      				move_uploaded_file($_FILES["file"]["tmp_name"],
      				"upload/" . $_FILES["file"]["name"]);
      				echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      				}
    			}
  			}
		else
  			{
  			echo "Invalid file";
  			}
    
    }    
    
    /*-------------------------------------------------------------------------------------------------
	Demonstrating Classes/Objects
	-------------------------------------------------------------------------------------------------*/
	public function display_image() {
	
		// Make sure code has access to my image class (temp solution)
		require(APP_PATH.'/libraries/Image.php');
	
		#echo "You are looking at test1.";
	
		#echo APP_PATH."<br>";
		#echo DOC_ROOT."<br>";
	
		// Once we have access, we instantiate an object from that class
		// and pass the parameter to the construct
		$imageObj = new Image('http://placekitten.com/1000/1000');
	
		// Then we have access to all the methods within that object
		// and we can point to the methods in that class
		$imageObj->resize(500,500);
	
		$imageObj->display();
		
		
		/* from A's section 10/22
		$imageObj = new Image('img/kitten.jpg');
		$imageObj->resize(500,500);	
		$image_class = get_class($imageObj);
		$reflector = new ReflectionClass($image_class);
		$fn = $reflector->getFileName();
		echo dirname($fn);
		*/

	}
	    	

}  # eoc

