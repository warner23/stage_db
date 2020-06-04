<?php

/**
* 
*/
class WIShows
{
    
    function __construct() 
    {
         $this->WIdb = WIdb::getInstance();
         $this->Page = new WIPagination();
         $this->maint = new WIMaintenace();
         $this->theatre = new WITheatres();
         $this->cast = new WICast();
         $this->crew = new WICrew();
         $this->company = new WICompany();
         $this->login = new WILogin();
         $this->Info = new WIUserInfo();
         $this->user   = new WIUser(WISession::get('user_id'));
         $this->Perm = new WIPermissions();
    }

    public function hasShows()
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

        $sql = "SELECT * FROM `wi_shows` ORDER BY `start_date` ASC LIMIT :page, :item_per_page";
        $query = $this->WIdb->prepare($sql);
        $query->bindParam(':page', $page_position, PDO::PARAM_INT);
        $query->bindParam(':item_per_page', $item_per_page, PDO::PARAM_INT);
        $query->execute();
        echo '<div class="row">
                  <div id="products" class="row list-group">';
        while ($result = $query->fetchAll(PDO::FETCH_ASSOC) ) {
            
            foreach ($result as $show) {
                $photo = $show['photo'];
            if (empty($photo)) {
                $photo = "image01.jpg";
            }
              
            if($this->user->isAdmin()  OR $this->Perm->hasPermission(WISession::get('user_id'), "2", "Shows", "edit" ) ){
              
              echo '
        <div class="item  col-xs-4 col-lg-4">
        <div class="flipcard-' . $show['id'] . '">
        <span class="btn-edit editing-' . $show['id'] . '">Edit</span>
        <span class="btn-edit show-delete" onclick="WIShow.delete(`' . $show['id'] . '`);">Delete</span>
        <div class="back">
           <div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
            <div class="col-xs-12 col-md-6">
                            <a class="show_link" id="'. $show['id'].'" href="show.php" >'. $show['name'].'</a>
                        </div>
                <img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/shows/'. $photo.'" alt="'. $show['name'].'" />
                <div class="caption">
                    <h4 class="group inner list-group-item-heading">
                       <p><a class="show_link" id="'. $show['id'].'" href="show.php" >'. $show['name'].'</a></p></h4>
                      <p> ';echo $this->theatre->getLocation($show['id']); echo '</p>
                                <p><a class="theatre_link" id="'. $show['theatre_id'].'" href="theatre.php" >'. $show['theatre'].'</a></p>
                              <p class="group inner list-group-item-text stbio">
                        '. $show['theatre_company'].'</p>  
                        </div>
                        
            </div>
            </div>
                  </div>

                  
        
         <div class="front text-center">
         <div class="item">
            <div class="thumbnail">
                <a class="show_link" id="'. $show['id'].'" href="show.php" ><img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/shows/'. $photo.'" alt="'. $show['name'].'" /></a>
                <div class="caption">
                    <h4 class="group inner list-group-item-headings">
                       <p class="showP"><a class="show_link" id="'. $show['id'].'" href="show.php" >'. $show['name'].'</a></p></h4>
                                <p class="showP"><a class="theatre_link" id="'. $show['theatre_id'].'" href="theatre.php" >'. $show['theatre'].'</a></p>
                                <p class="group inner list-group-item-text">
                        '. $show['theatre_company'].'</p>
                        </div>
                        

                    
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <p class="lead">
                                                    </div>
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
                    .flipcard-' . $show['id'] . ' {
                      position: relative;
                      width: 100%;
                      height: 200px;
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
                      padding: 10px 5px;
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
        }else{
            //user is not admin
             echo '<div class="item  col-xs-4 col-lg-4">
            <div class="thumbnail">
           
               <a class="show_link" id="'. $show['id'].'" href="show.php" > <img class="group list-group-image" style="border-radius: 36px;" src="WIAdmin/WIMedia/Img/shows/'. $photo.'" alt="'. $show['name'].'" /></a>
                <div class="caption">
                    <h1 class="group inner list-group-item-heading">
                       <p><a class="show_link" id="'. $show['id'].'" href="show.php" >'. $show['name'].'</a></p></h1>
                                
                                <p><a class="theatre_link" id="'. $show['theatre_id'].'" href="theatre.php" >'. $show['theatre'].'</a></p>
                      <p><a class="show_link" id="'. $show['id'].'" href="company.php" >'. $show['theatre_company'].'</a></p></h1>
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
      $Pagin = $this->Page->Pagination($item_per_page, $page_number, $rows, $total_pages, $JsClass, $onclick);
    //print_r($Pagination);


         echo '<div align="center">';
    /* We call the pagination function here to generate Pagination link for us. 
    As you can see I have passed several parameters to the function. */
    echo $Pagin;
    echo '</div>';
    echo '</div></div>';
    }
   
    public function showInfo($show_id)
    {
        $sql = "SELECT * FROM `wi_shows` WHERE `id`=:show_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('show_id', $show_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch();
        echo json_encode($res);
    }

    public function ViewShow($show_id)
    {
        $sql = "SELECT * FROM `wi_shows` WHERE `id`=:show_id";

        $query = $this->WIdb->prepare($sql);
        $query->bindParam('show_id', $show_id, PDO::PARAM_INT);
        $query->execute();

        $show = $query->fetch();

        $photo = $show['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }
        echo '<div class="row">';
        if($this->user->isAdmin() ){
            //user is admin

        echo '
        <div class="flipcard-' . $show['id'] . '">
        <span class="btn editing-' . $show['id'] . '">Edit</span>
        <span class="btn show-delete" onclick="WIShow.delete(`' . $show['id'] . '`);">Delete</span>
        <div class="back">
            <div class="top-bit" id="' . $show['id'] . '">
      <div class="row">
        <div class="col-xs-4">
             <figure class="post-image" id="show_Image">            
          <div id="dragandrophandler-' . $show['id'] . '" class="dragandrophandler">Drag & Drop Files Here</div>
        <div class="img-preview-' . $show['id'] . '" id="preview-' . $show['id'] . '"></div>
        <div class="upload-msg" id="status"></div>
                <input type="hidden" name="supload" id="supload" class="supload" value="shows">
      </figure>

        </div>
        <div class="col-xs-6">
          <h3 class="showsName"><blockquote>
        <p><input type="text" class="name" name="name" id="name-' . $show['id'] . '" value="'. $show['name'].'" placeholder="show Name"></p>
        
      </blockquote></h3>
        </div>
      </div>
          </div>
          <div class="middle-bit-show">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cast" id="cast">'; echo $this->cast->showCast($show['cast_id']); echo '</div>
          <div class="crew" id="crew">'; echo $this->crew->showCrew($show['id']); echo '</div>
                      </div>

            </div>
                    <div class="end-bit">
                    <div class="row">
                      <div class="col-xs-12">
                        <button id="submit" type="button" onclick="WIshow.editshows(`' . $show['id'] . '`);" class="btn btn-sm btn-smooth btn-custom" data-plan="free">Save</button>
                      </div>
                    </div>
                  </div>
                  </div>

                  
        
         <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-4">
        <span class="off-grey-show">
    <img class="img-responsive" src="WIAdmin/WIMedia/Img/shows/'. $photo.'" style="border-radius: 36px;">
    </span>
        </div>
        <div class="col-xs-6">
          <h3 class="showsName"><blockquote>
        <p>'. $show['name'].'</p>
        
      </blockquote></h3>
      <h3 class="showsLocation"><blockquote>
        <p>'; echo $this->theatre->getLocation($show['id']); echo'</p>
        
      </blockquote></h3>
      <h3 class="showsTheatre"><blockquote>
        <p><a class="theatre_link" id="'. $show['theatre_id'].'" href="theatre.php" >'. $show['theatre'].'</a></p>
        
      </blockquote></h3>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="tbio">'. $show['description'].'</p>
                        </div>

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                         $hasTrailers = self::findIfTrailers($show['id']);
                         if($hasTrailers > 0){
                            echo '<label>Trailers</label><div class="trailers" id="trailers">'; self::getTrailers($show['id'],$show['theatre_id']); echo'</div>';
                         }else{
                          echo '<a href="javascript:void(0);" onclick="WIShows.createTrailer(' .$show['id'] . ',' .$show['theatre_id'] . ')" class="btn">Upload Trailer</a>';
                         }
                        echo '</div>
      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                     
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cast" id="cast">'; echo $this->cast->showCast($show['id']); echo '</div>
          <div class="crew" id="crew">'; echo $this->crew->showCrew($show['id']); echo '</div>
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
              </div><style>

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
    height: auto;
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
        margin: 0px 0px -275px 0px;
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

        }else{
            //user is not admin
            echo '<div class="flipcard">
       <div class="front text-center">
          <div class="top-bit">
      <div class="row">
        <div class="col-xs-6">';
        if (date("Y-m-d") > $show['end_date']) {
          echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="raduis closed"></div>
          <div class="showClosed">show is closed</div>
          </div>';
        }else if (date("Y-m-d") < $show['end_date']) {
          echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
          <div class="raduis live"></div>
          <div class="showLive">show is open</div>
          </div>';

        }
        echo '<span class="off-grey-show">
    <img class="img-responsive thumb" src="WIAdmin/WIMedia/Img/shows/'. $photo.'" >
    </span>
        </div>
        <div class="col-xs-6">
          <h3 class="showsName"><blockquote>
        <p><a class="show_link" id="'. $show['id'].'" href="show.php" >'. $show['name'].'</a></p>
        
      </blockquote></h3>
      <h3 class="showsLocation"><blockquote>
        <p>';echo $this->theatre->getLocation($show['id']); echo '</p>
        
      </blockquote></h3>
      <h3 class="showsTheatre"><blockquote>
        <p><a class="theatre_link" id="'. $show['theatre_id'].'" href="theatre.php" >'. $show['theatre'].'</a></p>
        
      </blockquote></h3>
      <p>' ; echo self::showDates($show['start_date']); echo '</p>
      <p>'; echo self::showDates($show['end_date']); echo '</p>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <p class="tbio">'. $show['description'].'</p>
                        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                         $hasTrailers = self::findIfTrailers($show['id']);
                         if($hasTrailers > 0){
                            echo '<label>Trailers</label><div class="trailers" id="trailers">'; self::getTrailers($show['id'],$show['theatre_id']); echo'</div>';
                         }else{
                          
                         }
                        echo '</div>

      </div>
          </div>
          <div class="middle-bit-show">
                    <div class="row">
                     
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                       <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 cast" id="cast">'; echo $this->cast->showCast($show['id']); echo '</div>
          <div class="crew" id="crew">'; echo $this->crew->showCrew($show['id']); echo '</div>
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
                }
                  </style>';

        }
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
        <figure class="post-video" id="youtube_video">                                    
               ' . $trailer['src']. '        
                 </figure>
        </div></li>';
      }
    }
    echo '</ul>';
    

 
  }


    public function InsertShows($name, $desc,$theatre,$company,$start_date,$end_date,$user,$Image, $cast)
    {

        $sql = "SELECT * FROM `wi_shows` WHERE `name`=:name";
    //echo $sql;
    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->execute();

    $res = $query->fetch();
    print_r($res);
  if (empty($res)) {
    
    $theatre_name = $this->theatre->getTheatreName($theatre);
    $company_name = $this->company->companyName($company);

    $this->WIdb->insert('wi_shows', array(
            "name" => $name,
            "description" => $desc,
            "company_id" => $company,
            "theatre_id" => $theatre,
            "theatre" => $theatre_name,
            "theatre_company" => $company_name,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "photo" => $Image,
            "keywords" => $name
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


     Public function searchShows($search)
  {
    //echo $search;
    //$sql = "SELECT * FROM `wi_shows` WHERE `name` LIKE '%" .$search . "%'";

    $showresults = $this->WIdb->select("SELECT * FROM `wi_shows` WHERE `name` LIKE '%" .$search . "%' OR `keywords` LIKE '%" .$search . "%'");
    $theatreresults = $this->WIdb->select("SELECT * FROM `wi_theatres` WHERE `name` LIKE '%" .$search . "%'  OR `keywords` LIKE '%" .$search . "%'");
    $actorresults = $this->WIdb->select("SELECT * FROM `wi_theatre_person` WHERE `name` LIKE '%" .$search . "%'");
    $companyresults = $this->WIdb->select("SELECT * FROM `wi_theatre_company` WHERE `name` LIKE '%" .$search . "%'");
    $searchresults = array_merge($showresults,$theatreresults,$actorresults,$companyresults);

    echo '<ul class="resultsearch" id="searchResults">';
    foreach ($searchresults as $result ) {
        echo '<li class="row" id="columns">
            <div class="col-xs-12 col-md-12 col-lg-12">
            <div col-xs-4 col-md-4 col-lg-4">';

        $location = "WIAdmin/WIMedia/Img";
        $selector = array('shows', 'theatres', 'person', 'company');
        //echo $_SERVER['DOCUMENT_ROOT'] . '/'. $location . '/shows/'. $photo;
        //var_dump(file_exists($_SERVER['DOCUMENT_ROOT'] . '/The_Stage_DB/' .$location . '/shows/'. $photo)) ;
        $photo = $result['photo'];
        if (empty($photo)) {
          $photo = "image01.jpg";
        }



        foreach ($selector as $key ) {
          $searchPhoto =$result['photo'];
          if (empty($searchPhoto)) {
          $searchPhoto = "NULL.jpg";
        }
          if (file_exists($_SERVER['DOCUMENT_ROOT']. '/The_Stage_DB/' .$location . '/'. $key . '/'. $searchPhoto)) {
            echo '<img class="img-responsive" src="' .$location . '/'. $key . '/'. $photo. '" width="60" height="60">';
          }
        }

      echo '</div>
            <div col-xs-8 col-md-8 col-lg-8">
            <div col-xs-4 col-md-4 col-lg-4">
            ';echo preg_replace("/\w*?".preg_quote($search)."\w*/i", "<b>$0</b>", $result['name']);  echo '</div>
            </div>
            </div>
            </li>';

    }

    echo '</ul>';

  }




  public function ActorRelatedShows($show_id = array() )
  {


        //var_dump($show_id);
         echo '<ul class="show_casting" id="show_casting">';
    foreach ($show_id as $id) {
      //var_dump($id);
          $qu = $this->WIdb->select("SELECT * FROM `wi_shows` WHERE `id`=:show_id", array("show_id" => $id['show_id'])
  );
          //var_dump($qu);
          foreach ($qu as $shows) {
            $photo = $shows['photo'];
          //echo $photo;
            if (empty($photo)) {
                $photo = "image01.jpg";
            }

            $start_date = self::showDates($shows['start_date']);
            $end_date = self::showDates($shows['end_date']);
/*            $startDate = $shows['start_date'];
            $sparts = explode("-", $startDate);
            $start_date = $sparts[2] .'/' . $sparts[1] . '/' . $sparts[0];

                        $endDate = $shows['end_date'];
            $eparts = explode("-", $endDate);
            $end_date = $eparts[2] .'/' . $eparts[1] . '/' . $eparts[0];
*/
               echo '<li class="col-md-12 casting" id="cast_' .$shows['id'] . '">
                <div id="edit_casting_' .$shows['id'] . '">
                <img src="WIAdmin/WIMedia/Img/shows/' . $photo . '" class="img-responsive" id="Cast" value="' . $photo . '">
               <div class="charactor_name" id-"charactor_name">(' . $start_date . ' - ' . $end_date . ')</div> 
                <div class="pb">' . $shows['theatre'] . '</div><div class="playedBy" id="playedBy"><div id="select_actor"></div></div></div></li>';
          }
          
    }
     echo '</ul>'; 

       
    }

    public function showDates($date)
    {
                  $startDate = $date;
            $parts = explode("-", $startDate);
            $date = $parts[2] .'/' . $parts[1] . '/' . $parts[0];

            return $date;
    }


   
}



?>
