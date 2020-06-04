<?php
/**
* WIModules Class
* Created by Warner Infinity
* Author Jules Warner
*/
class WIModules
{

    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $this->Page = new WIPagination();
    }

    public function InstallMods()
    {
        
         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $JsClass="WIMod";
        $onclick = "NextInstallMod";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $dir = dirname(dirname(dirname(__FILE__))) . '/WIModule/';
        $modules = scandir($dir);
        $modTotal = count($modules);
        //echo $modTotal;
        $current_page =$this->Page->currentPage-1;
        $page_position = (($page_number-1) * $item_per_page);
        $itemsPerPage = $this->Page->itemsPerPage;
        //break records into pages
        $total_pages = ceil($modTotal/$item_per_page);
        //echo "tot" .$total_pages;

        foreach ($modules as $module => $value) {
            
        if ($value === '.' or $value === '..') continue;
        if (is_dir($dir.$value)) {
        //code to use if directory
                echo '<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
        <div class="panel panel-info">
        <div class="panel-heading">' . $value . '</div>
        <div class="panel-body">

             <button type="button" name="' . $value . '" value="enabled" id="' . $value . '-Install"  class="btn">Install</button>
         <button type="button" name="' . $value . '" value="disabled" id="' . $value . '-Uninstall" class="btn btn-danger active" >Unistall</button>
        </div>
        <div class="panel-footer">
            Author: Jules Warner
        </div>
        </div>
    </div>  <script type="text/javascript">
     
    var module = "'; self::InstallModuleToggle($value); echo '";

                       if (module === "disabled"){
                        $("#' . $value . '-Install").removeClass("btn-success active");
                        $("#' . $value . '-Uninstall").addClass("btn-danger active");
                       }else if (module === "enabled"){
                        $("#' . $value . '-Uninstall").removeClass("btn-danger active");
                        $("#' . $value . '-Install").addClass("btn-success active");
                       }



                    $("#' . $value . '-Install").click(function(){
                        $("#' . $value . '-Uninstall").removeClass("btn-danger active")
                        $("#' . $value . '-Install").addClass("btn-success active");
                        WIMod.ModInstall("' . $value . '", "Jules Warner");
                    })

                    $("#' . $value . '-Uninstall").click(function(){
                       $("#' . $value . '-Install").removeClass("btn-success active")
                        $("#' . $value . '-Uninstall").addClass("btn-danger active");
                        WIMod.ModUninstall("' . $value . '");
                    })
</script>';

    }

        }

          $Pagin = $this->Page->Pagination($item_per_page, $page_number, $modTotal, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    }


    public function InstallElements()
    {
        
         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $JsClass="WIMod";
        $onclick = "NextInstallEle";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $dir = dirname(dirname(dirname(__FILE__))) . '/WIModule/Elements/';
        $modules = scandir($dir);
        $modTotal = count($modules);
        //echo $modTotal;
        $current_page =$this->Page->currentPage-1;
        $page_position = (($page_number-1) * $item_per_page);
        $itemsPerPage = $this->Page->itemsPerPage;
        //break records into pages
        $total_pages = ceil($modTotal/$item_per_page);
        //echo "tot" .$total_pages;

        foreach ($modules as $module => $value) {
            
        if ($value === '.' or $value === '..') continue;
        if (is_dir($dir.$value)) {
        //code to use if directory
                echo '<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
        <div class="panel panel-info">
        <div class="panel-heading">' . $value . '</div>
        <div class="panel-body">

             <button type="button" name="' . $value . '" value="enabled" id="' . $value . '-Install"  class="btn">Install</button>
         <button type="button" name="' . $value . '" value="disabled" id="' . $value . '-Uninstall" class="btn btn-danger active" >Unistall</button>
        </div>
        <div class="panel-footer">
            Author: Jules Warner
        </div>
        </div>
    </div>  <script type="text/javascript">
     
    var module = "'; echo self::InstallElementToggle($value); echo '";

                       if (module === "disabled"){
                        $("#' . $value . '-Install").removeClass("btn-success active");
                        $("#' . $value . '-Uninstall").addClass("btn-danger active");
                       }else if (module === "enabled"){
                        $("#' . $value . '-Uninstall").removeClass("btn-danger active");
                        $("#' . $value . '-Install").addClass("btn-success active");
                       }



                    $("#' . $value . '-Install").click(function(){
                        $("#' . $value . '-Uninstall").removeClass("btn-danger active")
                        $("#' . $value . '-Install").addClass("btn-success active");
                        WIMod.EleInstall("' . $value . '", "Jules Warner");
                    })

                    $("#' . $value . '-Uninstall").click(function(){
                       $("#' . $value . '-Install").removeClass("btn-success active")
                        $("#' . $value . '-Uninstall").addClass("btn-danger active");
                        WIMod.EleUninstall("' . $value . '");
                    })
</script>';

    }

        }

          $Pagin = $this->Page->Pagination($item_per_page, $page_number, $modTotal, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    }



    public function getModules()
    {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_mod`");
        $rows = count($result);


        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $JsClass = "WIMod";
        $onclick = "NextMod";

/*        $sql = "SELECT * FROM `wi_mod` WHERE mod_type =:mod_type ORDER BY `mod_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':mod_type' ,$mod_type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();*/

        $modules = $this->WIdb->get("SELECT * FROM `wi_mod` ORDER BY `mod_id` ASC LIMIT :page, :item_per_page", array(
            "page"     => $page_position,
            "item_per_page"  => $item_per_page
        )); 

       // var_dump($modules);
        echo '<ul class="contents">';
       foreach ($modules as $res){
             echo '<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
        <div class="panel panel-info">
        <div class="panel-heading">' . $res['module_name'] . '</div>
        <div class="panel-body">
        <input type="hidden" name="' . $res['module_name'] . '" class="btn-group-value" id="' . $res['module_name'] . '" value="'. $res['mod_status'] . '" />
             <button type="button" name="' . $res['module_name'] . '" value="enabled" id="' . $res['module_name'] . '-enabled"  class="btn">Enabled</button>
         <button type="button" name="' . $res['module_name'] . '" value="disabled" id="' . $res['module_name'] . '-disabled" class="btn btn-danger active" >Disabled</button>
        </div>
        <div class="panel-heading">
            
        </div>
        </div>
    </div>  <script type="text/javascript">
     
    var module = "' . $res['mod_status'] . '";

                       if (module === "disabled"){
                        $("#' . $res['module_name'] . '-enabledd").removeClass("btn-success active");
                        $("#' . $res['module_name'] . '-disable").addClass("btn-danger active");
                       }else if (module === "enabled"){
                        $("#' . $res['module_name'] . '-disabled").removeClass("btn-danger active");
                        $("#' . $res['module_name'] . '-enabled").addClass("btn-success active");
                       }



                    $("#' . $res['module_name'] . '-enabled").click(function(){
                        
                       // $("#' . $res['module_name'] . '-enabled").attr("value", "enabled")
                        $("#' . $res['module_name'] . '-disabled").removeClass("btn-danger active")
                        $("#' . $res['module_name'] . '-enabled").addClass("btn-success active");
                        WIMod.enable("' . $res['module_name'] . '", "enabled");
                    })

                    $("#' . $res['module_name'] . '-disabled").click(function(){
                       
                       // $("#' . $res['module_name'] . '-disabled").attr("value", "disabled")
                        $("#' . $res['module_name'] . '-enabled").removeClass("btn-success active")
                        $("#' . $res['module_name'] . '-disabled").addClass("btn-danger active");
                        WIMod.disable("' . $res['module_name'] . '", "disabled");
                    })
</script>';
        }
        echo '</ul>';

         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    }


    public function getElements()
    {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_elements`");
        $rows = count($result);


        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $JsClass = "WIMod";
        $onclick = "NextMod";

/*        $sql = "SELECT * FROM `wi_mod` WHERE mod_type =:mod_type ORDER BY `mod_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':mod_type' ,$mod_type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();


        echo '<ul class="contents">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {*/


        $modules = $this->WIdb->get('SELECT * FROM `wi_elements` ORDER BY `element_id` ASC LIMIT :page, :item_per_page', array(
            "page"     => $page_position,
            "item_per_page"  => $item_per_page
        )); 


        echo '<ul class="contents">';
       foreach ($modules as $res){
             echo '<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
        <div class="panel panel-info">
        <div class="panel-heading">' . $res['element_name'] . '</div>
        <div class="panel-body">
        <input type="hidden" name="' . $res['element_name'] . '" class="btn-group-value" id="' . $res['element_name'] . '" value="'. $res['element_status'] . '" />
             <button type="button" name="' . $res['element_name'] . '" value="enabled" id="' . $res['element_name'] . '-enabled"  class="btn">Enabled</button>
         <button type="button" name="' . $res['element_name'] . '" value="disabled" id="' . $res['element_name'] . '-disabled" class="btn btn-danger active" >Disabled</button>
        </div>
        <div class="panel-heading">
            
        </div>
        </div>
    </div>  <script type="text/javascript">
     
    var module = "' . $res['element_status'] . '";

                       if (module === "disabled"){
                        $("#' . $res['element_name'] . '-enabledd").removeClass("btn-success active");
                        $("#' . $res['element_name'] . '-disable").addClass("btn-danger active");
                       }else if (module === "enabled"){
                        $("#' . $res['element_name'] . '-disabled").removeClass("btn-danger active");
                        $("#' . $res['element_name'] . '-enabled").addClass("btn-success active");
                       }



                    $("#' . $res['element_name'] . '-enabled").click(function(){
                        
                       // $("#' . $res['element_name'] . '-enabled").attr("value", "enabled")
                        $("#' . $res['element_name'] . '-disabled").removeClass("btn-danger active")
                        $("#' . $res['element_name'] . '-enabled").addClass("btn-success active");
                        WIMod.EleEnable("' . $res['element_name'] . '", "enabled");
                    })

                    $("#' . $res['element_name'] . '-disabled").click(function(){
                       
                       // $("#' . $res['element_name'] . '-disabled").attr("value", "disabled")
                        $("#' . $res['element_name'] . '-enabled").removeClass("btn-success active")
                        $("#' . $res['element_name'] . '-disabled").addClass("btn-danger active");
                        WIMod.EleDisable("' . $res['element_name'] . '", "disabled");
                    })
</script>';
        }
        echo '</ul>';

         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    }

     public function getInstalledModules()
    {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_mod`");
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        $JsClass = "WIMod";
        $onclick = "NextInstMod";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $mod_type = "element";

/*        $sql = "SELECT * FROM `wi_mod` WHERE mod_type =:mod_type ORDER BY `mod_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':mod_type' ,$mod_type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();*/


        $modules = $this->WIdb->select('SELECT * FROM `wi_mod` WHERE mod_type =:mod_type ORDER BY `mod_id` ASC LIMIT :page, :item_per_page', array(
            "page"     => $page_position,
            "mod_type"  => $mod_type,
            "item_per_page"  => $item_per_page
        )); 
        echo '<ul class="contents">';
        //var_dump($modules);
        foreach ($modules as $res){
             echo '<div class="col-md-4 col-sm-4 col-xs-4 col-lg-4">
        <div class="panel panel-info">
        <div class="panel-heading">' . $res['module_name'] . '</div>
        <div class="panel-body">
        <input type="hidden" name="' . $res['module_name'] . '" class="btn-group-value" id="' . $res['module_name'] . '" value="'. $res['mod_status'] . '" />
             <button type="button" name="' . $res['module_name'] . '" value="enabled" id="' . $res['module_name'] . '-enabled"  class="btn">Enabled</button>
         <button type="button" name="' . $res['module_name'] . '" value="disabled" id="' . $res['module_name'] . '-disabled" class="btn btn-danger active" >Disabled</button>
        </div>
        <div class="panel-heading">
            
        </div>
        </div>
    </div>  <script type="text/javascript">
     
    var module = "' . $res['mod_status'] . '";

                       if (module === "disabled"){
                        $("#' . $res['module_name'] . '-enabledd").removeClass("btn-success active");
                        $("#' . $res['module_name'] . '-disable").addClass("btn-danger active");
                       }else if (module === "enabled"){
                        $("#' . $res['module_name'] . '-disabled").removeClass("btn-danger active");
                        $("#' . $res['module_name'] . '-enabled").addClass("btn-success active");
                       }



                    $("#' . $res['module_name'] . '-enabled").click(function(){
                        
                       // $("#' . $res['module_name'] . '-enabled").attr("value", "enabled")
                        $("#' . $res['module_name'] . '-disabled").removeClass("btn-danger active")
                        $("#' . $res['module_name'] . '-enabled").addClass("btn-success active");
                        WIMod.enable("' . $res['module_name'] . '", "enabled");
                    })

                    $("#' . $res['module_name'] . '-disabled").click(function(){
                       
                       // $("#' . $res['module_name'] . '-disabled").attr("value", "disabled")
                        $("#' . $res['module_name'] . '-enabled").removeClass("btn-success active")
                        $("#' . $res['module_name'] . '-disabled").addClass("btn-danger active");
                        WIMod.disable("' . $res['module_name'] . '", "disabled");
                    })
</script>';
        }
        echo '</ul>';

         $Pagination = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagination;
    echo '</div>';
    }



    public static function moduleToggle($column, $mod_name) 
    {
        //$WIdb = WIdb::getInstance();

/*        $query = $WIdb->prepare('SELECT * FROM `wi_mod` WHERE `module_name` = :mod_name');
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);*/

                $res = $this->WIdb->select(
                    "SELECT * FROM `wi_mod` WHERE `module_name` = :mod_name",
                     array(
                       "mod_name" => $mod_name
                     )
                  );

       return $res[$column];
    }

        public function InstallModuleToggle($mod_name) 
    {

    $res = $this->WIdb->selectColumn("SELECT * FROM `wi_mod` WHERE `module_name` = :mod_name",
    array( "mod_name" => $mod_name ), "module_name");
         if ($res === $mod_name ) {
            echo "enabled";
               // return "enabled";
         }else{
            echo "disabled";
           // return "disabled";
        }
    }

    public function InstallElementToggle($mod_name) 
    {

        $res = $this->WIdb->selectColumn("SELECT * FROM `wi_elements` WHERE `element_name`=:mod_name",
        array("mod_name" => $mod_name), "element_name" );
        if ($res === $mod_name) {
        echo "enabled";
    }else{
        echo "disabled";
    }
            
    }

     public function install_mod($mod_name, $author)
    {
        //

/*        $sql = "INSERT INTO `wi_mod` (module_name, mod_author) VALUES (:mod_name, :mod_author)";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_author', $author, PDO::PARAM_STR);
        $query->execute();*/

        $this->WIdb->insert('wi_mod', array(
            "module_name"     => $mod_name,
            "mod_author"  => $author
        )); 

    }

         public function install_Element($ele_name, $author)
    {
        //

/*        $sql = "INSERT INTO `wi_mod` (module_name, mod_author) VALUES (:mod_name, :mod_author)";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_author', $author, PDO::PARAM_STR);
        $query->execute();*/

        $this->WIdb->insert('wi_elements', array(
            "element_name"     => $ele_name,
            "element_author"  => $author
        )); 

    }

    public function uninstall_mod($mod_name)
    {
        //

/*        $sql = "DELETE FROM `wi_mod` WHERE module_name= :mod_name";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->execute();*/

        $this->WIdb->delete("wi_mod", "module_name= :mod_name", array( "mod_name" => $mod_name ));


    }


    public function uninstall_ele($ele_name)
    {
        //

/*        $sql = "DELETE FROM `wi_mod` WHERE module_name= :mod_name";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->execute();*/

        $this->WIdb->delete("wi_elements", "element_name= :ele_name", array( "ele_name" => $ele_name ));


    }


    public function active_available_mod($mod_name, $enable)
    {
        //INSERT INTO `wi_mod` (module_name, mod_status) VALUES (:mod_name, :mod_status)
        echo $enable;
        $power = "power_on";
        $sql = "UPDATE `wi_mod` SET `mod_status` = :mod_status , `mod_powered`=:power WHERE `module_name` = :mod_name";
        echo $sql;
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_status', $enable, PDO::PARAM_STR);
        $query->bindParam(':power', $power, PDO::PARAM_STR);
        $query->execute();
    }

        public function active_available_ele($mod_name, $enable)
    {
        //INSERT INTO `wi_mod` (module_name, mod_status) VALUES (:mod_name, :mod_status)
        echo $enable;
        $power = "power_on";
        $sql = "UPDATE `wi_elements` SET `element_status` = :mod_status , `element_powered`=:power WHERE `element_name` = :mod_name";
        //echo $sql;
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_status', $enable, PDO::PARAM_STR);
        $query->bindParam(':power', $power, PDO::PARAM_STR);
        $query->execute();
    }



        public function deactive_available_mod($mod_name, $disable)
    {
        //echo $disable;
        //echo $mod_name;
        $power = "power_off";
        $sql = "UPDATE `wi_mod` SET `mof_status` = :mod_status , `mod_powered`=:power WHERE `module_name` = :mod_name";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_status', $disable, PDO::PARAM_STR);
        $query->bindParam(':power', $power, PDO::PARAM_STR);

        $query->execute();

    }

    public function deactive_available_ele($mod_name, $disable)
    {
        //echo $disable;
        //echo $mod_name;
        $power = "power_off";
        $sql = "UPDATE `wi_elements` SET `element_status` = :mod_status , `element_powered`=:power WHERE `element_name` = :mod_name";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_status', $disable, PDO::PARAM_STR);
        $query->bindParam(':power', $power, PDO::PARAM_STR);

        $query->execute();

    }

     public function ActiveMods()
     {
        $element_status = "enabled";
        $element_type = "element";
        $sql = "SELECT * FROM `wi_elements` WHERE `element_type` = :element_type AND `element_status`=:element_status";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':element_type' ,$element_type, PDO::PARAM_STR);
        $query->bindParam(':element_status' ,$element_status, PDO::PARAM_STR);
        $query->execute();
        echo '<ul id="draggable" class="ui-widget-header col-md-4 col-sm-4 col-xs-4 col-lg-4">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<li id="'.$res['element_name'] . '" title="'.$res['element_name'] . '" class="ui-draggable ui-draggable-handle '.$res['element_font'] . '"></li>';
        }
        echo '</ul>';

     }

     public function dropElement($mod_name, $mod_drop, $empty)
     {
/*        echo "hey". $empty;
        echo "mod". $mod_name;
        echo "drop". $mod_drop;
*/
        //echo dirname(dirname(dirname(__FILE__))) . '/WIModule/Elements/' .$mod_name.'/'.$mod_name.'.php';
    include_once dirname(dirname(dirname(__FILE__))) . '/WIModule/Elements/' .$mod_name.'/'.$mod_name.'.php';
    //echo "mod".$mod_name;
/*
        echo "mod".$mod_name;
        echo $mod_drop;*/
        $mod_drop = new $mod_drop;
        $mod_drop->mod_name($empty, $mod_name);

     }

          public function cloneElement($mod_name, $empty)
     {
        //echo dirname(dirname(dirname(__FILE__))) . '/WIModule/Elements/' .$mod_name.'/'.$mod_name.'.php';
    include_once dirname(dirname(dirname(__FILE__))) . '/WIModule/Elements/' .$mod_name.'/'.$mod_name.'.php';
        $mod_drop = $mod_name;

        $mod_drop = new $mod_drop;

        $mod_drop->cloneColumn($empty);

     }

     public function dropColElement($mod_name)
     {
        include_once dirname(dirname(dirname(__FILE__))) . '/WIModule/columns/columns.php';
        /*
        spl_autoload_register(function($mod_name)
        {
            require_once $dir .'/' .$mod_name . '.php';
        });
        */

        $columns = new columns;

        $columns->$mod_name();

     }

          public function editDropElement($mod_name, $page_id)
     {
        include_once dirname(dirname(dirname(__FILE__))) . '/WIModule/' .$mod_name.'/'.$mod_name.'.php';

        $mod_name = new $mod_name;

        $mod_name->editPageContent($page_id);

     }

     
     public function columns()
     {
        $mod_name = "columns";
        $mod_status = "enabled";
        $sql = "SELECT * FROM `wi_mod` WHERE module_name = :mod_name AND mod_status = :mod_status";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_name', $mod_name, PDO::PARAM_STR);
        $query->bindParam(':mod_status', $mod_status, PDO::PARAM_STR);
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);

        if ($res > 0)
            return true;
        else
            return false;

     }


     


     public function getActiveMods()
     {

        if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 25;

        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_mod`");
        $rows = count($result);
        //echo "row". $rows;
        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        $JsClass = "WIMod";
        $onclick = "NextActiveMod";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        $mod_status = "enabled";
/*        $sql = "SELECT * FROM `wi_mod` WHERE mod_status = :mod_status ORDER BY `mod_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':mod_status', $mod_status, PDO::PARAM_STR);
        $query->bindParam(':mod_type', $mod_type, PDO::PARAM_STR);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();*/

        $resy = $this->WIdb->get(
                    "SELECT * FROM `wi_mod` WHERE mod_status = :mod_status ORDER BY `mod_id` ASC LIMIT :page, :item_per_page", array(
                        "mod_status" => $mod_status,
                        "page"       => $page_position,
                        "item_per_page" => $item_per_page
                    )
                );
        //var_dump($resy);
        echo '<ul id="draggable" class="ui-widget-header">';
        foreach ($resy as $res) {
            echo '<li id="'.$res['module_name'] . '" title="'.$res['module_name'] . '" class="ui-draggable ui-draggable-handle '.$res['mod_font'] . '">'.$res['module_name'] . '</li>';
        }
        echo '</ul>';
         $Pagination = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagination;
    echo '</div>';

     }


      public function ActiveElements()
     {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $onclick = "nextElement";
        $element_status = "enabled";
        $item_per_page = 15;
        $mod_type = "element";
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status",
                     array(
                       "element_status" => $element_status
                ));
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        

        $sql = "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status ORDER BY `element_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':element_status' ,$element_status, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();

        echo '<ul id="draggable" class="ui-widget-header">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<li id="'.$res['element_name'] . '" title="'.$res['element_name'] . '" class="ui-draggable ui-draggable-handle '.$res['element_font'] . '">
            <button id="modEle" type="button">'.$res['element_name'] . '</button>
            </li> $( "button#modEle" ).mousedown(function() {
              $("li#'.$res['element_name'] . '").attr("draggable", true);
            });
               ';
        }
         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick);
    //print_r($Pagination);
         echo '</ul>';

         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';

     }


    public function ActiveElementsCommonFields()
     {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }
        $JsClass = "WIModule";
        $onclick = "nextElement";
        $element_status = "enabled";
        $item_per_page = 15;
        $power = "power_on";
        $type = "Common Fields";
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type`=:type",
                     array(
                       "element_status" => $element_status,
                       "power" => $power,
                       "type" => $type,
                ));
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        

        $sql = "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type` =:type ORDER BY `element_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':element_status' ,$element_status, PDO::PARAM_STR);
          $query->bindParam(':power' ,$power, PDO::PARAM_STR);
          $query->bindParam(':type' ,$type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();

        echo '<ul id="draggableElement" class="ui-widget-header control-panel common-fields">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($res);
            echo '<li id="'.$res['element_name'] . '" title="'.$res['element_name'] . '" class="modLi ui-draggable ui-draggable-handle '.$res['element_font'] . '" draggable="true">
            <button id="modEle" type="button">'.$res['element_name'] . '</button>
            </li>
            ';
        }
         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages,$JsClass, $onclick);
    //print_r($Pagination);
         echo '</ul>';
         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';

     }


     public function ActiveElementsHTMLElements()
     {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }
        $JsClass = "WIModule";
        $onclick = "nextElement";
        $element_status = "enabled";
        $item_per_page = 15;
        $power = "power_on";
        $type = "HTML Elements";
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type`=:type",
                     array(
                       "element_status" => $element_status,
                       "power" => $power,
                       "type" => $type
                ));
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        

        $sql = "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type`=:type ORDER BY `element_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':element_status' ,$element_status, PDO::PARAM_STR);
          $query->bindParam(':power' ,$power, PDO::PARAM_STR);
          $query->bindParam(':type' ,$type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();

        echo '<ul id="draggableElement" class="ui-widget-header control-panel common-fields">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<li id="'.$res['element_name'] . '" title="'.$res['element_name'] . '" class="modLi ui-draggable ui-draggable-handle '.$res['element_font'] . '" draggable="true">
                <button id="modEle" type="button">'.$res['element_name'] . '</button>
            </li>';
        }

         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $JsClass, $onclick);
    //print_r($Pagination);
         echo '</ul>';

         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';

     }

     public function ActiveElementsLayouts()
     {

         if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }
        $JsClass = "WIModule";
        $onclick = "nextElement";
        $element_status = "enabled";
        $item_per_page = 15;
        $power = "power_on";
        $type = "Layout";
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type`=:type",
                     array(
                       "element_status" => $element_status,
                       "power" => $power,
                       "type" => $type
                ));
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
        

       $sql = "SELECT * FROM `wi_elements` WHERE `element_status` = :element_status AND `element_powered` =:power AND `element_type`=:type ORDER BY `element_id` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
         $query->bindParam(':element_status' ,$element_status, PDO::PARAM_STR);
          $query->bindParam(':power' ,$power, PDO::PARAM_STR);
          $query->bindParam(':type' ,$type, PDO::PARAM_STR);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();

        echo '<ul id="draggableElement" class="ui-widget-header control-panel common-fields">';
        while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
            echo '<li id="'.$res['element_name'] . '" title="'.$res['element_name'] . '" class="modLi ui-draggable ui-draggable-handle '.$res['element_font'] . '" draggable="true">
                <button id="modEle" type="button">'.$res['element_name'] . '</button>
            </li>';
        }
         $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $JsClass, $onclick);
    //print_r($Pagination);
         echo '</ul>';

         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';

     }



     public function CheckModPower($modName)
     {
        
     }

         public function getMod($mod)
    {
        //echo $mod;
        //echo   'WIAdmin/WIModule/' .$mod.'/'.$mod.'.php';
        $directory = dirname(dirname(dirname(__FILE__)));
        require_once $directory . '/WIModule/' .$mod.'/'.$mod.'.php';
        
       // echo $mod;
        $mod = new $mod;

        $mod->mod_name();
    }

    public function EditMod($mod)
    {
        //echo $mod;
        //echo   'WIAdmin/WIModule/' .$mod.'/'.$mod.'.php';
        require_once  'WIAdmin/WIModule/' .$mod.'/'.$mod.'.php';
        
       // echo $mod;
        $mod = new $mod;

        $mod->mod_name();
    }

    public function editContents($mod_name, $title, $para)
    {
        $sql = "SELECT  FROM `wi_site` WHERE `id` =:id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
    }


    public function module($page_id, $column)
    {
        $id = "1";
        $name = $page_id;
        //echo $name;
        $sql = "SELECT `multi_lang` FROM `wi_site` WHERE `id` =:id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();
        //echo $result['multi_lang'];
        $mlang = $result['multi_lang'];
        
   // echo $mlang;

        $sql1 = "SELECT * FROM `wi_modules` WHERE `name`=:name";
        $query1 = $this->WIdb->prepare($sql1);
        $query1->bindParam(':name', $name, PDO::PARAM_STR);
        $query1->execute();

        $res = $query1->fetch(PDO::FETCH_ASSOC);
       // print_r($res);

        if ($column === "text") {
            $trans = "trans";
        }elseif ($column === "text1") {
            $trans = "trans1";
        }elseif ($column === "text2") {
            $trans = "trans2";
        }elseif ($column === "text3") {
            $trans = "trans3";
        }elseif ($column === "text4") {
            $trans = "trans4";
        }elseif ($column === "text5") {
            $trans = "trans5";
        }elseif ($column === "text6") {
            $trans = "trans6";
        }
        //echo $trans;
        $lange = $res[$trans];
        $text  = $res[$column];

       // echo $lange;
        if ($mlang === "off"){
            echo $text;
        }else{
            echo WILang::get($lange);
        }

    }

    public function ModName($page_id)
    {
        $sql = "SELECT * FROM `wi_page` WHERE `name`=:page";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_id, PDO::PARAM_STR);
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);

        $mod_name = $res['contents'];

        return $mod_name;
    }


    public function createMod($contents, $mod_name, $mod_drop, $element)
    {
          $directory = dirname(dirname(dirname(__FILE__))) . '/WIModule';
        $check = $directory . '/'. $mod_name .'/' . $mod_name. '.php';
        if(!file_exists($check)){
            //mkdir($directory . '/'. $mod_name);
            mkdir($directory . '/'. $mod_name);
      //echo $directory.'/'. $mod_name .'/' . $mod_name. '.php';
      $NewPage = fopen($directory. '/'  .$mod_name .'/'  .$mod_name . '.php', "w") or die("Unable to open file!");

      $File = '<?php

/**
* 
*/
class ' . $mod_name . '
{
    function __construct()
    {
        $this->WIdb = WIdb::getInstance();
        $this->Web  = new WIWebsite();
        $this->site = new WISite();
        $this->mod  = new WIModules();
        $this->page = new WIPage();
    }

        public function editMod()
    {
        echo `<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">`;

        if(isset($page)){
            $right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
        $rightSideBar = $this->Web->PageMod($page, "right_sidebar");
        $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
        $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
        //echo $Panel;
        if ($left_sidePower > 0) {
            $this->mod->getMod($leftSideBar);
            echo `<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">`;
        }elseif ( $right_sidePower > 0){
            echo `<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 text-left">`;
        }else{
            echo `<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">`;
        }

        }

