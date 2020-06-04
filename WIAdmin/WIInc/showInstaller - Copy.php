
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>
<link rel='stylesheet' href='WIInc/css/showInstaller.css' type='text/css' />
 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Show Creator
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Show Creator</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 col-xl-12">
                            <!-- input box's box -->
                            <div class="modal-body">

            <div class="well">


                     <div id="tabs">
  <ul>
    <li><a href="#tabs-1">People</a></li>
    <li><a href="#tabs-2">Cast</a></li>
    <li><a href="#tabs-3">Crew</a></li>
    <li><a href="#tabs-4">Company</a></li>
    <li><a href="#tabs-5">Theater</a></li>
    <li><a href="#tabs-6">show</a></li>


  </ul>
  <div id="tabs-1">
<?php include_once 'WIInc/site/showCreator/people.php'; ?>  
  </div>
  <div id="tabs-2">
<?php include_once 'WIInc/site/showCreator/cast.php'; ?> 
  </div>
  <div id="tabs-3">
 <?php include_once 'WIInc/site/showCreator/crew.php'; ?> 
  </div>

    <div id="tabs-4">
 <?php include_once 'WIInc/site/showCreator/company.php'; ?> 
  </div>

    <div id="tabs-5">
 <?php include_once 'WIInc/site/showCreator/theatre.php'; ?> 
  </div>

    <div id="tabs-6">
<?php include_once 'WIInc/site/showCreator/show.php'; ?> 
  </div>

   
</div>


                     </div>
                     </div>
                     </div>
                     </div>

                     </section>
<script type="text/javascript" src="WICore/WIJ/WICore.js"></script>
<script type="text/javascript" src="WICore/WIJ/WIShowInstaller.js"></script>
