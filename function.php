<?php
function include_template($file, $content){
    if (file_exists($file)){
        ob_start();
        require_once $file;
        extract($content);
        return ob_get_clean();
    }
    else{
        return '';
    }
}
