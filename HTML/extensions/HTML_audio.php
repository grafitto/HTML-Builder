<?php
/*HTML_audio class
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
class HTML_audio implements HTML_mediaInterface{
    
    private $source; //stores the source
    private $type; //stores the audio type
    private $content;//will be displayed if the video is not suppoted
    private $attrib = array("controls","width"=>"480px"); //the default attribute
/*constructs a HTML_audio object
 *@param string $videoType eg 'audio/mpeg'
 *@param array $attrib ..overloads the default attributes
 */
private function __construct($type,$attrib){
    if($attrib != NULL)
        $this->attrib = $attrib;
    $this->type = $type;
}
/*adds content to the taag that is to be displayed if the browser
 *doesnt support the media format
 *@param string $content
 */
public function addContent($content){
    $this->content = $content;
}
/*sets the source of the audio*/
public function source($src){
    $this->source = $src;
}
/*builds the tag by creating a HTML_tag, building it and returning a string
 *@return string $audio->build()
 */
public function build(){
    if(!$this->source){
        throw new Exception("Source not found: set it using the source method");
        exit;
    }
        $srcAttrib = array("src"=>$this->source,"type"=>$this->type);
        $media = HTML_tag::instantiate("audio",$this->attrib);
        $media->addContent($this->content);
        $media->pushRawChild("source",$srcAttrib,true);
        //$src = HTML_tag::instantiate("source",$srcAttrib,true);
        //$media->pushChild($src);
        return $media->build();
}
/*instantiates a HTML_audio objects and returns it*/
public static function instantiate($type,$attrib = NULL){
    return new self($type,$attrib);
}
}
?>
