<?php
class ResizeImage
{
	private $ext;
	private $image;
	private $newImage;
	private $origWidth;
	private $origHeight;
	private $resizeWidth;
	private $resizeHeight;
	public function __construct( $filename )
	{
		if(file_exists($filename))
		{
			$this->setImage( $filename );
		} else {
			throw new Exception('Image ' . $filename . ' can not be found, try another image.');
		}
	}
	private function setImage( $filename )
	{
		$size = getimagesize($filename);
		$this->ext = $size['mime'];
		switch($this->ext)
	    {
	    	// Image is a JPG
	        case 'image/jpg':
	        case 'image/jpeg':
	        	// create a jpeg extension
	            $this->image = imagecreatefromjpeg($filename);
	            break;
	        default:
	            throw new Exception("File is not an image, please use another file type.", 1);
	    }
	    $this->origWidth = imagesx($this->image);
	    $this->origHeight = imagesy($this->image);
	}
	public function saveImage($savePath, $imageQuality="100", $download = false)
	{
	    switch($this->ext)
	    {
	        case 'image/jpg':
	        case 'image/jpeg':
	        	// Check PHP supports this file type
	            if (imagetypes() & IMG_JPG) {
	                imagejpeg($this->newImage, $savePath, $imageQuality);
	            }
	            break;
	    }
	    if($download)
	    {
	    	header('Content-Description: File Transfer');
			header("Content-type: application/octet-stream");
			header("Content-disposition: attachment; filename= ".$savePath."");
			readfile($savePath);
	    }
	    imagedestroy($this->newImage);
	}
	public function resizeTo( $width, $height, $resizeOption = 'default' )
	{
		switch(strtolower($resizeOption))
		{
			case 'exact':
				$this->resizeWidth = $width;
				$this->resizeHeight = $height;
			break;
			default:
				if($this->origWidth > $width || $this->origHeight > $height)
				{
					if ( $this->origWidth > $this->origHeight ) {
				    	 $this->resizeHeight = $this->resizeHeightByWidth($width);
			  			 $this->resizeWidth  = $width;
					} else if( $this->origWidth < $this->origHeight ) {
						$this->resizeWidth  = $this->resizeWidthByHeight($height);
						$this->resizeHeight = $height;
					}
				} else {
		            $this->resizeWidth = $width;
		            $this->resizeHeight = $height;
		        }
			break;
		}
		$this->newImage = imagecreatetruecolor($this->resizeWidth, $this->resizeHeight);
    	imagecopyresampled($this->newImage, $this->image, 0, 0, 0, 0, $this->resizeWidth, $this->resizeHeight, $this->origWidth, $this->origHeight);
	}
	private function resizeHeightByWidth($width)
	{
		return floor(($this->origHeight/$this->origWidth)*$width);
	}
	private function resizeWidthByHeight($height)
	{
		return floor(($this->origWidth/$this->origHeight)*$height);
	}
}

	include 'connect.php';
	define('MB', 1048576);
	
	$errorExt = 0;
	$errorError = 0;
	$errorSize = 0;
	
	$file = $_FILES['file'];
	
	$fileName = $file['name'];
	$fileTmpName = $file['tmp_name'];
	$fileError = $file['error'];
	$fileSize = $file['size'];
	
	$fileExt = explode('.',$fileName);
	$fileAExt = strtolower(end($fileExt));
	$allowed = array('jpg','jpeg');
	
	if(in_array($fileAExt,$allowed)){
		if($fileError === 0){
			if($fileSize < 5*MB){
				session_start();
				$image_name = $fileTmpName;
				$fileNameNew = $_SESSION['login'].".jpg";
				$fileDestination = '../img/avatar/'.$fileNameNew;
				move_uploaded_file($fileTmpName,$fileDestination);
				$resize = new ResizeImage('../img/avatar/'.$fileNameNew);
				$resize->resizeTo(100, 100, 'exact');
				$resize->saveImage('../img/avatar/'.$fileNameNew);
			}
			else{
				$errorSize = 1;
			}
		}
		else{
			$errorError = 1;
		}
	}
	else{
		$errorExt = 1;
	}
	$errors = array($errorExt,$errorError,$errorSize);
	echo json_encode($errors);
?>