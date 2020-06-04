<?php

/**
* 
*/
class notepad 
{
  
  function __construct()
  {
    $this->WIdb = WIdb::getInstance();
  }

  public function Install($element_name)
  {
    $author = "Jules Warner";
    $type = "Common Fields";
    $font = "wi_" . $element_name;
    $power = "power_on";
    $this->WIdb->insert('wi_elements', array(
            "element_name" => $element_name,
            "element_author" => $author,
            "element_type" => $type,
            "element_font" => $font,
            "element_powered" => $power
        )); 
  }

    public function editMod()
  {
    echo '<div id="remove">
      <a href="#">
      <button id="delete" onclick="WIMod.delete(event);">Delete</button>
      </a>
       <div id="dialog-confirm" title="Remove Module?" class="hide">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;">
  </span>Are you sure?</p>
  <p> This will remove the module and any unsaved data.</p>
  <span><button class="btn btn-danger" onclick="WIMod.remove(event);">Remove</button> <button class="btn" onclick="WIMod.close(event);">Close</button></span>
</div>
    <link rel="stylesheet" type="text/css" href="WIModule/appearing_button/appearing_button.css">
    <div id="box1">
      <a href="#">
      <button><input text="text" placeholder="Appearing button" id="appear"></button></a>
      </div></div>';
  }

  public function mod_name($empty, $mod_drop)
  {
    //echo $mod_drop;
    $count = 0;
    $count ++;

    if($empty === "0") {
      echo '<li class="stageRow-' . $count . '" data-hover-tag="Row" data-editing-hover-tag="Editing Row" id="dropStage-' . $count . '">
      <style>.stageRow-' . $count . ' {
    transition: background-color 125ms ease-in-out;
    position: relative;
    clear: both;
    margin-left: 0;
    margin-bottom: 6px;
    background-color: #fff;
    padding: 5px;
    min-height: 34px;
    box-shadow: inset 0 0 0 1px #ccc;
}</style>';
    }else{
      echo '<li class="stageRow" data-hover-tag="Row" data-editing-hover-tag="Editing Row" id="dropStage">';
    }


    if($empty === "0") {
      echo '<div class="siderowActions-'. $count .' sidegroupActions item-handle" id="sideAction-'. $count .'"><style>
      .siderowActions-'. $count .' {
    width: 24px;
    height: 24px;
    left: -23px;
    text-align: right;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    transition: height .15s ease-in-out;
    white-space: normal;
    border: 1px solid #ccc;
    border-right: 1px solid #fff;
}
.siderowActions-'. $count .' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}</style>';
    }else{
      echo '<div class="siderowActions sidegroupActions item-handle" id="sideAction"><style>
      .siderowActions {
    width: 24px;
    height: 24px;
    left: -23px;
    text-align: right;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    transition: height .15s ease-in-out;
    white-space: normal;
    border: 1px solid #ccc;
    border-right: 1px solid #fff;
}
.siderowActions button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}</style>';
    }

    echo '<svg class="svg-icon icon-handle">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
    <svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
    <path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
    </svg>
    </use>
    </svg>';

    if($empty === "0") {
      echo '<div class="sideactionBtnWrapper hidden" id="sideactionBtnWrapper-'. $count .'">';
    }else{
      echo '<div class="sideactionBtnWrapper hidden" id="sideactionBtnWrapper">';
    }
    self::sideActionButtons($empty, $count, $mod_drop);
    echo '
    </div>
    </div>';
    if ($empty === "0") {
      echo '<div class="rowEdit groupConfig-'. $count.'"><style>.groupConfig {
    display: none;
    padding: .5rem;
}
.sidegroupActions-'. $count.' .icon-handle {
    opacity: .5;
}

.midrowActions-'. $count.' .item-handle .icon-handle {
    transform: rotate(90deg);
}

.midgroupActions-'. $count.' .icon-handle {
    opacity: .5;
}

.midgroupActions-'. $count.' {
    min-width: 24px;
    width: 24px;
    height: 24px;
    overflow: hidden;
    position: absolute;
    top: 0;
    line-height: 0;
    z-index: 1;
}

.midgroupActions-'. $count.' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}

.midrowActions-'. $count.' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}


