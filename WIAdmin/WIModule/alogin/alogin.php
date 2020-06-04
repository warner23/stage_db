<?php

/**
* 
*/
class alogin 
{
	

	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Web  = new WIWebsite();
		$this->site = new WISite();
		$this->mod  = new WIModules();
		$this->page = new WIPage();
		//$this->page = new WIPage();
	}

		

	public function editPageContent($page_id)
	{
       echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

    if(isset($page)){
    $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
    $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
    //echo $Panel;
    if ($left_sidePower > 0) {
      $this->mod->getMod($leftSideBar);
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 alogin">';
    }else{
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 center">';
    }

    }


 echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-left center"> 

<div class="col-md-6 login-panel"><a href="javascript:void(0)" class="btn" data-toggle="modal" data-target="#login-modal">Login</a></div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h1>Login to Your Account</h1><br>
          <form class="form-horizontal">
          <input type="text" id="username" name="user" placeholder="Username">
          <input type="password" id="password" name="pass" placeholder="Password">
          <input type="submit" id="admin_login" name="login" class="login loginmodal-submit" value="Login">
          <div class="aerror" id="aerror"></div>
          </form>

          
        
        </div>
      </div>
      </div>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/WICore.js"></script>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/WILogin.js"></script>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/sha512.js"></script>
<script src="WIAdmin/WICore/WIJ/WIUsers.js" type="text/javascript" charset="utf-8"></script>
</div>
</div>';

    if(isset($page)){     
    $right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
    $rightSideBar = $this->Web->PageMod($page, "right_sidebar");
    //echo $Panel;
    if ($right_sidePower > 0) {

      $this->mod->getMod($rightSideBar);
    }

    }     
          

  echo '</div>
      </div>
      </div>';
 

	}

	public function mod_name($module, $page)
	{

    echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';

    if(isset($page)){
    $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
    $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
    //echo $Panel;
    if ($left_sidePower > 0) {
      $this->mod->getMod($leftSideBar);
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 alogin">';
    }else{
      echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 center">';
    }

    }


 echo '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-left center"> 

<div class="col-md-6 login-panel"><a href="javascript:void(0)" class="btn" data-toggle="modal" data-target="#login-modal">Login</a></div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h1>Login to Your Account</h1><br>
				  <form class="form-horizontal">
					<input type="text" id="username" name="user" placeholder="Username">
					<input type="password" id="password" name="pass" placeholder="Password">
					<input type="submit" id="admin_login" name="login" class="login loginmodal-submit" value="Login">
          <div class="aerror" id="aerror"></div>
				  </form>

					
				
				</div>
			</div>
		  </div>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/WICore.js"></script>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/WILogin.js"></script>
      <script type="text/javascript" src="WIAdmin/WICore/WIJ/sha512.js"></script>
<script src="WIAdmin/WICore/WIJ/WIUsers.js" type="text/javascript" charset="utf-8"></script>
</div>
</div>';

		if(isset($page)){			
		$right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
		$rightSideBar = $this->Web->PageMod($page, "right_sidebar");
		//echo $Panel;
		if ($right_sidePower > 0) {

			$this->mod->getMod($rightSideBar);
		}

		}			
					

	echo '</div>
			</div>
      </div>';
	}


}