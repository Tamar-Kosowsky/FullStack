
<?php 
    
    // require to use vision client service from file path ->vendor\google\cloud-vision\src\VisionClient.php
    use Google\Cloud\Vision\VisionClient;


    class GoogleVisionInternal{

    // request from admin_page.php after upload image
    public static function getImageLables($file_name){
        
        // request from admin page 
        // upwords-d49f3d716acc.json -> authentication file
        // connect to google api with upwords-d49f3d716acc.json authentication file
        $vision = new VisionClient(['keyFile'=>json_decode(file_get_contents('upwords-d49f3d716acc.json'),true)]);
        
        // open image file
        $familyPhotoResource = fopen('uploads/'.$file_name, 'r');
        
        // send current image to google vision api and return image object
        $image = $vision->image($familyPhotoResource, [
            'LABEL_DETECTION'
        ]);
        
        // send image object and get response of image annotate 
        $annotation = $vision->annotate($image);

        // get the lables of image object return as array
        $labels = $annotation->labels();
       // $web = $annotation->web();            
       // $imageProperties = $annotation->imageProperties();
    
       //return object with diffrent arrays
        return $labels;
                   

        }


    }

?>