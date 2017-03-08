<?php
$datei=file_get_contents("shellget.txt");
$zeit1 = time();
$upget = explode("\n",$datei);
$zahl=count($upget);
$check = 0;

for ($count = 0 ; $count <= ($zahl-1); $count++)
	{
		$output = shell_exec('pgrep wget | wc -l'); 
		if ($output<4)
			{
					if ($check == 1) { $check = 0; $count = $count-1;}
                    echo "Es laeuft ".$output." wget -starte File: ".($count+1)."\n";
					shell_exec("nohup ".$upget[$count]." > /dev/null &");
			}
		else 
			{
					$output = shell_exec('pgrep wget | wc -l'); 
					while ($output>=4)
						{
								$check = 1;
                                $output = shell_exec('pgrep wget | wc -l');
								sleep(10);
						}
			}
	}

					$output = shell_exec('pgrep wget | wc -l'); 
					while ($output>=1)
						{
                                $output = shell_exec('pgrep wget | wc -l');
                                echo ".";
								sleep(10);
						}
$zeit2 = time();    
echo "\nFertig in: ".($zeit2-$zeit1)." Sekunden\n";    
?>
