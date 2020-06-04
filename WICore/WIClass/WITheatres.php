<?php

/**
* WITheatres Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WITheatres {


    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $this->maint = new WIMaintenace();
        $this->feature = new WIFeatures();
        $this->login = new WILogin();
        $this->Info = new WIUserInfo();
        $this->user   = new WIUser(WISession::get('user_id'));
        $this->Page = new WIPagination();
        $this->maint = new WIMaintenace();
        $this->site = new WISite();
        $this->feature = new WIFeatures();
        $this->Perm = new WIPermissions();
        $this->group = "2";

    }

    public function SelectTheatre()
  {

             $result = $this->WIdb->select("SELECT * FROM wi_theatres");

             echo '<label for="Theatre">Theatre</label><select name="Theatre" id="theatre"><option value="" selected="selected">Select Theatre</option> ';

            foreach ($result as $res) {
                            echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
            }


/*    $query = $this->WIdb->prepare('SELECT * FROM wi_theatres');
    $query->execute();
    echo '<label for="Theatre">Theatre</label><select name="Theatre" id="theatre"><option value="" selected="selected">Select Theatre</option> ';
    while ($res = $query->fetch(PDO::FETCH_ASSOC)) {
      echo '<option value="' . $res['id'] . '">' . $res['name'] . '</option>';
    }*/
    echo ' </select>';

  }

