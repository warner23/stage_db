<?php

class WICSV

{

	    public function __construct() {
        $this->WIdb = WIdb::getInstance();
        $WIdb = WIdb::getInstance();
        
    }

    public function Database2($csv, $table)
    {
    	$fieldsTermBy = ";";
    	$fieldsEncBy = '"';
    	$file = fopen(dirname(dirname(dirname(__FILE__))) . '/WIMedia/Docs/csv/' . $csv ,"r");
    	echo "being dbed";

    $query = "LOAD DATA INFILE '" .$file."'
         INTO TABLE ".$table."
        FIELDS TERMINATED BY ';'
         OPTIONALLY ENCLOSED BY '\"'
        LINES TERMINATED BY '\n'
        (name, first_line, second_line, city, region, postcode, country, description, photo)";
   $this->WIdb->prepare($query)->execute();

  /* $this->WIdb->exec("LOAD DATA LOCAL INFILE $file
                                    INTO TABLE $table
                                    FIELDS TERMINATED BY ';'
                                    OPTIONALLY ENCLOSED BY '\"'
                                    LINES TERMINATED BY '\n'
                                    (name, first_line, second_line, city, region, postcode, country, description, photo)");*/



    	
    }
	
	public function Database3($csv, $table)
	{
		echo "skip";
		echo $csv;
		echo $table;
		echo dirname(dirname(dirname(__FILE__))) . '/WIMedia/Docs/csv/' . $csv;
 		$csvFile = fopen(dirname(dirname(dirname(__FILE__))) . '/WIMedia/Docs/csv/' . $csv ,"r");
            
            //skip first line
           // fgetcsv($csvFile);
            

            echo "getv";
            if(is_resource($csvFile)){
            while(($line = fgetcsv($csvFile, 10000,";","\"")) !== FALSE){
            		print_r($line);
                       	
            	$name = $line[0];
            	echo "name". $name;
            	$import = $this->WIdb->prepare('INSERT INTO `' .$table.'` (name, first_line, second_line, city, region, postcode, country, description, photo) VALUES (?,?,?,?,?,?,?,?,?)');
                    //insert member data into database
            //$sql = "INSERT INTO `$table` (name, first_line, second_line, city, region, postcode, country, description, photo) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."','".$line[5]."' ,'".$line[6]."' ,'".$line[7]."' ,'".$line[8]."')";

            //$query = $this->WIdb->prepare($sql);

                    //$WIdb->bindfree("INSERT INTO `$table` (name, first_line, second_line, city, region, postcode, country, description, photo) VALUES ('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[3]."','".$line[4]."' ,'".$line[5]."' ,'".$line[6]."' ,'".$line[7]."')");
            $import->execute($line);
            
            
            //close opened csv file
                    echo "nearly finished";
            fclose($csvFile);
    }
    }else{
    	echo "unable to open file";
    }
	}

    public function Database($csv, $table)
    {
        $csvFile = fopen(dirname(dirname(dirname(__FILE__))) . '/WIMedia/Docs/csv/' . $csv ,"r");
        if ($table === "wi_theatres") {
                    try { 
        // prepare for insertion

        $query_ip = $this->WIdb->prepare('
            INSERT INTO ' .$table. ' (name, first_line, second_line, city, region, postcode, country, description, photo, seats
            ) VALUES (
            ?,?,?,
            ?,?,?,
            ?,?,?,
            ?
            )
        ');

        // unset the first line like this       
        fgets($csvFile);

        // created loop here
        while (($data = fgetcsv($csvFile, 1000, ',')) !== FALSE) {
            $query_ip->execute($data);
        }       

        fclose($csvFile);

    } catch(PDOException $e) {
        die($e->getMessage());
    }
        }elseif ($table === "wi_shows") {
            
            try { 
        // prepare for insertion

        $query_ip = $this->WIdb->prepare('
            INSERT INTO ' .$table. ' (id, company_id, cast_id, crew_id, theatre_id, name, theatre, description, theatre_company, start_date, end_date, photo, language, coming_soon, closed, has_Trailer, keywords)  VALUES (
            ?,?,?,
            ?,?,?,
            ?,?,?,
            ?,?,?,
            ?,?,?,
            ?,?
            )
        ');

        // unset the first line like this       
        fgets($csvFile);

        // created loop here
        while (($data = fgetcsv($csvFile, 1000, ',')) !== FALSE) {
            $query_ip->execute($data);
        }       

        fclose($csvFile);

    } catch(PDOException $e) {
        die($e->getMessage());
    }
        }elseif ($table === "wi_theatre_cast") {
            try { 
        // prepare for insertion

        $query_ip = $this->WIdb->prepare('
            INSERT INTO ' .$table. ' ( `name`, `address`, `country`, `biography`, `photo`) VALUES(
            ?,?,?,
            ?,?
            )
        ');

        // unset the first line like this       
        fgets($csvFile);

        // created loop here
        while (($data = fgetcsv($csvFile, 1000, ',')) !== FALSE) {
            $query_ip->execute($data);
        }       

        fclose($csvFile);

    } catch(PDOException $e) {
        die($e->getMessage());
    }
        }elseif ($table === " wi_theatre_company") {
            try { 
        // prepare for insertion

        $query_ip = $this->WIdb->prepare('
            INSERT INTO ' .$table. ' ( `name`, `address`, `country`, `biography`, `photo`) VALUES(
            ?,?,?,
            ?,?
            )
        ');

        // unset the first line like this       
        fgets($csvFile);

        // created loop here
        while (($data = fgetcsv($csvFile, 1000, ',')) !== FALSE) {
            $query_ip->execute($data);
        }       

        fclose($csvFile);

    } catch(PDOException $e) {
        die($e->getMessage());
    }
        }elseif ($table === "wi_theatre_person") {
            try { 
        // prepare for insertion
        $query_ip = $this->WIdb->prepare('
            INSERT INTO ' .$table. ' ( `name`, `biography`, `dob`, `photo`) VALUES(
            ?,?,?,
            ?
            )
        ');

        // unset the first line like this       
        fgets($csvFile);

        // created loop here
        while (($data = fgetcsv($csvFile, 1000, ',')) !== FALSE) {
            $query_ip->execute($data);
        }       

        fclose($csvFile);

    } catch(PDOException $e) {
        die($e->getMessage());
    }
        }

    }
}


?>