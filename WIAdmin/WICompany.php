<?php
define("INCLUDE_CHECK", true);
include_once 'WICore/init.php';

 if($admin->isAdmin()){
 include_once 'WIInc/WI_start_up.php';
include_once 'WIInc/WI_header.php';
include_once 'WIInc/sidebar.php';
include_once 'WIInc/company.php';
}else{
header("location:../index.php");
            }
?>



<!-- footer -->
<!-- end footer -->




</body>
</html>
	<script type="text/javascript" src="WICore/WIJ/jquery.cookie.js"></script> <!-- jQuery cookie --> 