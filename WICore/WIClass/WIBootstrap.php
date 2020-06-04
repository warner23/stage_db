<?php

/**
* WIBootstrap Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WIBootstrap {

    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $this->Page = new WIPagination();
        $this->mod = new WIModules();
        $this->Web = new WIWebsite();
    }

    public function Edit($page, $args , $Id)
    {
        
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
            echo '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 text-left">';
       }else{
            echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">';
        }

        }

        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
             $ele = $args[0]['mod_name_function'];
   $elements = explode(",", $ele);
   
    //var_dump($elements);
            foreach ($elements as $element) {
            include_once dirname(dirname(dirname(__FILE__))) .'/WIModule/Elements/' . $element .'/' . $element .'.php';
 $element = new $element;
  $element->edit($Id); 
        }
        echo '</div>
        </div>';

        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo '</div>
            </div></div>';

    }


     public function EditContent($page, $args , $Id)
    {

    echo '<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
        if(isset($page)){
            $right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
        $rightSideBar = $this->Web->PageMod($page, "right_sidebar");
        $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
        $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
        if ($left_sidePower > 0) {
            $this->mod->getMod($leftSideBar);
        echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">';
        }elseif ( $right_sidePower > 0){
        echo '<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">';
       }else{
        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">';
        }

        }

        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
             $ele = $args[0]['mod_name_function'];
   $elements = explode(",", $ele);
   
    //var_dump($elements);
            foreach ($elements as $element) {
            include_once dirname(dirname(dirname(__FILE__))) .'/WIModule/Elements/' . $element .'/' . $element .'.php';
 $element = new $element;
  $element->editContens($Id); 
        }
        echo '</div>
        </div>';


    
        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo "</div>
            </div></div>";


    }


    public function createModule($module, $page, $args)
    {
        //var_dump($args);
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
        echo '<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 text-left">';
        }else{
        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">';
        }

        }

        echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
                        //var_dump($args);
                        foreach ($args as $arg) {
                            $ele = $arg['mod_name_function'];
                        $Id = $arg['id'];
                         } 
                        
   $elements = explode(",", $ele);
   
    //var_dump($elements);
            foreach ($elements as $element) {
            include_once dirname(dirname(dirname(__FILE__))) .'/WIAdmin/WIModule/Elements/' . $element .'/' . $element .'.php';
 $element = new $element();
  $element->front_page($Id); 
        }
        echo '</div>
        </div>';


        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo "</div>
            </div></div>";
    }


    
   

} 