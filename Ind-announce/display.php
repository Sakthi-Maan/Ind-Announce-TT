<?php
//putenv('GOOGLE_APPLICATION_CREDENTIALS=var/www/html/vast-falcon-113308-6743dc8f2733.json');
//echo getenv('GOOGLE_APPLICATION_CREDENTIALS'); 
require_once 'vendor/autoload.php';
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;
 
try {
    $textToSpeechClient = new TextToSpeechClient();
 
    $input = new SynthesisInput();
    $input->setText('Japan\'s national soccer team won against Colombia!');
    $voice = new VoiceSelectionParams();
    $voice->setLanguageCode('en-US');
     
    // optional
    $voice->setName('en-US-Standard-C');
 
    $audioConfig = new AudioConfig();
    $audioConfig->setAudioEncoding(AudioEncoding::MP3);
 
    $resp = $textToSpeechClient->synthesizeSpeech($input, $voice, $audioConfig);
     
    $resultData = $resp->getAudioContent();
    header('Content-length: ' . strlen($resultData));
    header('Content-Disposition: attachment; filename="text-to-speech.mp3"');
    header('X-Pad: avoid browser bug');
    header('Cache-Control: no-cache');
    echo $resultData;
 
    $textToSpeechClient->close();
} catch(Exception $e) {
    echo $e->getMessage();
}
?>