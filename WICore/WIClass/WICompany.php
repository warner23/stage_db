<?php

/**
* WICompany Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WICompany
{

	    function __construct() 
    {
         $this->WIdb = WIdb::getInstance();
         $this->Page = new WIPagination();
         $this->maint = new WIMaintenace();
         $this->theatre = new WITheatres();

    }

  public function SelectCompamy()
  {
    $query = $this->WIdb->prepare('SELECT * FROM wi_theatre_company');
    $query->execute();
    echo '<label for="company">company</label><select name="company" id="company"><option selected="selected">Select Theatre Company</option>
    <option value="0">UNDISCLOSED</option>';
    while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
    }
    echo ' </select>';
  }

    public function companyInfo($company_id)
    {
     // echo "c". $company_id;
        $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:company_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('company_id', $company_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        //print_r($res);
        echo json_encode($res);
    }

   public function showCompany($company_id)
   {
    //echo $company_id;
   		$sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:company_id";

   		$query = $this->WIdb->prepare($sql);
   		$query->bindParam(':company_id', $company_id, PDO::PARAM_INT);
   		$query->execute();
   		echo '<ul>';
   		$res = $query->fetchAll();
   		foreach ($res as $company ) {
   			echo '<li><a class="company_link" href="company.php" id="' . $company['id'] . '">' . $company['name'] . '</a></li>';
   		}
   		echo '</ul>';
   }

   public function companyShows($company_id)
   {
    $sql = "SELECT * FROM `wi_viewings` WHERE `company_id`=:company_id";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':company_id', $company_id, PDO::PARAM_INT);
      $query->execute();
      echo '<ul>';
      $res = $query->fetchAll();
      foreach ($res as $shows ) {
        echo '<li><a class="show_link" href="show.php" id="' . $shows['id'] . '">' . $shows['name'] . '</a></li>';
      }
      echo '</ul>';
   }

   public function companyName($company_id)
    {
     // echo "c". $company_id;
        $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:company_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('company_id', $company_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        $company = $res['name'];

        return $company;
    }



   public function InsertCompany($name, $address,$bio,$user,$Image)
    {

        $sql = "SELECT * FROM `wi_theatre_company` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetch();
    print_r($res);
  if (empty($res)) {

    $this->WIdb->insert('wi_theatre_company', array(
            "name" => $name,
            "address" => $address,
            "biography" => $bio,
            "photo" => $Image
        )); 

        $st1  = $user ;
            $st2  = "Added New Show";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg
            );

            echo json_encode($result);
  }else{
    $msg = "The Theatre you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
  }
    }



}