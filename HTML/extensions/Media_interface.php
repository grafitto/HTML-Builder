<?php
/*this is the interface that all media extensions should follow
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
interface HTML_mediaInterface{
    public function source($src); 
    public static function instantiate($type,$attrib = NULL); 
}
?>