echo `' . $contents . '`;

    
        //echo $Panel;
        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo `</div>
            </div></div>`;
    }

    public function editPageContent($page)
    {
echo `<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">`;

        if(isset($page)){
            $right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
        $rightSideBar = $this->Web->PageMod($page, "right_sidebar");
        $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
        $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
        //echo $Panel;
        if ($left_sidePower > 0) {
            $this->mod->getMod($leftSideBar);
            echo `<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">`;
        }elseif ( $right_sidePower > 0){
            echo `<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">`;
        }else{
            echo `<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">`;
        }

        }

include_once dirname(dirname(dirname(__FILE__))) ."/WIModule/Elements/' . $element .'/' . $element .'.php";
 $'.$element.' = new '.$element.'; $'.$element.'->edit(); 
        echo "</div>";

    
        //echo $Panel;
        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo `</div>
            </div></div>`;
    }

    public function mod_name($module, $page)
    {
        echo `<div class="container-fluid text-center">    
  <div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">`;

        if(isset($page)){
            $right_sidePower = $this->Web->pageModPower($page, "right_sidebar");
        $rightSideBar = $this->Web->PageMod($page, "right_sidebar");
        $left_sidePower = $this->Web->pageModPower($page, "left_sidebar");
        $leftSideBar = $this->Web->PageMod($page, "left_sidebar");
        //echo $Panel;
        if ($left_sidePower > 0) {
            $this->mod->getMod($leftSideBar);
            echo `<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 text-left">`;
        }elseif ( $right_sidePower > 0){
            echo `<div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 text-left">`;
        }else{
            echo `<div class="col-lg-12 col-md-12 col-sm-12 col-xs-8 text-left">`;
        }

        }

        include_once dirname(dirname(dirname(__FILE__))) ."/WIModule/Elements/' . $element .'/' . $element .'.php";
 $'.$element.' = new '.$element.'; $'.$element.'->create(); 
        echo "</div>";

        if ($right_sidePower > 0) {
            $this->mod->getMod($rightSideBar);
        }
                    

    echo `</div>
            </div></div>`;
    }

}';
     
      fwrite($NewPage, $File);
      fclose($NewPage);
    
     $this->WIdb->insert('wi_modules', array(
            "name"     => $mod_name
        )); 


    $msg = "Successfully created Module";

    $result = array(
                "status" => "success",
                "msg"    => $msg
            );
            
            echo json_encode($result);

        }
    }


        public function moduleImg($page_id, $column)
    {
        $sql1 = "SELECT * FROM `wi_modules` WHERE `name`=:name";
        $query1 = $this->WIdb->prepare($sql1);
        $query1->bindParam(':name', $page_id, PDO::PARAM_STR);
        $query1->execute();

        $res = $query1->fetch(PDO::FETCH_ASSOC);
            if ($res > 0) {
                echo ' <img class="img-responsive cp" id="Pic" src="WIMedia/Img/'. $page_id . '/'. $res[$column] . '.PNG" style="width:120px; height:120px;">
                    <button class="btn mediaPic" onclick="WIMedia.changePic()">Change Picture</button>
                                
                            </div>';
            }else{

            echo '
            <div class="col-lg-8 col-md-3 col-sm-2">
                 <img class="img-responsive cp" id="Pic" src="WIMedia/Img/placeholder.png" style="width:120px; height:120px;">
                    <button class="btn mediaPic" onclick="WIMedia.changePic()">Change Picture</button>
                                
                            </div>';
                        }


    }


}