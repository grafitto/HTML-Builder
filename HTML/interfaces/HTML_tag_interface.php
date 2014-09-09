<?php
/* implimented by all HTML_tags
 * @package HTML_builder
 * @author Kevin Nderitu <nderituKelvin19@gmail.com>
 */
interface HTML_tag_interface{
    public function createTag($tag,$attrib);
    public function build();
}
?>