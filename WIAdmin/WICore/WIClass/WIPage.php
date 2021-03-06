<?php

/**
* Pages Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WIPage
{
	function __construct() {
       $this->WIdb = WIdb::getInstance();
    }


          public function findPage()
    {

        $sql = "SELECT * FROM `wi_page`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();
         echo '<ul class="page_link_list">';
        while ($res = $query->fetch()) {

            echo '<a class="col-lg-4 col-md-3 col-xs-3 col-sm-3"  href="javascript:void(0);" id="' . $res['name'] . '" onclick="WIMenu.placelink(`' . $res['name'] . '`);">
            <li class="col-lg-4 col-dm-4 col-xs-4 col-sm-4">
            <div class="col-lg-2 col-dm-3 col-xs-3 col-sm-3">
                          ' .  $res['name'] . '
              </div>
              </li></a>';
        }
        echo '</ul>';

    }

    public function Pages()
	{
		$dir = "../";
		//echo $dir;
    	$filelist = glob($dir."*.php");
    	//var_dump($filelist);
    	echo '<ul>';
    	foreach ($filelist as $file => $value) {
    		echo '<a class="hover_link" href="WIEditpage.php"><li id="' . $file . '">' .  basename($value) . '</a></li>';
    	}
    	echo '</ul>';
    }
    



        public function PageListings2()
    {
        $sql = "SELECT * FROM `wi_page`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();
         echo '<ul>';
        while ($res = $query->fetch()) {
            echo '<li id="' . $res['id'] . '"><a class="page" id="' . $res['id'] . '""  href="WIEditpage.php">' .  $res['name'] . '</a></li>';
        }
        echo '</ul>';

    }

        public function PageListings()
    {

        $sql = "SELECT * FROM `wi_page`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();
         echo '<ul>';
        while ($res = $query->fetch()) {

            echo '<li class="col-lg-12 col-dm-12 col-xs-12 col-sm-12"><div class="col-lg-2 col-dm-3 col-xs-3 col-sm-3">
                              ' .  $res['name'] . '
                            </div>
<div class="col-lg-2 col-dm-3 col-xs-3 col-sm-3">
                              <a class="col-lg-4 col-dm-3 col-xs-3 col-sm-3 page" href="javascript:void(0)"  onclick="WIPages.href(`' .  $res['name'] . '`);" id="' . $res['name'] . '">' .  $res['name'] . '</a>
                            </div>
                            <div class="col-lg-2 col-dm-3 col-xs-3 col-sm-3">
                              <a class="col-lg-2 col-dm-3 col-xs-3 col-sm-3 page"><button type="button" class="close" onclick="WIPages.Open(' . $res['id'] . ', `' . $res['name'] . '`)" data-dismiss="modal" aria-hidden="false">&times;</button></a>
                            </div>
                            
                            </li>
              
            ';
        }
        echo '</ul>';

    }



    public function PageInfo($page_id)
    {
     $sql = "SELECT * FROM `wi_page` WHERE `id` =:page";
     $query = $this->WIdb->prepare($sql);
     $query->bindParam(':page', $page_id, PDO::PARAM_INT);
     $query->execute();

     while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
        $name = $res['name'];
              echo  $name;
          }     

    }

    public function LoadPage($page_id)
    {
     // echo $page_id;
     $sql = "SELECT * FROM `wi_page` WHERE `name` =:page";
     $query = $this->WIdb->prepare($sql);
     $query->bindParam(':page', $page_id, PDO::PARAM_STR);
     $query->execute();

     $res = $query->fetch(PDO::FETCH_ASSOC);
        $name = $res['contents'];
        if ($name === '') {
          echo "<div class='empty' id='notAssigned'>No Module Assigned to this page yet, please drop a module into your page to assign.</div>";
        }else{
        $directory = dirname(dirname(dirname(__FILE__)));
//include_once  $directory . '/WIInc/edit/' . $page_id . '.php' ;
      //echo  '/WIModule/' .$name.'/'.$name.'.php';
      require_once  $directory . '/WIModule/' .$name.'/'.$name.'.php';
        $name = new $name;

        $name->editPageContent($page_id); 
        }

  
    }

    public function LoadMetaPage($page_id)
    {
      //echo "page " . $page_id;
           $sql = "SELECT * FROM `wi_meta` WHERE `page` =:page";
     $query = $this->WIdb->prepare($sql);
     $query->bindParam(':page', $page_id, PDO::PARAM_STR);
     $query->execute();

      echo '<ul class="meta">';
    
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            echo ' <li class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
             
                            <div class="controls col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['name'].'</div>
                            </div>
                    

                            
                            <div class="controls col-sm-4 col-md-4 col-lg-4 col-xs-4">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['content'].' </div>
                                
                            </div>

                            
                            <div class="controls col-sm-3 col-md-3 col-lg-3 col-xs-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['author'].'</div>
                            </div>
                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2"><a href="#" onclick="WIMeta.showMetaModal(' . $result['meta_id'].')">Edit</a></div>

                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"><a href="#" onclick="WIMeta.DeleteMetaModal(' . $result['meta_id'].')">Delete</a></div>
                            
                            </li>';
        }
        echo '<ul>';
      
    }

        public function LoadCssPage($page_id)
    {
      //echo "page " . $page_id;
           $sql = "SELECT * FROM `wi_css` WHERE `page` =:page";
     $query = $this->WIdb->prepare($sql);
     $query->bindParam(':page', $page_id, PDO::PARAM_STR);
     $query->execute();

      echo '<ul class="css">';
    
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            echo ' <li class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
             
                            <div class="controls col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-6">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['href'].'</div>
                            </div>
                    

                            
                            <div class="controls col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xs-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['rel'].' </div>
                                
                            </div>

                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2"><a href="#" onclick="WICSS.showCssModal(' . $result['id'].')">Edit</a></div>

                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"><a href="#" onclick="WICSS.DeleteCssModal(' . $result['id'].')">Delete</a></div>
                            
                            </li>';
        }
        echo '<ul>';
      
    }

        public function LoadJsPage($page_id)
    {
      //echo "page " . $page_id;
           $sql = "SELECT * FROM `wi_scripts` WHERE `page` =:page";
     $query = $this->WIdb->prepare($sql);
     $query->bindParam(':page', $page_id, PDO::PARAM_STR);
     $query->execute();

      echo '<ul class="js">';
    
        while($result = $query->fetch(PDO::FETCH_ASSOC)){
            echo ' <li class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
             
                            <div class="controls col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xs-8">
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">' . $result['src'].'</div>
                            </div>
                    
                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-2"><a href="#" onclick="WIMeta.showMetaModal(' . $result['id'].')">Edit</a></div>

                                <div class="col-sm-1 col-md-1 col-lg-1 col-xs-1"><a href="#" onclick="WIMeta.DeleteMetaModal(' . $result['id'].')">Delete</a></div>
                            
                            </li>';
        }
        echo '<ul>';
      
    }



    public function newPage($pageName, $menu)
    {
      $directory = dirname(dirname(dirname(dirname(__FILE__))));
     // echo $directory.$pageName;
      $NewPage = fopen($directory. '/'  .$pageName .'.php', "w") or die("Unable to open file!");
      $txt = '<?php
$page = "'. $pageName .'";

include_once "WIInc/WI_StartUp.php";

$ref = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";

$agent = $_SERVER["HTTP_USER_AGENT"];
$ip = $_SERVER["REMOTE_ADDR"];


$tracking_page = $_SERVER["SCRIPT_NAME"];

$country = $maint->ip_info($ip, "country");
if($country === null){
  $country = "localhost";
}

$maint->visitors_log($page, $ip, $country, $ref, $agent, $tracking_page);

$panelPower = $web->pageModPower($page, "panel");
$Panel = $web->PageMod($page, "panel");
if ($panelPower > 0) {
  $mod->getMod($Panel);
}

$topPower = $web->pageModPower($page, "top_head");
$top_head = $web->PageMod($page, "top_head");
if ($topPower > 0) {
  $mod->getMod($top_head);
}
$headerPower = $web->pageModPower($page, "header");
if ($headerPower > 0) {
  $web->MainHeader();
}

$web->MainMenu(); 

$contents = $web->pageModPower($page, "contents");
$mod->getModMain($contents, $page, $contents);

$web->footer();
?>
</body>
</html>
';
      fwrite($NewPage, $txt);
      fclose($NewPage);

       $cssCheck = self::CssCheck($pageName);
      $JsCheck = self::JsCheck($pageName);
      $MetaCheck = self::MetaCheck($pageName);
      $pageCheck = self::pageCheck($pageName);
      if ($cssCheck === "0") {
        
        $css = "INSERT INTO `wi_css` ( `href`, `rel`, `page`) VALUES
      ( 'site/css/frameworks/bootstrap.css', 'stylesheet', '" . $pageName . "'),
      ( 'site/css/login_panel/css/slide.css', 'stylesheet', '" . $pageName . "'),
      ( 'site/css/frameworks/menus.css', 'stylesheet', '" . $pageName . "'),
      ( 'site/css/style.css', 'stylesheet', '" . $pageName . "'),
      ( 'site/css/font-awesome.css', 'stylesheet', '" . $pageName . "'),
      ( 'site/css/vendor/bootstrap.min.css', 'stylesheet', '" . $pageName . "');";

      $query = $this->WIdb->prepare($css);
        $query->execute();

      }

      if ($JsCheck === "0") {
        $js = "INSERT INTO `wi_scripts` ( `src`, `page`) VALUES
      ( 'site/js/frameworks/JQuery.js', '" . $pageName . "'),
      ( 'site/js/frameworks/bootstrap.js', '" . $pageName . "'),
      ( 'site/js/login_panel/js/slide.js', '" . $pageName . "');
      ";

      $query = $this->WIdb->prepare($js);
        $query->execute();
      }

      if ($MetaCheck === "0") {
        $Meta = "INSERT INTO `wi_meta` ( `page`, `name`, `content`, `author`) VALUES
      ( '" . $pageName . "', 'viewport', 'width=device-width, initial-scale=1', 'Jules Warner'),
      ( '" . $pageName . "', 'description', 'Warner-Infinity Content Management System with simplified back end', 'Jules Warner'),
      ( '" . $pageName . "', 'keywords', 'WI, WICMS, System, UI', 'Jules Warner'),
      ( '" . $pageName . "', 'author', 'warner-infinity', 'Jules Warner');
      ";
      
      $query = $this->WIdb->prepare($Meta);
        $query->execute();
      }

      if ($pageCheck === "0") {
        if ($rightsidebar > 0) {
          $page = "INSERT INTO `wi_page` ( `name`, `panel`, `top_head`, `header`, `left_sidebar`, `right_sidebar`, `contents`, `footer`) VALUES
      ( '" . $pageName . "', '1', '0', '0', '0', '1', '', '1');
        ";
        $query = $this->WIdb->prepare($page);
        $query->execute();
        $page = $this->WIdb->lastInsertId();
        
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_page`
                     WHERE `id` = :id",
                     array(
                       "id" => $page
                     )
                  );
        $page_id = $result['page'];
        }else{
           $page = "INSERT INTO `wi_page` ( `name`, `panel`, `top_head`, `header`, `left_sidebar`, `right_sidebar`, `contents`, `footer`) VALUES
      ( '" . $pageName . "', '1', '0', '0', '0', '0', '', '1');
        ";
        $query = $this->WIdb->prepare($page);
        $query->execute();
        $page = $this->WIdb->lastInsertId();

        if($menu === "1")
        {
          $Menupage = "INSERT INTO `wi_menu` ( `label`, `link`) VALUES
      ( '" . $pageName . "', '" . $pageName . ".php');
        ";
        $query = $this->WIdb->prepare($Menupage);
        $query->execute();
        }

                $result = $this->WIdb->select(
                    "SELECT * FROM `wi_page`
                     WHERE `id` = :id",
                     array(
                       "id" => $page
                     )
                  );
        $page_id = $result[0]['name'];
        }
        
        
      }
// array  $page_id is the name of the page, $page is the id
  $results = array(
    "completed" => "saved",
    "msg"    => "successfully created new page",
    "page_id" => $page_id,
    "page"  => $page
    );
    
    echo json_encode($results);
    }


        public function selectPage()
    {
      $sql = "SELECT * FROM `wi_page`";
      $query = $this->WIdb->prepare($sql);
      $query->execute();

      $res = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach ($res as $key => $value) {
      echo '<option value="' . $value['name'] . '">' . $value['name'] . '</option>';
      }
    }


     public function GetColums($page_id, $column)
    {
      //echo $page_id;
      $sql = "SELECT * FROM `wi_page` WHERE `name` =:name";
      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':name', $page_id, PDO::PARAM_STR);
      $query->execute();
      $res = $query->fetch(PDO::FETCH_ASSOC);
      return $res[$column];
    }

        public function loadPageOptions($page_id)
    {
      $lsc = WIPage::GetColums($page_id, "left_sidebar");
      $rsc = WIPage::GetColums($page_id, "right_sidebar");

      $results = array(
        "status" => "completed",
        "lsc" => $lsc,
        "rsc" => $rsc
        );
      echo json_encode($results);
    }

    public function toggleSideColumns($page_id, $col)
    {
            $lsc = WIPage::GetColums($page_id, "left_sidebar");
      $rsc = WIPage::GetColums($page_id, "right_sidebar");

      if ($col === "left") {
        
        if ($lsc > 0) {
          $status = 0;
          $sql = "UPDATE `wi_page` SET  `left_sidebar` =:status WHERE  `wi_page`.`name` =:page";
          $query = $this->WIdb->prepare($sql);
          $query->bindParam(':status', $status, PDO::PARAM_INT);
          $query->bindParam(':page', $page_id, PDO::PARAM_STR);
          $query->execute();

          $result = array(
            "status" => "complete",
            "lsc"   => 0
            );
          echo json_encode($result);
          }else{
                      $status = 1;
          $sql = "UPDATE `wi_page` SET  `left_sidebar` =:status WHERE  `wi_page`.`name` =:page";
          $query = $this->WIdb->prepare($sql);
          $query->bindParam(':status', $status, PDO::PARAM_INT);
          $query->bindParam(':page', $page_id, PDO::PARAM_STR);
          $query->execute();

          $result = array(
            "status" => "complete",
            "lsc"   => 1

            );
          echo json_encode($result);
          }
      }

      if ($col === "right") {
         if ($lsc > 0) {
          $status = 0;
          $sql = "UPDATE `wi_page` SET  `right_sidebar` =:status WHERE  `wi_page`.`name` =:page";
          $query = $this->WIdb->prepare($sql);
          $query->bindParam(':status', $status, PDO::PARAM_INT);
          $query->bindParam(':page', $page_id, PDO::PARAM_STR);
          $query->execute();

          $result = array(
            "status" => "complete",
            "rsc"   => 0
            );
          echo json_encode($result);
          }else{
                      $status = 1;
          $sql = "UPDATE `wi_page` SET  `right_sidebar` =:status WHERE  `wi_page`.`name` =:page";
          $query = $this->WIdb->prepare($sql);
          $query->bindParam(':status', $status, PDO::PARAM_INT);
          $query->bindParam(':page', $page_id, PDO::PARAM_STR);
          $query->execute();

          $result = array(
            "status" => "complete",
            "rsc"   => 1
            );
          echo json_encode($result);
          }
      }
    }


    public function deletePage($id, $name)
    {
      $sql = "DELETE FROM `wi_page` WHERE id =:id";

      //delete page from page
      $this->WIdb->delete("wi_page", "id = :id", array( "id" => $id ));
      // deleted page from css
      $this->WIdb->delete("wi_css", "page = :name", array( "name" => $name ));
      // delete page from menu
      // $this->WIdb->delete("wi_menu", "page = :name", array( "name" => $this->name ));
      //delete page rom meta
       $this->WIdb->delete("wi_meta", "page = :name", array( "name" => $name ));
      // delete page from scripts
        $this->WIdb->delete("wi_scripts", "page = :name", array( "name" => $name ));

       $result = array(
            "status" => "complete",
            );
          echo json_encode($result);

    }

    public function changeLSC($page, $col)
    {
      $lsc = WIPage::GetColums($page, "left_sidebar");
     // echo $lsc;
      if($lsc === "0"){
        $left = "1";
        $sql = "UPDATE `wi_page` SET `left_sidebar`=:left WHERE `name` =:page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':left', $left, PDO::PARAM_STR);
        $query->bindParam(':page', $page, PDO::PARAM_STR);
        $query->execute();

                  $result = array(
            "status" => "complete",
            "lsc"   => 1
            );
          echo json_encode($result);

      }else if($lsc === "1"){
         $left = "0";
        $sql = "UPDATE `wi_page` SET `left_sidebar`=:left WHERE `name` =:page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':left', $left, PDO::PARAM_STR);
        $query->bindParam(':page', $page, PDO::PARAM_STR);
        $query->execute();

                  $result = array(
            "status" => "complete",
            "lsc"   => 0
            );
          echo json_encode($result);
      }



    }


public function changeRSC($page, $col)
    {
      $rsc = WIPage::GetColums($page, "right_sidebar");
     // echo $lsc;
      if($rsc === "0"){
        $right = "1";
        $sql = "UPDATE `wi_page` SET `right_sidebar`=:right WHERE `name` =:page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':right', $right, PDO::PARAM_STR);
        $query->bindParam(':page', $page, PDO::PARAM_STR);
        $query->execute();

                  $result = array(
            "status" => "complete",
            "rsc"   => 1
            );
          echo json_encode($result);

      }else if($rsc === "1"){
         $right = "0";
        $sql = "UPDATE `wi_page` SET `right_sidebar`=:right WHERE `name` =:page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':right', $right, PDO::PARAM_STR);
        $query->bindParam(':page', $page, PDO::PARAM_STR);
        $query->execute();

                  $result = array(
            "status" => "complete",
            "rsc"   => 0
            );
          echo json_encode($result);
      }



    }


    public function toogleLsc($page, $col)
    {
      $sql = "SELECT * FROM `wi_page` WHERE name=:page";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':page', $page, PDO::PARAM_STR);
      $query->execute();

      $res = $query->fetch(PDO::FETCH_ASSOC);
      $lsc = $res[$col];

       $result = array(
            "status" => "complete",
            "lsc"   => $lsc
            );
          echo json_encode($result);
      }

      public function CssCheck($pageName)
    {
      $label = $pageName;
      $sql = "SELECT * FROM `wi_css` WHERE `page`=:label";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':label', $label, PDO::PARAM_STR);
      $query->execute();

      $result = $query->fetch();
      //print_r($result);
      if( count($result) > 1){
        return "1";
      }else{
        return "0";
      }
    }

    public function JsCheck($pageName)
    {
      $label = $pageName;
      $sql = "SELECT * FROM `wi_scripts` WHERE `page`=:label";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':label', $label, PDO::PARAM_STR);
      $query->execute();

      $result = $query->fetch();
      //print_r($result);
      if( count($result) > 1){
        return "1";
      }else{
        return "0";
      }
    }

    public function MetaCheck($pageName)
    {
      $label = $pageName;
      $sql = "SELECT * FROM `wi_meta` WHERE `page`=:label";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':label', $label, PDO::PARAM_STR);
      $query->execute();

      $result = $query->fetch();
      //print_r($result);
      if( count($result) > 1){
        return "1";
      }else{
        return "0";
      }
    }

        public function pageCheck($pageName)
    {
      $label = $pageName;
      $sql = "SELECT * FROM `wi_page` WHERE `name`=:label";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':label', $label, PDO::PARAM_STR);
      $query->execute();

      $result = $query->fetch();
      //print_r($result);
      if( count($result) > 1){
        return "1";
      }else{
        return "0";
      }
    }

    public function EditPage($data)
    {
      $edit = $data['UserData'];
      $page_id = $data['PageInfo']['page_id'];
      $count = 0;
      $count++;

      foreach ($edit as $value ) {
        'ALTER TABLE `wi_modules` ADD `contents_'. $count.'` VARCHAR( 255 ) after `contents`';
        $this->WIdb->editUpdate("wi_modules", $edit, "`id` = :page_id", $edit);
      }
//$result = $this->WIdb->editUpdate("wi_modules", $edit, "`name` = :page_id", $edit);

     /* $this->WIdb->update("wi_page", $edit['page_id'], "`contents` = :page_id",
        array( "page_id" => $edit['page_id'] )
               );
      $count = 0;
      $count++;


           $this->WIdb->update(
                    "wi_modules", 
                    $edit, 
                    "`name` = :page_id",
                    $edit
               );
*/

    }


   
}