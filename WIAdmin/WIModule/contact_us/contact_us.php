<?php

/**
* 
*/
class contact_us 
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
		// include_once '../../WIInc/WI_StartUp.php';
echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 about min_height">';

    if(isset($page)){
    $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
    $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
    //echo $Panel;
    if ($left_sidePower > 0) {
      $this->mod->getMod($leftSideBar);
      echo '<div class="col-lg-8 col-md-8 col-sm-8 contact">';
    }else{
      echo '<div class="col-lg-8 col-md-8 col-sm-8 center">';
    }

    }
    
    echo ' 
   
        <style type="text/css">
     .hide{
      display: none;
     }   

     .contact{
      background-color: white;
     }

     .center{
      margin-left:65px;
     }
      </style>

<div class="col-lg-8 col-md-8 col-sm-8 center">           
  <div class="title_content">             
 <h3>';$this->mod->module($module, 'text'); echo '</h3>           
  </div>            
  <p>';$this->mod->module($module, 'text1'); echo '</p> 
                      
  <div class="alert alert-success hidden alert-dismissable" id="contactSuccess">              
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>             
   <strong>Success!</strong> Your message has been sent to us.            
   </div>                       
   <div class="alert alert-danger hidden" id="contactError">              
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>            
    <strong>Error!</strong> <span class="errorMessage">There was an error sending your message.</span>            
    </div>                        
    <form id="contactForm" novalidate="novalidate" class="Contact">             
    <div class="row">               
    <div class="form-group">                  
    <div class="col-lg-6 col-md-6 col-sm-6">                    
    <input type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Please enter your name." value="" placeholder="Your Name" required >                 
    </div>                  
    <div class="col-lg-6 col-md-6 col-sm-6">                    
    <input type="email" id="email" name="email" class="form-control" maxlength="100" data-msg-email="Please enter a valid email address." data-msg-required="Please enter your email address." value="" placeholder="Your E-mail" required>                 
    </div>                
    </div>              
    </div>              
    <div class="row">               
    <div class="form-group">                  
    <div class="col-md-12 col-lg-12 col-sm-12">                   
    <input type="text" id="subject" name="subject" class="form-control" maxlength="100" data-msg-required="Please enter the subject." value="" placeholder="Subject" required>                  
    </div>                
    </div>              
    </div>              
    <div class="row mrgb_20">               
    <div class="form-group">                  
    <div class="col-md-12 col-lg-12 col-sm-12">                   
    <textarea id="message" name="message" rows="8" cols="50" data-msg-required="Please enter your message." maxlength="5000" placeholder="Type your message here." required></textarea>                                     
    </div>                
    </div>              
    </div>              
    <div class="row">               
    <div class="col-md-12 col-lg-12 col-sm-12">                 
    <input type="submit" data-loading-text="Loading..." class="btn btn-primary" id="contact" value="Send Message">                
    </div>  
                
    </div>            
    </form>
      </div>  
    </div>
    <!-- End Contact Page -->
    <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>
    <script type="text/javascript" src="WICore/WIJ/WIContacts.js"></script>';

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
  <div class="col-lg-12 col-md-12 col-sm-12 about min_height">';

    if(isset($page)){
    $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
    $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
    //echo $Panel;
    if ($left_sidePower > 0) {
      $this->mod->getMod($leftSideBar);
      echo '<div class="col-lg-8 col-md-8 col-sm-8 contact">';
    }else{
      echo '<div class="col-lg-8 col-md-8 col-sm-8 center">';
    }

    }
		
		echo ' 
   
				<style type="text/css">
     .hide{
      display: none;
     }   

     .contact{
      background-color: white;
     }

     .center{
      margin-left:65px;
     }
      </style>

<div class="col-lg-8 col-md-8 col-sm-8 center">  					
  <div class="title_content">							
 <h3>';$this->mod->module($module, 'text'); echo '</h3> 					
  </div>						
  <p>';$this->mod->module($module, 'text1'); echo '</p>	
											
  <div class="alert alert-success hidden alert-dismissable" id="contactSuccess">						  
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>						 
   <strong>Success!</strong> Your message has been sent to us.						
   </div>												
   <div class="alert alert-danger hidden" id="contactError">						  
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>						 
    <strong>Error!</strong> <span class="errorMessage">There was an error sending your message.</span>						
    </div>												
    <form id="contactForm" novalidate="novalidate" class="Contact">							
    <div class="row">								
    <div class="form-group">									
    <div class="col-lg-6 col-md-6 col-sm-6">										
    <input type="text" id="name" name="name" class="form-control" maxlength="100" data-msg-required="Please enter your name." value="" placeholder="Your Name" required >									
    </div>									
    <div class="col-lg-6 col-md-6 col-sm-6">										
    <input type="email" id="email" name="email" class="form-control" maxlength="100" data-msg-email="Please enter a valid email address." data-msg-required="Please enter your email address." value="" placeholder="Your E-mail" required>									
    </div>								
    </div>							
    </div>							
    <div class="row">								
    <div class="form-group">									
    <div class="col-md-12 col-lg-12 col-sm-12">										
    <input type="text" id="subject" name="subject" class="form-control" maxlength="100" data-msg-required="Please enter the subject." value="" placeholder="Subject" required>									
    </div>								
    </div>							
    </div>							
    <div class="row mrgb_20">								
    <div class="form-group">									
    <div class="col-md-12 col-lg-12 col-sm-12">										
    <textarea id="message" name="message" rows="8" cols="50" data-msg-required="Please enter your message." maxlength="5000" placeholder="Type your message here." required></textarea>																			
    </div>								
    </div>							
    </div>							
    <div class="row">								
    <div class="col-md-12 col-lg-12 col-sm-12">									
    <input type="submit" data-loading-text="Loading..." class="btn btn-primary" id="contact" value="Send Message">								
    </div>	
    		  			
    </div>						
    </form>
      </div>	
    </div>
    <!-- End Contact Page -->
    <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>
    <script type="text/javascript" src="WICore/WIJ/WIContacts.js"></script>';

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