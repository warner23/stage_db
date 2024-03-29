<?php

/**
* 
*/
class Theatres 
{
	

	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Web  = new WIWebsite();
		$this->site = new WISite();
		$this->mod  = new WIModules();
		$this->page = new WIPage();
		$this->login = new WILogin();
		$url = $_SERVER['PHP_SELF'];

		if (strpos($url,'WIAdmin') !== false) {
    $this->user   = new WIAdmin(WISession::get('user_id'));
	} else {
		 //$this->user   = new WIAdmin(WISession::get('user_id'));
	    $this->user   = new WIUser(WISession::get('user_id'));
	}

        
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
';

echo '<div class="container-fluid text-center">    
  <div class="row content">

	<div class="col-lg-12 col-md-12 col-sm-12" >
						<div class="col-lg-12 col-md-12 col-sm-12" >

						 <div class="col-lg-12 col-md-12 col-sm-12 text-left"> 
							<div class="intro_box">
<h1>' .WILang::get("welcome_") . '<span>'. $this->site->Website_Info('site_name') . '</span></h1>
							<p>' . WILang::get("main_title") . '</p>
							</div>
						</div>
					</div>
				
					<div class="col-lg-4 col-md-4 col-sm-4" >
						<div class="services">
							<div class="icon">
								<i class="fa fa-laptop"></i>
							</div>
							<div class="serv_detail">
								<h3>' . WILang::get("community") . '</h3>
								<p>' . WILang::get("learn") . '
</p>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4">
						<div class="services">
							<div class="icon">
								<i class="fa fa-trophy"></i>
							</div>
							<div class="serv_detail">
								<h3>' . WILang::get("software") . '</h3>
								<p>' .WILang::get("software") . '
</p>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-4 col-sm-4" >
						<div class="services">
							<div class="icon">
								<i class="fa fa-cogs"></i>
							</div>
							<div class="serv_detail">
								<h3>' . WILang::get("it") . '</h3>
								<p>' . WILang::get("it_title")  . '
</p>
							</div>
						</div>
					</div>
					</div>
					


    
				</div>
			</div>';


		echo '</div>';
	}

	public function editPageContent($page_id)
	{
	//echo $page;
		echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

		if(isset($page)){
			$right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
		$rightSideBar = $this->Web->PageMod($page, "right_sidebar");
		$left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
		$leftSideBar = $this->Web->PageMod($page, "left_sidebar");
		//echo $Panel;
		if ($left_sidePower > 0) {
			$this->mod->getMod($leftSideBar);
			echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">';
		}elseif ( $right_sidePower > 0){
			echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">';
		}else{
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">';
		}

		}

echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>';

if($this->user->isAdmin()){

		echo '<div class="type">
<div class="showsSelect" id="shows_post" title="Choose Post" onclick="WIFrontSideEditing.type()">
<i class="fa fa-th"></i>
</div>	

<div class="admin_post hidden">
<ul>
	<li class="shows_type" title="Add Theatres"><a href="javascript:void(0)"  onclick="WIFrontSideEditing.theatre(`';echo $this->user->getRole(); echo'`)"><i class="icon-theatre" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add show"><a href="javascript:void(0)" onclick="WIFrontSideEditing.show(`'; echo $this->user->getRole(); echo'`)"><i class="icon-shows" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add companies"><a href="javascript:void(0)" onclick="WIFrontSideEditing.company(`'; echo $this->user->getRole(); echo'`)"><i class="icon-company" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add actor"><a href="javascript:void(0)"  onclick="WIFrontSideEditing.actor(`'; echo $this->user->getRole(); echo '`)"><i class="icon-actor" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add crew"><a href="javascript:void(0)" onclick="WIFrontSideEditing.crew(`'; echo $this->user->getRole(); echo '`)"><i class="icon-crew" aria-hidden="true"></i></a></li>
</ul>
</div>
	</div>';
	} else {
        echo '<div class="type">
</div>';	
       }

       echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	
	<div class="shows_style" id="shows_style">
		
	</div>	

  <div class="shows_style" id="shows">							
						
	</div>	';
	//$this->Shows->Shows();
		echo '</div></div>
	</div><script type="text/javascript" src="WICore/WIJ/WITheatres.js"></script>
	<script type="text/javascript" src="WICore/WIJ/WIMedia.js"></script>';

		
		//echo $Panel;
		if ($right_sidePower > 0) {
			$this->mod->getMod($rightSideBar);
		}
					

	echo '</div>
			</div></div>';

	}

	public function mod_name($module, $page)
	{
		//echo $page;
		echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

		if(isset($page)){
			$right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
		$rightSideBar = $this->Web->PageMod($page, "right_sidebar");
		$left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
		$leftSideBar = $this->Web->PageMod($page, "left_sidebar");
		//echo $Panel;
		if ($left_sidePower > 0) {
			$this->mod->getMod($leftSideBar);
			echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">';
		}elseif ( $right_sidePower > 0){
			echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-left">';
		}else{
			echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-left">';
		}

		}

echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <div class="btn-group">
            <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
            </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                class="glyphicon glyphicon-th"></span>Grid</a>
        </div>';

if($this->user->isAdmin()){

		echo '<div class="type">
<div class="showsSelect" id="shows_post" title="Choose Post" onclick="WIFrontSideEditing.type()">
<i class="fa fa-th"></i>
</div>	

<div class="admin_post hidden">
<ul>
	<li class="shows_type" title="Add Theatres"><a href="javascript:void(0)"  onclick="WIFrontSideEditing.theatre(`';echo $this->user->getRole(); echo'`)"><i class="icon-theatre" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add show"><a href="javascript:void(0)" onclick="WIFrontSideEditing.show(`'; echo $this->user->getRole(); echo'`)"><i class="icon-shows" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add companies"><a href="javascript:void(0)" onclick="WIFrontSideEditing.company(`'; echo $this->user->getRole(); echo'`)"><i class="icon-company" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add actor"><a href="javascript:void(0)"  onclick="WIFrontSideEditing.actor(`'; echo $this->user->getRole(); echo '`)"><i class="icon-actor" aria-hidden="true"></i></a></li>
	<li class="shows_type" title="Add crew"><a href="javascript:void(0)" onclick="WIFrontSideEditing.crew(`'; echo $this->user->getRole(); echo '`)"><i class="icon-crew" aria-hidden="true"></i></a></li>
</ul>
</div>
	</div>';
	} else {
        echo '<div class="type">
</div>';	
       }

       echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
	
	<div class="shows_style" id="shows_style">
		
	</div>	

  <div class="shows_style" id="shows">							
						
	</div>	';
	//$this->Shows->Shows();
		echo '</div></div>
	</div><script type="text/javascript" src="WICore/WIJ/WITheatres.js"></script>
	<script type="text/javascript" src="WICore/WIJ/WIMedia.js"></script>';

		
		//echo $Panel;
		if ($right_sidePower > 0) {
			$this->mod->getMod($rightSideBar);
		}
					

	echo '</div>
			</div></div>';
	}


}