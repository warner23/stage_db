<?php

/**
* 
*/
class WIWebsite
{
    
    function __construct() 
    {
         $this->WIdb = WIdb::getInstance();
         $this->Widget = new WIWidget();

    }




        public function webSite_essentials($column)
    {
              $result = $this->WIdb->select(
                    "SELECT * FROM `wi_header`"
                  );
              var_dump($result);
              return $result[$column];
    }

    public function webSite_icons()
    {
      $result = $this->WIdb->select("SELECT * FROM `wi_site`");

        echo '<link rel="icon" type="image/png" href="WIAdmin/WIMedia/Img/favicon/' . $result[0]['favicon'] . '"/>';
    }

    

    public function Meta($page)
    {
      
               $result = $this->WIdb->select("SELECT * FROM `wi_meta` WHERE `page`=:page",array(
        "page" => $page
      )
    );

          foreach ($result as $meta ) {
                        echo '<meta name="' . $meta['name'] . '" content="' . $meta['content'] . '">';
          }

    }

    public function Theme()
    {
       $in_use = 1;

            $result = $this->WIdb->select("SELECT * FROM `wi_theme` WHERE `in_use`=:in_use",array(
        "in_use" => $in_use
      )
    );
        return $result[0]['destination'];


    }
    

    public function Styling($page)
    {
          $result = $this->WIdb->select("SELECT * FROM `wi_css` WHERE `page`=:page",array(
        "page" => $page
      )
    );

          foreach ($result as $css ) {
                        echo '<link rel="' . $css['rel'] . '" href="' . self::theme() . $css['href'] . '">';
          }
    }

    public function Scripts($page)
    {
      $result = $this->WIdb->select("SELECT * FROM `wi_scripts` WHERE `page`=:page",array(
        "page" => $page
      )
    );

          foreach ($result as $scripts ) {
                        echo '<script src="' . self::theme() . $scripts['src'] . '" type="text/javascript"></script>';
          }
    }

    public function StartUp()
    {
        echo '<!DOCTYPE html>
                <html class="no-js" lang="en">
                <head>   
                  <title>' . WEBSITE_NAME. ' </title>
                  <meta charset="utf-8">';
    }

    public function Social()
    {

        $query = $this->WIdb->prepare('SELECT * FROM `wi_Social`');
        $query->execute();

        while($res = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo ' <ul class="social_media"> 
                            <li><a href="' . $res['facebook'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-facebook" title="Facebook">Facebook</a></li>
                            <li><a href="' . $res['google'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-google-plus" title="Google+">Google+</a></li>
                            <li><a href="' . $res['twitter'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-twitter" title="Twitter">Twitter</a></li>
                            <li><a href="' . $res['pinterest'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-pinterest" title="Pinterest">Pinterest</a></li>
                            <li><a href="' . $res['linkedIn'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-linkedin" title="Linkedin">Linkedin</a></li>
                            <li><a href="' . $res['rss'] .'" data-placement="bottom" data-toggle="tooltip" class="fa fa-rss" title="Feedburner">RSS</a></li>
                        </ul><!-- End Social --> ';
        }
    }

    public function MainHeader()
    {

            $result = $this->WIdb->select("SELECT * FROM `wi_header`");
        /*$sql = "SELECT * FROM `wi_header`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();

        while($res = $query->fetch(PDO::PARAM_STR))
        {*/
         echo ' <header class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div class="navbar_brand">
                                <a href="index.php">
                                <img alt=""  class="logo" src="WIAdmin/WIMedia/Img/header/' . $result[0]['logo'] .'"></a>
                                
                            </div>
                        </div>

                        <!-- start of header-->
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="col-ms"> 
                        <div class="zapfino"><h2><b>' . $result[0]['header_content'] . '</b></h2>
                        <span class="slogan">' . $result[0]['header_slogan'] . '</span>
                        </div>
                        </div><!-- end col-ms-->
                         <!--end opf header-->
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                        <div class="controls col-lg-12 col-sm-12 col-md-12 col-xs-12"> 
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="Shows_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WIShows.Search();">Search</button><a href="javascript:void(0);" onclick="WIShows.ExitSearch();" name="Exit Search" class="btn cross">&times;</a>
 <div id="searchresultscontainer"></div>
</div>
                  </div>
                        </div><!-- end col-ms-->
                         <!--end opf header-->
                        </div>

                </div> 
                
        </header>';
    //}

    }


        public function MainMenu()
    {
        $sql = "SELECT * FROM `wi_menu`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();
        $result = $query->fetch();
        $menu_order = $result['sort'];

        $sql1 = "SELECT * FROM `wi_menu` ORDER BY :order";
        $query1 = $this->WIdb->prepare($sql1);
        $query1->bindParam(':order', $menu_order, PDO::PARAM_INT);
        $query1->execute();
        echo '<div class="menu"><div class="col-lg-12 col-md-12 col-sm-12 menusT">
              <div id="nav">
               <ul id="mainMenu" class="mainMenu default">';
               $multilang = self::IsMultilang();
               //echo $multilang;
        while($res = $query1->fetch(PDO::FETCH_ASSOC)){
          //foreach ($res as $menu) {
           // var_dump($menu);
             echo '<li><a href="' . $res['link'] . '">'; 
         if($multilang =="on"){ 
           WILang::get($res['lang']);
        }elseif($multilang =="off"){
         echo  $res['label'];
        } 
        echo '</a></li>';
         if($res['parent'] > 0)
         {
            echo '<li><a href="' . $res['link'] . '">'; 
            if($multilang ==="on"){ 
              echo WILang::get($res['lang']);
            }elseif($multilang ==="off"){
            echo $res['label'];
           } '</a></li>';
         }
          }
        
        echo '</ul>
            </div><!-- nav -->   
            <!-- end of menu -->
            </div></div>';
    }

