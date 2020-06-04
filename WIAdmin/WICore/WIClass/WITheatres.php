<?php

class WITheatres
{
	
	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Page = new WIPagination();
    $this->maint = new WIMaintenace();
    $this->site = new WISite();
    $this->feature = new WIFeatures();

	}

  Public function ViewEdittheatre()
  {
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_theatres`");
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        $JsClass = "WITheatres";
        $onclick = "NextTheatre";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
    $sql = "SELECT * FROM `wi_theatres` ORDER BY `id` ASC LIMIT :page, :item_per_page";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':page', $page_position, PDO::PARAM_INT);
    $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
    $query->execute();
    echo '<div class="col-xs-12 col-md-12 col-lg-12">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $theatre) {
        $photo = $theatre['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-12 col-md-10 col-lg-10">
        <div class="flipcard-' . $theatre['id'] . '">
        <span class="btn editing-' . $theatre['id'] . '">Edit</span>
        <span class="btn theatre-delete" onclick="WITheatres.delete(`' . $theatre['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $theatre['id'] . '">
      <div class="row">
        <div class="col-xs-6">
             <span class="off-grey" id="theatre_change_pic-' . $theatre['id'] . '">';
             if(empty($theatre['photo'])){
            echo '<div class="img-media" id="edit-' . $theatre['id'] . '"></div>
             <div class="well on" id="uploadOptions">
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`theatres`,`edit-' . $theatre['id'] . '`, `theatreImg`, `edit-' . $theatre['id'] . '`, `theatres`)">Upload from WIMedia Library</a>
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`theatres`, `wi_theatres`,`theatres`,`theatres`,`edit-' . $theatre['id'] . '`)">upload from computer</a>
                    </div>';
                  }else{
                    echo '<div class="img-media" id="edit-' . $theatre['id'] . '"><img class="sm_border_pic" src="WIMedia/Img/theatres/'. $photo.'"><a href="javascript:void(0);" class="btn theatre_change_photo_link" onclick="WITheatres.clearTheatre(' . $theatre['id'] . ');">Change Photo</a></div>';
                  }
          echo '</span>

        </div>
        <div class="col-xs-6">
          <h3 class="theatresName"><blockquote>
        <p>Name : <input type="text" class="name black" name="name" id="name-' . $theatre['id'] . '" value="'. $theatre['name'].'" placeholder="Theatre Name"></p>
        
      </blockquote></h3>
        </div>

        <div class="col-xs-12">
        Description : <textarea rows="4" cols="50" class="bio name black" id="bio-' . $theatre['id'] . '" placeholder="Biography">'. $theatre['description'].'</textarea>
        </div>
      </div>
          </div>
          <div class="middle-bit-theatre">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        

          <div class="form-group">
            <div class="col-sm-10">
              First Line :<input type="text" placeholder="Address Line 1" id="line1-' . $theatre['id'] . '" class="form-control name black" value="'. $theatre['first_line'].'">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10">
              Second Line : <input type="text" placeholder="Address Line 2" id="line2-' . $theatre['id'] . '" class="form-control name black" value="'. $theatre['second_line'].'">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-10">
              Town : <input type="text" placeholder="City" id="city-' . $theatre['id'] . '" class="form-control name black" value="'. $theatre['city'].'">
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-4">
              County : <input type="text" placeholder="State" id="region-' . $theatre['id'] . '" class="form-control name black" value="'. $theatre['region'].'">
            </div>
            </div>

<div class="form-group">
            <div class="col-sm-4">
              Postcode : <input type="text" placeholder="Post Code" id="postcode-' . $theatre['id'] . '" class="form-control name black" value="'. $theatre['postcode'].'">
            </div>
          </div>

<div class="form-group">
            <div class="col-sm-4 theatre_country">
              Country : '; $this->site->Country($theatre['id']); echo '
            </div>
          </div>


                  </div>


                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                  $features = $this->feature->Theatre_Features_added($theatre['id']);
                  if ($features != false) {
                    echo '<div id="create_features" class="btn hide">
                  <a href="javascript:void(0);" onclick="WIFeatures.CreateFeatures(`feature`,' . $theatre['id'] .');">Create Features</a></div>
                  <div id="installed_features" class="show">';
                  }else{
                    echo '<div id="create_features" class="btn show">
                  <a href="javascript:void(0);" onclick="WIFeatures.CreateFeatures(`feature`,' . $theatre['id'] .');">Create Features</a></div>
                  <div id="installed_features" class="hide">';
                  }
                  
