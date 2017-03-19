### HTML_builder ###
This is a PHP library that dynamicaly generates HTML tags, it efficient in simple webpages opposed to major complex websites where templates are most appropriate.

Include the init file first

```
#!php

require_once("HTML_builder/init.php");
//replqce the HTML_builder with your path
```
## Formatter ##

Before we move to the main classes you can format texts using the library, simple formats i.e bold, italics, underline a text

Example:


```
#!php

global $formatter;
$f =& $formatter;

$txt = "This is a test text";

$btxt = f::b($txt);
//$btxt is now bold

$itxt = f::i($txt);
//$itxt is now italic

$utxt = f::u($txt);
//utxt is now underlined

$butxt = f::b(f::u($txt));
$butxt is now bold and underlined
```

## HTML_tag class ##
This is the main class which has *instantiate* method that generates a tag object.
The *instantiate* method takes two parameters, the HTML tag name and the tag's attributes (eg id, class, style etc). There you have no attributes then you should provide an empty array.
The methods will be demonstrated in this example
Example:

```
#!php
$div = HTML_tag::instantiate("div",array());
//creates a $div tag object

$div2 = HTML_tag::instantiate("div",array("id"="MyDiv"));
//creates a $div tag object


$div2->pushChild($div);
//this method appends $div tag to $div2 tag

$div2->pushRawChild("img",array("src"=>"path/to/file"),true);
//this adds a child DIV tag to $div2, the third parameter is optional
//which if set true will generate a self closing tag eg img tag

$div2->pushChildren(2,$div);
//this appends 2 $div children to $div2, the children are identical

$div3->pushRawChildren(2,"img",array("src"=>"path/to/file"),true);
//this appends 2 self closing img tags to $div3 which are self closing tags

$div2->children();
//this returns an array of all its children objects

$div2->getChildAt(1);
//this returns a child tag object at position 1

$div2->getChildNext();
//this returns the next child from since getChildAt method was called, if it
//wasn't called then it returns the first child, if it gets to the end of 
//its children then it loops through to the first child

$div2->getChildPrev();
//this works in reverse of wat getChildNext method does

$div->getParent();
//returns the parent tag object
 
```
## Class mainHandler ##

This class is used to instantiate html, head, link, title tags. 
Example:

```
#!php

$html = new mainHandler(true);
//creates a html tag, the parameter must be set to true, if it isnt then the
//above listed tags will not be generated

$html->setTitle("Example code");
//sets the title of the page

$html->addCSS("path/to/css/file.css");
//adds a css link

$html->addTag($div2);
//adds a previusly generated tag 

echo $html->build();
//displays the content.

$html->dump("path/to/dump/file.html");
//this dumps the content to a file, it is created if it doesn't exist
```
### Extensions ###

1.**Video.**

This works the same way as the HTML_tag

Example:

```
#!php

$video = HTML_video::instantiate("video/mp4",array("controls","width"="480px"));
//this creates a video tag, the second parameter is optional which will
//load the defaults i.e. controls width="480px"

$video->source("path/to/video/file.mp4");
//loads the source of the video

$video->addContent("This format is not suported by your browser");
 //this is displayed if the video is not suported

echo $video->build();
//display the html

```

2.**Audio**

This works the same as the video extension

Example:


```
#!php

$audio = HTML_audio::instantiate("audio/mpeg",array("controls","width"="480px"));
//this creates a audio tag, the second parameter is optional which will
//load the defaults i.e. controls width="480px"

$audio->source("path/to/audio/file.mp3");
//loads the source of the audio

$audio->addContent("This format is not suported by your browser");
 //this is displayed if the audio is not suported

echo $audio->build();
//display the html


```

### FULL EXAMPLE: ###

You should probably copy and paste this code, change the sources and run it. You will have to download the library first


```
#!php

require_once("HTML_builder/lib/init.php");

$div = HTML_tag::instantiate("DIV",array("style"=>"text-align:center;width:100%;height:100%;background:#eee"));
//construct video
$video = HTML_video::instantiate('video/mp4',array("controls","width"=>"600px","style"=>"padding:10px;box-shadow:2px 6px 7px -3px #777;background:white"));
$video->source("path/to/video/file.mp4");
$video->addContent("The video is not supported in this browser");
$div->pushChild($video); //add video

$audio = HTML_audio::instantiate('audio/mpeg');
$audio->source("path/to/audio/file.mp3");

//uncomment the line below to view the audio
//$div->pushChild($audio);

$body = HTML_tag::instantiate("body",array());
$body->pushChild($div);

$html = new mainHandler(true);
$html->setTitle("Video");
$html->addTag($body);

//echo $html->build();
$html->dump("testing_html_builder.html");

header("Location:testing_html_builder.html");
//redirect to the newly created file
```

**Note:**

All tag objects including the video and audio tag objects have the build method, so you can create a tag and build it.




Take a minute and look at [mylocation.atwebpages.com](http://mylocation.atwebpages.com) that was created entirely using this library
