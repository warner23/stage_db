<?php

/**
* WICast Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WICast {


    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $this->login = new WILogin();
        $this->Info = new WIUserInfo();
        $this->user   = new WIUser(WISession::get('user_id'));
    }

    public function showCast($cast_id)
   {
    //echo "t". $theatre_id;
    //echo "casty" . $cast_id;
        $sql = "SELECT * FROM `wi_theatre_cast` WHERE `show_id`=:cast_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':cast_id', $cast_id, PDO::PARAM_INT);
        $query->execute();
        echo '<ul class="show_casting">';
        $res = $query->fetchAll();
        foreach ($res as $cast ) {
            //print_r($cast);
            $photo = $cast['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
                echo '<li class="col-md-12 casting"><img src="WIAdmin/WIMedia/Img/person/' . $photo . '" class="img-responsive" id="Cast" value="' . $photo . '">
                <div class="charactor_name" id-"charactor_name">' . $cast['character_name'] . '</div> 
                <div class="pb">Played By :</div><div class="playedBy" id="playedBy"><a class="cast_link" href="Actor.php" id="' . $cast['actor_id'] . '">' . self::playedBy($cast['actor_id']) . '</a></div></li>';
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