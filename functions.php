<?php
function include_template($file, $content = array()){
	if (file_exists($file)){
		ob_start();
        extract($content);
		require_once($file);
		return ob_get_clean();
	}
	else{
		return '';
	}
}

function formStr($price){
    $price = ceil($price);
    if ($price < 1000) {
        return $price;
    } else {
        $price = (string)number_format($price, 0, '', ' ') . "&#8381";
        return $price;
    }
}

?>
