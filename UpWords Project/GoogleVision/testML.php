<?php 

header('Content-Type: text/html; charset=utf-8');

require_once 'vendor/autoload.php';

// use Google\Cloud\Vision\VisionClient;

// //$vision = new VisionClient();

// $vision = new VisionClient(['keyFile'=>json_decode(file_get_contents('upwords-d49f3d716acc.json'),true)]);
//https://storage.cloud.google.com/upwords_bucket/birthdayparty-2021-03-26T17%3A30%3A31.469Z.jpg
/*
$url = 'https://vision.googleapis.com/v1/images:annotate';
$url .= '?key=upwords';

$data = [
    [
        'image' => [
            'source' => [
                'gcsImageUri' => 'gs://upwords_bucket/birthdayparty-2021-03-26T17:30:31.469Z.jpg'
            ]
         ],
         'features' => [
             [
                 'type' => 'LABEL_DETECTION',
                 'maxResults' => 200
             ]
         ]
    ]
];
*/

$headers = "accept: */*\r\nContent-Type: application/json\r\n";
/*
$context = [
    'http' => [
        'method' => 'POST',
        'header' => $headers,
        'content' => json_encode($data),
    ]
];
$context = stream_context_create($context);
$result = file_get_contents($url, false, $context);



*/







$data = [
    [
        'image' => [
            'source' => [
                'gcsImageUri' => 'gs://upwords_bucket/birthdayparty-2021-03-26T17:30:31.469Z.jpg'
            ]
         ],
         'features' => [
             [
                 'type' => 'LABEL_DETECTION',
                 'maxResults' => 200
             ]
         ]
    ]
];
$url = 'https://vision.googleapis.com/v1/images:annotate?key=upwords';

$headers = [
    'Accept: */*',
    'Content-Type: application/x-www-form-urlencoded',
    'Custom-Header: custom-value',
    'Custom-Header-Two: custom-value-2'
];

// open connection
$ch = curl_init();

// set curl options
$options = [
    CURLOPT_URL => $url,
    CURLOPT_POST => count($data),
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($ch, $options);

// execute
$result = curl_exec($ch);
echo $result;
// close connection
curl_close($ch);



?>