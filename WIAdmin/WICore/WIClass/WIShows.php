<?php

class WIShows
{
	
	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Page = new WIPagination();
    $this->maint = new WIMaintenace();
    $this->site = new WISite();
    $this->theatre = new WITheatres();

	}




    Public function ViewEditShows()
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
        
        $JsClass = "WIShows";
        $onclick = "NextShows";
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
        echo '<div class="col-xs-12 col-md-12 col-lg-12">
        <div class="flipcard-' . $show['id'] . '">
        <span class="btn editing-' . $show['id'] . '">Edit</span>
        <span class="btn show-delete" onclick="WIShows.delete(`' . $show['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit-show" id="' . $show['id'] . '">
      <div class="row">
        <div class="col-xs-4">
        <span class="off-grey" id="show_change_pic-' . $show['id'] . '">';
          if(empty($show['photo'])){
            echo '<div class="img-media-show" id="edit-' . $show['id'] . '"></div>
             <div class="well on" id="uploadOptions">
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.MediaManager(`shows`,`edit-' . $show['id'] . '`, `showsImg`, `edit-' . $show['id'] . '`, `shows`)">Upload from WIMedia Library</a>
                      <a href="javascript:void(0);" class="btn media_manager" onclick="WIMedia.dropAndDragUpload(`shows`, `wi_shows`,`shows`,`shows`,`edit-' . $show['id'] . '`)">upload from computer</a>
                    </div> ';  
                  }else{
                    echo '<div class="img-media-show" id="edit-' . $show['id'] . '"><img class="lg_border_pic" src="WIMedia/Img/shows/'. $photo.'"><a href="javascript:void(0);" class="btn theatre_change_photo_link" onclick="WIShows.clearShow(' . $show['id'] . ');">Change Photo</a></div>';
                  }

                  echo '</span>';

                    echo '<div class="form-group">
                        <label class="control-label col-lg-3 no-padding" for="addShows-sdate">
                          Start Date
                        </label>
                        <div class="controls col-lg-9 no-padding"><span class="required">*</span>
                          <input id="datepickersdate_' . $show['id'] . '" name="addShows-sdate" type="text" class="input-xlarge form-control show_name black" placeholder="Shows\'s Name" value="' . $show['start_date'] . '">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-lg-3 no-padding" for="addShows-fdate">
                          End Date
                        </label>
                        <div class="controls col-lg-9 no-padding"><span class="required">*</span>
                          <input id="datepickerfdate_' . $show['id'] . '" name="addShows-fdate" type="text" class="input-xlarge form-control show_name black" placeholder="Shows\'s Name" value="' . $show['end_date'] . '">
                        </div>
                      </div>
        </div>


        <div class="col-xs-8">
          <h3 class="showsName">
          <blockquote>
        <p><label class="control-label col-lg-3 no-padding" for="show_name">
                          Name :
                        </label> <input type="text" class="show_name black" name="name" id="name-' . $show['id'] . '" value="'. $show['name'].'" placeholder="show Name"><span class="required">*</span></p>
        
      </blockquote>
      </h3>

      <blockquote>
      <div class="controls col-lg-9 no-padding" id="change_company_' . $show['id'] . '">
      <div id="chose_company_' . $show['id'] . '">';
      if(!empty($show['theatre_company'])){
          echo '<p><label class="control-label col-lg-3 no-padding" for="addShows-sdate">
                          Company : 
                        </label> <input type="text" class="show_name black" name="name" id="company-' . $show['id'] . '" value="'. $show['theatre_company'].'" placeholder="theatre company"><span class="required">*</span></p><a href="javascript:void(0);" class="btn show clear_show" id="ClearCompany" onclick="WIShows.ClearCompany(' . $show['id'] . ')">Clear Company</a><div id="company_find_edit_' . $show['id'] . '" class="hide"></div>';
      }else{
          echo '<a href="javascript:void(0);" class="btn btn-primary show" id="findCompanies_' . $show['id'] . '" onclick="WIShows.editFindCompany(' . $show['id'] . ')">Find Company</a>
                          <div id="company_find_edit_' . $show['id'] . '" class="hide">
                          </div>                         
                        </div>';
      }
        
      echo '</div></blockquote>

      <blockquote>';
      echo '<div class="controls col-lg-9 no-padding" id="change_theatre_' . $show['id'] . '">
      <div id="chose_theatre_' . $show['id'] . '">';
      if(!empty($show['theatre'])){

        echo '<p><label class="control-label col-lg-3 no-padding" for="addShows-sdate">
                         Theatre : 
                        </label><input type="text" class="theatre show_name black" name="theatre" id="addShows-theatre' . $show['id'] . '" value="'. $show['theatre'].'" placeholder="theatre Name">
                        <input type="text" class="theatre show_location black" name="theatre" id="theatre-location' . $show['id'] . '" value="'. $this->theatre->getLocation($show['id']).'" placeholder="theatre Location">
                        <input id="addShows-theatre-id" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control" value="' . $show['theatre_id'] . '">
                        
                        <span class="required">*</span></p><a href="javascript:void(0);" class="btn show clear_show" id="ClearTheatre" onclick="WIShows.ClearTheatre(' . $show['id'] . ')">Clear Theatre</a><div id="edittheatres'. $show['id'] . '" class="hide"></div> </div>';
      }else{
        echo '<div class="controls col-lg-9 no-padding"><span class="required">*</span>
                          <a href="javascript:void(0);" class="btn btn-primary show" id="editFindTheatre' . $show['id'] . '" onclick="WIShows.editFindTheatre(' . $show['id'] . ')">Find Theatres</a>
                          <div id="theatre_find_edit_'. $show['id'] . '" class="hide"></div>                         
                        </div>';
      }
      echo '</blockquote>';
        
      
      echo '</div>
      </div>
          </div>
          <div class="middle-bit-show">
                   <div class="row">
                   <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                         <label class="control-label col-lg-3 no-padding" for="addShows-sdate">
                          Description : 
                        </label><textarea rows="4" cols="50" class="bio show_name black" id="bio-' . $show['id'] . '" placeholder="Description">'. $show['description'].'</textarea>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                         $hasTrailers = self::findIfTrailers($show['id']);
                         if($hasTrailers > 0){
                            echo '<div class="trailers" id="trailers">'; self::getTrailers($show['id'],$show['theatre_id']); echo'</div>';
                         }else{
                          echo '<a href="javascript:void(0);" onclick="WIShows.createTrailer(' .$show['id'] . ',' .$show['theatre_id'] . ')" class="btn">Upload Trailer</a>';
                         }
                        echo '</div>



                        </div>
                    

                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WIShows.editShows(`' . $show['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
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
          <h3 class="showsName"><blockquote>
        <p>'. $show['name'].'</p>
        
      </blockquote></h3>
      <h3 class="showsLocation"><blockquote>
        <p>';echo $this->theatre->getLocation($show['id']); echo '</p>
        
      </blockquote></h3>
      <h3 class="showsTheatre"><blockquote>
        <p>'. $show['theatre'].'</p>
        
      </blockquote></h3>
      <h3 class="showsName"><blockquote>
        <p>'. $show['theatre_company'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="tbio">'. $show['description'].'</p>
                        </div>
                        
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">';
                      $start_date = $show['start_date'];
                      $ending = $show['end_date'];

                      if (empty($start_date) or $start_date === "0000-00-00" ) {
                        echo '<div id="sdate">To be Annouced</div>';
                      }else{
                        echo '<div id="sdate">Start Date : '. $show['start_date'].'</div>';
                      }

                      if (empty($ending) or $ending === "0000-00-00" ) {
                        echo '<div id="edate">To be Annouced</div>';
                      }else{
                        echo '<div id="edate">End Date : '. $show['end_date'].'</div>';
                      }
                      
                     
                      echo '</div>

                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                         $hasTrailers = self::findIfTrailers($show['id']);
                         if($hasTrailers > 0){
                            echo '<div class="trailers" id="trailers">'; self::getTrailers($show['id'],$show['theatre_id']); echo'</div>';
                         }else{
                          
                         }
                        echo '</div>
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
    position: relative;
    width: 100%;
    height: 560px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
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



 $( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepickersdate_' . $show['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepickersdate_' . $show['id'] . '").change(function() {
    //var date = $(this).datepicker("getDate");
    var date = $("#datepickersdate_' . $show['id'] . '").datepicker({ dateFormat: "yy-mm-dd" }).val();
    $("#datepickersdate_' . $show['id'] . '").attr(`value`, date);
});

   $( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepickerfdate_' . $show['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepickerfdate_' . $show['id'] . '").change(function() {
    var date = $("#datepickerfdate_' . $show['id'] . '").datepicker({ dateFormat: "yy-mm-dd" }).val();
    $("#datepickerfdate_' . $show['id'] . '").attr(`value`, date);
});

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

    $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $onclick, $JsClass);

    echo $Pagin;
  }

  public function selectshow($id)
  {
    $sql = "SELECT * FROM `wi_shows` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    echo '<span class="naming" id="' . $res['id'] . '" value="' . $res['name'] . '">' . $res['name'] . '</span>';
  }


    public function addshow($name, $bio, $address, $img)
    {
                $sql = "SELECT * FROM `wi_shows` WHERE `name`=:name";
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

      
        $this->WIdb->insert('wi_shows', array(
            "name"     => $name,
            "description"  => $bio,
            "address"  => $address,
            "photo" => $img
        )); 

        $showId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New show";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new show";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "show_id"  => $showId
            );

            echo json_encode($result);

    }else{
    $msg = "The show you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}
    public function addShowTrailer($show_id, $theatre_id, $src)
    {
      $sql = "SELECT * FROM `wi_theatre_trailers` WHERE `show_id`=:show_id AND `theatre_id`=:theatre_id";
      $query = $this->WIdb->prepare($sql);

      $query->bindParam(':show_id', $show_id, PDO::PARAM_INT);
      $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
      $query->execute();

      $res = $query->fetchAll();
      if(count($res) > 0){
        $msg = "This video has already been uploaded";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
      }else{
        $this->WIdb->insert('wi_theatre_trailers', array(
            "show_id"     => $show_id,
            "theatre_id"  => $theatre_id,
            "src"  => $src
          )); 


        $showTrailerId = $this->WIdb->lastInsertId();
        //echo $showTrailerId;

        $hasTrailers = "1";        
        $sql3 = "UPDATE `wi_shows` SET `has_Trailer`=:hasTrailers WHERE `id` =:id";

        $query3 = $this->WIdb->prepare($sql3);
        $query3->bindParam(':hasTrailers', $hasTrailers, PDO::PARAM_STR);
        $query3->bindParam(':id', $show_id, PDO::PARAM_INT);
        $query3->execute();

         $msg = "The youtube video is successfully added and assigned.";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
      }
    }


      public function CreateShows($name, $theatre_name, $theatre_location, $theatre_id, $company, $company_id, $start_date, $end_date, $bio,  $img)
    {
                $sql = "SELECT * FROM `wi_shows` WHERE `name`=:name AND `theatre`=:theatre";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':theatre', $theatre_name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    //print_r($res);

  if (count($res) <1) {


         
         $sql = "INSERT INTO `wi_shows` (`company_id`, `theatre_id`, `name`, `theatre`, `description`, `theatre_company`, `start_date`, `end_date`, `photo`) values (:company_id, :theatre_id, :name, :theatre_name, :bio, :company, :start_date, :end_date, :img)";
        
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->bindParam(':theatre_name', $theatre_name, PDO::PARAM_STR);
        $stmt->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();
       
        $showId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New show";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new show";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "show_id"  => $showId
            );

            echo json_encode($result);

    }else{
    $msg = "The show you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg//,
                //"dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


  public function showInstalledshow($id)
  { 
     $sql = "SELECT * FROM `wi_shows` WHERE `id`=:id";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    $photo = $res['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
    echo '<li class="ui-state-default ui-corner-all showshow">
                            <form class="form-show">
                          <article class="post_container" id="showPost">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                          <div class="showshownel">' . $res['name'] . '

      </label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <figure class="post-image" id="show_Image">            
        <div class="showshownel"><div class="img-preview"><img src="WIMedia/Img/shows/' . $photo.'"></div></div>
      </figure>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="showshownel">' . $res['description'].'
  </div></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="showshownel">' . $res['description'].'

    </div></div></article>
  </form>
                       </li>';
  }


  public function editshow($id, $name, $bio,  $theatre, $theatre_id, $company, $company_id, $start_date, $end_date,  $img)//$location,
  {

        if (empty($img)) {
          
          $sql = "UPDATE `wi_shows` SET  `name` =:name, `theatre` =:theatre, `theatre_id` =:theatre_id, `description`=:bio, `theatre_company`=:company, `company_id`=:company_id, `start_date`=:start_date, `end_date`=:end_date  WHERE  `id` =:id";

        $stmt = $this->WIdb->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':theatre', $theatre, PDO::PARAM_STR);
        $stmt->bindParam(':theatre_id', $theatre_id, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->execute();
        }else{

        $sql = "UPDATE `wi_shows` SET  `name` =:name, `theatre` =:theatre, `theatre_id` =:theatre_id, `description`=:bio, `theatre_company`=:company, `company_id`=:company_id, `start_date`=:start_date, `end_date`=:end_date, `photo`=:img WHERE  `id` =:id";

        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':theatre', $theatre, PDO::PARAM_STR);
        $stmt->bindParam(':theatre_id', $theatre_id, PDO::PARAM_STR);
        $stmt->bindParam(':company', $company, PDO::PARAM_STR);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();
        }



         $st1  = WISession::get('user_id') ;
            $st2  = "Edited show";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully edited the " . $name ." show";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg
            );

            echo json_encode($result);
  }

  
  public function deleteshow($id)
  {
    //echo "id". $id;
    $sql = "DELETE FROM `wi_shows` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $msg = "You have successfully added a deleted a show";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg            
              );

            echo json_encode($result);
  }


    public function deleteTrailer($id)
  {
    $stmt = "SELECT * FROM `wi_theatre_trailers` WHERE `id`=:id";

    $query0 = $this->WIdb->prepare($stmt);
    $query0->bindParam(':id', $id, PDO::PARAM_INT);
    $query0->execute();

    $records = $query0->fetch();
    $show_id = $records['show_id'];
    
    $sql = "DELETE FROM `wi_theatre_trailers` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $hasTrailers = "0";        
        $sql3 = "UPDATE `wi_shows` SET `has_Trailer`=:hasTrailers WHERE `id` =:id";

        $query3 = $this->WIdb->prepare($sql3);
        $query3->bindParam(':hasTrailers', $hasTrailers, PDO::PARAM_STR);
        $query3->bindParam(':id', $show_id, PDO::PARAM_INT);
        $query3->execute();

    $msg = "You have successfully added a deleted a trailer";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg            
              );

            echo json_encode($result);

  }

  public function findIfTrailers($show_id)
  {
    $sql = "SELECT * FROM `wi_shows` WHERE `id`=:show_id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':show_id', $show_id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    $trailer = $res['has_Trailer'];

    return $trailer;
  }

    public function getTrailers($show_id, $theatre_id)
  {
    $sql = "SELECT * FROM `wi_theatre_trailers` WHERE `show_id`=:show_id AND `theatre_id`=:theatre_id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':show_id', $show_id, PDO::PARAM_INT);
    $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
    $query->execute();
    echo '<ul id="trailer">';
    while ($res = $query->fetchAll()) {
      foreach ($res as $trailer) {
        echo '<li id="trailer"><div id="youtube_vid">
        <figure class="post-video"><span class="edit" id="edit"><a href="" onclick="WIShows.deleteTrailer(' . $trailer['id'] . ');" class="btn"><i class="fa fa-trash-o"></i></a></span>                                    
               ' . $trailer['src']. '        
                 </figure>
        </div></li>';
      }
    }
    echo '</ul>';
    

 
  }


  Public function searchshow($search)
  {
    //echo $search;
    $sql = "SELECT * FROM `wi_shows` WHERE `name` LIKE '%" .$search . "%'";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $show) {
        $photo = $show['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-6 col-md-6 col-lg-3">
        <div class="flipcard-show' . $show['id'] . '"><span class="btn editing-' . $show['id'] . '">Edit</span><span class="btn delete" onclick="WIshow.delete(`' . $show['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $show['id'] . '">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-show fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x">
            <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler-' . $show['id'] . '" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview" id="preview' . $show['id'] . '"></div>
        <div class="upload-msg" id="status"></div>
                <input type="hidden" name="supload" id="supload" class="supload" value="shows">

      </figure>
            </span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="showsName" style="margin: 10px 0;"><blockquote>
        <p><input type="text" class="name" name="name" id="name" value="'. $show['name'].'"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom"><span><textarea rows="4" cols="50" class="bio" id="bio">'. $show['description'].'</textarea></span></span>

                         <p>
        <i class="icon-globe"></i><input type="text" class="bcity" name="bcity" value="'. $show['city_birth'] . '"> <br>
        <i class="fas fa-birthday-cake"></i><input type="text" id="datepicker' . $show['id'] . '" class="datepicker" name="dob" value="'. $show['dob'] . '"> 
      </p>
                      </div>
                    </div>
                    <p style="font-size: 12px;" class="text-center demure">More ...</p>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WIshow.editshow(`' . $show['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-show fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x"><img src="WIMedia/Img/shows/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;></span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="showsName" style="margin: 10px 0;"><blockquote>
        <p>'. $show['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_show"><span class="bio"><p class="tbio">'. $show['description'].'</p></span></span>

                         <p>
        <i class="icon-globe">Birth City</i> '. $show['city_birth'] . '<br>
        <i class="fas fa-birthday-cake">Birthday</i>'. $show['dob'] . '
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

  .editing-' . $show['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-show' . $show['id'] . ' {
    position: relative;
    width: 244px;
    height: 412px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-show' . $show['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-show' . $show['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-show' . $show['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-show' . $show['id'] . ' .front, .flipcard-show' . $show['id'] . ' .back
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

    $("body").delegate(".editing-' . $show['id'] . '", "click", function(){
        $(".flipcard-show' . $show['id'] . '").toggleClass("flip");
        });

$( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker' . $show['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker' . $show['id'] . '").attr("value", date);
});



  var obj = $("#dragandrophandler-' . $show['id'] . '");
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


  public function FindShows()
  {
    $sql = "SELECT * FROM `wi_shows`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();
    echo '<ul id="showing">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {
       // print_r($showing);
        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }

        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WICast.addshowInfo(' . $showing['id']. ');">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct">
                              <img class="shows_img" src="WIMedia/Img/shows/' . $photo . '">
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['name']. '</span>
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['theatre']. '</span>
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['theatre_company']. '</span>
                            </div>
                          </a></li>';
      }
    }

    echo '</ul>';
  }


  public function FindCrewShows()
  {
    $sql = "SELECT * FROM `wi_shows`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();
    echo '<ul id="showing">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {
       // print_r($showing);
        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }

        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WICrew.getCrewShow_info(' . $showing['id']. ');">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ct">
                              <img class="shows_img" src="WIMedia/Img/shows/' . $photo . '">
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['name']. '</span>
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['theatre']. '</span>
                              <span class="col-lg-12 col-md-12 col-sm-12 col-xs-12 sh">' . $showing['theatre_company']. '</span>
                            </div>
                          </a></li>';
      }
    }

    echo '</ul>';
  }


  public function getShow_info($id)
  {
    $sql = "SELECT * FROM `wi_shows` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCast" placeholder="theatre\'s name" value="Show Name : ' . $res['name']. '">

        <input id="addCast-show-id" name="addShows-show-id" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['id']. '">
        <input id="addCast-show-name" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCast" value="' . $res['name']. '">

        <input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCast" placeholder="theatre\'s name" value="Theatre : ' . $res['theatre']. '">
        <input id="addShows-theatre" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control findShowCast">

        <input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCast" placeholder="theatre\'s name" value="Location : '. $this->theatre->getLocation($res['theatre_id']).'">
        <input id="addShows-theat" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control">

        <input id="addShows-theatre-company" name="addShows-location" type="text" class="input-xlarge form-control findShowCast" placeholder="Copmany" value="Company : ' . $res['theatre_company']. '">';
  }


  public function getCrewShow_info($id)
  {
    $sql = "SELECT * FROM `wi_shows` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCrew" placeholder="theatre\'s name" value="Show Name : ' . $res['name']. '">

        <input id="addCast-show-id" name="addShows-show-id" type="hidden" class="input-xlarge form-control findShowCrew" value="' . $res['id']. '">
        <input id="addCast-show-name" name="addShows-show-name" type="hidden" class="input-xlarge form-control findShowCrew" value="' . $res['name']. '">

        <input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCrew" placeholder="theatre\'s name" value="Theatre : ' . $res['theatre']. '">
        <input id="addShows-theatre" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control findShowCrew">

        <input id="addShows-cast-show" name="addShows-name" type="text" class="input-xlarge form-control findShowCrew" placeholder="theatre\'s name" value="Location : '. $this->theatre->getLocation($res['theatre_id']).'">
        <input id="addShows-theat" name="addShows-theatre-id" type="hidden" class="input-xlarge form-control">

        <input id="addShows-theatre-company" name="addShows-location" type="text" class="input-xlarge form-control findShowCrew" placeholder="Copmany" value="Company : ' . $res['theatre_company']. '">';
  }
	

}
?>