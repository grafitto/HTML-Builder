<?php
/*this is the class used to iterate the HTML_tags children
 *@package HTML_tag
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
class childrenIterator implements HTML_tag_iterator{
    private $_children = array(); //stores the children
/*expects an array
 *@param array $children
 */
public function __construct(array $children){
    $this->_children = $children;
}
/*@return bool
 */
public function hasNext(){
    return !empty($this->_children);
}
/*@return child
 */
public function next(){
    $temp = array_splice($this->_children,0,1);
    return array_shift($temp);
}
}
?>