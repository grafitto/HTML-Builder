<?php
/*this class is used for basic textformating*/
class formatter{
/*returns a bold text*/
    public static function b($string){
        return "<b>{$string}</b>";
    }
    /*returns an italic text*/
    public static function i($string){
        return "<i>{$string}</i>";
    }
    /*return an underlined string
    @param string
    #return string
    */
    public static function u($string){
        return "<u>{$string}</u>";
    }
}
$formatter = new formatter();
?>