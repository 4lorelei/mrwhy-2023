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
$path_soluzioni='soluzioni.txt';
$path_livello='livello.txt';
$path_punteggio='punteggio.txt';
$path_piazzamento='piazzamento.txt';


// keyboard con emoticons
$emo_uno = "\x31\xE2\x83\xA3";
$emoji_uno=json_decode('"'.$emo_uno.'"');
$key_uno=$emoji_uno."";

$emo_due = "\x32\xE2\x83\xA3";
$emoji_due=json_decode('"'.$emo_due.'"');
$key_due=$emoji_due."";

$emo_tre = "\x33\xE2\x83\xA3";
$emoji_tre=json_decode('"'.$emo_tre.'"');
$key_tre=$emoji_tre."";

$emo_quattro = "\x34\xE2\x83\xA3";
$emoji_quattro=json_decode('"'.$emo_quattro.'"');
$key_quattro=$emoji_quattro."";

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

$emo_admin_set = "\xF0\x9F\x9B\xA1";
$emoji_admin_set=json_decode('"'.$emo_admin_set.'"');
$key_admin_set=$emoji_admin_set." impostazioni";

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


$emo_admin_go = "\xF0\x9F\x9B\xA1";
$emoji_admin_go=json_decode('"'.$emo_admin_go.'"');
$key_admin_go=$emoji_admin_go." go";

$emo_admin_pausa = "\xF0\x9F\x9B\xA1";
$emoji_admin_pausa=json_decode('"'.$emo_admin_pausa.'"');
$key_admin_pausa=$emoji_admin_pausa." pausa";

$emo_admin_classifica = "\xF0\x9F\x9B\xA1";
$emoji_admin_classifica=json_decode('"'.$emo_admin_classifica.'"');
$key_admin_classifica=$emoji_admin_classifica." classifica";

$emo_admin_anteprima = "\xF0\x9F\x9B\xA1";
$emoji_admin_anteprima=json_decode('"'.$emo_admin_anteprima.'"');
$key_admin_anteprima=$emoji_admin_anteprima." anteprima";


$emo_admin_reset = "\xF0\x9F\x9B\xA1";
$emoji_admin_reset=json_decode('"'.$emo_admin_reset.'"');
$key_admin_reset=$emoji_admin_reset." reset";

$emo_admin_livello = "\xF0\x9F\x9B\xA1";
$emoji_admin_livello=json_decode('"'.$emo_admin_livello.'"');
$key_admin_livello=$emoji_admin_livello." livello";

$emo_admin_risposte = "\xF0\x9F\x9B\xA1";
$emoji_admin_risposte=json_decode('"'.$emo_admin_risposte.'"');
$key_admin_risposte=$emoji_admin_risposte." soluzioni";

$emo_admin_verifica = "\xF0\x9F\x9B\xA1";
$emoji_admin_verifica=json_decode('"'.$emo_admin_verifica.'"');
$key_admin_verifica=$emoji_admin_verifica." stato";

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



notifica_mittente($chatId, $tipo."***".$text."***");

