<?php

class WICompany
{
	
	function __construct()
	{
		$this->WIdb = WIdb::getInstance();
		$this->Page = new WIPagination();
    $this->maint = new WIMaintenace();
    $this->site = new WISite();

	}


  Public function ViewEditCompany()
  {
    if(isset($_POST["page"])){
        $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
        if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
    }else{
        $page_number = 1; //if there's no page number, set it to 1
    }

        $item_per_page = 15;

        $result = $this->WIdb->select(
                    "SELECT * FROM `wi_theatre_company`");
        $rows = count($result);

        //break records into pages
        $total_pages = ceil($rows/$item_per_page);
        
        $JsClass = "WICompany";
        $onclick = "Nextcomp";
        //get starting position to fetch the records
        $page_position = (($page_number-1) * $item_per_page);
    $sql = "SELECT * FROM `wi_theatre_company` ORDER BY `id` ASC LIMIT :page, :item_per_page";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':page', $page_position, PDO::PARAM_INT);
    $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $company) {
        $photo = $company['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-6 col-md-6 col-lg-3">
        <div class="flipcard-' . $company['id'] . '"><span class="btn editing-' . $company['id'] . '">Edit</span><span class="btn delete" onclick="WICompany.delete(`' . $company['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $company['id'] . '">
      <div class="row">
        <div class="col-xs-12">
           <span class="off-grey" id="company_change_pic-' . $company['id'] . '">';
           if(empty($company['photo'])){

            echo '<div class="img-media" id="edit-' . $company['id'] . '"></div>
             <div class="well on" id="uploadOptions">
                      <a href="javascript:void(0);" class="btn" onclick="WIMedia.MediaManager(`company`,`edit-' . $company['id'] . '`, `companyImg`, `edit-' . $company['id'] . '`, `company`)">Upload from WIMedia Library</a>
                      <a href="javascript:void(0);" class="btn" onclick="WIMedia.dropAndDragUpload(`company`, `wi_theatre_company`,`company`,`company`,`edit-' . $company['id'] . '`)">upload from computer</a>
                    </div>';
           }else{

            echo '<div class="img-media" id="edit-' . $company['id'] . '"><img class="sm_border_pic" src="WIMedia/Img/company/'. $photo.'"><a href="javascript:void(0);" class="btn actor_change_photo_link" onclick="WICompany.clearCompany(' . $company['id'] . ');">Change Photo</a></div>';
           }
            
          echo '</span>

        </div>
        <div class="col-xs-12">
          <h3 class="companysName" style="margin: 10px 0;"><blockquote>
        <p>
        Name : <input type="text" class="name black" name="name" id="name-' . $company['id'] . '" value="'. $company['name'].'" placeholder="Companies Name"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom"><span>Description : <textarea rows="4" cols="50" class="bio name black" id="bio-' . $company['id'] . '" placeholder="Biography">'. $company['biography'].'</textarea></span></span>

                         <p>
        Address : <input type="text" class="address name black" name="address" value="'. $company['address'] . '" id="address-' . $company['id'] . '" placeholder="Address"> <br>
        <i class="fas fa-globe"></i>
        <div class="controls col-lg-9">'; $this->site->Country($company['id'], $company['country']); echo '</div>
      </p>
                      </div>
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WICompany.editCompany(`' . $company['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
            <span class="off-grey">
            <img src="WIMedia/Img/company/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;">
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="companysName" style="margin: 10px 0;"><blockquote>
        <p>'. $company['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_company"><span class="bio"><p class="pbio">'. $company['biography'].'</p></span></span>

                      
        <br>
        <i class="far fa-address-card"></i>'. $company['address'] . '</br>
        <i class="fas fa-globe"></i>'. $company['country'] . '
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

  .editing-' . $company['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-' . $company['id'] . ' {
    position: relative;
    width: 100%;
    height: 412px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-' . $company['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-' . $company['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-' . $company['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-' . $company['id'] . ' .front, .flipcard-' . $company['id'] . ' .back
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

    $(".editing-' . $company['id'] . '").on("click", function(event) {
                            event.stopPropagation();
                            $(".flipcard-' . $company['id'] . '").toggleClass("flip");
                                      });

  var obj = $("#dragandrophandler-' . $company['id'] . '");
  var dir = $(".supload").attr("value");
  var ele_id = $(".img-preview-' . $company['id'] . '").attr("id");

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

  public function selectCompany($id)
  {
    $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetch();
    echo '<span class="naming" id="' . $res['id'] . '" value="' . $res['name'] . '">' . $res['name'] . '</span>';
  }


    public function addCompany($name, $bio, $address, $img)
    {
                $sql = "SELECT * FROM `wi_theatre_company` WHERE `name`=:name";
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

      
        $this->WIdb->insert('wi_theatre_company', array(
            "name"     => $name,
            "biography"  => $bio,
            "address"  => $address,
            "photo" => $img
        )); 

        $CompanyId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New company";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new company";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "company_id"  => $CompanyId
            );

            echo json_encode($result);

    }else{
    $msg = "The company you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg,
                "dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


      public function CreateCompany($name, $address, $country, $bio,  $img)
    {
                $sql = "SELECT * FROM `wi_theatre_company` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    //print_r($res);

  if (count($res) <1) {

        if(empty($name)){

          $msg = "You Have not Entered a value for the Company Name !";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg            
              );

            echo json_encode($result);
            }

          if(empty($address)){
            $address = null;
        }

        if(empty($country)){
            $country = null;
        }

        if(empty($bio)){
            $bio = null;
        }

        if(empty($img)){
            $img = null;
        }
         $sql = "INSERT INTO `wi_theatre_company` (`name`, `address`, `country`, `biography`, `photo`) values (:name, :address, :country, :bio, :img)";
        
        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':bio', $bio, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':country', $country, PDO::PARAM_STR);
        $stmt->bindParam(':img', $img, PDO::PARAM_STR);
        $stmt->execute();
       
        $CompanyId = $this->WIdb->lastInsertId();

         $st1  = WISession::get('user_id') ;
            $st2  = "Added New company";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new company";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "company_id"  => $CompanyId
            );

            echo json_encode($result);

    }else{
    $msg = "The company you are trying to add already exists !!";
            
            //prepare and output success message
            $result = array(
                "status" => "error",
                "msg"    => $msg//,
                //"dump" => var_dump($res)
            );

            echo json_encode($result);
  }
}


  public function showInstalledCompany($id)
  { 
     $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:id";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetchAll();
    $photo = $res['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
    echo '<li class="ui-state-default ui-corner-all showcompany">
                            <form class="form-company">
                          <article class="post_container" id="companyPost">
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label for="name" class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                          <div class="showcompanynel">' . $res['name'] . '

      </label>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <figure class="post-image" id="show_Image">            
        <div class="showcompanynel"><div class="img-preview"><img src="WIMedia/Img/company/' . $photo.'"></div></div>
      </figure>
    </div>
  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
    <div class="showcompanynel">' . $res['biography'].'
  </div></div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="showcompanynel">' . $res['biography'].'

    </div></div></article>
  </form>
                       </li>';
  }


  public function editCompany($id, $name, $bio, $address, $country, $img)
  {

        $sql = "UPDATE `wi_theatre_company` SET  `address` =:address, `name`=:name, `biography`=:bio, `country`=:country, `photo`=:img WHERE  `id` =:id";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':bio', $bio, PDO::PARAM_STR);
        $query->bindParam(':country', $country, PDO::PARAM_STR);
        $query->bindParam(':img', $img, PDO::PARAM_STR);
        $query->bindParam(':address', $address, PDO::PARAM_STR);
        $query->execute();


         $st1  = WISession::get('user_id') ;
            $st2  = "Edited Company";
            //$maintain = new WIMaintenace();

            $this->maint->LogFunction($st1, $st2);
            $this->maint->Notifications($st1, $st2);

             $msg = "You have successfully added a new company";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg,
                "company_id"  => $CompanyId
            );

            echo json_encode($result);
  }

  
  public function deleteCompany($id)
  {
    $sql = "DELETE FROM `wi_theatre_company` WHERE `id`=:id";
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $msg = "You have successfully added a deleted a company";
            
            //prepare and output success message
            $result = array(
                "status" => "success",
                "msg"    => $msg            
              );

            echo json_encode($result);
  }


  Public function searchCompany($search)
  {
    //echo $search;
    $sql = "SELECT * FROM `wi_theatre_company` WHERE `name` LIKE '%" .$search . "%'";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    while ($res = $query->fetchAll(PDO::FETCH_ASSOC) ) {
      //print_r($res);
      foreach ($res as $company) {
        $photo = $company['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="col-xs-6 col-md-6 col-lg-3">
        <div class="flipcard-' . $company['id'] . '"><span class="btn editing-' . $company['id'] . '">Edit</span><span class="btn delete" onclick="WICompany.delete(`' . $company['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $company['id'] . '">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-company fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x">
            <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler-' . $company['id'] . '" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview" id="preview' . $company['id'] . '"></div>
        <div class="upload-msg" id="status"></div>
                <input type="hidden" name="supload" id="supload" class="supload" value="company">

      </figure>
            </span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="companysName" style="margin: 10px 0;"><blockquote>
        <p><input type="text" class="name" name="name" id="name" value="'. $company['name'].'"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="plan_price plan-bottom"><span><textarea rows="4" cols="50" class="bio" id="bio">'. $company['biography'].'</textarea></span></span>

                         <p>
        <i class="icon-globe"></i><input type="text" class="bcity" name="bcity" value="'. $company['city_birth'] . '"> <br>
        <i class="fas fa-birthday-cake"></i><input type="text" id="datepicker' . $company['id'] . '" class="datepicker" name="dob" value="'. $company['dob'] . '"> 
      </p>
                      </div>
                    </div>
                  </div>
                  <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WICompany.editcompany(`' . $company['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
        
        </div>
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-12">
          <span class="fa-stack-company fa-2x">
            <span class="fa fa-circle fa-stack-2x icon-background4"></span>
            <span class="fa fa-circle-thin fa-stack-2x icon-background6"></span>
            <span class="off-grey fa-stack-1x"><img src="WIMedia/Img/company/'. $photo.'" style="width:60px; height:60px; border-radius: 36px;></span>
          </span>
        </div>
        <div class="col-xs-12">
          <h3 class="companysName" style="margin: 10px 0;"><blockquote>
        <p>'. $company['name'].'</p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit">
                    <div class="row">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="about_company"><span class="bio"><p class="pbio">'. $company['biography'].'</p></span></span>

                         <p>
        <i class="icon-globe">Birth City</i> '. $company['city_birth'] . '<br>
        <i class="fas fa-birthday-cake">Birthday</i>'. $company['dob'] . '
      </p>
                      </div>
                    </div>
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

  .editing-' . $company['id'] . '{
      background-color: #bf6cda;
    color: white;
    perspective: 638px;
    margin-left: 10px;
    margin-top: 10px;
}
  .flipcard-' . $company['id'] . ' {
    position: relative;
    width: 244px;
    height: 412px;
    perspective: 638px;
    margin: 0px 6px 10px 0px;
}
.flipcard-' . $company['id'] . '.flip .front {
  transform: rotateY(180deg);
}
.flipcard-' . $company['id'] . '.flip .back {
  transform: rotateY(0deg);
}
.flipcard-' . $company['id'] . ' .back{
  transform: rotateY(-180deg);
}
.flipcard-' . $company['id'] . ' .front, .flipcard-' . $company['id'] . ' .back
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
      
    $("body").delegate(".editing-' . $company['id'] . '", "click", function(){
        $(".flipcard-' . $company['id'] . '").toggleClass("flip");
        });

$( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker' . $company['id'] . '" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker' . $company['id'] . '").attr("value", date);
});



  var obj = $("#dragandrophandler-' . $company['id'] . '");
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


    public function GetCompany()
  {
    $sql = "SELECT * FROM `wi_theatre_company`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul id="companyul">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {

        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WIShows.addCompanyInfo(' . $showing['id']. ');">
                            <div class="col-lg-12">
                              <img class="theatre_img" src="WIMedia/Img/company/' . $photo . '">
                              <span class="company_edit_naming">' . $showing['name']. '</span>
                            </div>
                          </a></li>';
      }
    }

    echo '</ul>';
  }

   public function editGetCompany($id)
  {
    $sql = "SELECT * FROM `wi_theatre_company`";

    $query = $this->WIdb->prepare($sql);
    $query->execute();

    echo '<ul id="companyul">';
    while($res = $query->fetchAll())
    {
      foreach ($res as $showing) {

        $photo = $showing['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<li class="th">
        <a href="javascript:void(0);" onclick="WIShows.addEditCompanyInfo(' . $showing['id']. ',' . $id. ');">
                            <div class="col-lg-12">
                              <img class="theatre_img" src="WIMedia/Img/company/' . $photo . '">
                              <span class="company_edit_naming">' . $showing['name']. '</span>
                            </div>
                          </a></li>';
      }
    }

    echo '</ul>';
  }


  public function getCompany_info($id)
  {
    $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addShows-company-name" name="addShows-name" type="text" class="input-xlarge form-control" placeholder="companie\'s name" value="' . $res['name']. '">
        <input id="addShows-company-id" name="addShows-company-id" type="hidden" class="input-xlarge form-control" value="' . $res['id']. '">';
    }

      public function editGetCompany_info($company_id, $id)
  {
    $sql = "SELECT * FROM `wi_theatre_company` WHERE `id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $company_id, PDO::PARAM_INT);
    $query->execute();
    $res = $query->fetch();

        echo '<input id="addeditShows_company_name_' . $id . '" name="addShows-name" type="text" class="input-xlarge form-control" placeholder="companie\'s name" value="' . $res['name']. '">
        <input id="addShows_company_id_' . $id . '" name="addShows-company-id" type="hidden" class="input-xlarge form-control" value="' . $res['id']. '">';
    }


}
?>