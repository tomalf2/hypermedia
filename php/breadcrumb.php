<?php

	$url = $_GET['url'];
	$page = $_GET['pageName'];

	include 'database.php';

	echo breadcrumbIncipit();


	//<span id="mCat">Devices </span><span id="mSeparator">> </span>
	$text = '';
	switch($page){
		case 'all_category_devices':
			$text = 'Dispositivi > Categorie';
			break;
		case 'all_category_assistance':
			$text = 'Assistenza > Categorie';
			break;
		case 'all_category_smartlife':
			$text = 'Smart Life > Categorie';
			break;
		case 'all_devices':
			$text = 'Dispositivi > Categoria > '.mGetType($url);
			break;
		case 'device':
			$text = 'Dispositivi > Categoria > '.mGetType($url).' > '.mGetName( mGetId($url) );
			break;
		case 'highlights':

			break;
		case 'promotions':

			break;
		default:
			$text = "breadcrumb not set for this page";
			break;
	}

	echo $text;


	function breadcrumbIncipit(){
		return "<span id=\"mTitle\">Stai guardando  </span>";
	}

	function mGetType($url){
		$isContained = preg_match('/tipo/', $url);
		if( $isContained === 1){
			$startIndxOfType = strrpos($url, 'tipo=') + 5; //4 is the length of 'tipo='
			$endIndx = strrpos($url, '&', $startIndxOfType);
			if( $endIndx === false )
				$endIndx = strlen($url);
			$type = substr($url, $startIndxOfType, $endIndx - $startIndxOfType);
			return $type;	
		}
	}

	function mGetId($url){
		$isContained = preg_match('/id/', $url);
		if( $isContained === 1){
			$startIndxOfType = strrpos($url, 'id=') +3; //2 is the length of 'id='
			$endIndx = strrpos($url, '&', $startIndxOfType);
			if( $endIndx === false )
				$endIndx = strlen($url);
			return substr($url, $startIndxOfType, $endIndx - $startIndxOfType);
		}
	}

	function mGetName($id){
		$info = getProductInfoId($id);
		return $info[DEV_NAME];
	}
	
?>