<?php


class WYSIWYG
{
	function __contruct(){
	    $this->WIdb = WIdb::getInstance();
	}

	public function Paragraph()
	{
		$count = 0;
		$count ++;
		echo '<div class="toolbar">
  <a href="javascript:void(0);" data-command="undo" title="Undo"><i class="fa fa-undo"></i></a>
  <a href="javascript:void(0);" data-command="redo" title="redo"><i class="fa fa-repeat"></i></a>
  <div class="fore-wrapper" data-command="fontcolor" title="font color"><i class="fa fa-font" style="color:#C96;"></i>
    <div class="fore-palette">
    </div>
  </div>
  
<div class="back-wrapper" data-command="backcolor" title="background color"><i class="fa fa-font" style="color:#C96;"></i>
    <div class="back-palette">
    </div>
  </div>
  <a href="javascript:void(0);" data-command="bold" title="Bold" onclick="wysiwyg.Bold();"><i class="fa fa-bold"></i></a>
  <a href="javascript:void(0);" data-command="italic" title="Italic" onclick="wysiwyg.Italic();"><i class="fa fa-italic"></i></a>
  <a href="javascript:void(0);" data-command="underline" title="Underline" onclick="wysiwyg.Underline();"><i class="fa fa-underline"></i></a>
  <a href="javascript:void(0);" data-command="strikeThrough" title="strikeThrough" onclick="wysiwyg.strikeThrough();"><i class="fa fa-strikethrough"></i></a>
  <a href="javascript:void(0);" data-command="justifyLeft" title="justifyLeft"><i class="fa fa-align-left"></i></a>
  <a href="javascript:void(0);" data-command="justifyCenter" title="justifyCenter"><i class="fa fa-align-center"></i></a>
  <a href="javascript:void(0);" data-command="justifyRight" title="justifyRight"><i class="fa fa-align-right"></i></a>
  <a href="javascript:void(0);" data-command="justifyFull" title="justifyFull"><i class="fa fa-align-justify"></i></a>
  <a href="javascript:void(0);" data-command="indent" title="indent"><i class="fa fa-indent"></i></a>
  <a href="javascript:void(0);" data-command="outdent" title="outdent"><i class="fa fa-outdent"></i></a>
  <a href="javascript:void(0);" data-command="insertUnorderedList" title="insertUnorderedList" onclick="wysiwyg.insertUnorderedList();"><i class="fa fa-list-ul"></i></a>
  <a href="javascript:void(0);" data-command="insertOrderedList" title="insertOrderedList" onclick="wysiwyg.insertOrderedList();"><i class="fa fa-list-ol"></i></a>
  <a href="javascript:void(0);" data-command="h1" title="H1">H1</a>
  <a href="javascript:void(0);" data-command="h2" title="H2">H2</a>
  <a href="javascript:void(0);" data-command="createlink" title="Create Link"><i class="fa fa-link"></i></a>
  <a href="javascript:void(0);" data-command="unlink" title="Unlink"><i class="fa fa-unlink"></i></a>
  <a href="javascript:void(0);" data-command="insertimage" title="Insert Image"><i class="fa fa-image"></i></a>
  <a href="javascript:void(0);" data-command="p" title="Paragraph">P</a>
  <a href="javascript:void(0);" data-command="subscript" title="subscript" onclick="wysiwyg.subscript();"><i class="fa fa-subscript"></i></a>
  <a href="javascript:void(0);" data-command="superscript" title="superscript" onclick="wysiwyg.superscript();"><i class="fa fa-superscript"></i></a>
</div>
<div id="editor" class="editor"  contenteditable>
  <h1>A WYSIWYG Editor.</h1>
  <p>Try making some changes here. Add your own text or maybe an image.</p>
  <p>
    Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer
    ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit
    amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut
    odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
    </p>
</div>';
	}
}


?>