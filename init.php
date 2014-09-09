<?php
/*this is the meating point of all clases.
 *they socialize using this channel
 *;-)
 *@package HTML_builder
 *@author Kevin Nderitu <nderitukelvin19@gmail.com>
 */
DEFINE('DS',DIRECTORY_SEPARATOR);
DEFINE('ROOT',"HTML_builder".DS."lib".DS."HTML");
DEFINE('CORE',ROOT.DS."core");
DEFINE('INTERFACES',ROOT.DS."interfaces");
DEFINE('ITERATORS',ROOT.DS."iterators");
DEFINE('EXTENSIONS',ROOT.DS."extensions");

require_once(CORE.DS."HTML_tag.php");
require_once(CORE.DS."selfClose.php");
require_once(CORE.DS."Tag_handler.php");

require_once(INTERFACES.DS."HTML_tag_interface.php");
require_once(INTERFACES.DS."HTML_tag_iterator.php");

require_once(ITERATORS.DS."Children_iterator.php");

require_once(EXTENSIONS.DS."Media_interface.php");
require_once(EXTENSIONS.DS."Iframe.php");
require_once(EXTENSIONS.DS."HTML_video.php");
require_once(EXTENSIONS.DS."HTML_audio.php");

require_once("attribs.php");
?>