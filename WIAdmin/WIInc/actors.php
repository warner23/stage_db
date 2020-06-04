
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        People
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">People</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WIActor.addActor();">Add</button>

                    <button id="exit_search" class="btn btn-primary" onclick="WIActor.ExitSearch();">Exit Search</button>
                    <button id="csvUpload" class="btn btn-primary" onclick="WIActor.dropAndDragUpload(`wi_theatre_person`,`actor`, `actor`,`csv`,`new`)">Upload CSV</button>
                    <button id="bulkUpload" class="btn btn-primary" onclick="WIActor.dropAndDragBulkUpload(`actor`, `person`,`bulkPersonUpload`,`new`)">Bulk Image Uploader</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="people_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WIActor.Search();">Search</button>
</div>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showActors">

              
                  </div>
                  <div id="modal"></div>
                  <div id="mediaCenter"></div>
                  <div id="mediaupload"></div>

    </div>
                     </section>
                     </aside>




          

           


          <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>

          <script type="text/javascript" src="WICore/WIJ/WIActor.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMedia.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMediaCenter.js"></script>

        <!--   <script type="text/javascript">
            $(document).ready(function(){

              $( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepicker" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepicker").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepicker").attr('value', date);
});

  var obj = $("#dragandrophandler");
  dir = $("#supload").attr('value');
  var ele_id = $(".img-preview").attr("id");
obj.on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
});
obj.on('dragover', function (e) 
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e) 
{
 
     $(this).css('border', '2px dotted #0B85A1');
     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
 
     //We need to send dropped files to Server
     showCreationhandleFileUpload(files,obj, dir, ele_id);
     $("#modal-actor-upload").removeClass('on').addClass('off');
  $("#uploadOptions").removeClass("on").addClass("off");
});
$(document).on('dragenter', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e) 
{
  e.stopPropagation();
  e.preventDefault();
  obj.css('border', '2px dotted #0B85A1');
});
$(document).on('drop', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
});

});
          </script> -->