/*    public function theatreTheatre($theatre_id)
   {
    //echo "t". $theatre_id;
        $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:theatre_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
        $query->execute();
        echo '<ul>';
        $res = $query->fetchAll();
        foreach ($res as $theatre ) {
            echo '<li><a class="theatre_link" href="theatre.php" id="' . $theatre['id'] . '">' . $theatre['name'] . '</a></li>';
        }
        echo '</ul>';
   }*/

   public function Theatre_Info($theatre_id)
   {
    // echo "c". $company_id;
        $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:theatre_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('theatre_id', $theatre_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        //print_r($res);
        echo json_encode($res);
   }

   public function theatretheatres($theatre_id)
   {
    $sql = "SELECT * FROM `wi_viewings` WHERE `theatre_id`=:theatre_id";

      $query = $this->WIdb->prepare($sql);
      $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
      $query->execute();
      echo '<ul>';
      $res = $query->fetchAll();
      foreach ($res as $theatres ) {
        echo '<li><a class="theatre_link" href="theatre.php" id="' . $theatres['id'] . '">' . $theatres['name'] . '</a></li>';
      }
      echo '</ul>';
   }

   public function InsertTheatre($name, $desc,$fline,$sline,$city,$postcode,$user,$Image)
   {
    $sql = "SELECT * FROM `wi_theatres` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetch();
    print_r($res);
  if (empty($res)) {
    $this->WIdb->insert('wi_theatres', array(
            "name" => $name,
            "description" => $desc,
            "first_line" => $fline,
            "second_line" => $sline,
            "city" => $city,
            "postcode" => $postcode,
            "photo" => $Image
        )); 

        $st1  = $user ;
            $st2  = "Added New Theatre";
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


       public function getTheatreName($theatre)
    {
        $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:theatre";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':theatre', $theatre, PDO::PARAM_INT);
        $query->execute();

        $result = $query->fetch();

        $name = $result['name'];

        return $name;
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



  public function theatreInfo($theatre_id)
    {
        $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:theatre_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('theatre_id', $theatre_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        echo json_encode($res);
    }

    public function ViewTheatre($theatre_id)
    {
        $sql = "SELECT * FROM `wi_theatres` WHERE `id`=:theatre_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('theatre_id', $theatre_id, PDO::PARAM_INT);
        $query->execute();

        $theatre = $query->fetch();

        $photo = $theatre['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }

        if($this->user->isAdmin() OR $this->Perm->hasPermission(WISession::get('user_id'), $this->group, "Theatre", "edit") ){
            //user is admin

        echo '<div class="col-xs-12 col-md-10 col-lg-12">
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
                    echo '<div class="img-media" id="edit-' . $theatre['id'] . '"><img class="thumb" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'"><a href="javascript:void(0);" class="btn theatre_change_photo_link" onclick="WITheatres.clearTheatre(' . $theatre['id'] . ');">Change Photo</a></div>';
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
    <img class="thumb" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'">
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
          <legend class="text15">Address Details</legend>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
           <p class="text15"> '. $theatre['first_line'].'</p>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
             <p class="text15"> '. $theatre['second_line'].'    </p> 
              </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
             <p class="text15"> '. $theatre['city'].'</p>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <p class="text15">'. $theatre['region'].' </p>
            <div class="col-sm-12">
            
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-12">
             <p class="text15"> '. $theatre['postcode'].'</p>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
            <p class="text15">  '. $theatre['country'].'</p>
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

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="installed_features">';
                      echo '<legend class="text15">Features</legend>';
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
    height: auto;
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
        background-color: #eae8e8;
    border: 1px solid #222;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    position: relative;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    transition: all 1s ease 0s;
    color: #a94442;
    padding: 10px 23px;
    backface-visibility: hidden;
    top: 5px;
    z-index: -1;
        margin: 0px 0px -1622px 0px;
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

        }else{
            //user is not admin
            echo '<div class="flipcard">
            <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-4">
        <span class="off-grey-theatre">
    <img class="thumb" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'">
    </span>
        </div>
        <div class="col-xs-6">
          <h3 class="theatresName"><blockquote>
        <p class="text15">'. $theatre['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="tbio text20">'. $theatre['description'].'</p>
                        </div>

          </div>
          <div class="middle-bit-theatre">
                    <div class="row">
    
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                      <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
</head>
<body>
 
<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Address</a></li>
    <li><a href="#tabs-2">Features</a></li>
    <li><a href="#tabs-3">Seating</a></li>
  </ul>
  <div id="tabs-1">
  <div class="Taddress">
                             <!-- Form Name -->
                       <div class="address_details">  
          <legend class="text15">Address Details</legend>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
            <p class="text15">'. $theatre['first_line'].'</p>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
            <p class="text15">  '. $theatre['second_line'].'  </p>   
              </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
            <div class="col-sm-12">
            <p class="text15">  '. $theatre['city'].'</p>
            </div>
          </div>

          <!-- Text input-->
          <div class="form-group">
          <p class="text15">  '. $theatre['region'].'</p>
            <div class="col-sm-12">
            
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-12">
            <p class="text15">  '. $theatre['postcode'].'</p>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-12">
             <p class="text15"> '. $theatre['country'].'</p>
            </div>
          </div>
          </div>

            <div class="directions">
              <iframe class="google_mapping" src="//www.google.com/maps/embed/v1/place?q='. $theatre['name'].','. $theatre['first_line'].','. $theatre['city'].','. $theatre['postcode'].','. $theatre['country'].'
      &zoom=17
      &key=' .  GOOGLE_MAP_API . '">
  </iframe>
            </div>
            </div>



                      
                     
  </div>
  <div id="tabs-2">
                     <div class="features" id="installed_features">';
                      echo '<legend class="text15">Features</legend>';
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
  <div id="tabs-3">

  </div>
</div>
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                      <legend class="text15">Current shows</legend>';
                      self::TheatreShows($theatre_id);
                     echo '</div>
                    </div>
                  </div>
        </div>
    </div>
  </div>
                   <style>

                 
                  .flipcard{
                    position: relative;
                    width: 100%;
                    height: auto;
                    perspective: 638px;
                    margin: 0px 6px 10px 0px;
                }
                .flipcard .flip .front {
                  transform: rotateY(180deg);
                }
                .flipcard .flip .back {
                  transform: rotateY(0deg);
                }
                .flipcard .back{
                  transform: rotateY(-180deg);
                }
                .flipcard .front, .flipcard .back
                {
                    background-color: #eae8e8;
                    border: 1px solid #222;
                    border-radius: 5px;
                    box-shadow: 0 5px 15px rgba(0,0,0,.5);
                    position: relative;
                    width: 100%;
                    height: 100%;
                    box-sizing: border-box;
                    transition: all 1s ease 0s;
                    color: #a94442;
                    padding: 10px 23px;
                    backface-visibility: hidden;
                    top: 5px;
                    z-index: -1;
                        margin: 0px 0px -1622px 0px;
                }
                  </style>';

        }
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
    echo '<div class="row">
                  <div id="products" class="row list-group">';
    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $theatre) {
        $photo = $theatre['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }

        
        if($this->user->isAdmin()  OR $this->Perm->hasPermission(WISession::get('user_id'), "2", "Theatre", "edit") ){
         echo '
        <div class="item  col-xs-4 col-lg-4">
        <div class="flipcard-' . $theatre['id'] . '">
        <span class="btn editing-' . $theatre['id'] . '">Edit</span>
        <span class="btn theatre-delete" onclick="WITheatres.delete(`' . $theatre['id'] . '`);">Delete</span>
        <div class="back">
           <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
                <img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'" alt="'. $theatre['name'].'" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                       <p><a class="show_link" id="'. $theatre['id'].'" href="theatre.php" >'. $theatre['name'].'</a></p></h4>
                      <p> ';echo self::getLocation($theatre['id']); echo '</p>
                                <p><a class="theatre_link" id="'. $theatre['theatre_id'].'" href="theatre.php" >'. $theatre['theatre'].'</a></p>
                        </div>
                        

                   
            </div>
            </div>
                  </div>

                  
        
         <div class="front text-center">
         <div class="item">
            <div class="thumbnail">
                <img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'" alt="'. $theatre['name'].'" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                       <p><a class="show_link" id="'. $theatre['id'].'" href="theatre.php" >'. $theatre['name'].'</a></p></h4>
                      <p> ';echo self::getLocation($theatre['id']); echo '</p>
                                <p><a class="theatre_link" id="'. $theatre['theatre_id'].'" href="theatre.php" >'. $theatre['theatre'].'</a></p>
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
                      height: 200px;
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
                          background-color: #eae8e8;
                      border: 1px solid #222;
                      border-radius: 5px;
                      box-shadow: 0 5px 15px rgba(0,0,0,.5);
                      position: absolute;
                      width: 100%;
                      height: 100%;
                      box-sizing: border-box;
                      transition: all 1s ease 0s;
                      color: #a94442;
                      padding: 10px 23px;
                      backface-visibility: hidden;
                      top: 5px;
                      z-index: -1;
                  }
                    </style>
                              <script type="text/javascript">
                              $(document).ready(function(){

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
        }else{
            //user is not admin
             echo '<div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
            <div class="col-xs-12 col-md-6">
                            <a class="show_link" id="'. $theatre['id'].'" href="theatre.php" >'. $theatre['name'].'</a>
                        </div>
                <img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/theatres/'. $photo.'" alt="'. $theatre['name'].'" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                       <p><a class="show_link" id="'. $theatre['id'].'" href="theatre.php" >'. $theatre['name'].'</a></p></h4>
                      <p> ';echo self::getLocation($theatre['id']); echo '</p>
                                <p><a class="theatre_link" id="'. $theatre['theatre_id'].'" href="theatre.php" >'. $theatre['theatre'].'</a></p>
                        </div>
            </div>
            </div>




                   <style>

                 
                  .flipcard{
                    position: relative;
                    width: 100%;
                    height: 200px;
                    perspective: 638px;
                    margin: 0px 6px 10px 0px;
                }
                .flipcard .flip .front {
                  transform: rotateY(180deg);
                }
                .flipcard .flip .back {
                  transform: rotateY(0deg);
                }
                .flipcard .back{
                  transform: rotateY(-180deg);
                }
                .flipcard .front, .flipcard .back
                {
                    background-color: #eae8e8;
    border: 1px solid #222;
    border-radius: 5px;
    box-shadow: 0 5px 15px rgba(0,0,0,.5);
    position: absolute;
    width: 100%;
    height: 100%;
    box-sizing: border-box;
    transition: all 1s ease 0s;
    color: #a94442;
    padding: 10px 23px;
    backface-visibility: hidden;
    top: 5px;
    z-index: -1;
                }
                  </style>';
            }

         
               }
        }
      $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    echo '</div></div>';
   } 


   public function TheatreShows($theatre_id)
   {
    $sql = "SELECT * FROM `wi_shows` WHERE `theatre_id` = :theatre_id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
    $query->execute();
    echo '<ul class="theatre_showings">';
    $res = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $play) {
      echo '<li class="virticalSlide"><a class="show_link" id="'. $play['id'].'" href="show.php" > <img class="group list-group-image" style="border-radius: 36px; width:60px; height:60px;" src="WIAdmin/WIMedia/Img/shows/'. $play['photo'].'" alt="'. $play['name'].'" /></a></li>';
    }
    echo '</ul>';
   }
}