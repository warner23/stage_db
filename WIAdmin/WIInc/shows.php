
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Shows
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Shows</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">

                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button id="addActor" class="btn btn-primary" onclick="WIShows.addShows();">Add</button>

                    <button id="exit_search" class="btn btn-primary" onclick="WIShows.ExitSearch();">Exit Search</button>
                    <button id="exit_search" class="btn btn-primary" onclick="WIShows.dropAndDragUpload(`wi_shows`, `shows`, `shows`,`csv`,`new`)">Upload CSV</button>
                    <button id="bulkUpload" class="btn btn-primary" onclick="WIShows.dropAndDragBulkUpload(`shows`, `shows`,`bulkShowUpload`,`new`)">Bulk Image Uploader</button>
                     <div class="search">
<input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" id="Shows_search" />
 <button type="submit" class="btn_search btn-primary btn-sm" onclick="WIShows.Search();">Search</button>
</div>
                  </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="showShows">

            
                  </div>
                    <div id="modal"></div>
                  <div id="mediaCenter"></div>
                  <div id="mediaupload"></div>
                  <div id="trailerupload"></div>

    </div>
                     </section>
                     </aside>


          <script type="text/javascript" src="WICore/WIJ/WICore.js"></script>

          <script type="text/javascript" src="WICore/WIJ/WIShows.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMedia.js"></script>
          <script type="text/javascript" src="WICore/WIJ/WIMediaCenter.js"></script>

         <!--  <script type="text/javascript">
            $(document).ready(function(){

 $( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepickersdate" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepickersdate").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepickersdate").attr('value', date);
});

   $( function() {
    jQuery.datepicker.setDefaults({dateFormat:"yy-mm-dd"});
    $( "#datepickerfdate" ).datepicker({changeMonth: true, changeYear: true});
  } );

  $("#datepickerfdate").change(function() {
    var date = $(this).datepicker("getDate");
    $("#datepickerfdate").attr('value', date);
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