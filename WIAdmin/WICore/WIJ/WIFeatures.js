$(document).ready(function () {
    
					$("#wheelchair_access_true").click(function(){
                        //alert('clicked');
                        $("#wheelchair_access").attr("value", '1')
                        $("#wheelchair_access_false").removeClass('btn-danger active')
                        $("#wheelchair_access_true").addClass('btn-success active');
                    });

                    $("#wheelchair_access_false").click(function(){
                        //alert('clicked');
                        $("#wheelchair_access").attr("value", '0')
                        $("#wheelchair_access_true").removeClass('btn-success active')
                        $("#wheelchair_access_false").addClass('btn-danger active');
                    });  

                    $("#disabled_toliets_true").click(function(){
                        //alert('clicked');
                        $("#disabled_toliets").attr("value", '1')
                        $("#disabled_toliets_false").removeClass('btn-danger active')
                        $("#disabled_toliets_true").addClass('btn-success active');
                    });

                    $("#disabled_toliets_false").click(function(){
                        //alert('clicked');
                        $("#disabled_toliets").attr("value", '0')
                        $("#disabled_toliets_true").removeClass('btn-success active')
                        $("#disabled_toliets_false").addClass('btn-danger active');
                    });    

                    $("#toliets_true").click(function(){
                        //alert('clicked');
                        $("#toliets").attr("value", '1')
                        $("#toliets_false").removeClass('btn-danger active')
                        $("#toliets_true").addClass('btn-success active');
                    });

                    $("#toliets_false").click(function(){
                        //alert('clicked');
                        $("#toliets").attr("value", '0')
                        $("#toliets_true").removeClass('btn-success active')
                        $("#toliets_false").addClass('btn-danger active');
                    });       

                        $("#bar_true").click(function(){
                        //alert('clicked');
                        $("#bar").attr("value", '1')
                        $("#bar_false").removeClass('btn-danger active')
                        $("#bar_true").addClass('btn-success active');
                    });

                    $("#bar_false").click(function(){
                        //alert('clicked');
                        $("#bar").attr("value", '0')
                        $("#bar_false").removeClass('btn-danger active')
                        $("#bar_true").addClass('btn-success active');
                    }); 

                    $("#loop_system_true").click(function(){
                        //alert('clicked');
                        $("#loop_system").attr("value", '1')
                        $("#loop_system_true").removeClass('btn-success active')
                        $("#loop_system_false").addClass('btn-danger active');
                    });

                    $("#loop_system_false").click(function(){
                        //alert('clicked');
                        $("#loop_system").attr("value", '0')
                        $("#loop_system_true").removeClass('btn-success active')
                        $("#loop_system_false").addClass('btn-danger active');
                    });

                      $("#disabled_parking_true").click(function(){
                        $("#disabled_parking").attr("value", '1');
                        $("#disabled_parking_false").removeClass('btn-danger active');
                        $("#disabled_parking_true").addClass('btn-success active');
                    });

                    $("#disabled_parking_false").click(function(){
                        $("#disabled_parking").attr("value", '0')
                        $("#disabled_parking_true").removeClass('btn-success active')
                        $("#disabled_parking_false").addClass('btn-danger active');
                    });


                    $("#guide_dogs_true").click(function(){
                        //alert('clicked');
                        $("#guide_dogs").attr("value", '1')
                        $("#guide_dogs_false").removeClass('btn-danger active')
                        $("#guide_dogs_true").addClass('btn-success active');
                    });

                    $("#guide_dogs_false").click(function(){
                        //alert('clicked');
                        $("#guide_dogs").attr("value", '0')
                        $("#guide_dogs_true").removeClass('btn-success active')
                        $("#guide_dogs_false").addClass('btn-danger active');
                    });

                    $("#stairs_true").click(function(){
                        //alert('clicked');
                        $("#stairs").attr("value", '1')
                        $("#stairs_false").removeClass('btn-danger active')
                        $("#stairs_true").addClass('btn-success active');
                    });

                    $("#stairs_false").click(function(){
                        //alert('clicked');
                        $("#stairs").attr("value", '0')
                        $("#stairs_true").removeClass('btn-success active')
                        $("#stairs_false").addClass('btn-danger active');
                    });

                    

});

var WIFeatures = {};

WIFeatures.CreateFeatures = function(ele_id, theatre_id){

	$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "CreateFeatures",
        ele_id  : ele_id,
        theatre_id : theatre_id
      },
      success  : function(data){
        $("#InstallFeatures").html(data);
        WIFeatures.show('feature');
      }
    });
}


WIFeatures.close = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('show').addClass('hide');
}

WIFeatures.show = function(ele_id){
  $("#modal-"+ele_id+"-details").removeClass('hide').addClass('show');
}

WIFeatures.InstallTheatreFeatures = function(id){

	  var da  = $("#wheelchair_access_"+id).attr('value');
  var dt  = $("#disabled_toliets_"+id).attr('value');
  var wc  = $("#toliets_"+id).attr('value');
  var bar  = $("#bar_"+id).attr('value');
  var hearing  = $("#loop_system_"+id).attr('value');
  var disabled_parking  = $("#disabled_parking_"+id).attr('value');
  var guide_dogs  = $("#guide_dogs_"+id).attr('value');
  var stairs  = $("#stairs_"+id).attr('value');

  	$.ajax({
      url      : "WICore/WIClass/WIAjax.php",
      method   : "POST",
      data     : {
        action : "InstallTheatreFeatures",
        theatre_id : id,
        da     : da,
        dt     : dt,
        wc     : wc,
        bar   : bar,
        hearing : hearing,
        guide_dogs : guide_dogs,
        stairs   : stairs,
        disabled_parking : disabled_parking
      },
      success  : function(data){
        $("#InstallFeatures").html(data);
        WIFeatures.close('feature');
        $("#create_features").removeClass('show').addClass('hide');
        $("#installed_features").removeClass('hide').addClass('show');

      }
    });
}

