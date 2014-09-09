<?php
/*the video extension class
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */


class HTML_video implements HTML_mediaInterface{
    
    private $source; //stores the source
    private $videoType; //stores the video type
    private $content;//will be displayed if the video is not suppoted
    private $attrib = array("controls","width"=>"480px"); //the default attribute
/*constructs a HTML_video object
 *@param string $videoType eg 'video/mp4'
 *@param array $attrib ..overloads the default attributes
 */
private function __construct($videoType,$attrib){
    if($attrib != NULL)
        $this->attrib = $attrib;
    $this->videoType = $videoType;
}
public function addContent($content){
    $this->content = "\n".$content;
}
/*sets the source of the video*/
public function source($src){
    $this->source = $src;
}
/*builds the tag by creating a HTML_tag, building it and returning a string
 *@return string $video->build()
 */
public function build(){
    if(!$this->source){
        throw new Exception("Source not found: set it using the source method");
        exit;
    }
        $srcAttrib = array("src"=>$this->source,"type"=>$this->videoType);
        $video = HTML_tag::instantiate("video",$this->attrib);
        $video->addContent($this->content);
        $video->pushRawChild("source",$srcAttrib,true);
        return $video->build();
}
/*instantiates a HTML_video objects and returns it*/
public static function instantiate($videoType,$attrib = NULL){
    return new self($videoType,$attrib);
}
}
