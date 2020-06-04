<?php

/**
* 
*/
class FAQ
{
    function __construct()
    {
        $this->WIdb = WIdb::getInstance();
        $this->Web  = new WIWebsite();
        $this->site = new WISite();
        $this->mod  = new WIModules();
        $this->page = new WIPage();
        $this->Bootstrap = new WIBootstrap();
    }

        public function editMod($Id)
    {
        $Id = 1;
        $element = $this->WIdb->select(
                    "SELECT * FROM `wi_modules`
                     WHERE `id` = :id",
                     array(
                       "id" => $Id
                     )
                  );

        $this->Bootstrap->Edit($page,$Id, $element);
      
    }


    public function editPageContent($page)
    {
         $Id = 1;
        $element = $this->WIdb->select(
                    "SELECT `id`, `name`, `mod_name_function` FROM `wi_modules`
                     WHERE `id` = :id",
                     array(
                       "id" => $Id
                     )
                  );
       // var_dump($element);
    $this->Bootstrap->EditContent($page, $element,$Id);
    }

    public function mod_name($module, $page)
    {

        $moduleName = $this->WIdb->select(
                    "SELECT `contents` FROM `wi_page`
                     WHERE `name` = :name",
                     array(
                       "name" => $page
                     )
                  );
        //var_dump($moduleName);
        $mod = $moduleName[0]['contents'];



        $element = $this->WIdb->select(
                    "SELECT `mod_name_function`, `id` FROM `wi_modules`
                     WHERE `name` = :name",
                     array(
                       "name" => $mod
                     )
                  );

        $this->Bootstrap->createModule($module, $page, $element);
    }

}