<?php
error_reporting(0);

$upid = "xxxx";
$uppass ="xxxx";

$data=("id=".$upid."&pw=".$uppass);
$host="uploaded.to";
$agent = "User-Agent: Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.2.17) Gecko/20110422 Ubuntu/10.04 (lucid) Firefox/3.6.17";
$ref="Referer: http://uploaded.to/";
$zahlenbypass = $argv[2];


socketpost($host,"/io/login",$agent,$ref,$data);
preg_match_all('/(Set-Cookie: )(.*?)(.*?)(;)/i',  $bla , $matches);

$cook=("Cookie: ".$matches[3][0]."; ".$matches[3][1]."; ".$matches[3][2]);
$sock = fsockopen("uploaded.net", 80); 
fputs($sock, "GET /me HTTP/1.1\r\n");
fputs($sock, "Host: uploaded.net\r\n");
fputs($sock, "User-Agent: ".$agent."\r\n");
fputs($sock, $cook."\r\n");
fputs($sock, "Connection: close\r\n\r\n");
while(!feof($sock))
$bla2 .= fgets($sock, 4096); 
fclose($sock);
$bla2 = str_replace("\n", " ", $bla2);
$bla2 = str_replace("\n", " ", $bla2);
$bla2 = str_replace("\t", " ", $bla2);
$bla2 = str_replace("  ", " ", $bla2);
$bla2 = str_replace("  ", " ", $bla2);
preg_match('/(Duration:<\/td>)(.*?)(<\/th>)/i',  $bla2, $matches);
echo str_replace("<th>","",$matches[2]."\n");
sleep (2);
if (isset($argv[1])) {
    $dlcfile = file_get_contents($argv[1]);
    $response_from_post = socketpost("dcrypt.it","/decrypt/paste","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:40.0) Gecko/20100101 Firefox/40.0","http://dcrypt.it/","content=".urlencode($dlcfile));
    echo $response_from_post;
    preg_match_all('/(\")(.*?)(\")/i',  $response_from_post , $matches4);
    print_r($matches4);
    $zahl=count($matches4[2]);
    for ($count = 5 ; $count < $zahl; $count++)
	{
		$fn=$fn+1;
		$url = str_replace('"','',($matches4[1][$count].$matches4[2][$count]));
        echo $url."\n";
        $htcheck=file_get_contents($url);
        preg_match('/(filename\">)(.*?)(<)/i',  $htcheck , $matches3);
        print_r($matches3);
        $dateiname = $matches3[2];
       	        if ($zahlenbypass == 1 ) {
                $shellbefehl="wget --header '".$agent."' --header '".$cook."' -O '".'file.part'.$fn.'.rar'."' ".$url;
                $liste.=$shellbefehl."\n";

}	
		else {
		$shellbefehl="wget --header '".$agent."' --header '".$cook."' -O '".$dateiname."' ".$url;
		$liste.=$shellbefehl."\n";
}
	
	}
file_put_contents("shellget.txt",$liste);
echo $liste;

sleep(3);
echo "\n Liste generiert - starte uploaded-grabber.php \n";
}

else {

$datei=file_get_contents("liste.txt");

$upget = explode("\n",$datei);
$zahl=count($upget);



for ($count = 0 ; $count < ($zahl-1); $count++)
	{
		$fn=$fn+1;
		
        $htcheck=file_get_contents($upget[$count]);
        preg_match('/(filename\">)(.*?)(<)/i',  $htcheck , $matches3);
        $dateiname = $matches3[2];
       
		$shellbefehl="wget --header '".$agent."' --header '".$cook."' -O '".$dateiname."' ".$upget[$count];
		$liste.=$shellbefehl."\n";
		
	
	}



file_put_contents("shellget.txt",$liste);
echo $liste;

sleep(3);
echo "\n Liste generiert - starte uploaded-grabber.php \n";

}


function socketpost($host, $pfad, $agent,$ref,$data)

{

global $bla;
header("Content-type: text/plain");
$sock = fsockopen($host, 80); 
fputs($sock, "POST ".$pfad." HTTP/1.1\r\n");
fputs($sock, "Host: ".$host."\r\n");
fputs($sock, "User-Agent: ".$agent."\r\n");
fputs($sock, "Referer: ".$ref."\r\n");
if (isset($cook)) 

	{
		fputs($sock, $cook."\r\n");
	}
fputs($sock, "Content-type: application/x-www-form-urlencoded\r\n");
fputs($sock, "Content-length: ". strlen($data) ."\r\n");
fputs($sock, "Connection: close\r\n\r\n");
fputs($sock, $data);


while(!feof($sock))
$bla .= fgets($sock, 4096); 
fclose($sock);

$bla = str_replace("\n", " ", $bla);


return $bla;
}

function socketget($host, $trilapfad, $cook,$agent,$ref,$bla2)

{

global $bla2;
header("Content-type: text/plain");
$sock = fsockopen($host, 80); 
fputs($sock, "GET ".$trilapfad." HTTP/1.1\r\n");
fputs($sock, "Host: ".$host."\r\n");
fputs($sock, $cook."\r\n");
fputs($sock, "User-Agent: ".$agent."\r\n");
fputs($sock, "Referer: ".$ref."\r\n");
fputs($sock, "Connection: close\r\n\r\n");

while(!feof($sock))
$bla2 .= fgets($sock, 4096); 
fclose($sock);

$bla2 = str_replace("\n", " ", $bla2);


return $bla;
}


function socketget2($host, $trilapfad, $cook,$agent,$ref,$bla3)

{

global $bla3;
header("Content-type: text/plain");
$sock = fsockopen($host, 80); 
fputs($sock, "GET ".$trilapfad." HTTP/1.1\r\n");
fputs($sock, "Host: ".$host."\r\n");
fputs($sock, $cook."\r\n");
fputs($sock, "User-Agent: ".$agent."\r\n");
fputs($sock, "Referer: ".$ref."\r\n");
fputs($sock, "Connection: close\r\n\r\n");

for ($ia=1; $ia< 9; $ia++)
{
$bla3 .= fgets($sock, 4096); 
}
fclose($sock);

$bla3 = str_replace("\n", " ", $bla3);


return $bla;
}

?>
