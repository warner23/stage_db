<?php

/**
* Pages Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WIPage
{

	function __construct() 
  {
       $this->WIdb = WIdb::getInstance();
  }


    public function GetColums($page_id, $column)
    {

          $result = $this->WIdb->select(
                    "SELECT * FROM `wi_page` WHERE `name` =:name", array(
                      "name" => $page_id
                    )
                  );
              //var_dump($result);
              return $result[$column];

      /*$sql = "SELECT * FROM `wi_page` WHERE `name` =:name";
      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':name', $page_id, PDO::PARAM_STR);
      $query->execute();
      $res = $query->fetch(PDO::FETCH_ASSOC);
      return $res[$column];*/
    }




   
}