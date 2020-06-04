<?php

/**
* WIActor Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WIActor {


    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
    }


    public function SelectActorRole()
  {
    $query = $this->WIdb->prepare('SELECT * FROM wi_theatre_roles');
    $query->execute();
    echo '<label for="CastRole">Cast Role</label><select name="CastRole" id="CastRole"><option selected="selected">Select Cast role</option>';
    while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
    }
    echo ' </select>';
  }

    public function ActorInfo($actor_id)
    {
     // echo "c". $company_id;
        $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:actor_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('actor_id', $actor_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        //print_r($res);
        echo json_encode($res);
    }

    public function showActor($actor_id)
   {
    //echo "t". $theatre_id;
       $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:actor_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();
        $showing = $result['show_id'];
        //$parts = str_split($showing);
        $shows=explode(",",$showing);
        //print_r($parts);
        //print_r($shows);
         echo '<ul>';
        //print_r($shows);
        foreach ($shows as $show) {
            //echo $show;
            $sql1 = "SELECT * FROM `wi_shows` WHERE `id`=:actor_id";

        $query1 = $this->WIdb->prepare($sql1);
        $query1->bindParam(':actor_id', $show, PDO::PARAM_INT);
        $query1->execute();
          
        $res = $query1->fetch();
        //print_r($res);
        $photo = $result['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
            echo '<li class="col-md-8 casting">
            <img src="WIAdmin/WIMedia/Img/actor/' . $photo . '" class="img-responsive">' . $res['name'] . '<a class="show_link" href="show.php" id="' . $res['id'] . '"></a>
            </li>';
        }
        echo '</ul>';
 
   }

   public function playedBy($actor_id)
   {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:actor_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetch();
        $name = $res['name'];

        return $name;
   }

   

} 