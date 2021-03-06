<?php


class WYSIWYG
{
	function __contruct(){
	    $this->WIdb = WIdb::getInstance();
	}

	public function Paragraph()
	{
		echo '<div class="toolbar">
  <a href="#" data-command="undo"><i class="fa fa-undo"></i></a>
  <a href="#" data-command="redo"><i class="fa fa-repeat"></i></a>
  <div class="fore-wrapper"><i class="fa fa-font" style="color:#C96;"></i>
    <div class="fore-palette">
    </div>
  </div>
  <div class="back-wrapper"><i class="fa fa-font" style="background:#C96;"></i>
    <div class="back-palette">
    </div>
  </div>
  <a href="#" data-command="bold"><i class="fa fa-bold"></i></a>
  <a href="#" data-command="italic"><i class="fa fa-italic"></i></a>
  <a href="#" data-command="underline"><i class="fa fa-underline"></i></a>
  <a href="#" data-command="strikeThrough"><i class="fa fa-strikethrough"></i></a>
  <a href="#" data-command="justifyLeft"><i class="fa fa-align-left"></i></a>
  <a href="#" data-command="justifyCenter"><i class="fa fa-align-center"></i></a>
  <a href="#" data-command="justifyRight"><i class="fa fa-align-right"></i></a>
  <a href="#" data-command="justifyFull"><i class="fa fa-align-justify"></i></a>
  <a href="#" data-command="indent"><i class="fa fa-indent"></i></a>
  <a href="#" data-command="outdent"><i class="fa fa-outdent"></i></a>
  <a href="#" data-command="insertUnorderedList"><i class="fa fa-list-ul"></i></a>
  <a href="#" data-command="insertOrderedList"><i class="fa fa-list-ol"></i></a>
  <a href="#" data-command="h1">H1</a>
  <a href="#" data-command="h2">H2</a>
  <a href="#" data-command="createlink"><i class="fa fa-link"></i></a>
  <a href="#" data-command="unlink"><i class="fa fa-unlink"></i></a>
  <a href="#" data-command="insertimage"><i class="fa fa-image"></i></a>
  <a href="#" data-command="p">P</a>
  <a href="#" data-command="subscript"><i class="fa fa-subscript"></i></a>
  <a href="#" data-command="superscript"><i class="fa fa-superscript"></i></a>
</div>
<div id="editor" contenteditable>
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