echo '<script type="text/javascript">
                          $( function() {
   //$( "input" ).checkboxradio();
  } );
  </script>
                    <form  class="form-horizontal" id="features-form">
                        <fieldset>
                        <legend>Features</legend>';

                        $this->feature->getTheatreFeatures($theatre['id']);

                       
                        echo '</fieldset>
                      </form>

                      
                      </div>

                      </div>
                      <div class="form-group">
                        <!-- Button -->
                      </div>
                      <div class="results" id="sesresults"></div>
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WITheatres.editTheatre(`' . $theatre['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-4">
        <span class="off-grey-theatre">
    <img src="WIMedia/Img/theatres/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;">
    </span>
        </div>
        <div class="col-xs-6">
          <h3 class="theatresName"><blockquote>
        <p>'. $theatre['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="tbio">'. $theatre['description'].'</p>
                        </div>

          </div>
          <div class="middle-bit-theatre">
                    <div class="row">
    
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <!-- Form Name -->
                       <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">  
          <legend>Address Details</legend>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
            '. $theatre['first_line'].'
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
              '. $theatre['second_line'].'     
              </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
              '. $theatre['city'].'
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            '. $theatre['region'].'
            <div class="col-sm-12">
            
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-12">
              '. $theatre['postcode'].'
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
              '. $theatre['country'].'
            </div>
          </div>
          </div>

            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <iframe class="google_mapping" src="//www.google.com/maps/embed/v1/place?q='. $theatre['name'].','. $theatre['first_line'].','. $theatre['city'].','. $theatre['postcode'].','. $theatre['country'].'
      &zoom=17
      &key=' .  GOOGLE_MAP_API . '">
  </iframe>
            </div>



                      
                      </div>

                      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" id="installed_features">';
                      echo '<legend>Features</legend>';
                      $chair = "wheelchair_access";
                        $wheelchair = $this->feature->availableFeatures($theatre['id'], $chair);
                        //echo $wheelchair;
                        if ($wheelchair > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheels"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheels"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $dt = "disabled_toliets";
                        $disabled_toliets = $this->feature->availableFeatures($theatre['id'], $dt);
                       //echo $disabled_toliets;
                        if ($disabled_toliets > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsToliet"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsToliet"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $wc = "toliets";
                        $toliets = $this->feature->availableFeatures($theatre['id'], $wc);
                        //echo $wheelchair;
                        if ($toliets > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="toliets"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="toliets"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $bar = "bar";
                        $theatre_bar = $this->feature->availableFeatures($theatre['id'], $bar);
                        //echo $theatre_bar;
                        if ($theatre_bar > 0) {
                          echo '<li class="list-group-item" id="feature-list" >Bar :
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" >Bar :
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $hearing_aid = "hearing_assistance";
                        $hearing = $this->feature->availableFeatures($theatre['id'], $hearing_aid);
                        //echo $wheelchair;
                        if ($hearing > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="loop"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="loop"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $dp = "disabled_parking";
                        $dparking = $this->feature->availableFeatures($theatre['id'], $dp);
                        //echo $wheelchair;
                        if ($dparking > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsparking"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsparking"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $gdogs = "guide_dogs";
                        $dogs = $this->feature->availableFeatures($theatre['id'], $gdogs);
                        //echo $wheelchair;
                        if ($dogs > 0) {
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsdogs"></div>
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" ><div class="wheelsdogs"></div>
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }

                        $stairs = "stairs";
                        $stair = $this->feature->availableFeatures($theatre['id'], $stairs);
                        //echo $wheelchair;
                        if ($stair > 0) {
                          echo '<li class="list-group-item" id="feature-list" >Stairs:
                            <span class="badge badge-success" id="php-true" ><i class="fa fa-check"></i></span>
                        </li>';
                        }else{
                          echo '<li class="list-group-item" id="feature-list" >Stairs :
                            <span class="badge badge-danger" id="php-false" ><i class="fa fa-times"></i></span>
                        </li>';
                        }




                      echo '</div>
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

  .editing-' . $theatre['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-' . $theatre['id'] . ' {
    position: relative;
    width: 100%;
    height: 992px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-' . $theatre['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-' . $theatre['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-' . $theatre['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-' . $theatre['id'] . ' .front, .flipcard-' . $theatre['id'] . ' .back
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

      $("select#countries' . $theatre['id'] . '").on("change", function() {
                           // alert( this.value );

            $("select#countries' . $theatre['id'] . '").attr("value" , this.value );

      })
   $(".editing-' . $theatre['id'] . '").on("click", function(event) {
                            event.stopPropagation();
                            $(".flipcard-' . $theatre['id'] . '").toggleClass("flip");
                                      });

  var obj = $("#dragandrophandler-' . $theatre['id'] . '");
  var dir = $(".supload").attr("value");
  var ele_id = $(".img-preview-' . $theatre['id'] . '").attr("id");

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

  public function selecttheatre($id)
  {
    $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    echo '<span class="naming" id="' . $res['id'] . '" value="' . $res['name'] . '">' . $res['name'] . '</span>';
  }


    public function addtheatre($name, $bio, $address, $img)
    {
                $sql = "SELECT * FROM `wi_theatres` WHERE `name`=:name";
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

      
        $this->WIdb->insert('wi_theatres', array(
            "name"     => $name,
            "description"  => $bio,
            "address"  => $address,
            "photo" => $img
        )); 

        $theatreId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New theatre";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "theatre_id"  => $theatreId
            );

            echo json_encode($result);

    }else{
    $msg = "The theatre you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


      public function Createtheatre($name, $line1, $line2, $city, $region, $postcode, $country, $bio,  $img)
    {
                $sql = "SELECT * FROM `wi_theatres` WHERE `name`=:name AND `city`=:city";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':city', $city, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    //print_r($res);

  if (count($res) <1) {

        if(empty($name)){

          $msg = "You Have not Entered a value for the theatre Name !";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg            
              );

            echo json_encode($result);
            }

         
         $sql = "INSERT INTO `wi_theatres` (`name`, `first_line`, `second_line`, `city`, `region`, `postcode`, `country`, `description`, `photo`) values (:name, :line1, :line2, :city, :region, :postcode, :country, :bio, :img)";
        
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':line1', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line2', $lin2, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();
       
        $theatreId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New theatre";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "theatre_id"  => $theatreId
            );

            echo json_encode($result);

    }else{
    $msg = "The theatre you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg//,
                //"dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


  public function showInstalledtheatre($id)
  { 
     $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:id";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    $photo = $res['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
    echo '<li class="ui-state-default ui-corner-all showtheatre">
                            <form class="form-theatre">
                          <article class="post_container" id="theatrePost">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                          <div class="showtheatrenel">' . $res['name'] . '

      </label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <figure class="post-image" id="show_Image">            
        <div class="showtheatrenel"><div class="img-preview"><img src="WIMedia/Img/theatres/' . $photo.'"></div></div>
      </figure>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="showtheatrenel">' . $res['description'].'
  </div></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="showtheatrenel">' . $res['description'].'

    </div></div></article>
  </form>
                       </li>';
  }


  public function editTheatre($id, $name, $line1, $line2, $city, $region, $postcode, $country, $bio,  $img, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking)
  {

      if(empty($img)){
                  $sql = "UPDATE `wi_theatres` SET  `first_line` =:line1, `second_line` =:line2, `city` =:city, `region` =:region, `postcode` =:postcode, `name`=:name, `description`=:bio, `country`=:country WHERE  `id` =:id";
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':line1', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line2', $lin2, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->execute();

        $this->feature->editFeatures($id, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking);


         $st1  = WISession::get('user_id') ;
            $st2  = "Edited theatre";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "theatre_id"  => $theatreId
            );

            echo json_encode($result);
      }else{

                  $sql = "UPDATE `wi_theatres` SET  `first_line` =:line1, `second_line` =:line2, `city` =:city, `region` =:region, `postcode` =:postcode, `name`=:name, `description`=:bio, `country`=:country, `photo`=:img WHERE  `id` =:id";
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':line1', $line1, PDO::PARAM_STR);
        $stmt->bindParam(':line2', $lin2, PDO::PARAM_STR);
        $stmt->bindParam(':city', $city, PDO::PARAM_STR);
        $stmt->bindParam(':region', $region, PDO::PARAM_STR);
        $stmt->bindParam(':postcode', $postcode, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();

        $this->feature->editFeatures($id, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking);


         $st1  = WISession::get('user_id') ;
            $st2  = "Edited theatre";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "theatre_id"  => $theatreId
            );

            echo json_encode($result);
      }

  }

  
  public function deletetheatre($id)
  {
    $sql = "DELETE FROM `wi_theatres` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $msg = "You have successfully added a deleted a theatre";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg            
              );

            echo json_encode($result);
  }


  Public function searchtheatre($search)
  {
    //echo $search;
    $sql = "SELECT * FROM `wi_theatres` WHERE `name` LIKE '%" .$search . "%'";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $theatre) {
        $photo = $theatre['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-6 col-md-6 col-lg-3">
        <div class="flipcard-theatre' . $theatre['id'] . '"><span class="btn editing-' . $theatre['id'] . '">Edit</span><span class="btn delete" onclick="WITheatres.delete(`' . $theatre['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $theatre['id'] . '">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-theatre fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x">
            <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler-' . $theatre['id'] . '" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview" id="preview' . $theatre['id'] . '"></div>
        <div class="upload-msg" id="status"></div>
                <input type="hidden" name="supload" id="supload" class="supload" value="theatre">

      </figure>
            </span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="theatresName" style="margin: 10px 0;"><blockquote>
        <p><input type="text" class="name" name="name" id="name" value="'. $theatre['name'].'"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-theatre">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom"><span><textarea rows="4" cols="50" class="bio" id="bio">'. $theatre['description'].'</textarea></span></span>

                         <p>
        <i class="icon-globe"></i><input type="text" class="bcity" name="bcity" value="'. $theatre['city_birth'] . '"> <br>
        <i class="fas fa-birthday-cake"></i><input type="text" id="datepicker' . $theatre['id'] . '" class="datepicker" name="dob" value="'. $theatre['dob'] . '"> 
      </p>
                      </div>
                    </div>
                    <p style="font-size: 12px;" class="text-center demure">More ...</p>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WITheatres.edittheatre(`' . $theatre['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-theatre fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x"><img src="WIMedia/Img/theatres/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;></span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="theatresName" style="margin: 10px 0;"><blockquote>
        <p>'. $theatre['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-theatre">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_theatre"><span class="bio"><p class="tbio">'. $theatre['description'].'</p></span></span>

                         <p>
        <i class="icon-globe">Birth City</i> '. $theatre['city_birth'] . '<br>
        <i class="fas fa-birthday-cake">Birthday</i>'. $theatre['dob'] . '
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

  .editing-' . $theatre['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-theatre' . $theatre['id'] . ' {
    position: relative;
    width: 244px;
    height: 412px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-theatre' . $theatre['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-theatre' . $theatre['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-theatre' . $theatre['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-theatre' . $theatre['id'] . ' .front, .flipcard-theatre' . $theatre['id'] . ' .back
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

    $("body").delegate(".editing-' . $theatre['id'] . '", "click", function(){
        $(".flipcard-theatre' . $theatre['id'] . '").toggleClass("flip");
        });

$( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker' . $theatre['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker' . $theatre['id'] . '").attr("value", date);
});



  var obj = $("#dragandrophandler-' . $theatre['id'] . '");
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
	

  public function getLocation($id)
  {
    $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();

    $location = $res['city'];

    return $location;
  }


  public function GetTheatres($show_id)
  {
    $sql = "SELECT * FROM `wi_theatres`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul id="Theatre_location">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {

        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WIShows.addTheatreLoc(' . $show_id. ');">
                            <div class="col-lg-12">
                              <img class="theatre_img" src="WIMedia/Img/theatres/' . $photo . '">
                              <span class="col-lg-12">' . $showing['name']. '</span>
                              <span class="col-lg-12">' . $showing['city']. '</span>
                            </div>
                          </a></li>';
      }
    }
  }

      public function editGetTheatres($id)
  {
    $sql = "SELECT * FROM `wi_theatres`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul id="Theatre_location">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {

        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WIShows.editAddTheatreLoc(' . $showing['id']. ', ' . $id . ');">
                            <div class="col-lg-12">
                              <img class="theatre_img" src="WIMedia/Img/theatres/' . $photo . '">
                              <span class="col-lg-12">' . $showing['name']. '</span>
                              <span class="col-lg-12">' . $showing['city']. '</span>
                            </div>
                          </a></li>';
      }
    }

    echo '</ul>';
  }


  public function getTheatre_info($id)
  {
    $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addShows-theatre-name" name="addShows-name" type="text" class="input-xlarge form-control" placeholder="theatre\'s name" value="' . $res['name']. '">
        <input id="addShows-theatre-id" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control" value="' . $res['id']. '">

        <input id="addShows-theatre-location" name="addShows-location" type="text" class="input-xlarge form-control" placeholder="theatre\'s location" value="' . $res['city']. '">';

  }

  public function editGetTheatre_info($id, $show_id)
  {
    $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addShows-theatre_'.$show_id.'" name="addShows-name" type="text" class="input-xlarge form-control" placeholder="theatre\'s name" value="' . $res['name']. '">

        <input id="addShows-theatre-id_'.$show_id.'" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control" value="' . $res['id']. '">
        
        <input id="addShows-theatre-location_'.$show_id.'" name="addShows-location" type="text" class="input-xlarge form-control" placeholder="theatre\'s location" value="' . $res['city']. '">';

  }


}
?>