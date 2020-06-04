<li class="stageRow" data-hover-tag="Row" data-editing-hover-tag="Editing Row" id="dropStage">
		<div class="siderowActions sidegroupActions item-handle">
		<svg class="svg-icon icon-handle">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
		<svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
		<path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
		</svg>
		</use>
		</svg>
			<div class="sideactionBtnWrapper hidden">
			<ul>
		<li class="btn item icon-move-vertical" title="move vertical">
		<svg class="svg-icon icon-move-vertical">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink="#icon-move-vertical">
		<svg viewBox="0 0 512 512" id="icon-move-vertical" width="100%" height="100%"
		<path d="M287.744 94.736V415.76h64.496L256 512l-96.256-96.24h64V94.736h-62.496L256 0l94.752 94.736z"></path>
		</svg>
		</use>
		</svg>
		</li>
		<li class="btn item item_editToggle" title="edit column" onclick="WIPageBuilder.sideeditColumn();">
		<svg class="svg-icon icon-edit">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit">
		<svg viewBox="0 0 28 32" id="icon-edit" width="100%" height="100%">
		<path d="M22 2l-4 4 6 6 4-4-6-6zM0 24l.021 6.018L6 30l16-16-6-6L0 24zm6 4H2v-4h2v2h2v2z">
		</path>
		</svg>
		</use>
		</svg>
		</li>
		<li class="btn item item_clone" title="column">
		<svg class="svg-icon icon-copy">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
		<svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
		<path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z">
		</path>
		</svg>
		</use>
		</svg>
		</li>
		<li class="btn item item_remove" title="remove">
		<svg class="svg-icon icon-remove">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
		<svg viewBox="0 0 512 512"width="100%" height="100%">
		<path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
		<path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
		</svg>
		</use>
		</svg>
		</li>
		</ul>
		</div>
		</div>
		<div class="rowEdit groupConfig">
			<div class="fCheck">
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
		</div>

		<ul class="stageColumn" data-hover-tag="Column" id="columnx" data-col-width="100%" style="width:100%; float:left;">
			<li class="columnsActions midgroupActions icon-handle" id="midActions">
						<svg class="svg-icon icon-handle">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
			<svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
			<path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
			</svg>
			</use>
			</svg>
			<div class="midactionBtnWrapper hidden">
			<ul>
			<li class="btn
			itemClone item">
			<svg class="svg-icon icon-copy">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
			<svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
			<path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z"></path>
			</svg>
			</use>
			</svg>
			<li class="btn itemHandle item">
			<svg class="svg-icon icon-move">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-move">
			<svg viewBox="0 0 512 512" id="icon-move" width="100%" height="100%">
			<path d="M287.744 94.736v129.008h128v-64L512 256l-96.256 96.24v-65.488h-128V415.76h64.496L256 512l-96.256-96.24h64V286.752h-128v64.992L0 256l95.744-95.744v63.488h128V94.736h-62.496L256 0l94.752 94.736h-63.008z"></path>
			</use>
			</svg>
			<svg class="svg-icon icon-handle item">
			<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
			<svg viewBox="0 0 16 16" id="icon-handle" height="100%" width="100%">
			<path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
			</svg>
			</use>
			</svg>
			</li>
					<li class="btn item_remove item">
		<svg class="svg-icon icon-remove">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
		<svg viewBox="0 0 512 512"width="100%" height="100%">
		<path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
		<path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
		</svg>
		</use>
		</svg>
		</li>
			</li>
			</ul>
			</li>
			<li class="columnEdit groupConfig"></li>
			<li class="resizeXHandle"></li>
			<li class="stageFields fieldTypeButton firstField LastField" data-hover-tag="Field" id="Fields">

			<li class="fieldActions endgroupActions" id="endActions">
					<svg class="svg-icon icon-handle">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-handle">
		<svg viewBox="0 0 16 16" id="icon-handle" width="100%" height="100%">
		<path d="M2 5h2v2H2zm5 0h2v2H7zm5 0h2v2h-2zM2 9h2v2H2zm5 0h2v2H7zm5 0h2v2h-2z"></path>
		</svg>
		</use>
		</svg>
			<div class="endactionBtnWrapper hidden">
			<ul>
		<li class="btn item_handle item">
		<svg class="svg-icon icon-move-vertical">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink="#icon-move-vertical">
		<svg viewBox="0 0 512 512" id="icon-move-vertical" width="100%" height="100%"
		<path d="M287.744 94.736V415.76h64.496L256 512l-96.256-96.24h64V94.736h-62.496L256 0l94.752 94.736z"></path>
		</svg>
		</use>
		</svg>
		<li class="btn item_editToggle item" onclick="WIPageBuilder.editAttr();">
		<svg class="svg-icon icon-edit">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-edit">
		<svg viewBox="0 0 28 32" id="icon-edit" width="100%" height="100%">
		<path d="M22 2l-4 4 6 6 4-4-6-6zM0 24l.021 6.018L6 30l16-16-6-6L0 24zm6 4H2v-4h2v2h2v2z">
		</path>
		</svg>
		</use>
		</svg>

		</li>
		<li class="btn item_clone item">
		<svg class="svg-icon icon-copy">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-copy">
		<svg viewBox="0 0 32 32" id="icon-copy" width="100%" height="100%">
		<path d="M20 8V0H6L0 6v18h12v8h20V8H20zM6 2.828V6H2.828L6 2.828zM2 22V8h6V2h10v6l-6 6v8H2zm16-11.172V14h-3.172L18 10.828zM30 30H14V16h6v-6h10v20z">
		</path>
		</svg>

		</use>
		</svg>
		</li>
		<li class="btn item_remove item">
		<svg class="svg-icon icon-remove">
		<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-remove">
		<svg viewBox="0 0 512 512"width="100%" height="100%">
		<path d="M44.491 106.237l61.746-61.746L467.51 405.763l-61.746 61.746z"></path>
		<path d="M405.763 44.491l61.746 61.746L106.237 467.51l-61.746-61.746z"></path>
		</svg>
		</use>
		</svg>
		</li>
		</ul>
		</div>
		</div>
		</li>
			<div class="fieldEdit slideToggle panelsWrap panelCount" style="display:none; position:relative; opacity:1; height:auto;">

			<nav class="panel-nav">
			<button class="prev-group" title="previous group"  type="button" data-toggle="tooltip"data-placement="top"></button>
			<div class="panel-labels">
			<div class="options">
			<h5 class="active-tab">Attrs</h5>
			<h5>Options</h5>
			</div>
			</div>
			<button class="next-group" title="Next group"  type="button" data-toggle="tooltip"data-placement="top"></button>
			</nav>
			
			<div class="panels" style="height:116.313px;">
			<div class="Fpanel attrsPanels">
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
			</div>
			<div class="Fpanel optionsPanel">
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
				</div>
				</div>



				</div>
				<div class="fieldPreview">
				<div class="fBtnGroup">
				<button type="button" id="buttonInput">Button</button>
				</div>
				</div>
				</li>
		 </ul>




		</li>

