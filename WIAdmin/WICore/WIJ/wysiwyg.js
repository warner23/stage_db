  var colorPalette = ['000000', 'FF9966', '6699FF', '99FF66', 'CC0000', '00CC00', '0000CC', '333333', '0066FF', 'FFFFFF'];
  var forePalette = $('.fore-palette');
  var backPalette = $('.back-palette');

  for (var i = 0; i < colorPalette.length; i++) {
    forePalette.append('<a href="javascript:void(0);" data-command="forecolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
    backPalette.append('<a href="javascript:void(0);" data-command="backcolor" data-value="' + '#' + colorPalette[i] + '" style="background-color:' + '#' + colorPalette[i] + ';" class="palette-item"></a>');
  }

  $('.toolbar a').click(function(e) {
    var command = $(this).data('command');
    if (command == 'h1' || command == 'h2' || command == 'p') {
      document.execCommand('formatBlock', false, command);
    }
    if (command == 'forecolor' || command == 'backcolor') {
      document.execCommand($(this).data('command'), false, $(this).data('value'));
    }
    if (command == 'createlink' || command == 'insertimage') {
      url = prompt('Enter the link here: ', 'http:\/\/');
      document.execCommand($(this).data('command'), false, url);
    } else document.execCommand($(this).data('command'), false, null);
  });

var wysiwyg = {}

wysiwyg.Bold = function(){
  //document.execCommand('bold');
  document.queryCommandState("bold");
}

wysiwyg.Italic = function(){
document.queryCommandState('italic', false, null);
}

wysiwyg.backColor = function(){
  document.execCommand('backColor', false, null);
}

wysiwyg.Underline = function(){
  document.queryCommandState('underline', false, null);
}

wysiwyg.strikeThrough = function(){
  document.queryCommandState('strikeThrough', false, null);
}

wysiwyg.justifyLeft = function(){
  document.queryCommandState('justifyleft', false, null);
}


wysiwyg.insertUnorderedList = function(){
  var highlight = window.getSelection();  
    var span = '<ul><li>something</li><li>something2</li></ul>';
    $(highlight).html(span); 
}

wysiwyg.insertOrderedList = function(){
  document.execCommand('insertOrderedList', false, "newOL");

}

wysiwyg.subscript = function(){
document.execCommand('subscript', false, null);
}

wysiwyg.superscript = function(){
  document.execCommand('superscript', false, null);
}