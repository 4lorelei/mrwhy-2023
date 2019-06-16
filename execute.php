<?php
setlocale(LC_TIME, 'it_IT');
date_default_timezone_set('Europe/Rome');
$content = file_get_contents("php://input");
$update = json_decode($content, true);
if(!$update)
{
  exit;
}
//Versione
//mr why 001 ver. 0.1 evo 16/06/2019
//Token
$token="819802080:AAEchb_QkdRNkrHf99xjrJBqd5PJMZJYmgc";

$botUrl = "https://api.telegram.org/bot".$token."/sendPhoto";
$botUrlVoice = "https://api.telegram.org/bot".$token."/sendVoice";
$botUrlVideo = "https://api.telegram.org/bot".$token."/sendVideo";
$botUrlMessage = "https://api.telegram.org/bot".$token."/sendMessage";
$botUrlDocument = "https://api.telegram.org/bot".$token."/sendDocument";
//parametri ricevuti all'invocazione
$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";
$text = trim($text);
$text = strtolower($text);


header("Content-Type: application/json");
// path dei file sequenziali gestiti a run-time
$path = 'livello.txt';
$path_abl = 'abilitazione.txt';
$path_admin='amministratore.txt';
$path_black_list='black_list.txt';
$path_restore='restore.txt';
$path_broadcast='broadcast.txt';
$path_classifica='classifica.txt';
$path_users='users.txt';
$path_faq='faq.txt';
$path_faq_menu='faq_.txt';
$path_about='about.txt';
$path_about_menu='about_.txt';
$path_cron='cron.txt';
$path_anagrafica='anagrafica.txt';
$path_automa='automa.txt';
$path_monitor='monitor.txt';
$path_log='log.txt';
$path_lock='lock.txt';

// keyboard con emoticons
/*
$emo_help = "\xF0\x9F\x94\x8D";
$emoji_help=json_decode('"'.$emo_help.'"');
$key_help=$emoji_help." indizi";
*/

$emo_uno = "\x31\xE2\x83\xA3";
$emoji_uno=json_decode('"'.$emo_uno.'"');
$key_uno=$emoji_uno." ";

$emo_due = "\x31\xE2\x83\xA3";
$emoji_due=json_decode('"'.$emo_due.'"');
$key_due=$emoji_due." ";

$emo_tre = "\x31\xE2\x83\xA3";
$emoji_tre=json_decode('"'.$emo_tre.'"');
$key_uno=$emoji_tre." ";

$emo_quattro = "\x31\xE2\x83\xA3";
$emoji_quattro=json_decode('"'.$emo_quattro.'"');
$key_quattro=$emoji_quattro." ";

echo keyboard_1_4 ($chatId);

function keyboard_1_4 ($chatId) 
{
	global $botUrlMessage;
	global $key_uno, $key_due, $key_tre, $key_quattro;
	
	$reply_markup='{"keyboard":[["'.$key_uno.'","'.$key_due.'"],["'.$key_tre.'","'. $key_quattro. '"]],"resize_keyboard":true}';
	
	$msg="tastiera";
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
    return  $output;
}
