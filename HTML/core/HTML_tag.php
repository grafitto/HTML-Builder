<?php

/*this is the core of HTML_builder. It is the main class that does much of the work
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
class HTML_tag {
    private $tag;
    private $content;
    private $parentTag = NULL;
    private $children = array();
    private $attributes;
    private $childCount = 0;
    private $currentPosition = 0;
    private $indexInParent = 0;
/*calls $this-create method using
 *$tag and $attrib parameters
*/
private function __construct($tag,$attrib){
    $this->createTag($tag,$attrib);
}
/*gets a value from private members
 *@param string $name
 *@return string $this->$name
 */
public function __get($name){
    return $this->$name;
}
/*sets a value from private members
 *@param string $name
 *@param string $value
 */
public function __set($name,$value){
    $this->$name = $value;
}
/*adds an attribute to the current working tag
 *@param array $attributes
 */
public function addAttrib($attrib){
    $final = array();
    $composedAttributes = "";
    global $attributes;
        foreach($attributes as $attribute){
            if(isset($attrib[$attribute])){
                $temp = $attribute;
                $temp = " {$attribute}=".'"'.$attrib[$attribute].'"';
                
            }else{
                
            }
            
        }
        foreach($final as $attribute)
            $this->attributes .= $attribute;
}
/*sets the content of the current working tag
 *@param string $content
 */
public function addContent($content){
    $this->content = $content;
}
/*appends contents to the existing content, if any
 *@param string $content
 */
public function appendContent($content){
    $this->content .= $content;
}
/*constructs a new child using its parameters and appends it to its children
 *@param string $tag ..the name of the child tag
 *@param array $attrib ..attributes of that child
 */
public function pushRawChild($tag,$attrib,$isSelfClose = false){
//check if everything is in order before proceding
    if(!$attrib){
        throw new Exception("Attributes not set.");
        exit;
    }
    if(!$tag){
        throw new Exception("Tag name not set.");
        exit;
    }
//if everything is good now continue
    if(!$isSelfClose){
        $temp = new self($tag,$attrib);
        $temp->parentTag = $this;
        $temp->indexInParent = $this->childCount;
        array_push($this->children,$temp);
        $this->childCount++;
    }else{
        $temp = new selfClose($tag,$attrib);
        $temp->parentTag = $this;
        $temp->indexInParent = $this->childCount;
        array_push($this->children,$temp);
        $this->childCount++;
    }
}
/*appends aa child which has already been externally constructed
 *@param HTML_tag $child ..a child to be added
 */
public function pushChild($child){
    $child->parentTag = $this;
    $child->indexInParent = $this->childCount;
    array_push($this->children,$child);
    $this->childCount++;
    
}
/*constructs children and appends them to its children
 *children are of the same tag i.e tag in the parameters
 *children use the same attributes i.e attributes in the parameters
 *@param int $number ..the number of children to append
 *@param string $tag ..the tag of the children
 *@param array $attrib ..attributes to be used by the children
 *@param bool $isselfClose ..determines if the children have a closing tag
 */
public function pushRawChildren($number,$tag,$attrib,$isSelfClose = false){
    for($i=0;$i<$number;$i++){
        $this->pushRawChild($tag,$attrib,$isSelfClose);
    }
}
/*add children already made externally
 *children are identical
 *@param int $number ..the number of children to be instantiated
 *@param HTML_tag $tag ..children to be appended
 */
public function pushChildren($number,$tag){
    for($i=0;$i<$number;$i++){
        $this->pushChild($tag);
        
    }
}
/*returns an array of all children
 *@return array $this->children ..all children
 */
public function children(){
    return $this->children;
}
/*returns a child at a position $index. 
 *@return pointer HTML_tag $pointer ..a pointer to the child at position index
 */
public function getChildAt($index){
    $pointer =& $this->children[$index];
    $this->currentPosition = $pointer->indexInParent;
    return $pointer;
}
/*returns the next child in the list
 *if the curent child is the last the returns the first
 *wraps around to the first etc.
 *@return HTML_tag $Pointer
 */
public function getChildNext(){
    if($this->currentPosition < $this->childCount){
        return $this->getChildAt(++$this->currentPosition);
    }else{
        $this->currentPosition = 0;
        return $this->getChildAt($this->currentPosition);
    }
}
/*returns the previus child in the list
 *if the current is the first, then the last one is returned
 *wraps around to the last
 *@return HTML_tag $pointer
 */
public function getChildPrev(){
    if($this->currentPosition > 0){
        return $this->getChildAt(--$this->currentPosition);
    }else{
        $this->currentPosition = $this->childCount;
        return $this->getChildAt(--$this->currentPosition);
    }
}
/*returns a pointer to the parent tag
 *@return HTML_tag $parentTag
 */
public function getParent(){
    $pointer =& $this->parentTag;
    return $pointer;
}
/*this is where everything happens. all the strings of the tag are put together
 *by concantination(sorry if i misspelt). then checks if there are any children,
 *if there is it calls the build method of each children so reculsion happens actually.
 *after building it returns it as a string
 *@return string $content
 */
public function build(){
    $content = "";
    $content = "<".$this->tag.$this->attributes.">";
    $content .= $this->content;
        if(!empty($this->children)){
            foreach($this->children as $children){
                $content .= "\n".$children->build()."\n";
            }
        }
    $content .= "</".$this->tag.">";
    return ($content);
    }
/*a tag is created by joining its attributes to its opening tag from the array
 */
public function createTag($tagName,$attrib){
    $this->tag = $tagName;
    $final = array();
    $composedAttributes = "";
    global $attributes;
    //this loops through the attrib array checking if there is a value
    //without a key. this is helpful especialy when using <video controls>
    //becouse controls is just a word without the right hand part.
  foreach($attrib as $key=>$value){
       if(!$key)
            $final[] = " ".$value;
   }
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
/*instantiates a new tag and returns the object
 *@return HTML_tag $self
 */
public static function instantiate($tag,$attrib){
    return new self($tag,$attrib);
}
}
?>