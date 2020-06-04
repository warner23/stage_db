 <form  class="form-horizontal UPermission-form" id="UPermission">
                      <fieldset>
                        <div id="legend">
                          <legend class="">User Permissions</legend>
                        </div>


                        <div class="form-group">
                           
                          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
         <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Site</div>

                 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">Permission</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Create</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Edit</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">View</div>
                            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Delete</div>
                        </div>
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    User
                  </div>

                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="#" class="toggler no">&nbsp;</a>
                </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                   <a href="#" class="toggler no">&nbsp;</a>
                  </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#" class="toggler no">&nbsp;</a>
                  </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#" class="toggler no">&nbsp;</a>

                    <span class="help-block"></span>

                  </div>

                  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    Site
                  </div>

                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                        <a href="#" class="toggler no" id="">&nbsp;</a>
                </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                   <a href="#" class="toggler no">&nbsp;</a>
                  </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#" class="toggler no">&nbsp;</a>
                  </div>
                  <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                    <a href="#" class="toggler no">&nbsp;</a>

                    <span class="help-block"></span>

                  </div>
                </div>

                       
                              <div class="form-group">
                        <!-- Button -->
                        <div class="controls col-lg-offset-4 col-lg-8">
                           <button id="database_btn" class="btn btn-success" >Save</button> 
                        </div>
                      </div>
                      <div class="results" id="results"></div>
                    </fieldset>
                        <br /><br />
                  </form>


                   <script type="text/javascript">
                      $(document).ready(function(){
    $('a.toggler').click(function(){
        $(this).toggleClass('no');
    });
});

                   </script>