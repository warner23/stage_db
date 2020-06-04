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

    
    public function addingCrewPerson($show_id, $show_name, $character_name, $actor_id, $img, $role)
  {

        //echo "shid". $show_id;
    $this->WIdb->insert('wi_theatre_crew', array(
            "person_id"     => $actor_id,
            "role"  => $role,
            "show_id"  => $show_id,
            "photo" => $img,
            "play_name" => $show_name
        )); 

        $CrewId = $this->WIdb->lastInsertId();

         $sqlz = "UPDATE `wi_theatre_person` SET  `role` =:role, `show_id`=:show_id, `crew_id`=:cast_id WHERE `id` =:actor_id";

         $queryz = $this->WIdb->prepare($sqlz);
        $queryz->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $queryz->bindParam(':role', $role, PDO::PARAM_INT);
        $queryz->bindParam(':show_id', $show_id, PDO::PARAM_INT);
        $queryz->bindParam(':cast_id', $show_id, PDO::PARAM_INT);
        $queryz->execute();

        $sql0 = "UPDATE `wi_shows` SET  `crew_id` =:show_id WHERE `id` =:show_id";

         $query0 = $this->WIdb->prepare($sql0);
        $query0->bindParam(':show_id', $show_id, PDO::PARAM_INT);
        $query0->bindParam(':show_id', $show_id, PDO::PARAM_INT);
        $query0->execute();
    
        $msg = "Cast Member Created and Assigned";

        $display = '<li class="col-md-12 casting">
    <div class="charactor_name">
    <div id-"charactor_name" value="' . $character_name . '" class="input-xlarge form-control findShowCast">' . $character_name . '</div>
    </div>
     <div class="pb">Played By :</div><img class="actorPic" src="WIMedia/Img/person/' . $img . '" class="img-responsive" value="' . $img . '"></li>';
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "display"  => $display

            );

            echo json_encode($result);
  }


   public function editCastingPerson($person_id, $show_id, $show_name, $character_name, $cast_id, $actor_id, $img, $role)
  {

    $sql = "SELECT * FROM `wi_theatre_crew` WHERE `id`=:cast_id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':cast_id', $cast_id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    //print_r($res);
    //echo $actor_id;
    //echo "resid". $res['id'];
    if (empty($res['id'])) {
      //echo "string";
      $this->WIdb->insert('wi_theatre_crew', array(
            "actor_id"     => $actor_id,
            "character_name"  => $character_name,
            "show_id"  => $show_id,
            "photo" => $img,
            "play_name" => $show_name
        )); 

      $castId = $this->WIdb->lastInsertId();
    }else{
      //echo "hey";

      $sql0 = "UPDATE `wi_theatre_crew` SET `actor_id`=:actor_id, `character_name`=:character_name, `show_id`=:show_id, `photo`=:img, `play_name`=:show_name WHERE `id`=:cast_id";

    $stmt = $this->WIdb->prepare($sql0);
    $stmt->bindParam('cast_id', $cast_id, PDO::PARAM_INT);
    $stmt->bindParam('actor_id', $actor_id, PDO::PARAM_STR);
    $stmt->bindParam('character_name', $character_name, PDO::PARAM_STR);
    $stmt->bindParam('show_id', $show_id, PDO::PARAM_STR);
    $stmt->bindParam('img', $img, PDO::PARAM_STR);
    $stmt->bindParam('show_name', $show_name, PDO::PARAM_STR);
    $stmt->execute();
    }

        

     $sqlz = "UPDATE `wi_theatre_person` SET  `role` =:role, `show_id`=:show_id, `cast_id`=:cast_id WHERE `id` =:actor_id";

         $queryz = $this->WIdb->prepare($sqlz);
        $queryz->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $queryz->bindParam(':role', $role, PDO::PARAM_STR);
        $queryz->bindParam(':show_id', $show_id, PDO::PARAM_INT);
        $queryz->bindParam(':cast_id', $cast_id, PDO::PARAM_INT);
        $queryz->execute();
    
        $msg = "Cast Member edited and Assigned";


        $display =  '<li class="col-md-12 casting">

                <img src="WIMedia/Img/person/' . $img . '" class="img-responsive" id="Cast" value="' . $photo . '">
                <div class="charactor_name" id-"charactor_name">' . $character_name . '</div> 
                <div class="pb">Played By :</div><div class="playedBy" id="playedBy">' . self::playedBy($actor_id) . '</div></li>';


       /* $display = '<li class="col-md-12 casting">
    <div class="charactor_name">
    <div id-"charactor_name" value="' . $character_name . '" class="input-xlarge form-control findShowCast">' . $character_name . '</div>
    </div>
     <div class="pb">Played By :</div><img class="actorPic" src="WIMedia/Img/person/' . $img . '" class="img-responsive" value="' . $img . '"></li>';*/
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "display"  => $display

            );

            echo json_encode($result);
  }




  Public function ViewEditShowingCrew()
  {
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_shows`");
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        $JsClass = "WICrew";
        $onclick = "NextCrew";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
    $sql = "SELECT * FROM `wi_shows` ORDER BY `id` ASC LIMIT :page, :item_per_page";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':page', $page_position, PDO::PARAM_INT);
    $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $show) {
        $photo = $show['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        $cast_id = $show['cast_id'];
        if ($cast_id > 0) {
           echo '<div class="col-xs-12 col-md-12 col-lg-12">
        <div class="flipcard-' . $show['id'] . '">
        <span class="btn editing-' . $show['id'] . '">Edit</span>
        <span class="btn casting-delete" onclick="WIShow.delete(`' . $show['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $show['id'] . '">
      <div class="row">
        <div class="col-xs-4">
          <span class="btn casting-delete" onclick="WICast.addCast(`' . $show['id'] . '`);">Add Cast</span>
        </div>
        <div class="col-xs-6">
          <input type="hidden" value="' . $show['name'] . '" id="show_Name_' . $show['id'] . '">
        
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
                   <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cast" id="casty">';self::editGetCrew($show['id']); echo '</div> 
                       </div>
                  <div class="end-bit">
                   </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-4">
        <span class="off-grey-show">
    <img class="img-responsive" src="WIMedia/Img/shows/'. $photo.'" style="border-radius: 36px;">
    </span>
        </div>
        <div class="col-xs-6">
          <h3 class="showsName"><blockquote class="blockquoteCast">
        <p>'. $show['name'].'</p>
        
      </blockquote></h3>
      <h3 class="showsLocation"><blockquote class="blockquoteCast">
        <p>';echo $this->theatre->getLocation($show['id']); echo '</p>
        
      </blockquote></h3>
      <h3 class="showsTheatre"><blockquote class="blockquoteCast">
        <p>'. $show['theatre'].'</p>
        
      </blockquote></h3>
      <h3 class="showsName"><blockquote class="blockquoteCast">
        <p>'. $show['theatre_company'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <legend>Crew</legend>
                             <div id="cast">';self::getCrew($show['id']); echo '</div>
                      </div>
                        </div>
                       
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                      </div>
                    </div>
                  </div>
        </div>
    </div>
  </div>
   <style>

   #dragandrophandler-' . $show['id'] . '
{
    border: 2px dotted #0B85A1;
    width: 100%;
    color: #92AAB0;
    text-align: left;
    vertical-align: middle;
    padding: 10px 10px 10 10px;
    margin-bottom: 8px;
    margin-top: 30px;
    font-size: 102%;
}

  .editing-' . $show['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-' . $show['id'] . ' {
    min-width: 100%;
    position: relative;
    transition: transform 3s;
    border-radius: 25px;
    padding: 20px 0px 20px 2px;
    overflow: hidden;
    min-height: 412px;
    margin: 0px 6px 10px 0px;
    opacity: .99;
}
.flipcard-' . $show['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-' . $show['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-' . $show['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-' . $show['id'] . ' .front, .flipcard-' . $show['id'] . ' .back
{
      background-color: #2c2c2c;
    border: 1px solid #222;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    position: absolute;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    transition: all 1s ease 0s;
    color: white;
    padding: 10px 23px;
    backface-visibility: hidden;
    top: 5px;
    z-index: -1;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){

   $(".editing-' . $show['id'] . '").on("click", function(event) {
                            event.stopPropagation();
                            $(".flipcard-' . $show['id'] . '").toggleClass("flip");
                                      });

  var obj = $("#dragandrophandler-' . $show['id'] . '");
  var dir = $(".supload").attr("value");
  var ele_id = $(".img-preview-' . $show['id'] . '").attr("id");

obj.on("dragenter", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css("border", "2px solid #0B85A1");
});
obj.on("dragover", function (e) 
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on("drop", function (e)
{
 
     $(this).css("border", "2px dotted #0B85A1");
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
     //We need to send dropped files to Server
     showCreationhandleFileUpload(files,obj, dir, ele_id);
});
$(document).on("dragenter", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on("dragover", function (e)
{
e.stopPropagation();
  e.preventDefault();
  obj.css("border", "2px dotted #0B85A1");
});
$(document).on("drop", function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});

});
</script>';
        }
       
      }
     
    }

    $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);

    echo $Pagin;
  }


      public function SelectCrewRole()
  {
    $query = $this->WIdb->prepare('SELECT * FROM wi_theatre_roles');
    $query->execute();
    echo '<label for="CrewRole">Crew Role</label><select name="CrewRole" id="CrewRole"><option selected="selected">Select Crew role</option>';
    while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
    }
    echo ' </select>';
  }


  public function getCrew($id)
  {
    //echo "id".$id;
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
                <img src="WIMedia/Img/person/' . $photo . '" class="img-responsive" id="Cast" value="' . $photo . '">
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

     public function editGetCrew($id)
  {
    //echo "id".$id;
     $sql = "SELECT * FROM `wi_theatre_crew` WHERE `show_id`=:crew_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':crew_id', $id, PDO::PARAM_INT);
        $query->execute();
        echo '<ul class="show_casting">';
        $res = $query->fetchAll();
        foreach ($res as $cast ) {
            //print_r($cast);
            $photo = $cast['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
                
                echo '<li class="col-md-12 casting">

                <img src="WIMedia/Img/person/' . $photo . '" class="img-responsive" id="Cast" value="' . $photo . '">
                <div class="charactor_name" id-"charactor_name"><input type="text" id="edit_charactor_name-' .  $cast['id'] . '" value="' . $cast['character_name'] . '"></div> 
                <div class="pbc">Played By :</div><div class="playedBy" id="playedBy">' . self::editplayedBy($cast['actor_id'], $cast['show_id']) . '</div> <a href="javascript:void(0);" onclick="WICast.saveEditCharacter(' .  $cast['id'] . ');" class="btn">Save</a></li>';
            }
           echo '</ul>'; 
    
  }

    public function editPlayedBy($actor_id, $show_id)
   {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:actor_id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':actor_id', $actor_id, PDO::PARAM_INT);
        $query->execute();
        $res = $query->fetch();
        $name = $res['name'];

        $div = '<a href="javascript:void(0);" class="btn btn-primary actor-' . $actor_id . ' show" id="findPeople" onclick="WICast.inDisplayfindPerson(' . $actor_id . ', ' .$show_id . ')">Find Person</a>';
        if(empty($name))
          return $div;
        else
        return $name;
   }


   public function FindActor()
   {

   }

   public function EditCharater($id, $charactor_name)
   {
    $sql = "UPDATE `wi_theatre_cast` SET `character_name`=:character_name WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->bindParam(':character_name', $charactor_name, PDO::PARAM_STR);
    $query->execute();

    $msg = "Successfully updated Character Name " . $charactor_name;
     $result = array(
                "status" => "success",
                "msg"    => $msg
            );

    echo json_encode($result);
   }

   

} 