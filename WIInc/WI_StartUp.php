<?php
define("INCLUDE_CHECK", true);
include_once 'WICore/init.php';
$web->StartUp();
$web->Meta($page);
$web->Styling($page);
$web->Scripts($page);
$web->webSite_icons();
?>
<!--   <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery-1.6.1.min.js"></script>
    <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery-1.8.0.min.js"></script>
<script src="WITheme/STAGE_DB/site/js/jquery.min.js"></script>
 <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery-1.10.2.js"></script> 
     -->
     <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
   <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery-1.12.4.js"></script>
 <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery-ui.js"></script>

   

  <script type="text/javascript" src="WITheme/STAGE_DB/site/js/jquery.cookie.js"></script>

      
  <script type="text/javascript">
            var $_lang = <?php echo WILang::all(); ?>;
        </script> 

</head>
<body>
  