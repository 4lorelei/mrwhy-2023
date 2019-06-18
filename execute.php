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
$path_keyboard='keyboard.txt';


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

$emo_admin_registra = "\xF0\x9F\x9B\xA1";
$emoji_admin_registra=json_decode('"'.$emo_admin_registra.'"');
$key_admin_registra=$emoji_admin_registra." registrazione";

$emo_admin_team = "\xF0\x9F\x9B\xA1";
$emoji_admin_team=json_decode('"'.$emo_admin_team.'"');
$key_admin_team=$emoji_admin_team." team";

$emo_admin_gara = "\xF0\x9F\x9B\xA1";
$emoji_admin_gara=json_decode('"'.$emo_admin_gara.'"');
$key_admin_gara=$emoji_admin_gara." gara";

$emo_admin_reset = "\xF0\x9F\x9B\xA1";
$emoji_admin_reset=json_decode('"'.$emo_admin_reset.'"');
$key_admin_reset=$emoji_admin_reset." reset";

$emo_admin_registra_on = "\xF0\x9F\x9B\xA1";
$emoji_admin_registra_on=json_decode('"'.$emo_admin_registra_on.'"');
$key_admin_registra_on=$emoji_admin_registra_on." registrazione on";

$emo_admin_registra_off = "\xF0\x9F\x9B\xA1";
$emoji_admin_registra_off=json_decode('"'.$emo_admin_registra_off.'"');
$key_admin_registra_off=$emoji_admin_registra_off." registrazione off";

$emo_admin_team_visualizza = "\xF0\x9F\x9B\xA1";
$emoji_admin_team_visualizza=json_decode('"'.$emo_admin_team_visualizza.'"');
$key_admin_team_visualizza=$emoji_admin_team_visualizza." visualizza";

$emo_admin_team_elimina = "\xF0\x9F\x9B\xA1";
$emoji_admin_team_elimina=json_decode('"'.$emo_admin_team_elimina.'"');
$key_admin_team_elimina=$emoji_admin_team_elimina." elimina";

$emo_admin_home = "\xF0\x9F\x9B\xA1";
$emoji_admin_home=json_decode('"'.$emo_admin_home.'"');
$key_admin_home=$emoji_admin_home." home";



// esiste admin?
if (!esiste_admin())
{
	set_admin($chatId);
}

// lettura tipo utente (admin, standard)
$tipo=tipo_utente($chatId);



notifica_mittente($chatId, $tipo);

// gestione admin
if ($tipo=="admin")
{
	if (keyboard_impostata($chatId)=="none")
	{
		keyboard_admin_menu($chatId, "tastiera admin");
	}
	
	//esecuzione comandi immediati degli utenti standard
	if (strcmp($text, $key_admin_registra) === 0)
	{
		keyboard_admin_registrazione($chatId, "tastiera admin");
		exit();
	}
	if (strcmp($text, $key_admin_team) === 0)
	{
		keyboard_admin_team($chatId, "tastiera admin");
		exit();
	}
	if (strcmp($text, $key_admin_gara) === 0)
	{
		keyboard_admin_gara($chatId, "tastiera admin");
		exit();
	}
	if (strcmp($text, $key_admin_reset) === 0)
	{
		//
		exit();
	}
	if (strcmp($text, $key_admin_registra_on) == 0)
	{
		//////INVIARE KEYBOARD DI REGISTRAZIONE A TUTTI GLI UTENTI
		
		notifica_mittente($chatId, "registrazione dei team abilitata");
		set_stato_corrente("registrazione_team");
		exit();
	}
	if (strcmp($text, $key_admin_registra_off) === 0)
	{
		notifica_mittente($chatId, "registrazione dei team disabilitata");
		set_stato_corrente("registrazione_team_off");
		exit();
	}
	if (strcmp($text, $key_admin_team_visualizza) === 0)
	{
		notifica_mittente($chatId, "visualizza team");
        // LISTARE TEAM
		exit();
	}
	if (strcmp($text, $key_admin_team_elimina) === 0)
	{
		set_automa("elimina_team", $chatId);
		notifica_mittente($chatId, "inserisci l'id del team da eliminare");
		exit();
	}
	
	if (strcmp($text, $key_admin_home) === 0)
	{
		keyboard_admin_menu($chatId, "tastiera admin");
		exit();
	}
	
	//esecuzione comandi pendenti degli utenti standard
	$push=push_automa($chatId);
	
	notifica_mittente($chatId, "***".$push."***");
	if ($push == "elimina_team")
	{
		cancellazione_team($text);
		notifica_mittente($chatId, "cancellazione del team ".$text." avvenuta correttamente");
		exit();
	
	}
	
	exit();
}


// gestione utente standard

//lettura dello stato corrente del bot (registrazione_team, registrazione_team_off, risposte_accettate, pausa, gara_terminata)
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
if (strcmp($text, $key_uno) === 0)
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
if (strcmp($text, $key_due) === 0)
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
if (strcmp($text, $key_tre) === 0)
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
if (strcmp($text, $key_quattro) === 0)
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
if (strcmp($text, $key_team) === 0)
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
if (strcmp($text, $key_team_view) === 0)
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


function keyboard_admin_menu($chatId, $msg)
{
	global $botUrlMessage;
	global $key_admin_registra, $key_admin_team, $key_admin_gara, $key_admin_reset;
	

	$reply_markup='{"keyboard":[["'.$key_admin_registra.'","'.$key_admin_team.'"],["'.$key_admin_gara.'","'. $key_admin_reset. '"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	set_keyboard($chatId, "menu");
	
    return  $output;
}

function keyboard_admin_registrazione($chatId, $msg)
{
	global $botUrlMessage;
	global $key_admin_registra_on, $key_admin_registra_off, $key_admin_home;
	

	$reply_markup='{"keyboard":[["'.$key_admin_registra_on.'","'.$key_admin_registra_off.'"],["'.$key_admin_home.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	set_keyboard($chatId, "registrazione");
	
    return  $output;
}

function keyboard_admin_team($chatId, $msg)
{
	global $botUrlMessage;
	global $key_admin_team_visualizza, $key_admin_team_elimina, $key_admin_home;
	

	$reply_markup='{"keyboard":[["'.$key_admin_team_visualizza.'","'.$key_admin_team_elimina.'"],["'.$key_admin_home.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	set_keyboard($chatId, "team");
	
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
		$stato="registrazione_team_off";
	
	return $stato;
}

function set_stato_corrente($nome)
{
	global $path_stato;
	
	$myStatoJson = json_encode($nome);
	file_put_contents($path_stato, $myStatoJson, LOCK_EX);
		
	return true;
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

function cancellazione_team($chatId, $text)
{
	global $path_utenti;
	
	//lettura del file dell'automa a stati
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	unset($utenti[$chatId]);
	
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
function set_keyboard($chatId, $nome)
{
	global $path_keyboard;
	
	//lettura del file dell'automa a stati
	$myKeyJson = file_get_contents($path_keyboard);
	$keyboard = json_decode($myKeyJson,true);
	$keyboard[$chatId] = $nome;
	
	$myKeyJson = json_encode($keyboard);
	file_put_contents($path_keyboard, $myKeyJson, LOCK_EX);
		
	return true;
}
function keyboard_impostata($chatId)
{
	global $path_keyboard;
	
	//lettura del file dell'automa a stati
	$myKeyJson = file_get_contents($path_keyboard);
	$keyboard = json_decode($myKeyJson,true);
	$nome=$keyboard[$chatId];
	
	if (sizeof($nome)==0)
	{
		return "none";
	}
	else
		return $nome;
}