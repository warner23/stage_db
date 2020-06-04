<?php

class WIPeople
{
	
	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Page = new WIPagination();
    $this->maint = new WIMaintenace();
    $this->actor = new WIActor();
    $this->Cast = new WICast();
    $this->Crew = new WICrew();

	}


  Public function ViewEditPeople()
  {
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 14;
        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_theatre_person`");
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        $JsClass = "WIActor";
        $onclick = "nextPage";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
    $sql = "SELECT * FROM `wi_theatre_person` ORDER BY `id` ASC LIMIT :page, :item_per_page";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':page', $page_position, PDO::PARAM_INT);
    $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
    $query->execute();
    echo '<div class="col-xs-12 col-md-12 col-lg-12">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $people) {
        $photo = $people['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }

        echo '<div class="col-xs-6 col-md-6 col-lg-4">
        <div class="flipcard-' . $people['id'] . ' noflip">
        <span class="btn editing-' . $people['id'] . '">Edit</span>
        <span class="btn actor_delete" onclick="WIActor.delete(`' . $people['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $people['id'] . '">
      <div class="row">
        <div class="col-xs-12">
            <span class="off-grey" id="person_change_pic-' . $people['id'] . '">';
            if(empty($people['photo'])){
                echo '<div class="img-media" id="edit-' . $people['id'] . '"></div>
             <div class="well on" id="uploadOptions">
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`actor`,`edit-' . $people['id'] . '`, `personImg`, `edit-' . $people['id'] . '`, `person`)">Upload from WIMedia Library</a>
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`actors`, `wi_theatre_person`,`person`,`person`,`edit-' . $people['id'] . '`)">upload from computer</a>
                    </div>';
            }else{
               echo '<div class="img-media" id="edit-' . $people['id'] . '"><img class="sm_border_pic" src="WIMedia/Img/person/'. $photo.'"><a href="javascript:void(0);" class="btn actor_change_photo_link" onclick="WIActor.clearPerson(' . $people['id'] . ');">Change Photo</a></div>';
            }
            
          echo '</span>
        </div>
        <div class="col-xs-12">
          <h3 class="personsName" style="margin: 10px 0;">
          <blockquote>
        <p> Name: <input type="text" class="name black" name="name" id="name-' . $people['id'] . '" value="'. $people['name'].'"></p>
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-admin">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom">
                        <span>
                        Biography:<textarea rows="4" cols="50" class="bio name black" id="bio-' . $people['id'] . '">'. $people['biography'].'</textarea>
                        </span>
                        </span>

                         <p>
        Birthplace :<input type="text" class="bcity name black" name="bcity" value="'. $people['city_birth'] . '" id="bcity-' . $people['id'] . '"> <br>
        Birthdate : <input type="text" id="datepicker-' . $people['id'] . '" class="datepicker name black" name="dob" value="'. $people['dob'] . '"> 
      </p>
                      </div>
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WIActor.editPerson(`' . $people['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save
                        </button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
            <span class="off-grey">
            <img class="sm_border_pic" src="WIMedia/Img/person/'. $photo.'">
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="personsName" style="margin: 10px 0;">
          <blockquote>
        <p>'. $people['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_person">
                        <span class="bio"><p class="pbio">'. $people['biography'].'</p>
                        </span>
                        </span>

                         <p>
        <i class="icon-globe"></i> '. $people['city_birth'] . '<br>
        <i class="fas fa-birthday-cake"></i>'. $people['dob'] . '
      </p>
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

                    .editing-' . $people['id'] . '{
                        background-color: #bf6cda;
                      color: white;
                      perspective: 638px;
                      margin-left: 10px;
                      margin-top: 10px;
                  }
                    .flipcard-' . $people['id'] . ' {
                      position: relative;
                      width: 100%;
                      min-height: 412px;
                      perspective: 638px;
                      margin: 0px 6px 10px 0px;
                  }
                  .flipcard-' . $people['id'] . '.flip .front {
                    transform: rotateY(180deg);
                  }
                  .flipcard-' . $people['id'] . '.flip .back {
                    transform: rotateY(0deg);
                  }
                  .flipcard-' . $people['id'] . ' .back{
                    transform: rotateY(-180deg);
                  }
                  .flipcard-' . $people['id'] . ' .front, .flipcard-' . $people['id'] . ' .back
                  {
                        background-color: #2c2c2c;
                      border: 1px solid #222;
                      border-radius: 5px;
                      box-shadow: 0 5px 15px rgba(0,0,0,.5);
                      position: absolute;
                      width: 100%;
                      height: 412px;
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
                        $(document).ready(function(e){

                           $(".editing-' . $people['id'] . '").on("click", function(event) {
                            event.stopPropagation();
                            $(".flipcard-' . $people['id'] . '").toggleClass("flip");
                                      });

                      $( function() {
                          jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
                          $( "#datepicker-' . $people['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
                        } );

                        $("#datepicker-' . $people['id'] . '").change(function() {
                          var date = $(this).datepicker("getDate");
                          $("#datepicker-' . $people['id'] . '").attr("value", date);
                      });



                          var obj = $("#dragandrophandler-' . $people['id'] . '");
                          var dir = $(".supload").attr("value");
                          var ele_id = $(".img-preview-' . $people['id'] . '").attr("id");

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
    echo '</div>';

    $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);

    echo $Pagin;
  }

  public function selectPerson($id)
  {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    echo '<span class="naming" id="' . $res['id'] . '" value="' . $res['name'] . '">' . $res['name'] . '</span>';
  }


    public function selectCastPerson($id)
  {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    $photo = $res['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
    echo '<div class="role">' . $this->actor->SelectActorRole() . '</div>
    <li class="col-md-12 casting"><img class="actorPic" src="WIMedia/Img/person/' . $photo . '" class="img-responsive" value="' . $photo . '">
    <div class="charactor_name">
    <input id="addShows-cast-charactor" name="addShows-character" type="text" class="input-xlarge form-control show_Cast" placeholder="Characters name"  id-"charactor_name" value="Character Name">
    <input id="addCast-actors-id" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['id']. '">
    </div>
     <div class="pb">Played By :</div>
    <div class="playedBy">' . $this->Cast->editPlayedBy($res['id'], $res['show_id']) . '</div></li>';
  }


      public function selectCrewPerson($id)
  {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    $photo = $res['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
    echo '<div class="role">' . $this->Crew->SelectCrewRole() . '</div>
    <li class="col-md-12 casting"><img class="actorPic" src="WIMedia/Img/person/' . $photo . '" class="img-responsive" value="' . $photo . '">
    <div class="charactor_name">
    <input id="addShows-cast-charactor" name="addShows-character" type="text" class="input-xlarge form-control show_Cast" placeholder="Characters name"  id-"charactor_name" value="Character Name">
    <input id="addCast-actors-id" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['id']. '">
    </div>
     <div class="pb">Played By :</div>
    <div class="playedBy">' . $this->Cast->editPlayedBy($res['id'], $res['show_id']) . '</div></li>';
  }


   public function selectCastedPerson($id)
  {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    $photo = $res['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
    echo '<div class="role">' . $this->actor->SelectActorRole() . '</div>
    <li class="col-md-12 casting"><img class="actorPic" src="WIMedia/Img/person/' . $photo . '" class="img-responsive" value="' . $photo . '">
    <div class="charactor_name">
    <input id="addShows-cast-charactor" name="addShows-character" type="text" class="input-xlarge form-control show_Cast" placeholder="Characters name"  id-"charactor_name" value="Character Name">
    <input id="addCast-actors-id" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['id']. '">
    </div>
     <div class="pb">Played By :</div>
    <div class="playedBy">' . $this->Cast->editPlayedBy($res['id']) . '</div></li><a href="javascript:void(0);" class="btn" onclick="WICast.Save(' . $res['id']. ');">Save</a>';
  }


  public function selectEditCastedPerson($id, $cast_id, $show_id)
  {
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    $photo = $res['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }

            echo '<li class="col-md-12 casting" id="cast_' .$cast_id. '">
                <div id="edit_casting_' .$cast_id . '">
                <img src="WIMedia/Img/person/' . $photo . '" class="img-responsive" id="Cast_' . $res['id']. '" value="' . $photo . '">
                <div class="charactor_name">Character\'s Name : <input type="text" id="charactor_name_' . $res['id']. '" placeholder="Characters Name"></div> 
                <div class="pb">Played By :</div>
                <div class="playedBy" id="playedBy">' . $this->Cast->editPlayedBy($res['id'], $show_id) . '
                <div id="select_actor_' . $res['id']. '" value="' . $res['id']. '">
                <div class="role">' . $this->actor->SelectActorRole() . '</div>
                </div>
                </div><a href="javascript:void(0);" class="btn" onclick="WICast.Save(' . $res['id']. ', ' . $show_id . ', ' .$cast_id. ');">Save</a></div></li><style>#Cast_'. $res['id'] . '{
        width: 7%;
    float: left;
}</style>';

/*    echo '<div class="role">' . $this->actor->SelectActorRole() . '</div>
    <li class="col-md-12 casting"><img class="actorPic" src="WIMedia/Img/person/' . $photo . '" class="img-responsive" value="' . $photo . '">
    <div class="charactor_name">
    <input id="addShows-cast-charactor" name="addShows-character" type="text" class="input-xlarge form-control show_Cast" placeholder="Characters name"  id-"charactor_name" value="' . $res['name']. '">
    <input id="addCast-actors-id" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['id']. '">
    </div>
     <div class="pb">Played By :</div>
    <div class="playedBy">' . self::playedBy($res['id']) . '</div></li><a href="javascript:void(0);" class="btn" onclick="WICast.Save(' . $res['id']. ');">Save</a>';*/
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

  public function findCast()
  {
    $sql = "SELECT * FROM `wi_theatre_person`";
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul class="personActor">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $cast) {
        $photo = $cast['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="cast"><a href="javascript:void(0);" class="btn selectionPerson" onclick="WICast.selectPerson(`' . $cast['id'] . '`);"><img class="img-responsive personImage" src="WIMedia/Img/person/' . $photo. '"><span class="cast_name">' . $cast['name']. '</span></a></li>';
      }
     
    }
    echo '</ul>';
  }


    public function findCrew()
  {
    $sql = "SELECT * FROM `wi_theatre_person`";
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul class="personCrew">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $cast) {
        $photo = $cast['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="cast"><a href="javascript:void(0);" class="btn selectionPerson" onclick="WICrew.selectCrewPerson(`' . $cast['id'] . '`);"><img class="img-responsive personImage" src="WIMedia/Img/person/' . $photo. '"><span class="cast_name">' . $cast['name']. '</span></a></li>';
      }
     
    }
    echo '</ul>';
  }


  public function findCasting()
  {
    $sql = "SELECT * FROM `wi_theatre_person`";
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul class="personActor">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $cast) {
        $photo = $cast['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="cast"><a href="javascript:void(0);" class="btn selectionPerson" onclick="WICast.selectedPerson(`' . $cast['id'] . '`);"><img class="img-responsive personImage" src="WIMedia/Img/person/' . $photo. '"><span class="cast_name">' . $cast['name']. '</span></a></li>';
      }
     
    }
    echo '</ul>';
  }


    public function findEditCasting($id, $show_id)
  {
    $sql = "SELECT * FROM `wi_theatre_person`";
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul class="personActor">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $cast) {
        $photo = $cast['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="cast"><a href="javascript:void(0);" class="btn selectionPerson" onclick="WICast.selectedEditingCastingPerson(`' . $cast['id'] . '`, ' . $id .', ' . $show_id . ');"><img class="img-responsive personImage" src="WIMedia/Img/person/' . $photo. '"><span class="cast_name">' . $cast['name']. '</span></a></li>';
      }
     
    }
    echo '</ul>';
  }

    public function addPerson($name, $bio, $dob, $img)
    {
                $sql = "SELECT * FROM `wi_theatre_person` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetch();
    //print_r($res);
  if (empty($res)) {

        if(empty($name)){
          echo 'Must Value can not be blank';
        }

      
        $this->WIdb->insert('wi_theatre_person', array(
            "name"     => $name,
            "biography"  => $bio,
            "dob"  => $dob,
            "photo" => $img
        )); 

        $PersonId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New person";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new person";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "person_id"  => $PersonId
            );

            echo json_encode($result);

    }else{
    $msg = "The Person you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


      public function addPersonel($name, $dob, $bcity, $bio,  $img)
    {
                $sql = "SELECT * FROM `wi_theatre_person` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    //print_r($res);

  if (count($res) <1) {

        if(empty($name)){
              echo 'Must Value can not be blank';
            }

          if(empty($dob)){
            $dob = null;
        }

        if(empty($bcity)){
            $bcity = null;
        }

        if(empty($bio)){
            $bio = null;
        }

        if(empty($img)){
            $img = null;
        }
         $sql = "INSERT INTO `wi_theatre_person` (`name`, `dob`, `city_birth`, `biography`, `photo`) values (:name, :dob, :bcity, :bio, :img)";
        
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':dob', $dob, PDO::PARAM_STR);
        $stmt->bindParam(':bcity', $bcity, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();
       
        $PersonId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New person";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new person";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "person_id"  => $PersonId
            );

            echo json_encode($result);

    }else{
    $msg = "The Person you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg//,
                //"dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


  public function showInstalledPerson($id)
  { 
     $sql = "SELECT * FROM `wi_theatre_person` WHERE `id`=:id";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    $photo = $res['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
    echo '<li class="ui-state-default ui-corner-all showperson">
                            <form class="form-people">
                          <article class="post_container" id="PersonPost">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                          <div class="showpersonnel">' . $res['name'] . '

      </label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <figure class="post-image" id="show_Image">            
        <div class="showpersonnel"><div class="img-preview"><img src="WIMedia/Img/person/' . $photo.'"></div></div>
      </figure>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="showpersonnel">' . $res['biography'].'
  </div></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="showpersonnel">' . $res['biography'].'

    </div></div></article>
  </form>
                       </li>';
  }


  public function editPerson($id, $name, $bio, $bcity, $dob, $img)
  {

        if (empty($img)) {
          $sql = "UPDATE `wi_theatre_person` SET  `city_birth` =:bcity, `name`=:name, `biography`=:bio, `dob`=:dob WHERE  `id` =:id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':bio', $bio, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':bcity', $bcity, PDO::PARAM_STR);
        $query->execute();
        }else{
          $sql = "UPDATE `wi_theatre_person` SET  `city_birth` =:bcity, `name`=:name, `biography`=:bio, `dob`=:dob, `photo`=:img WHERE  `id` =:id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':bio', $bio, PDO::PARAM_STR);
        $query->bindParam(':dob', $dob, PDO::PARAM_STR);
        $query->bindParam(':img', $img, PDO::PARAM_STR);
        $query->bindParam(':bcity', $bcity, PDO::PARAM_STR);
        $query->execute();
        }
        


         $st1  = WISession::get('user_id') ;
            $st2  = "Edited person";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new person";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "person_id"  => $PersonId
            );

            echo json_encode($result);
  }


  public function deletePerson($id)
  {
    $sql = "DELETE FROM `wi_theatre_person` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $msg = "You have successfully added a deleted a person";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg            
              );

            echo json_encode($result);
  }


  Public function searchPerson($search)
  {
    //echo $search;
    $sql = "SELECT * FROM `wi_theatre_person` WHERE `name` LIKE '%" .$search . "%'";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $people) {
        $photo = $people['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-6 col-md-6 col-lg-3">
        <div class="flipcard-' . $people['id'] . '"><span class="btn editing-' . $people['id'] . '">Edit</span><span class="btn delete" onclick="WIActor.delete(`' . $people['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $people['id'] . '">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x">
            <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler-' . $people['id'] . '" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview" id="preview' . $people['id'] . '"></div>
        <div class="upload-msg" id="status"></div>
                <input type="hidden" name="supload" id="supload" class="supload" value="person">

      </figure>
            </span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="personsName" style="margin: 10px 0;"><blockquote>
        <p><input type="text" class="name" name="name" id="name" value="'. $people['name'].'"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom"><span><textarea rows="4" cols="50" class="bio" id="bio">'. $people['biography'].'</textarea></span></span>

                         <p>
        <i class="icon-globe"></i><input type="text" class="bcity" name="bcity" value="'. $people['city_birth'] . '"> <br>
        <i class="fas fa-birthday-cake"></i><input type="text" id="datepicker' . $people['id'] . '" class="datepicker" name="dob" value="'. $people['dob'] . '"> 
      </p>
                      </div>
                    </div>
                    <p style="font-size: 12px;" class="text-center demure">More ...</p>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WIActor.editPerson(`' . $people['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x"><img src="WIMedia/Img/person/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;></span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="personsName" style="margin: 10px 0;"><blockquote>
        <p>'. $people['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_person"><span class="bio"><p class="pbio">'. $people['biography'].'</p></span></span>

                         <p>
        <i class="icon-globe">Birth City</i> '. $people['city_birth'] . '<br>
        <i class="fas fa-birthday-cake">Birthday</i>'. $people['dob'] . '
      </p>
                      </div>
                    </div>
                    <p style="font-size: 12px;" class="text-center demure">More ...</p>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                         <span id="free" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Viewing</span>
                      </div>
                    </div>
                  </div>
        </div>
    </div>
  </div>
  <style>

  .editing-' . $people['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-' . $people['id'] . ' {
    position: relative;
    width: 244px;
    height: 412px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-' . $people['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-' . $people['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-' . $people['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-' . $people['id'] . ' .front, .flipcard-' . $people['id'] . ' .back
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

    $("body").delegate(".editing-' . $people['id'] . '", "click", function(){
        $(".flipcard-' . $people['id'] . '").toggleClass("flip");
        });

$( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker' . $people['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker' . $people['id'] . '").attr("value", date);
});



  var obj = $("#dragandrophandler-' . $people['id'] . '");
  var dir = $(".supload").attr("value");
  var ele_id = $(".img-preview").attr("id");

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

}
?>