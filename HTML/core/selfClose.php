<?php
/*this takes care of the self closing tags eg input tags
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */

class selfClose extends HTML_tag {
    private $tag;
    private $parentTag = NULL;
    private $open;
    private $attributes;
    private $currentPosition = 0;
    private $indexInParent = 0;

public function __construct($tag,$attrib){
    $this->createTag($tag,$attrib);
}

public function build(){
    $tag  = "<".$this->tag.$this->attributes." />";
    return $tag;
}
public function createTag($tagName,$attrib){
    $this->tag = $tagName;
    $final = array();
    $composedAttributes = "";
    global $attributes;
        foreach($attributes as $attribute){
            if(isset($attrib[$attribute])){
                $temp = $attribute;
                $temp = " {$attribute}=".'"'.$attrib[$attribute].'"';
                array_push($final,$temp);
            }
        }
        foreach($final as $attribute)
            $this->attributes .= $attribute;
}
}
?>