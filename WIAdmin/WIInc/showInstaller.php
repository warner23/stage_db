
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


              <div class="wizard col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="steps">
                <ul>
                    <li>
                        <a :class="active">
                            <div class="stepNumber active" id="stepOne"><i class="fas fa-bars"></i></div>
                            <span class="stepDesc text-small"> Welcome </span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepTwo"><i class="fas fa-user-circle"></i></div>
                            <span class="stepDesc text-small">People</span>
                        </a>
                    </li>

                     <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepThree"><i class="fas fa-users"></i></div>
                            <span class="stepDesc text-small">Cast</span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepFour"><i class="fa fa-database"></i></div>
                            <span class="stepDesc text-small">Crew</span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepFive"><i class="fa fa-terminal"></i></div>
                            <span class="stepDesc text-small">Company</span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepSix"><i class="fa fa-terminal"></i></div>
                            <span class="stepDesc text-small">Theatre</span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepSeven"><i class="fa fa-terminal"></i></div>
                            <span class="stepDesc text-small">Show</span>
                        </a>
                    </li>
                    <li>
                        <a :class="active">
                            <div class="stepNumber inactive" id="stepEight"><i class="fa fa-flag-checkered"></i></div>
                            <span class="stepDesc text-small">Completed</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="step-content show" id="step_one">
              <?php include_once 'WIInc/site/showCreator/welcome.php'; ?> 
                
            </div>


            <div class="step-content hide" id="step_two">
        <?php include_once 'WIInc/site/showCreator/people.php'; ?> 
            </div>

             <div class="step-content hide" id="step_three">
              <?php include_once 'WIInc/site/showCreator/cast.php'; ?> 
            </div>


            <div class="step-content hide" id="step_four">
              <?php include_once 'WIInc/site/showCreator/crew.php'; ?> 
            </div>

            <div class="step-content hide" id="step_five">
              <?php include_once 'WIInc/site/showCreator/company.php'; ?>
            </div>


            <div class="step-content hide" id="step_six">
              <?php include_once 'WIInc/site/showCreator/theatre.php'; ?>
            </div>

            <div class="step-content hide" id="step_seven">
              <?php include_once 'WIInc/site/showCreator/show.php'; ?>
            </div>

            <div class="step-content hide" id="step_eight">
              <?php include_once 'WIInc/site/showCreator/completed.php'; ?>
            </div>

        </div>
    </div>
</div>




            </div><!-- end of well -->
          </div>
        </div>
      </div>


                     

                     </section>
<script type="text/javascript" src="WICore/WIJ/WICore.js"></script>
<script type="text/javascript" src="WICore/WIJ/WIShowInstaller.js"></script>

<script type="text/javascript" src="WICore/WIJ/WIMediaCenter.js"></script>
