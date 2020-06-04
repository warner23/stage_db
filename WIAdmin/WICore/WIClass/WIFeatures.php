<?php

/**
* WIActor Class
* Created by Warner Infinity
* Author Jules Warner
*/

class WIFeatures {


    /**
     * Class constructor
     */
    public function __construct() {
        $this->WIdb = WIdb::getInstance();
    }


    public function availableFeatures($theatre_id, $column)
    { 
        //echo "th". $theatre_id;
        //echo "col" . $column;
        $sql =  "SELECT `" .$column . "` FROM `wi_theatre_features` WHERE `theatre_id` = :theatre_id";
        $query = $this->WIdb->prepare($sql);
        //echo $sql;
        $query->bindParam(':theatre_id', $theatre_id, PDO::PARAM_INT);
        $query->execute();

        $res = $query->fetch(PDO::FETCH_ASSOC);
        //print_r($res);
        //echo $res;
        //var_dump($res);
        //echo $res[$column];
        
        return $res[$column];
    }

    public function editFeatures($id, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking)
    {
        $sql = "UPDATE `wi_theatre_features` SET  `wheelchair_access` =:da , `disabled_toliets` =:dt,  `toliets` =:wc, `bar` =:bar, `hearing_assistance` =:hearing, `disabled_parking` =:disabled_parking, `guide_dogs` =:guide_dogs, `stairs` =:stairs, WHERE `id` = :id";

        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':da', $da, PDO::PARAM_STR);
        $stmt->bindParam(':dt', $dt, PDO::PARAM_STR);
        $stmt->bindParam(':bar', $bar, PDO::PARAM_STR);
        $stmt->bindParam(':hearing_assistance', $hearing, PDO::PARAM_STR);
        $stmt->bindParam(':disabled_parking', $disabled_parking, PDO::PARAM_STR);
        $stmt->bindParam(':guide_dogs', $guide_dogs, PDO::PARAM_STR);
        $stmt->bindParam(':stairs', $stairs, PDO::PARAM_STR);
        $stmt->execute();
    }


        public function CreateFeatures($theatre_id, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking)
    {
        $sql = "INSERT INTO `wi_theatre_features`   `wheelchair_access` =:da , `disabled_toliets` =:dt,  `toliets` =:wc, `bar` =:bar, `hearing_assistance` =:hearing, `disabled_parking` =:disabled_parking, `guide_dogs` =:guide_dogs, `stairs` =:stairs";

        $stmt = $this->WIdb->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':da', $da, PDO::PARAM_STR);
        $stmt->bindParam(':dt', $dt, PDO::PARAM_STR);
        $stmt->bindParam(':bar', $bar, PDO::PARAM_STR);
        $stmt->bindParam(':hearing_assistance', $hearing, PDO::PARAM_STR);
        $stmt->bindParam(':disabled_parking', $disabled_parking, PDO::PARAM_STR);
        $stmt->bindParam(':guide_dogs', $guide_dogs, PDO::PARAM_STR);
        $stmt->bindParam(':stairs', $stairs, PDO::PARAM_STR);
        $stmt->execute();
    }


    public function FeatureOptions($id)
    {
        echo '<div id="feature_options">
<script type="text/javascript">
                          $( function() {
   //$( "input" ).checkboxradio();
  } );
  </script>
                    <form  class="form-horizontal" id="features-form_' . $id . '">
                        <fieldset>

                        <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="ds_icon"></span>
                        <div class="btn-group" data-toggle="buttons-radio">
                        <input type="hidden" name="wheelchair_access_' . $id . '" id="wheelchair_access_' . $id . '" class="btn-group-value" value="0"/>
                        <button type="button" id="wheelchair_access_' . $id . '_true" name="wheelchair_access_' . $id . '" value="true"  class="btn">yes
                        </button>
                        <button type="button" id="wheelchair_access_' . $id . '_false" name="wheelchair_access_' . $id . '" value="false" class="btn btn-danger active" >No
                        </button>
                        <span class="feature-install-help-block">Select <strong>Yes</strong> if you have wheelchair access to the theatre.
                        </span>
                    </div>

                        </div>
                      </div>



                      <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="dt_icon"></span>
                         <div class="btn-group" data-toggle="buttons-radio">
                        <input type="hidden" id="disabled_toliets_' . $id . '" name="disabled_toliets_' . $id . '" class="btn-group-value" value="0" />
                        <button id="disabled_toliets_' . $id . '_true" type="button" name="disabled_toliets_' . $id . '" value="true"  class="btn btn-success">Yes</button>
                        <button id="disabled_toliets_' . $id . '_false" type="button" name="disabled_toliets_' . $id . '" value="false" class="btn active" >No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have toliets_' . $id . ' suitable for wheelchairs</span>
                    </div>

                        </div>
                      </div>


                       <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="wc_icon"></span>
                         <div class="btn-group" data-toggle="buttons-radio">
                        <input id="toliets_' . $id . '" type="hidden" name="toliets_' . $id . '" class="btn-group-value" value="0" />
                        <button id="toliets_' . $id . '_true" type="button" name="toliets_' . $id . '" value="true"  class="btn btn-success">Yes</button>
                        <button id="toliets_' . $id . '_false" type="button" name="toliets_' . $id . '" value="false" class="btn active" >No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have Male and female toliet facilities</span>
                    </div>

                        </div>
                      </div>




                       <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="bar_icon"></span>
                        <div class="btn-group" data-toggle="buttons-radio">
                        <input  id="bar_' . $id . '" type="hidden" name="bar_' . $id . '" class="btn-group-value" value="0" />
                        <button id="bar_' . $id . '_true" type="button" name="bar_' . $id . '" value="1"  class="btn btn-success">Yes</button>
                        <button id="bar_' . $id . '_false" type="button" name="bar_' . $id . '" value="0" class="btn active">No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have a bar_' . $id . ' at this theatre</span>
                    </div>

                        </div>
                      </div>




                      <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="hearing_icon"></span>
                                            <div class="btn-group" data-toggle="buttons-radio">
                        <input  id="loop_system_' . $id . '" type="hidden" name="loop_system_' . $id . '" class="btn-group-value" value="0" />
                        <button id="loop_system_' . $id . '_true" type="button" name="loop_system_' . $id . '" value="1"  class="btn btn-success">Yes</button>
                        <button id="loop_system_' . $id . '_false" type="button" name="loop_system_' . $id . '" value="0" class="btn active">No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have a hearing loop system, installed in your theatre</span>
                    </div>

                        </div>
                      </div>



                      <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="dp_icon"></span>
                        <div class="btn-group" data-toggle="buttons-radio">
                        <input  id="disabled_parking_' . $id . '" type="hidden" name="disabled_parking_' . $id . '" class="btn-group-value" value="0" />
                        <button id="disabled_parking_' . $id . '_true" type="button" name="disabled_parking_' . $id . '" value="1"  class="btn btn-success">Yes</button>
                        <button id="disabled_parking_' . $id . '_false" type="button" name="disabled_parking_' . $id . '" value="0" class="btn active">No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have a bar_' . $id . ' at this theatre</span>

                    </div>

                        </div>
                      </div>



                      <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="dogs_icon"></span>
                        <div class="btn-group" data-toggle="buttons-radio">
                        <input  id="guide_dogs_' . $id . '" type="hidden" name="guide_dogs_' . $id . '" class="btn-group-value" value="0" />
                        <button id="guide_dogs_' . $id . '_true" type="button" name="guide_dogs_' . $id . '" value="1"  class="btn btn-success">Yes</button>
                        <button id="guide_dogs_' . $id . '_false" type="button" name="guide_dogs_' . $id . '" value="0" class="btn active">No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you allow guide dogs in your theatre</span>


                        </div>
                      </div>
                </div>

                 <div class="form-group">
                          
                        <div class="controls col-lg-8">
                        <span class="stairs_icon"></span>
                            <div class="btn-group" data-toggle="buttons-radio">
                        <input  id="stairs_' . $id . '" type="hidden" name="stairs_' . $id . '" class="btn-group-value" value="0" />
                        <button id="stairs_' . $id . '_true" type="button" name="stairs_' . $id . '" value="1"  class="btn btn-success">Yes</button>
                        <button id="stairs_' . $id . '_false" type="button" name="stairs_' . $id . '" value="0" class="btn active">No</button>
                    <span class="feature-install-help-block">Select<strong>Yes</strong> if you have a bar_' . $id . ' at this theatre</span>

                    </div>

                        </div>
                      </div>
                        </fieldset>
                      </form>

                       <script type="text/javascript">
                       var wheelchair_access_' . $id . ' = $("#wheelchair_access_' . $id . '").attr(`value`);
                       if (wheelchair_access_' . $id . ' === "0"){
                        $("#wheelchair_access_' . $id . '_true").removeClass(`btn-success active`)
                        $("#wheelchair_access_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (wheelchair_access_' . $id . ' === "1"){
                        $("#wheelchair_access_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#wheelchair_access_' . $id . '_true").addClass(`btn-success active`);
                       }

                       var disabled_toliets_' . $id . ' = $("#disabled_toliets_' . $id . '").attr(`value`);

                       if (disabled_toliets_' . $id . ' === "0"){
                        $("#disabled_toliets_' . $id . '_true").removeClass(`btn-success active`)
                        $("#disabled_toliets_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (disabled_toliets_' . $id . ' === "1"){
                        $("#disabled_toliets_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#disabled_toliets_' . $id . '_true").addClass(`btn-success active`);
                       }

                       var toliets_' . $id . ' = $("#toliets_' . $id . '").attr(`value`);
                       if (toliets_' . $id . ' === "0"){
                        $("#toliets_' . $id . '_true").removeClass(`btn-success active`)
                        $("#toliets_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (toliets_' . $id . ' === "1"){
                        $("#toliets_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#toliets_' . $id . '_true").addClass(`btn-success active`);
                       }

                       var bar_' . $id . ' = $("#bar_' . $id . '").attr(`value`);
                       if (bar_' . $id . ' === "0"){
                        $("#bar_' . $id . '_true").removeClass(`btn-success active`)
                        $("#bar_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (bar_' . $id . ' === "1"){
                        $("#bar_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#bar_' . $id . '_true").addClass(`btn-success active`);
                       }

                       var loop_system_' . $id . ' = $("#loop_system_' . $id . '").attr(`value`);
                       if (loop_system_' . $id . ' === "0"){
                        $("#loop_system_' . $id . '_true").removeClass(`btn-success active`)
                        $("#loop_system_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (loop_system_' . $id . ' === "1"){
                        $("#loop_system_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#loop_system_' . $id . '_true").addClass(`btn-success active`);
                       }

                        var disabled_parking_' . $id . ' = $("#disabled_parking_' . $id . '").attr(`value`);
                       if (disabled_parking_' . $id . ' === "0"){
                        $("#disabled_parking_' . $id . '_true").removeClass(`btn-success active`)
                        $("#disabled_parking_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (disabled_parking_' . $id . ' === "1"){
                        $("#disabled_parking_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#disabled_parking_' . $id . '_true").addClass(`btn-success active`);
                       }

                        var guide_dogs_' . $id . ' = $("#guide_dogs_' . $id . '").attr(`value`);
                       if (guide_dogs_' . $id . ' === "0"){
                        $("#guide_dogs_' . $id . '_true").removeClass(`btn-success active`)
                        $("#guide_dogs_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (guide_dogs_' . $id . ' === "1"){
                        $("#guide_dogs_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#guide_dogs_' . $id . '_true").addClass(`btn-success active`);
                       }

                        var stairs_' . $id . ' = $("#stairs_' . $id . '").attr(`value`);
                       if (stairs_' . $id . ' === "0"){
                        $("#stairs_' . $id . '_true").removeClass(`btn-success active`)
                        $("#stairs_' . $id . '_false").addClass(`btn-danger active`);
                       }else if (stairs_' . $id . ' === "1"){
                        $("#stairs_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#stairs_' . $id . '_true").addClass(`btn-success active`);
                       }



                        $("#wheelchair_access_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#wheelchair_access_' . $id . '").attr("value", `1`)
                        $("#wheelchair_access_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#wheelchair_access_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#wheelchair_access_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#wheelchair_access_' . $id . '").attr("value", `0`)
                        $("#wheelchair_access_' . $id . '_true").removeClass(`btn-success active`)
                        $("#wheelchair_access_' . $id . '_false").addClass(`btn-danger active`);
                    })

                    $("#disabled_toliets_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#disabled_toliets_' . $id . '").attr("value", `1`)
                        $("#disabled_toliets_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#disabled_toliets_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#disabled_toliets_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#disabled_toliets_' . $id . '").attr("value", `0`)
                        $("#disabled_toliets_' . $id . '_true").removeClass(`btn-success active`)
                        $("#disabled_toliets_' . $id . '_false").addClass(`btn-danger active`);
                    })


                     $("#toliets_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#toliets_' . $id . '").attr("value", `1`)
                        $("#toliets_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#toliets_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#toliets_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#toliets_' . $id . '").attr("value", `0`)
                        $("#toliets_' . $id . '_true").removeClass(`btn-success active`)
                        $("#toliets_' . $id . '_false").addClass(`btn-danger active`);
                    })

                    $("#bar_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#bar_' . $id . '").attr("value", `1`)
                        $("#bar_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#bar_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#bar_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#bar_' . $id . '").attr("value", `0`)
                        $("#bar_' . $id . '_false").addClass(`btn-danger active`)
                        $("#bar_' . $id . '_true").removeClass(`btn-success active`);
                    })

                    $("#loop_system_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#loop_system_' . $id . '").attr("value", `1`)
                        $("#loop_system_' . $id . '_true").addClass(`btn-success active`)
                        $("#loop_system_' . $id . '_false").removeClass(`btn-danger active`);
                    })
                    $("#loop_system_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#loop_system_' . $id . '").attr("value", `0`)
                        $("#loop_system_' . $id . '_true").addClass(`btn-success active`)
                        $("#loop_system_' . $id . '_false").removeClass(`btn-danger active`);
                    })

                    $("#disabled_parking_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#disabled_parking_' . $id . '").attr("value", `1`)
                        $("#disabled_parking_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#disabled_parking_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#disabled_parking_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#disabled_parking_' . $id . '").attr("value", `0`)
                        $("#disabled_parking_' . $id . '_true").removeClass(`btn-success active`)
                        $("#disabled_parking_' . $id . '_false").addClass(`btn-danger active`);
                    })

                    $("#guide_dogs_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#guide_dogs_' . $id . '").attr("value", `1`)
                        $("#guide_dogs_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#guide_dogs_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#guide_dogs_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#guide_dogs_' . $id . '").attr("value", `0`)
                        $("#guide_dogs_' . $id . '_true").removeClass(`btn-success active`)
                        $("#guide_dogs_' . $id . '_false").addClass(`btn-danger active`);
                    })

                    $("#stairs_' . $id . '_true").click(function(){
                        //alert(`clicked`);
                        $("#stairs_' . $id . '").attr("value", `1`)
                        $("#stairs_' . $id . '_false").removeClass(`btn-danger active`)
                        $("#stairs_' . $id . '_true").addClass(`btn-success active`);
                    })

                    $("#stairs_' . $id . '_false").click(function(){
                        //alert(`clicked`);
                        $("#stairs_' . $id . '").attr("value", `0`)
                        $("#stairs_' . $id . '_true").removeClass(`btn-success active`)
                        $("#stairs_' . $id . '_false").addClass(`btn-danger active`);
                    })

                   
                      </script>

                      <a href="javascript:void(0);" onclick="WIFeatures.InstallTheatreFeatures(' . $id . ');">Save</a>
                      </div>
