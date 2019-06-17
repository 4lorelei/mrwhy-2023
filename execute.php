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
$path_stato='stato.txt';
$path_utenti='utenti.txt';


// keyboard con emoticons
/*
$emo_help = "\xF0\x9F\x94\x8D";
$emoji_help=json_decode('"'.$emo_help.'"');
$key_help=$emoji_help." indizi";
*/

$emo_uno = "\x31\xE2\x83\xA3";
$emoji_uno=json_decode('"'.$emo_uno.'"');
$key_uno=$emoji_uno." ";

$emo_due = "\x32\xE2\x83\xA3";
$emoji_due=json_decode('"'.$emo_due.'"');
$key_due=$emoji_due." ";

$emo_tre = "\x33\xE2\x83\xA3";
$emoji_tre=json_decode('"'.$emo_tre.'"');
$key_tre=$emoji_tre." ";

$emo_quattro = "\x34\xE2\x83\xA3";
$emoji_quattro=json_decode('"'.$emo_quattro.'"');
$key_quattro=$emoji_quattro." ";

$emo_team = "\xF0\x9F\x9B\xA1";
$emoji_team=json_decode('"'.$emo_team.'"');
$key_team=$emoji_team." registra team";

$emo_team = "\xF0\x9F\x9B\xA1";
$emoji_team=json_decode('"'.$emo_team.'"');
$key_team_view=$emoji_team." visualizza team";

// esiste admin?
if (!esiste_admin())
{
	set_admin($chatId);
}

// lettura tipo utente
$tipo=tipo_utente($chatId);


notifica_mittente($chatId, $tipo);

// gestione admin



// gestione utente standard

//lettura dello stato corrente del bot (registrazione_team, risposte_accettate, pausa, gara_terminata)
$stato_sistema=stato_corrente();

//stato dell'utente (registrato o non_registrato)
$stato_utente=stato_corrente_utente($chatId);

if ($stato_utente=="non_registrato")
{
	keyboard_registra_team ($chatId, "tastiera");
}

//keyboard_1_4 ($chatId, "4 tasti numerici!");

//esecuzione comandi pendenti degli utenti standard
$push=push_automa($chatId);
if ($push == "registrazione")
{
	if ($stato_sistema=="registrazione_team")
	{
		registrazione_team($chatId, $text);
		notifica_mittente($chatId, "registrazione avvenuta con successo");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la registrazione del team al momento non è abilitata");
		exit();
	}
	
}

//esecuzione comandi immediati degli utenti standard
if (strpos($text, $key_uno) === 0)
{
	if ($stato_sistema=="risposte_accettate")
	{
		registrazione_risposta($chatId, "1");
		notifica_mittente($chatId, "è stata registrata la risposta 1");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la risposta non può essere accettata");
		exit();
	}
}
if (strpos($text, $key_due) === 0)
{
	if ($stato_sistema=="risposte_accettate")
	{
		registrazione_risposta($chatId, "2");
		notifica_mittente($chatId, "è stata registrata la risposta 2");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la risposta non può essere accettata");
		exit();
	}
}
if (strpos($text, $key_tre) === 0)
{
	if ($stato_sistema=="risposte_accettate")
	{
		registrazione_risposta($chatId, "3");
		notifica_mittente($chatId, "è stata registrata la risposta 3");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la risposta non può essere accettata");
		exit();
	}
}
if (strpos($text, $key_quattro) === 0)
{
	if ($stato_sistema=="risposte_accettate")
	{
		registrazione_risposta($chatId, "4");
		notifica_mittente($chatId, "è stata registrata la risposta 4");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la risposta non può essere accettata");
		exit();
	}
}
if (strpos($text, $key_team) === 0)
{
	if ($stato_sistema=="registrazione_team")
	{
		set_automa("registrazione", $chatId);
		notifica_mittente($chatId, "inserisci il nome del team e invia il messaggio");
		exit();
	}
	else
	{
		notifica_mittente($chatId, "la registrazione del team al momento non è abilitata");
		exit();
	}
}
if (strpos($text, $key_team_view) === 0)
{
	$nome_team=visualizza_team($chatId);
	notifica_mittente($chatId, "il tuo team è: ".$nome_team);
	exit();
}
else
{
	notifica_mittente($chatId, "comando non riconosciuto ");
	exit();
}


