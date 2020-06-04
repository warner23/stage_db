<?php

/**
* WICrew Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WICrew {

    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $this->theatre = new WITheatres();
        $this->Page = new WIPagination();
    }


  public function showCrew($id)
  {
   // echo "id".$id;
     $sql = "SELECT * FROM `wi_theatre_crew` WHERE `show_id`=:cast_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':cast_id', $id, PDO::PARAM_INT);
        $query->execute();
        echo '<ul class="show_casting" id="show_casting">';
        $res = $query->fetchAll();
        foreach ($res as $crew ) {
            //print_r($cast);
            $photo = $crew['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
               echo '<li class="col-md-12 casting" id="cast_' .$crew['id'] . '">
                <div id="edit_casting_' .$crew['id'] . '">
                <img src="WIAdmin/WIMedia/Img/person/' . $photo . '" class="img-responsive" id="Cast" value="' . $photo . '">
                <div class="charactor_name" id-"role">'; echo self::rolePosition($crew['role']); echo '</div> 
                <div class="playedBy" id="playedBy">'; echo self::PlayedBy($crew['person_id'], $id); echo '<div id="select_actor"></div></div></div></li>';
            }
           echo '</ul>'; 
    
  }


  public function playedBy($actor_id)
   {
    //echo $actor_id;
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:actor_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetch();
        $name = $res['name'];

        return $name;
   }

   public function rolePosition($role)
   {
    //echo $role;
      $sql = "SELECT * FROM `wi_theatre_roles` WHERE `id`=:id";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':id', $role, PDO::PARAM_INT);
      $query->execute();

      $res = $query->fetch();
        $name = $res['name'];

        return $name;

   }

  
}