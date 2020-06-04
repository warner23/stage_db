
  <script>
  $( function() {
    $( "#tabs" ).tabs();
  } );
  </script>

 <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Permissions
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Permissions</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6 col-xl-12">
                            <!-- input box's box -->
                            <div class="modal-body">

            <div class="well" id="permissions">
              <div id="presults"></div>
                  


                     </div>
                     </div>
                     </div>
                     </div>

                     </section>

                             <script type="text/javascript">
                       $(document).ready(function(){

                        $('select#group').on('change', function() {
                           // alert( this.value );
                           $('select option:nth(1)').prop("selected","selected");

                           //$("select#group option").val(this.val).prop("selected", "selected");

                          })
                       });
                     </script>
<script type="text/javascript" src="WICore/WIJ/WICore.js"></script>
<script type="text/javascript" src="WICore/WIJ/WIPermissions.js"></script>

   