    public function footer()
    {
        $id = 1;

        $date = date("Y");
        $http = str_replace("www.", "", $_SERVER['HTTP_HOST']);

        $result = $this->WIdb->select("SELECT * FROM `wi_footer` WHERE footer_id=:id",array(
        "id" => $id
      )
    );

/*        $query = $this->WIdb->prepare('SELECT * FROM `wi_footer` WHERE footer_id=:id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        while($res = $query->fetch(PDO::PARAM_STR))
        {*/
            echo '<footer class="footer">
            <section class="footer_bottom container-fluid text-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-xl-12">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xl-4"></div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xl-4">
                      <p class="copyright"><?php echo WILang::get("copyright");?> &copy; ' . $date . ' ' . $result[0]['website_name'] . '-  All rights reserved.    Powered by WICMS</p>
                      </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 col-xl-4"></div>
                    </div>
                </div>
            </div>
        </section>
        </footer>
        <!--End Footer-->';
        //}
    }

    public function langClassSelector($lang)
    {
      //echo $lang;

      if( WILang::getLanguage() === $lang){
        return WILang::getLanguage();
      }else{
        return "fade";
      }

    }

      public function viewLang()
    {
    

         $result = $this->WIdb->select("SELECT * FROM `wi_lang`");

          foreach ($result as $lang ) {
                        echo '<a href="' . $lang['href'] . '">
                 <img src="WIAdmin/WIMedia/Img/lang/' . $lang['lang_flag'] . '" alt="' . $lang['name'] .'" title="' . $lang['name'] .'"
                      class="'. WIWebsite::langClassSelector($lang['lang']) .'" /></a>';
          }

        /*$sql = "SELECT * FROM `wi_lang`";
        $query = $this->WIdb->prepare($sql);
        $query->execute();
         echo '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                         <div class="flags-wrapper">';
        while($res = $query->fetchAll(PDO::FETCH_ASSOC) ){

          
        foreach ($res as $lang ) {


        
            echo '<a href="' . $lang['href'] . '">
                 <img src="WIAdmin/WIMedia/Img/lang/' . $lang['lang_flag'] . '" alt="' . $lang['name'] .'" title="' . $lang['name'] .'"
                      class="'. WIWebsite::langClassSelector($lang['lang']) .'" /></a>';
            }
        }*/

         echo '</div>
                    </div><!-- end col-lg-6 col-md-6 col-sm-6-->';
    }

            public function google_lang()
    {
      echo '<div class="col-lg-5 col-md-5 col-sm-5 col-xs-10">
                         <div class="flags-wrapper">
                         <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: `en`, layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, `google_translate_element`);
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                         </div>
                    </div><!-- end col-lg-6 col-md-6 col-sm-6-->';

    }


  public function IsMultilang()
  {
            $sql = "SELECT * FROM `wi_site`";

        $query = $this->WIdb->prepare($sql);
        $query->execute();

        $res = $query->fetch();

        $multilang = $res['multi_lang'];
        return $multilang;
  }



   

    public function PageMod($page, $column)
    {
        //echo "col" . $column;

                $result = $this->WIdb->selectColumn(
                    "SELECT * FROM `wi_page` WHERE `name`=:page",
                     array(
                       "page" => $page
                     ), $column
                  );
               // print_r($result[$column]);
         if(count($result < 1)){
            return $column;
         }else{
            return $column;
         }


    }

       public function pageModPower($page, $column)
        {
        //echo "col" . $column;

                $result[$column] = $this->WIdb->selectColumn(
                    "SELECT * FROM `wi_page` WHERE `name`=:page",
                     array(
                       "page" => $page
                     ), $column
                  );
               //print_r($result[$column]);
         if(count($result[$column] < 1)){
            return $result[$column];
         }else{
            return $result[$column];
         }


    }

        public function showFavicon()
    {
        $sql = "SELECT * FROM `wi_site`";

        $query = $this->WIdb->prepare($sql);
        $query->execute();

        $res = $query->fetch();

        $favicon = $res['favicon'];
        return $favicon;

    }

    public function RsideBar()
    {

      $location = "right_sidebar";
       $result = $this->WIdb->select("SELECT * FROM `wi_widget` WHERE `widget_location`=:location ORDER BY `widget_order` ASC",array(
        "location" => $location
      )
    );

          foreach ($result as $bar ) {
            echo '<section id="widget_' . $bar['widget_id'].'" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 widget ">'; echo $this->Widget->getWidget($bar['widget_name']);  echo '</section>';
          }

      
     /* $sql = "SELECT * FROM `wi_widget` WHERE `widget_location`=:location ORDER BY `widget_order` ASC";
      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':location', $location, PDO::PARAM_STR);
      $query->execute();
      while ($result = $query->fetchAll() ) {
        //print_r($result);
        foreach ($result as $show) {
          echo '<section id="widget_' . $show['widget_id'].'" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 widget ">'; echo $this->Widget->getWidget($show['widget_name']);  echo '</section>';
        }
        
      }*/



    }
}



?>