function keyboard_registra_team ($chatId, $msg) 
{
	global $botUrlMessage;
	global $key_team, $key_team_view;
	
	$reply_markup='{"keyboard":[["'.$key_team.'", "'.$key_team_view.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
    return  $output;
}



function keyboard_1_4 ($chatId, $msg) 
{
	global $botUrlMessage;
	global $key_uno, $key_due, $key_tre, $key_quattro;
	
	$reply_markup='{"keyboard":[["'.$key_uno.'","'.$key_due.'"],["'.$key_tre.'","'. $key_quattro. '"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
    return  $output;
}

function set_automa($comando, $id)
{
	global $path_automa;
	
	//lettura del file dell'automa a stati
	$myAtmJson = file_get_contents($path_automa);
	$automa = json_decode($myAtmJson,true);
	$automa[$id] = $comando;
	
	$myAtmJson = json_encode($automa);
	file_put_contents($path_automa, $myAtmJson, LOCK_EX);
		
	return true;
}

function push_automa($chatId)
{
	global $path_automa;
	
	//lettura del file dell'automa a stati
	$myAtmJson = file_get_contents($path_automa);
	$automa = json_decode($myAtmJson,true);
	if (isset($automa[$chatId]))
	{
		$ret = $automa[$chatId];
		unset($automa[$chatId]);
		$myAtmJson = json_encode($automa);
		file_put_contents($path_automa, $myAtmJson, LOCK_EX);
	}
	else
		$ret="";
	
	return $ret;
}

function stato_corrente()
{
	global $path_stato;
	
	$myStatoJson = file_get_contents($path_stato);
	$stato = json_decode($myStatoJson,true);
	
	if ($stato == "")
		$stato="registrazione_team";
	
	return $stato;
}

function stato_corrente_utente($chatId)
{
	global $path_utenti;
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	if (isset($utenti[$chatId]))
		return "registrato";
	else
		return "non_registrato";

}
function registrazione_team($chatId, $text)
{
	global $path_utenti;
	
	//lettura del file dell'automa a stati
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	$utenti[$chatId] = $text;
	
	$myUtentiJson = json_encode($utenti);
	file_put_contents($path_utenti, $myUtentiJson, LOCK_EX);
		
	return true;
}
function visualizza_team($chatId)
{
	global $path_utenti;
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	if (isset($utenti[$chatId]))
		return $utenti[$chatId];
	else
		return "team non registrato";

}

function notifica_mittente($chatId, $text)
{
	global $botUrlMessage;
		
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($text);
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	return  $output;
}
function esiste_admin()
{
	global $path_admin;
	
	$myAdminJson = file_get_contents($path_admin);
	$admin = json_decode($myAdminJson,true);
	if (sizeof($admin) == 0 )
		return false;
	else
		return true;
}
function set_admin($chatId)
{
	global $path_admin;
	
	//lettura del file dell'automa a stati
	$myAdminJson = file_get_contents($path_admin);
	$admin = json_decode($myAdminJson,true);
	$admin[$chatId] = true;
	
	$myAdminJson = json_encode($admin);
	file_put_contents($path_admin, $myAdminJson, LOCK_EX);
		
	return true;
}
function tipo_utente($chatId)
{
	global $path_admin;
	
	//lettura del file dell'automa a stati
	$myAdminJson = file_get_contents($path_admin);
	$admin = json_decode($myAdminJson,true);
	if (isset($admin[$chatId]))
		return "admin";
	else
		return "standard";
}