// gestione admin
if ($tipo=="admin")
{
	$tastiera=keyboard_impostata($chatId);
	if ($tastiera=="none")
		keyboard_admin_menu($chatId, "menu");
	/*
	elseif ($tastiera=="team")
		keyboard_admin_team($chatId, "team");
	elseif ($tastiera=="registrazione")
		keyboard_admin_registrazione($chatId, "registrazione");
	elseif ($tastiera=="menu")
		keyboard_admin_menu($chatId, "menu");
	*/
		
	
	//esecuzione comandi immediati di admin
	
	// tastiere di admin
	if (strcmp($text, $key_admin_registra) === 0)
	{
		keyboard_admin_registrazione($chatId, "menu registrazione");
		exit();
	}
	if (strcmp($text, $key_admin_team) === 0)
	{
		keyboard_admin_team($chatId, "menu team");
		exit();
	}
	if (strcmp($text, $key_admin_gara) === 0)
	{
		keyboard_admin_gara($chatId, "menu gara");
		exit();
	}
	if (strcmp($text, $key_admin_set) === 0)
	{
		keyboard_admin_set($chatId, "menu set");
		exit();
	}
	
	
	// comandi della tastiera registrazione
	if (strcmp($text, $key_admin_registra_on) == 0)
	{
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
	
	// comandi della tastiera team
	if (strcmp($text, $key_admin_team_visualizza) === 0)
	{
		$elenco=elenca_team();
		notifica_mittente($chatId, $elenco);
		
		exit();
	}
	if (strcmp($text, $key_admin_team_elimina) === 0)
	{
		set_automa("elimina_team", $chatId);
		notifica_mittente($chatId, "inserisci l'id del team da eliminare");
		exit();
	}
	
	// comandi della tastiera gara
	if (strcmp($text, $key_admin_go) === 0)
	{
		$livello = next_livello();
		set_stato_corrente("risposte_accettate");
		reset_piazzamento();
		
		$cont=invia_keyboard("gara", "pulsantiera abilitata", $chatId);
		notifica_mittente($chatId, "livello: ".$livello . "\nabilitati " . $cont . " utenti" );
		
		notifica_all("livello ".$livello);
		
		exit();
	}
	if (strcmp($text, $key_admin_pausa) === 0)
	{
		$livello = get_livello();
		set_stato_corrente("pausa");
		notifica_punteggio();
		$cont=invia_keyboard("gara",  "pulsantiera disabilitata", $chatId);
		notifica_mittente($chatId, "livello: ".$livello . "\nin pausa " . $cont . " utenti" );
		exit();
	}
	if (strcmp($text, $key_admin_anteprima) === 0)
	{
		
		notifica_mittente($chatId, "ANTEPRIMA CLASSIFICA STATO E LIVELLO CORRENTE");
		exit();
	}
	if (strcmp($text, $key_admin_classifica) === 0)
	{
		
		notifica_mittente($chatId, "INVIO CLASSIFICA");
		exit();
	}
	
	// comandi della tastiera set
	if (strcmp($text, $key_admin_risposte) === 0)
	{
		set_automa("registra_risposte", $chatId);
		notifica_mittente($chatId, "inserisci le soluzioni una di seguito all'altra, ad es: 2431223");
		
		exit();
	}
	if (strcmp($text, $key_admin_livello) === 0)
	{
		
		notifica_mittente($chatId, "IMPOSTA LIVELLO CORRENTE");
		exit();
	}
	if (strcmp($text, $key_admin_verifica) === 0)
	{
		
		notifica_mittente($chatId, "VERIFICA RISPOSTE, LIVELLO CORRENTE");
		exit();
	}
	if (strcmp($text, $key_admin_reset) === 0)
	{
		
		notifica_mittente($chatId, "AZZERO TEAM, E LIVELLO");
		exit();
	}
	
	// comando home
	if (strcmp($text, $key_admin_home) === 0)
	{
		keyboard_admin_menu($chatId, "menu home");
		exit();
	}
	
	//esecuzione comandi pendenti di admin
	$push=push_automa($chatId);
	if ($push == "elimina_team")
	{
		if (cancellazione_team($text))
			notifica_mittente($chatId, "cancellazione del team ".$text." avvenuta correttamente");
		else
			notifica_mittente($chatId, "l'id ".$text." non è registrato");
		exit();
	
	}
	elseif ($push == "registra_risposte")
	{
		registrazione_risposte($text);
		notifica_mittente($chatId, "registrazione avvenuta correttamente");
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
	keyboard_registra_team ($chatId, "menu di registrazione");
}


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
if (strcmp($text, $key_uno) == 0)
{
	if ($stato_sistema=="risposte_accettate")
	{
		$ret = invia_risposta($text, $chatId);
		if ($ret==true)
			notifica_mittente($chatId, "è stata registrata la risposta 1");
		else
			notifica_mittente($chatId, "è già stata fornita una risposta!");
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
		$ret = invia_risposta($text, $chatId);
		if ($ret)
			notifica_mittente($chatId, "è stata registrata la risposta 2");
		else
			notifica_mittente($chatId, "è già stata fornita una risposta!");
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
		$ret = invia_risposta($text, $chatId);
		if ($ret)
			notifica_mittente($chatId, "è stata registrata la risposta 3");
		else
			notifica_mittente($chatId, "è già stata fornita una risposta!");
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
		$ret = invia_risposta($text, $chatId);
		if ($ret)
			notifica_mittente($chatId, "è stata registrata la risposta 4");
		else
			notifica_mittente($chatId, "è già stata fornita una risposta!");
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
	if ($nome_team=="")
		notifica_mittente($chatId, "team non registrato");
	else
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

function keyboard_gara ($chatId, $msg) 
{
	global $botUrlMessage;
	global $key_uno, $key_due, $key_tre, $key_quattro;
	
	$reply_markup='{"keyboard":[["'.$key_uno.'", "'.$key_due.'"],["'.$key_tre.'", "'.$key_quattro.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();

	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
    return  $output;
}

function keyboard_admin_gara ($chatId, $msg) 
{
	
	global $botUrlMessage;
	global $key_admin_go, $key_admin_pausa, $key_admin_anteprima, $key_admin_classifica, $key_admin_home;

	
	$reply_markup='{"keyboard":[["'.$key_admin_go.'","'.$key_admin_pausa.'"],["'.$key_admin_anteprima.'","'. $key_admin_classifica. '"],["'.$key_admin_home.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	set_keyboard($chatId, "gara");
	
	
    return  $output;
}


function keyboard_admin_menu($chatId, $msg)
{
	global $botUrlMessage;
	global $key_admin_registra, $key_admin_team, $key_admin_gara, $key_admin_set;

	/*
	$reply_markup='{"keyboard":[["'.$key_admin_registra.'","'.$key_admin_team.'"],["'.$key_admin_gara.'","'. $key_admin_set. '"]],"resize_keyboard":true}';
	
	*/
	
	$reply_markup='{"keyboard":[["'.$key_admin_set.'","'.$key_admin_team.'"],["'.$key_admin_gara.'"]],"resize_keyboard":true}';

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
	global $key_admin_registra_on, $key_admin_registra_off;

	$reply_markup='{"keyboard":[["'.$key_admin_registra_on.'","'.$key_admin_registra_off.'"],["'.$key_admin_team_visualizza.'","'.$key_admin_team_elimina.'"],["'.$key_admin_home.'"]],"resize_keyboard":true}';
	
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

function keyboard_admin_set($chatId, $msg)
{
	global $botUrlMessage;
	global $key_admin_risposte, $key_admin_livello, $key_admin_verifica, $key_admin_reset, $key_admin_home;
	

	$reply_markup='{"keyboard":[["'.$key_admin_risposte.'","'.$key_admin_livello.'"],["'.$key_admin_verifica.'","'.$key_admin_reset.'"],["'.$key_admin_home.'"]],"resize_keyboard":true}';
	
	$ch = curl_init();
	$myUrl=$botUrlMessage . "?chat_id=" . $chatId . "&text=" . urlencode($msg). "&reply_markup=" . $reply_markup;
	curl_setopt($ch, CURLOPT_URL, $myUrl); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
	// read curl response
	$output = curl_exec($ch);
	curl_close($ch);
	
	set_keyboard($chatId, "set");
	
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
	if (isset($utenti[$chatId]["nome"]))
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
	$utenti[$chatId]["nome"] = $text;
	
	$myUtentiJson = json_encode($utenti);
	file_put_contents($path_utenti, $myUtentiJson, LOCK_EX);
		
	return true;
}

function cancellazione_team($chatId)
{
	global $path_utenti;
	
	//lettura del file dell'automa a stati
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	if (isset($utenti[$chatId]["nome"]))
	{
		unset($utenti[$chatId]["nome"]);
		$myUtentiJson = json_encode($utenti);
		file_put_contents($path_utenti, $myUtentiJson, LOCK_EX);
		
		return true;
	}
	else
		return false;
	
}

function visualizza_team($chatId)
{
	global $path_utenti;
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	if (isset($utenti[$chatId]["nome"]))
		return $utenti[$chatId]["nome"];
	else
		return "";

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
function elenca_team()
{
	global $path_utenti;
	global $emoji_team;
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	if (sizeof($utenti)==0)
		return "nessun team registrato";
	else
	{
		foreach ($utenti as $key => $value)
		{
			$elenco=$elenco . $emoji_team . " " . $value["nome"] . ": " . $key . "\n";
		}
		return $elenco;
	}

}
function invia_keyboard($nome, $msg, $chatId)
{
	global $path_utenti;
	
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	$cont=0;
	foreach ($utenti as $key => $value)
	{
		if ($nome=="registra_team"){
			$out=keyboard_registra_team($key, $msg);
			//notifica_mittente($chatId, "notificato tastiera team a ". $key. "esito ". $out);
			$cont++;
		}
			
		elseif ($nome=="gara"){
			$out=keyboard_gara($key, $msg);
			//notifica_mittente($chatId, "notificato tastiera gara a ". $key. "esito ". $out);
			$cont++;
		} 
			
    }
	
	return $cont;

}
function notifica_all($notifica)
{
	global $path_utenti;
	global $botUrlMessage;
	
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	
	$cont=0;
	foreach ($utenti as $key => $value)
	{
		//Telegram prescrive una pausa di 1 sec ogni 30 notifiche 
		$j=1;
		if ($j % 20 == 0)
		{
			sleep(1);
		}
		$j++;
		$ch = curl_init();
		$myUrl=$botUrlMessage . "?chat_id=" . $key . "&text=" . urlencode($notifica);
		curl_setopt($ch, CURLOPT_URL, $myUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		// read curl response
		$output = curl_exec($ch);
		curl_close($ch);
		$cont++;
	}

	return true;
}

function registrazione_risposte($risposte)
{
	global $path_soluzioni;
		
	for ($i=0; $i<strlen($risposte); $i++)
	{
		$r=substr($risposte, $i, 1);
		$soluzioni[$i]=$r;
	}
	$mySoluzioniJson = json_encode($soluzioni);
	file_put_contents($path_soluzioni, $mySoluzioniJson, LOCK_EX);
		
	return true;
}
function risposta_esatta($livello)
{
	global $path_soluzioni;
		
	$mySoluzioniJson = file_get_contents($path_soluzioni);
	$soluzioni = json_decode($mySoluzioniJson,true);
	
	return $soluzioni[(int)$livello];
}

function next_livello()
{
	global $path_livello;
	
	$myLivelloJson = file_get_contents($path_livello);
	$livello = json_decode($myLivelloJson,true);
	if (sizeof($livello) == 0 )
	{
		$livello=1;
		$myLivelloJson = json_encode($livello);
		file_put_contents($path_livello, $myLivelloJson, LOCK_EX);
	}
	else
	{
		$livello++;
		$myLivelloJson = json_encode($livello);
		file_put_contents($path_livello, $myLivelloJson, LOCK_EX);
	}
	return $livello;
}

function get_livello()
{
	global $path_livello;
	
	$myLivelloJson = file_get_contents($path_livello);
	$livello = json_decode($myLivelloJson,true);
	return $livello;
}


function reset_piazzamento()
{
	global $path_piazzamento;
	
	$piazzamento=0;
	$myPiazzamentoJson = json_encode($piazzamento);
	file_put_contents($path_piazzamento, $myPiazzamentoJson, LOCK_EX);
	return true;
}

function invia_risposta($tasto, $chatId)
{
	global $path_utenti, $path_punteggio, $path_piazzamento;
	global $key_uno, $key_due, $key_tre, $key_quattro;

	
	if ($tasto==$key_uno) 
		$risposta="1";
	elseif ($tasto==$key_due) 
		$risposta="2";
	elseif ($tasto==$key_tre) 
		$risposta="3";
	elseif ($tasto==$key_quattro) 
		$risposta="4";
		
		notifica_mittente($chatId, "ricevuto risposta ".$risposta);
		
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	
	$myPunteggioJson = file_get_contents($path_punteggio);
	$punteggio = json_decode($myPunteggioJson,true);
	
	$myPiazzamentoJson = file_get_contents($path_piazzamento);
	$piazzamento = json_decode($myPiazzamentoJson,true);
	
	if (sizeof($piazzamento)==0)
		$piazzamento=0;
	
	$livello = get_livello();
	if (sizeof($livello)==0)
		$livello=0;
	
	if (isset($utenti[$chatId][(int)$livello]))    //risposta già data
		return false;
	
	$esatta = risposta_esatta($livello);
	    notifica_mittente($chatId, "attesa risposta esatta ".$esatta);
	if ((int)$esatta == (int)$risposta)
	{
	    $utenti[$chatId][$livello]=$punteggio[$piazzamento];
		$piazzamento++;
		$myPiazzamentoJson = json_encode($piazzamento);
		file_put_contents($path_piazzamento, $myPiazzamentoJson, LOCK_EX);
	}
	else
	{
		$utenti[$chatId][$livello]=0;
	}
	
	$myUtentiJson = json_encode($utenti);
	file_put_contents($path_utenti, $myUtentiJson, LOCK_EX);
		
	return true;
}
function notifica_punteggio()
{
	global $path_utenti;
	global $botUrlMessage;
	
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	
	$cont=0;
	$livello=get_livello();
	foreach ($utenti as $key => $value)
	{
		//Telegram prescrive una pausa di 1 sec ogni 30 notifiche 
		$j=1;
		if ($j % 20 == 0)
		{
			sleep(1);
		}
		$j++;
		$ch = curl_init();
		$notifica=$value[$livello];
		$myUrl=$botUrlMessage . "?chat_id=" . $key . "&text=" . urlencode("punteggio ultima risposta: ".$notifica);
		curl_setopt($ch, CURLOPT_URL, $myUrl); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		
		// read curl response
		$output = curl_exec($ch);
		curl_close($ch);
		$cont++;
	}

	return true;
}