.endrowActions-'. $count.' {
    width: 24px;
    height: 24px;
    left: -23px;
    text-align: right;
    border-top-left-radius: 6px;
    border-bottom-left-radius: 6px;
    transition: height .15s ease-in-out;
    white-space: normal;
    border: 1px solid #ccc;
    border-right: 1px solid #fff;
}

.endgroupActions-'. $count.' {
    min-width: 24px;
    width: 24px;
    height: 24px;
    overflow: hidden;
    position: absolute;
    top: 0;
    line-height: 0;
    z-index: 1;
}

.endgroupActions-'. $count.' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}

.endrowActions-'. $count.' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}

.stageColumn-'. $count.':last-of-type {
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
}

.stageColumn-'. $count.':first-of-type {
    border-top-right-radius: 5px;
}


.stageColumn-'. $count.'{
    margin: 0;
    padding: 0;
    list-style: none;
}

.stageColumn-'. $count.':before {
    transition-property: height;
    transition-duration: .15s;
    padding: 0 10px;
    left: 50%;
    top: 1px;
    transform: translate(-50%,-100%);
    width: auto;
    height: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
}

.columnsActions-'. $count.' {
    width: 24px;
    height: 24px;
    padding: 0;
    right: 50%;
    transform: translateX(12px);
    z-index: 1;
    transition: width .15s;
}


.groupActions-'. $count.' {
    min-width: 24px;
    width: 24px;
    height: 24px;
    overflow: hidden;
    position: absolute;
    top: 0;
    line-height: 0;
    z-index: 1;
}

.columnsActions-'. $count.' button{
    position: absolute;
    background-color: transparent;
    border-radius: 0;
}

