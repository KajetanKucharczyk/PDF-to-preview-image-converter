<?php
//WYŚWIETLANIE PODGLĄDÓW PIERWSZYSCH STRON INSTRUKCJI ORAZ LINK DO INSTRUKCJI W FORMACIE PDF
//KAJETAN KUCHARCZYK 29.12.2018

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//SORTOWANIE
function cmp($a, $b) {
	return strcasecmp($a, $b);
}

//ZMIENNE
$company = $_POST['c'];
$reference = $_POST['r'];

//SCIEŻKA
$dir = "/home/".str_replace(" ", "", $company)."/".$reference;
//TABLICA
$images = Array();

//LICZNIK ILOŚCI
$ilosc = 0;

//KATALOG ISTNIEJE
if(file_exists($dir)){
	if($handle = opendir($dir)){ 		
		while(false !== ($entry = readdir($handle))){	
			$pieces = explode(".", $entry);
			//POMIŃ PLIKI ŚMIECIOWE
			if(count($pieces) > 1 && $pieces[1] == "png"){
				//SPRAWDZ POPRAWNOSC PLIKU
				$filesize = filesize("/home/".str_replace(" ", "", $company)."/".$reference."/".$entry);
				if($filesize > 10000){
					//DO TABLICY
					array_push(
						$images,
						"/download/".str_replace(" ", "", $company)."/".$reference."/".$entry
					);
					$ilosc++;
				}else{
					//BŁĄD OBRAZKA -> ŹLE WYGENEROWANY
					//BRAK WYŚWITLENIA
				}
			}	
		}
	}
	//SORTOWANIE
	usort($images, 'cmp');
	//DODAJ INFORMACJE O ILOŚCI
	array_push(
		$images,
		$ilosc
	);
	//DODAJ PLIK PDF
	array_push(
		$images,
		"/download/".str_replace(" ", "", $company)."/".$reference."/".$reference.".pdf"
	);
	//WYPLUCIE WYNIKÓW ZCZYTYWANYCH W JS
	//OBSŁUGA W /f/kajtek/skrypty/kajtek_widget_manuals.js
	print_r(json_encode($images));
}else{
	//BRAK KATALOGU -> WYPLUCIE ZERA ZCZYTYWANEGO W JS
	//OBSŁUGA W /f/kajtek/skrypty/kajtek_widget_manuals.js
	print_r(0);
}
?>
