<?php
function getDomain() {
    if ( isset($_SERVER['HTTP_HOST']) ) {
        $dom = $_SERVER['HTTP_HOST'];
        if(strtolower(substr($dom, 0, 4)) == 'www.') {
            $dom = substr($dom, 4);
        }
        $uses_port = strpos($dom, ':');
        if($uses_port) {
            $dom = substr($dom, 0, $uses_port);
        }
        $dom = '.' . $dom;
    } else {
        $dom = false;
    }
    return $dom;
}
$dom = getDomain();
?>