.groupActions-'. $count.' button {
    width: 24px;
    height: 24px;
    padding: 6px;
    border: 0 none;
    line-height: 0;
    overflow: hidden;
    background-color: #fff;
}
</style>';
    }else{
      echo '<div class="rowEdit groupConfig">';
    }
    
      echo '<div class="fCheck">
        <label for="inputting">
          <input name="inputting" type="checkbox" aria=label="rowSeetingsInputGroupAria" id="inputGroup">
          <span class="checkable">Repeatable Region</span>
          </label>
        </div>
        <hr>
      <div class="FFieldGroup">
      <label>Wrap row in a <fieldset> tag</label>
      <div class="inputGroup">
      <span class="inputGroupAddon">
      <input name="checkboxX" type="checkbox" aria-label="wrap Row in Fieldset" id="fieldset">
      </span>
      <input name="legend" type="text" aria-label="Legend for fieldset" placeholder="legend" id="legend">
      </div>
      </div>
      <hr>
      <label>Define Column widths</label>
      <div class="FFieldGroupNew row">
      <label class="col-sm-4 form-control-label">Layout Preset</label>
      <div class="col-sm-8">
        <select name="column" aria-label="Define a column layout" class="columnPreset" id="preset">
        <option value="100.0" label="100%" selected="true">100%</option>
        </select>
        </div>
      </div>
    </div>';

        if($empty === "0") {
      echo '<script type="text/javascript">
      $("body").on("mouseenter","#sideAction-'. $count . '", function(){
    $("#sideactionBtnWrapper-'. $count . '").removeClass("hidden");
    $("#sideAction-'. $count . '").css("height", "82px");
    $(".stageRow-'. $count . '").addClass("hovering-row");
});

$("body").on("mouseleave","#sideAction-'. $count . '", function(){
    $("#sideAction-'. $count . '").css("height", "24px");
    $("#sideactionBtnWrapper-'. $count . '").addClass("hidden");
     $(".stageRow-'. $count . '").removeClass("hovering-row");
});</script>';
    }else{
      echo '<script type="text/javascript">
      $("body").on("mouseenter","#sideAction", function(){
    $("#sideactionBtnWrapper").removeClass("hidden");
    $("#sideAction").css("height", "82px");
    $(".stageRow").addClass("hovering-row");
});

$("body").on("mouseleave","#sideAction", function(){
    $("#sideAction").css("height", "24px");
    $("#sideactionBtnWrapper").addClass("hidden");
     $(".stageRow").removeClass("hovering-row");
});</script>';
    }


        if($empty === "0") {
      echo '<ul class="stageColumn" data-hover-tag="Column" id="columnx-'. $count . '" data-col-width="100%" style="width:100%; float:left;">';
    }else{
      echo '<ul class="stageColumn" data-hover-tag="Column" id="columnx" data-col-width="100%" style="width:100%; float:left;">';
    }

      if($empty === "0") {
      echo '<li class="columnsActions midgroupActions-'. $count . ' icon-handle" id="midActions-'. $count . '">';
    }else{
      echo '<li class="columnsActions midgroupActions icon-handle" id="midActions">';
    }

    echo '<svg class="svg-icon icon-handle">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
      <svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
      <path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
      </svg>
      </use>
      </svg>';

      if($empty === "0") {
      echo '<div class="midactionBtnWrapper hidden" id="midactionBtnWrapper-'. $count . '">';
    }else{
      echo '<div class="midactionBtnWrapper hidden" id="midactionBtnWrapper">';
    }
      $cloned = "no";
      self::midActionButtons($empty, $count, $mod_drop, $cloned);
      echo '
      </li>';
      if ($empty === "0") {
      echo '<li class="columnEdit groupConfig-'. $count.'"></li><style>.groupConfig {
    display: none;
    padding: .5rem;
}</style>';
    }else{
      echo '<li class="columnEdit groupConfig"></li>';
    }
      
      echo '<li class="resizeXHandle"></li>';

    if($empty === "0") {
      echo '<li class="stageFields-'. $count . ' fieldTypeButton firstField LastField" data-hover-tag="Field" id="Fields">';
    }else{
      echo '<li class="stageFields fieldTypeButton firstField LastField" data-hover-tag="Field" id="Fields">';
    }


    self::stageField($empty, $count, $mod_drop);

    echo '</ul>
    </li>';
  }


  public function attrsPanels()
  {
    echo '<div class="Fpanel attrsPanels">
      <div class="fPanelWrap">
      <ul class="fieldEditGroup fieldEditAttrs">
      <li class="attrsClassNameWrap propWrapper controlCount="1" id="PanelWrapers">
      <div class="propControls">
      <button type="button" class="propRemove propControls"></button>
      </div>
      <div class="propInputs">
      <div class="fieldGroup">
      <label for="className">Class</label>
      <select name="className" id="className">
        <option value="fBtnGroup">Grouped</option>
        <option value="FieldGroup">Un-Grouped</option>
        </select>
      </div>
      </div>
      </li>
      </ul>
      </div>
      <div class="panelActionButtons">
      <button type="button" class="addAttrs">+ Atrribute</button>
      </div>
      </div>';
  }

  public function optionsPanel()
  {
    echo '<div class="Fpanel optionsPanel">
      <div class="FpanelWrap">
        <ul class="fieldEditGroup fieldEditOptions">
          <li class="OptionsXWrapper propWrapper controlCount_2" id="propCont">
          <div class="propControls">
          <button type="button" class="propOrder propControls"></button>
          <button type="button" class="propOrder propControls"></button>
          </div>
          <div class="propInput FinputGroup">
          <input name="button" type="text" value="button" placeholder="label" id="buttons">
          <select name="button" id="buttonz">
          <option value="button" selected="true">appearing_button</option>
          <option value="reset">Reset</option>
          <option value="submit">Submit</option>
          </select>
          <select name="options" id="optional">
          <option selected="true">default</option>
          <option value="primary">Primary</option>
          <option value="error">Error</option>
          <option value="success">Success</option>
          <option value="warning">Warning</option>
          </select>
          </div>
          </li>
        </ul>
        </div>
        <div class="panelActionButtons">
        <button type="button" class="addOptions">+ Options</button>
        </div>
        </div>';
  }


  public function cloneColumn($empty)
  {

    $count = 0;
    $count ++;

    if($empty === "0") {
      echo '<ul class="stageColumn" data-hover-tag="Column" id="columnx-'. $count . '" data-col-width="100%" style="width:100%; float:left;">';
    }else{
      echo '<ul class="stageColumn" data-hover-tag="Column" id="columnx" data-col-width="100%" style="width:100%; float:left;">';
    }
          if($empty === "0") {
      echo '<li class="columnsActions midgroupActions icon-handle" id="midActions-'. $count . '">';
    }else{
      echo '<li class="columnsActions midgroupActions icon-handle" id="midActions">';
    }

    echo '<svg class="svg-icon icon-handle">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
      <svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
      <path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
      </svg>
      </use>
      </svg>';

      if($empty === "0") {
      echo '<div class="midactionBtnWrapper hidden" id="midactionBtnWrapper-'. $count . '">';
    }else{
      echo '<div class="midactionBtnWrapper hidden" id="midactionBtnWrapper">';
    }
      $cloned = "yes";
      self::midActionButtons($empty, $count, $mod_drop, $cloned);
      echo '
      </li>
      <li class="columnEdit groupConfig"></li>
      <li class="resizeXHandle"></li>';

    if($empty === "0") {
      echo '<li class="stageFields-'. $count . ' fieldTypeButton firstField LastField" data-hover-tag="Field" id="Fields">';
    }else{
      echo '<li class="stageFields fieldTypeButton firstField LastField" data-hover-tag="Field" id="Fields">';
    }


    self::stageField($empty, $count, $mod_drop);

    echo '</ul>';
  }

  public function sideActionButtons($empty, $count, $mod_drop)
  {
    echo '<ul>
    <li class="btn item icon-move-vertical vertical" title="move vertical">
    <svg class="svg-icon icon-move-vertical">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink="#icon-move-vertical">
    <svg viewBox="0 0 512 512" id="icon-move-vertical" width="100%" height="100%">
    <path d="M287.744 94.736V415.76h64.496L256 512l-96.256-96.24h64V94.736h-62.496L256 0l94.752 94.736z"></path>
    </svg>
    </use>
    </svg>
    </li>
    <li class="btn item item_editToggle" title="edit column" onclick="WIPageBuilder.sideeditColumn(';if($empty === "0") {echo "`stageField-". $count."`, `stageRow-". $count."`, `groupConfig-".$count."`, `midgroupActions-".$count."`";}else{echo "'stageField', 'stageRow', 'groupConfig' , 'midgroupActions' " ;}echo');");">
    <svg class="svg-icon icon-edit">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit">
    <svg viewBox="0 0 28 32" id="icon-edit" width="100%" height="100%">
    <path d="M22 2l-4 4 6 6 4-4-6-6zM0 24l.021 6.018L6 30l16-16-6-6L0 24zm6 4H2v-4h2v2h2v2z">
    </path>
    </svg>
    </use>
    </svg>
    </li>
    <li class="btn item item_clone" title="clone" onclick="WIPageBuilder.cloneRow(`'. $mod_drop.'`);">
    <svg class="svg-icon icon-copy">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
    <svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
    <path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z">
    </path>
    </svg>
    </use>
    </svg>
    </li>
    <li class="btn item item_remove" title="remove" onclick="WIPageBuilder.deleteRow(`';if($empty === "0") {echo "dropStage-". $count;}else{echo "dropStage";}echo'`);">
    <svg class="svg-icon icon-remove">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
    <svg viewBox="0 0 512 512"width="100%" height="100%">
    <path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
    <path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
    </svg>
    </use>
    </svg>
    </li>
    </ul>';
  }

    public function midActionButtons($empty, $count, $mod_drop, $cloned)
  {
    echo '<ul class="midAct">
      <li class="btn item-clone item" title="clone" onclick="WIPageBuilder.clonecolumn(`'. $mod_drop.'`);">
      <svg class="svg-icon icon-copy">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
      <svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
      <path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z"></path>
      </svg>
      </use>
      </svg>
      </li>
      <li class="btn itemHandle item" title="Move" onclick="WIPageBuilder.Move();">
      <svg class="svg-icon icon-move">
      <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-move">
      <svg viewBox="0 0 512 512" id="icon-move" width="100%" height="100%">
      <path d="M287.744 94.736v129.008h128v-64L512 256l-96.256 96.24v-65.488h-128V415.76h64.496L256 512l-96.256-96.24h64V286.752h-128v64.992L0 256l95.744-95.744v63.488h128V94.736h-62.496L256 0l94.752 94.736h-63.008z"></path>
      </use>
      </svg>
      </li>

          <li class="btn item_remove item" title="Remove" ';
          if($cloned === "yes"){
          echo 'onclick="WIPageBuilder.deleteRow(`';if($empty === "0") {echo "columnx-". $count;}else{echo "columnx";}echo'`);">';
          }else{
            echo 'onclick="WIPageBuilder.Removecol(`';if($empty === "0") {echo "dropStage-". $count;}else{echo "dropStage";}echo'`);">';
          }

          
    echo '<svg class="svg-icon icon-remove">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
    <svg viewBox="0 0 512 512"width="100%" height="100%">
    <path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
    <path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
    </svg>
    </use>
    </svg>
    </li>
      </ul>';

        if($empty === "0") {
      echo '<script type="text/javascript">
      $("body").on("mouseenter","#midActions-'.  $count. '", function(){
    $("#midactionBtnWrapper-'.  $count. '").removeClass("hidden");
    $("#midActions-'.  $count. '").css("height", "24px");
    $("#midActions-'.  $count. '").css("width", "100px");
     $("ul.midAct.item-clone").css("right", "5px");
    $("ul.midAct.item_remove").css("right", "67px");
     $("ul.midAct").css("width", "100px");
    $("#midActions-'.  $count. '").css("margin", "    margin: -1px -38px 0px 0px;");
    $(".stageRow-'. $count . '").addClass("hovering-column");
    $("#midActions-'.  $count. '").css("transform","translateX(50%");
});
$("body").on("mouseleave","#midActions-'.  $count. '", function(){
    $("#midActions-'.  $count. '").css("height", "24px");
    $("#midActions-'.  $count. '").css("width", "24px");
    $("#midactionBtnWrapper-'.  $count. '").addClass("hidden");
     $(".stageRow-'. $count . '").removeClass("hovering-column");
     $("#midActions-'.  $count. '").css("transform","translateX(12px)");
});</script>';
    }else{
  echo '<script type="text/javascript">
  $("body").on("mouseenter","#midActions", function(){
    $("#midactionBtnWrapper").removeClass("hidden");
    $("#midActions").css("height", "24px");
    $("#midActions").css("width", "100px");
    $("ul.midAct.item-clone").css("right", "5px");
     $("ul.midAct").css("width", "100px");
    $("ul.midAct.item_remove").css("right", "67px");
    $("#midActions").css("margin", "    margin: -1px -38px 0px 0px;");
    $(".stageRow").addClass("hovering-column");
    $("#midActions").css("transform","translateX(50%");
});
$("body").on("mouseleave","#midActions", function(){
    $("#midActions").css("height", "24px");
    $("#midActions").css("width", "24px");
    $("#midactionBtnWrapper").addClass("hidden");
     $(".stageRow").removeClass("hovering-column");
     $("#midActions").css("transform","translateX(12px)");
});</script>';
    }
  }

    public function endActionButtons($empty, $count, $mod_drop)
  {
    echo '<ul class="endAct">
    <li class="btn item_handle item">
    <svg class="svg-icon icon-move-vertical">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink="#icon-move-vertical">
    <svg viewBox="0 0 512 512" id="icon-move-vertical" width="100%" height="100%">
    <path d="M287.744 94.736V415.76h64.496L256 512l-96.256-96.24h64V94.736h-62.496L256 0l94.752 94.736z"></path>
    </svg>
    </use>
    </svg>
    </li>
    <li class="btn item_editToggle item" title="Edit Attributes" onclick="WIPageBuilder.editAttr("' . $mod_drop . '");">
    <svg class="svg-icon icon-edit">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit">
    <svg viewBox="0 0 28 32" id="icon-edit" width="100%" height="100%">
    <path d="M22 2l-4 4 6 6 4-4-6-6zM0 24l.021 6.018L6 30l16-16-6-6L0 24zm6 4H2v-4h2v2h2v2z">
    </path>
    </svg>
    </use>
    </svg>

    </li>
    <li class="btn item_clone item" title="Clone" onclick="WIPageBuilder.cloneRow(`'. $mod_drop.'`);">
    <svg class="svg-icon icon-copy">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
    <svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
    <path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z">
    </path>
    </svg>

    </use>
    </svg>
    </li>
    <li class="btn item_remove item" title="Remove" onclick="WIPageBuilder.deleteRow(`';if($empty === "0") {echo "dropStage-". $count;}else{echo "dropStage";}echo'`);">
    <svg class="svg-icon icon-remove">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
    <svg viewBox="0 0 512 512"width="100%" height="100%">
    <path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
    <path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
    </svg>
    </use>
    </svg>
    </li>
    </ul>';
  }

    public function Feature()
  {
    echo '<div class="fBtnGroup" id="notepad">
        <button type="button" id="buttonInput">Button</button>
        </div>';
  }

  public function stageField($empty, $count)
  {
    if($empty === "0") {
      echo '<div class="fieldActions endgroupActions-'. $count . '" id="endActions-'. $count . '">
      <style>
      .endgroupActions-'. $count . ' {
    min-width: 24px;
    width: 24px;
    height: 24px;
    overflow: hidden;
    position: absolute;
    top: 0;
    line-height: 0;
    z-index: 1;
}</style>';
    }else{
      echo '<div class="fieldActions endgroupActions" id="endActions">';
    }
          echo '<svg class="svg-icon icon-handle">
    <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
    <svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
    <path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
    </svg>
    </use>
    </svg>';

        if($empty === "0") {
      echo '<div class="endactionBtnWrapper hidden" id="endactionBtnWrapper-'. $count . '">';
    }else{
      echo '<div class="endactionBtnWrapper hidden" id="endactionBtnWrapper">';
    }

    self::endActionButtons($empty, $count);
      echo '
    </div>
    </div>
      <div class="fieldEdit slideToggle panelsWrap panelCount" style="display:none; position:relative; opacity:1; height:auto;">

          <script>
  $( function() {
    $( "#tabs7" ).tabs();
  } );
  </script>
<div class="well">
   

    <div id="tabs7">
  <ul>
    <li><a href="#tabs-1">Edit Modules</a></li>
    <li><a href="#tabs-2">Create Modules</a></li>
  </ul>
  <div id="tabs-1">';
  self::attrsPanels();
  echo '

  </div>
  <div id="tabs-2">';
  self::optionsPanel();
  echo '

  </div>

</div>

</div><style>.endgroupActions-'. $count . ' {
    min-width: 24px;
    width: 24px;
    height: 24px;
    overflow: hidden;
    position: absolute;
    top: 0;
    line-height: 0;
    z-index: 1;
}</style>';

      if($empty === "0") {
      echo '<script type="text/javascript">
      $("body").on("mouseenter","#endActions-'. $count . '", function(){
    $("#endactionBtnWrapper-'. $count . '").removeClass("hidden");
    $(".endgroupActions-'. $count . '").css("height", "24px");
    $(".endgroupActions-'. $count . '").css("width", "68px");
    $("ul.endAct").css("width", "56px");
    $(".stageRow-'. $count . '").addClass("hovering-row");
});
$("body").on("mouseleave","#endActions-'. $count . '", function(){
    $(".endgroupActions-'. $count . '").css("height", "24px");
    $(".endgroupActions-'. $count . '").css("width", "24px");
    $("#endactionBtnWrapper-'. $count . '").addClass("hidden");
     $(".stageRow-'. $count . '").removeClass("hovering-row");
});</script>';
    }else{
      echo '<script type="text/javascript">
      $("body").on("mouseenter","#endActions", function(){
    $("#endactionBtnWrapper").removeClass("hidden");
    $(".endgroupActions").css("height", "24px");
    $(".endgroupActions").css("width", "68px");
    $("ul.endAct").css("width", "56px");
    $(".stageRow").addClass("hovering-row");
});
$("body").on("mouseleave","#endActions", function(){
    $(".endgroupActions").css("height", "24px");
    $(".endgroupActions").css("width", "24px");
    $("#endactionBtnWrapper").addClass("hidden");
     $(".stageRow").removeClass("hovering-row");
});</script>';
    }

    if($empty === "0") {
      echo '<script type="text/javascript">// for highlight
$("body").on("mouseenter",".stageFields-'. $count . '", function(){
    $(this).addClass("hovering-field")
});

// remove highlight
$("body").on("mouseleave",".stageFields-'. $count . '", function(){
    $(".stageFields").removeClass("hovering-field")
});</script>';
    }else{
      echo '<script type="text/javascript">// for highlight
$("body").on("mouseenter",".stageFields", function(){
    $(this).addClass("hovering-field")
});

// remove highlight
$("body").on("mouseleave",".stageFields", function(){
    $(".stageFields").removeClass("hovering-field")
});</script>';
    }

        echo '</div>
        <div class="fieldPreview">'; 
        self::Feature();
        echo '</div>';
  }

}




