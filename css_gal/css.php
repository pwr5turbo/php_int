<?php
function echoStylesheets($cssFolder) {
    $styles = glob( $cssFolder.'/*.css');
    $html = [];

    foreach ($styles as $sheet) {
        $html[] = '<link rel="stylesheet" href="' . $sheet . '">';
    }
    return $html;     
}
?>
