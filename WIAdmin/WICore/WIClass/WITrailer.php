<?php

/**
* 
*/
class WITrailer
{
    
    function __construct() 
    {
         $this->WIdb = WIdb::getInstance();

    }

   
    public function ShowTrailer()
    {

        $query = $this->WIdb->prepare('SELECT * FROM `wi_theatre_trailers` ORDER BY RAND()');
        $query->execute();

        while($res = $query->fetch(PDO::FETCH_ASSOC))
        {
            echo '<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="showTrailers" >

                        <div class="services">
                        <figure class="post-video">                                    
                           ' . $res['src'] . '      
                             </figure>
                           
                        </div>
                    </div>';
        }
    }

   
}



?>
