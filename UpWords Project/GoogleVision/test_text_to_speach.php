<?php 
require __DIR__ . '/vendor/autoload.php';
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

/** Uncomment and populate these variables in your code */
// $path = 'The text file to be synthesized. (e.g., hello.txt)';

// create client object
$client = new TextToSpeechClient();

// get text from file
$text = file_get_contents($path);
$input_text = (new SynthesisInput())
    ->setText($text);

// note: the voice can also be specified by name
// names of voices can be retrieved with $client->listVoices()
$voice = (new VoiceSelectionParams())
    ->setLanguageCode('en-US')
    ->setSsmlGender(SsmlVoiceGender::FEMALE);

$audioConfig = (new AudioConfig())
    ->setAudioEncoding(AudioEncoding::MP3);

$response = $client->synthesizeSpeech($input_text, $voice, $audioConfig);
$audioContent = $response->getAudioContent();

file_put_contents('output.mp3', $audioContent);
print('Audio content written to "output.mp3"' . PHP_EOL);

$client->close();
?>