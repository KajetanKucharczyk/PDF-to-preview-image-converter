<?php
//KONWERSJA PLIKÓW INSTRUKCJI NA OBRAZKI PODGLĄDOWE
//KAJETAN KUCHARCZYK 29.12.2018

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//PLIKI .PDF UMIESZCZAMY W /download/NAZWA_PRODUCENTA GDZIE NAZWA_PRODUCENTA JEST TO
//NAZWA PRODUCENTA PISANA DUŻYMI LITERAMI BEZ SPACJI ORAZ PODKREŚLEŃ
//NASTĘPNIE URUCHAMIAMY SKRYPT, KTÓRY PRZETWARZA PLIKI WEDŁUG SCHEMATU:
//agtom.eu/f/kajtek/instrukcje/obrazki.php?c=NAZWA_PRODUCENTA


//ZMIENNE
$company = $_GET['c'];

//SCIEŻKA
$dir = "/home/admin/domains/agtom.eu/public_html/download/".$company."/";
echo "Katalog: ".$dir."<br><br>";

//KATALOG ISTNIEJE
$licz = 0;
if(is_dir($dir)){
	if($handle = opendir($dir)){ 		
		while(false !== ($entry = readdir($handle))){	
			$pieces = explode(".", $entry);
			//POMIŃ PLIKI ŚMIECIOWE
			if(count($pieces) > 1 && $pieces[1] == "pdf" && !$licz){
				echo "Znaleziono plik: ".$entry."<br><br>";
				$licz++;
				//REFERENCE
				$ref = $pieces[0];
				//KATALOG NA OBRAZY
				if(!file_exists($dir.$ref)) {
					mkdir($dir.$ref, 0777, true);
					echo "Katalog ".$dir.$ref." został stworzony"."<br><br>";
				}else{
					//KATALOG ISTENIEJE
					echo "Katalog ".$dir.$ref." istnieje"."<br><br>";
				}
				//ZCZYTANO PLIK
				//KONWERSJA
				if(php_to_images($dir.$entry, $dir.$ref, $ref, $company)){
					//PRZENOSZENIE .PDF PO ZAKONCZONEJ KONWERSJI
					if(is_file($dir.$entry)){
						rename($dir.$entry, $dir.$pieces[0]."/".$entry);
						echo "Plik pdf przeniesiony do katalogu: ".$dir.$pieces[0]."/".$entry."<br><br>";;
						//REFRESH STRONY
						echo "<a href='https://agtom.eu/f/kajtek/instrukcje/obrazki.php?c=$company' >KLIKNIJ ABY ODŚWIEŻYĆ</a>"."<br><br>";
					}
				}
			}	
		}
	}
}

//FUNKCJA PHP -> OBRAZKI
function php_to_images($pdf, $path, $ref, $company){
	//SKANOWANIE PDF -> ILOŚĆ STRON
	$im = new imagick($pdf);
	$strony = 0;
	if($im->getNumberImages() < 4){
		$strony = $im->getNumberImages();
	}else{
		$strony = 4;
	}
	//PĘTLA PO OBRAZKACH
	for($i = 0; $i < $strony; $i++){
		//WCZYTANIE OBRAZKA
		$imm = new Imagick();
		$imm->setResolution(100,100);
		$imm->readImage($pdf."[$i]");
		$imm->setImageBackgroundColor('white');
		$imm->setImageFormat('png');
		if($imm->getImageWidth() > $imm->getImageHeight()){
			//OBRAZEK SZEROKI
			$imm->thumbnailImage((int)(1800 / $strony), (int)(1800 / $strony * $imm->getImageHeight() / $imm->getImageWidth()));
		}else{
			//OBRAZEK ZWYKŁY
			//OPTYMALNIE 1800 / 4 = 450
			//MOŻNA ZASTOSOWAĆ 350 -> 350 * 4 = 1400 -> WTEDY ZMIENIĆ
			$imm->thumbnailImage((int)(1800 / $strony * $imm->getImageWidth() / $imm->getImageHeight()), (int)(1800 / $strony));
		}
		//ZAPIS
		$imm->writeImage($path."/".$ref."_".$i.".png");
		echo "Stworzono plik ".$path."/".$ref."_".$i.".png<br>";
		echo "<img src='https://agtom.eu/download/$company/$ref/".$ref."_".$i.".png' /><br><br>";		
		$imm->clear();
		$imm->destroy();
	}
	echo "<br><br>";
	//AUTOMATYCZNY REFRESH PO 2500MS
	echo "<script>setTimeout(function(){window.open('https://agtom.eu/f/kajtek/instrukcje/obrazki.php?c=$company', '_self')}, 2500)</script>";
	return 1;
}
?>
