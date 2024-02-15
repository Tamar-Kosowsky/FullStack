<?php 





header('Content-Type: text/html; charset=utf-8');

use Google\Cloud\Vision\VisionClient;


    require_once 'vendor/autoload.php';
    
    //$vision = new VisionClient();
    
    $vision = new VisionClient(['keyFile'=>json_decode(file_get_contents('upwords-d49f3d716acc.json'),true)]);
    
    $familyPhotoResource = fopen('images/92E141F8-36E4-4331-BB2EE42AC8674DD3_source.jpg', 'r');
    
    $image = $vision->image($familyPhotoResource, [
        'LABEL_DETECTION'
    ]);
    
    $annotation = $vision->annotate($image);
    $labels = $annotation->labels();
    $web = $annotation->web();
    $imageProperties = $annotation->imageProperties();
    
    
    // echo "<pre>";
    // var_dump($annotation);
    // echo "</pre>";
    // die();
    
    foreach($labels as $key=>$label){
        echo $label->info()['description']."<br>";
    
        echo ucfirst($label->info()['description']);
        echo number_format($label->info()['score'] * 100 ,2);
    }



?>