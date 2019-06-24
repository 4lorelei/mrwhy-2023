<?php 
setlocale(LC_TIME, 'it_IT');
date_default_timezone_set('Europe/Rome');
$content = file_get_contents("php://input");

$path_utenti='utenti.txt';


function leggi_classifica()
{
	global $path_utenti;
	global $botUrlMessage;
	global $emoji_admin_team;
	
	$myStatoJson = file_get_contents($path_utenti);
	$utenti = json_decode($myStatoJson,true);
	
	foreach ($utenti as $key => $value)
	{
		$aa[$key]=$value["tot"];
	}

	arsort($aa);
	
	$cont=1;
	$pos=0;
	$ultimo_punteggio=0;
	foreach ($aa as $key => $value)
	{
	    if ($ultimo_punteggio!=$value)
		{
			$pos++;
			$pos_v=$pos;
		}
		else
		    $pos_v=" ";
			
		$nome = $utenti[$key]["nome"];
		$punti = $value;
		
		$ultimo_punteggio = $value;
			
	    $riga = '<tr> <td width="10%">  ' . $pos_v . ' </td>';
		$riga = $riga . '<td width="60%"> ' . $nome . ' </td>';
		$riga = $riga . '<td width="30%"> ' . $punti . ' </td> </tr>';
	

		$all=$all . $riga;
	}

	return $all;
}
?>


<!DOCTYPE html>
<html>
<title>Mr. Why</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="ICON" href="gufo_.ico">
<style type="text/css">

div.titolo {
	font-family: "Comic Sans MS", cursive, sans-serif;
	font-size: 40px;
	font-weight: bold;
	color: #1C6EA4;
	text-align: center;
}

table.blueTable {
  font-family: "Comic Sans MS", cursive, sans-serif;
  border: 3px solid #1C6EA4;
  background-color: #EEEEEE;
  width: 67%;
  height: 300px;
  text-align: center;
  border-collapse: collapse;
  
  margin-left:auto; 
  margin-right:auto;
  

}
table.blueTable td, table.blueTable th {
  border: 0px solid #AAAAAA;
  padding: 3px 2px;
}
table.blueTable tbody td {
  font-size: 30px;
  font-weight: bold;
}
table.blueTable tr:nth-child(even) {
  background: #D0E4F5;
}
table.blueTable thead {
  background: #1C6EA4;
  background: -moz-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: -webkit-linear-gradient(top, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  background: linear-gradient(to bottom, #5592bb 0%, #327cad 66%, #1C6EA4 100%);
  border-bottom: 2px solid #444444;
}
table.blueTable thead th {
  font-size: 30px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
}
table.blueTable thead th:first-child {
  border-left: none;
}
table.blueTable tfoot td {
  font-size: 30px;
}
table.blueTable tfoot .links {
  text-align: right;
}
table.blueTable tfoot .links a{
  display: inline-block;
  background: #1C6EA4;
  color: #FFFFFF;
  padding: 2px 8px;
  border-radius: 5px;
}

</style>


<body>

<div class="titolo">
<br>Classifica generale<br><br>
</div>


<table class="blueTable">
<thead>
<tr>
<th>Pos</th>
<th>Team</th>
<th>Punti</th>
</tr>
</thead>
<tbody>

<?php 

$tab = leggi_classifica();
echo $tab;

?>

</tbody>
</table>

</body>
</html> 