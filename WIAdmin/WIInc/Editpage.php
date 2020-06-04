

  <style type="text/css">


    .drop{
          text-align: -webkit-center;
    }    

    .page{
         border: 2px solid lightblue;
    min-height: 256px;
    }

#page_selector {
    height: 57px;
    /* align-content: center; */
    margin: 8px 157px;
}

#module {
    min-height: 60px;
}

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.side_mod{
  float:right;
}
  </style>
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Edit Page
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Edit Page</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->

                    <div class="row">
                        <div class="col-lg-12 col-xs-6 col-xl-12 col-md-8">
                            <!-- input box's box -->
                           <div class="form-group">
                        <!-- Username -->
                        <label class="control-label col-lg-4"  for="page-title" id="page"> <?php echo WILang::get('title'); ?> </label>
                        <div class="controls col-lg-8">
                          <input type="text" id="page-title" name="title" placeholder="pagetitle" class="input-xlarge form-control" value=""> <br />
                        </div>
                      </div>

                     
                      <div class="col-lg-4 col-md-4 col-sm-4 side_mod">
                          <div class="module ui-widget-content" id="module">

                          </div>
                      </div>

                          <div class="col-lg-8 col-md-8 col-sm-8">  
                          <div id="page_selector">
                          <select id="page_selection">
                          <?php $page->selectPage();   ?>
                          </select>
                           
                          </div>
                      </div>

                        <div class="col-lg-8 col-md-8 col-sm-8">  
                          <div id="page_options">

                           <form>
                           <div class="col-lg-4">
                              <label>Left Hand Column</label>
                             <label class="switch">
                              <input type="checkbox" id="lsc">
                              <div class="slider round" onclick="WIEditpage.changeLHC()"></div>
                            </label>
                            </div>


                                     <div class="col-lg-4">
                              <label>Right Hand Column</label>
                             <label class="switch">
                              <input type="checkbox" id="rsc">
                              <div class="slider round" onclick="WIEditpage.changeRHC()"></div>
                            </label>
                            </div>


                           </form>

                          </div>
                      </div>


                       <div class="col-lg-8 col-md-8 col-sm-8">  
                          <div class="page" id="pages">

                           
                          </div>
                          <button onclick="WIEditpage.edit()">SAVE</button>
                      </div>
                        

                           
                        </div><!-- ./col -->
                     </div>
                     </section>
                     </aside>

                     <script type="text/javascript" src="WICore/WIJ/WIEditpage.js"></script>
                     <script type="text/javascript" src="WICore/WIJ/WIMod.js"></script>

<script type="text/javascript">
$(document).ready(function(){

    $( "#draggableMod li" ).draggable({
   containment : 'document',
  helper: 'clone',
   cursor: 'move',
  revert: 'true',
  hoverClass: "ui-state-active"
});


$( "ul#draggableMod li" ).on( "dragstart", function( event, ui ) {
      event.stopPropagation();
    event.preventDefault();
  console.log('is being called');
  $(this).css('border', '2px solid #0B85A1');
    var mod_name = $(event.target).prop('id');
    var mod_name1 = $(event.target).attr('id');
    console.log(mod_name);
     console.log(mod_name1);
      //event.dataTransfer.effectAllowed = 'copy'; // only dropEffect='copy' will be dropable
      event.originalEvent.dataTransfer.setData("text/html", mod_name ); // required otherwise doesn't work
      console.log(mod_name);
} );


$( "#pages" ).on('dragenter', function (event, ui) 
{
    event.stopPropagation();
    event.preventDefault();
    $(this).css('border', '2px solid #0B85A1');

});

$( "#pages" ).on('dragleave', function (e) 
{
    e.stopPropagation();
    e.preventDefault();
    $("li#dropStage").remove();
    $(this).css('border', '3px dashed #ccc');
  
});

$('#pages').on('dragover',function(event){
    event.preventDefault();
    event.originalEvent.dataTransfer.dropEffect = "copy"
})


$("#pages").on('drop', function (event, ui) {
        event.stopPropagation();
    event.preventDefault();
var mod_name = event.originalEvent.dataTransfer.getData("text/html");

    WIMod.drop(mod_name);
});





});
</script>


                     <script type="text/javascript">
                       $(document).ready(function(){

                        $('select').on('change', function() {
                           // alert( this.value );

                            WIEditpage.changePage(this.value);

                          })
                       });
                     </script>



