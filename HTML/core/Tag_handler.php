<?php
/*this class creates the other obvius tags eg HTML,TITLE,HEAD tags
 *you can chose not to use it
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
class mainHandler{
    private $htmlTag;
    private $headTag;
    private $title;
    private $tags = array();
    private $mainTag = NULL;
    private $currentTag;
    private $enabled = false;
    private $CSS;

public function __construct($enabled = false){
    $this->enabled = $enabled;
}
public function __get($name){
    return $this->$name;
}
public function setTitle($title){
    $this->title = $title;
}
public function addCSS($path){
    $this->CSS = $path;
}
private function buildTag($tagName){
    $tag = HTML_tag::instantiate($tagName,array());
    $tag->parentTag = $this;

    return $tag;
}
public function addTag($tag){
    array_push($this->tags,$tag);
    }
public function addRowTag($tagName,$attrib){
    $temp = HTML_tag::instantiate($tagName,$attrib);
    array_push($this->tags,$temp);
    $this->currentTag =& $temp;
}
public function addContent($content){
    $this->currentTag->addContent($content);
}
public function appendContent($content){
    $this->currentTag->appendContent($content);
}
public function build(){
    if($this->enabled){
       //create a title tag;
         $title = HTML_tag::instantiate("title",array());
         $title->addContent($this->title);
         
         //create a head tag and append the title tag
        $headTag = HTML_tag::instantiate("head",array());
        $headTag->pushChild($title);
         if(!empty($this->CSS)){
            $css = HTML_tag::instantiate("link",array("type"=>"text/stylesheet","href"=>$this->CSS));
            $headTag->pushChild($css);
         }
        //create html tag and apend the head tag
        $mainTag = HTML_tag::instantiate("html",array("style"=>"background:white"));
        $mainTag->pushChild($headTag);
        //push the body child in the html tag: the body tag is externally defined
        //for flexibillity
        foreach($this->tags as $tag){
            $mainTag->pushChild($tag);
        }
        return $mainTag->build();
    }else{
        $final = "";
            foreach($this->tags as $tag){
                $final .= $tag->build();
            }
        return $final;
    }
}
/*this function dumps all the HTML in a file specified in the parameter
 *and returns the number of bytes written
 *@param string $fileName
 *@return int bytes
 */
public function dump($fileName){
           return file_put_contents($fileName,$this->build());
    }
}
?>