';
    }

    public function InstallFeatures($ele_id, $theatre_id)
    {
              echo '<div class="modal off" id="modal-' . $ele_id . '-details">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" onclick="WIFeatures.close(`' . $ele_id . '`)" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title" id="modal-username">
                              Features
                    </h4>
                </div>

                <div class="modal-body" id="details-body">
                    <div class="theatre_features">';
                self::FeatureOptions($theatre_id);
                echo '</div>
                </div>
                <div align="center" class="ajax-loading off"><img src="WIMedia/Img/ajax_loader.gif" /></div>
                <div class="modal-footer">
                    <a href="javascript:void(0);" onclick="WIMedia.closeUpload(`actor`)" class="btn btn-default" data-dismiss="modal" aria-hidden="true">
                      ' .  WILang::get('cancel'). '
                    </a>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->';
    }


    public function InstallTheatreFeatures($theatre_id, $da, $dt, $wc, $bar, $hearing, $guide_dogs, $stairs, $disabled_parking)
    {
        $this->WIdb->insert('wi_theatre_features', array(
            "theatre_id"     => $theatre_id,
            "wheelchair_access"  => $da,
            "disabled_toliets"  => $dt,
            "toliets" => $wc,
            "bar" => $bar,
            "hearing_assistance" => $hearing,
            "disabled_parking" => $disabled_parking,
            "guide_dogs" => $guide_dogs,
            "stairs" => $stairs
        )); 

            $Feature_Id = $this->WIdb->lastInsertId();
    }



      public function Theatre_Features_added($id)
  {
    $sql = "SELECT * FROM `wi_theatre_features` WHERE `theatre_id`=:id";

    $query = $this->WIdb->prepare($sql);
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();

    $res = $query->fetchAll();

    if (count($res) > 0) {
        return true;
    }else{
        return false;
    }
  }

  public function GetFeatureInfo($id)
  {
  }

  public function getTheatreFeatures($id)
  {
    $sql = "SELECT * FROM `wi_features`";
    $query = $this->WIdb->prepare($sql);
    $query->execute();

    $res = $query->fetchAll(PDO::FETCH_ASSOC);

    foreach ($res as $feature) {
                        $features = $feature['feature'];
                        //echo $features;
                        //$feature_enable = self::availableFeatures($id, $features);
                        echo '<div class="col-md-3 col-sm-3 col-xs-3 col-lg-3">
                      <div class="panel panel-info">
                      <div class="panel-heading purple">' . $feature['feature_name'] .'</div>
                      <div class="panel-body">
                      <div class="' . $feature['feature_icon'] .'"></div>
                           <div class="btn-group-edit-features" id="wheelchair_accessy" data-toggle="buttons-radio">
                        <input type="hidden" name="wheelchair_access" id="' . $feature['feature'] .'_' . $id .'" class="btn-group-value" value="' . self::availableFeatures($id, $features) .'"/>
                        <button type="button" id="' . $feature['feature'] .'_' . $id .'_true" name="wheelchair_access" value="true"  class="btn">yes
                        </button>
                        <button type="button" id="' . $feature['feature'] .'_' . $id .'_false" name="wheelchair_access" value="false" class="btn btn-danger activewhens" >No
                        </button>
    
                        <div id="feature_info" class="feature_info"></div>
                        </div>
                        <span class="feature-help-block">' . $feature['feature_help_block'] .'
                        </span>

                      </div>

                      <div class="panel-footer purple">

                      </div>

                      </div>
                  </div>

                                          <script type="text/javascript">
                       var ' . $feature['feature'] .'_' . $id .' = $("#' . $feature['feature'] .'_' . $id .'").attr(`value`);
                       if (' . $feature['feature'] .'_' . $id .' === "0"){
                        $("#' . $feature['feature'] .'_' . $id .'_true").removeClass(`btn-success active`)
                        $("#' . $feature['feature'] .'_' . $id .'_false").addClass(`btn-danger active`);
                       }else if (' . $feature['feature'] .'_' . $id .' === "1"){
                        $("#' . $feature['feature'] .'_' . $id .'_false").removeClass(`btn-danger active`)
                        $("#' . $feature['feature'] .'_' . $id .'_true").addClass(`btn-success active`);
                       }
                       </script>';
    }
  }


   

} 