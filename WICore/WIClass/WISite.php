<?php

/**
* Site Class
* Created by Warner Infinity
* Author Jules Warner
*/
class WISite 
{
	private $WIdb = null;

	public function __construct()
	{
		$this->WIdb = WIdb::getInstance();

	}	

	public function Website_Info($column) 
	{


		$user_id = 1;

		$result = $this->WIdb->selectColumn('SELECT * FROM `wi_site` WHERE `id` = :user_id', array('user_id' => $user_id), $column);

		return  $result;
	}


		public function Theme_Info($column) 
	{
		$theme_id = 1;
		$result = $this->WIdb->select(
                    "SELECT * FROM `wi_theme` WHERE `id` = :theme_id", array(
                    	"theme_id" => $theme_id
                    )
                  );
              //var_dump($result);
              return $result[$column];


		
/*
		$query = $this->WIdb->prepare('SELECT * FROM `wi_theme` WHERE `id` = :theme_id');
		$query->bindParam(':theme_id', $theme_id, PDO::PARAM_STR);
		$query->execute();

		$res = $query->fetch(PDO::FETCH_ASSOC);

		return $res[$column];*/
	}


	public function Countries()
	{

				$result = $this->WIdb->select(
                    "SELECT * FROM `wi_countries`"
                  );

/*		$query = $this->WIdb->prepare('SELECT * FROM `wi_countries`');
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);*/
		echo '<select id="countries">';
		foreach ($result as $res) {
			echo '<option value="' . $res['country_code'] . '" title="' . $res['country_name'].'">' . $res['country_name'].'</option>';
		}
		echo '</select>';

	}

		public function Country($id)
	{

		$result = $this->WIdb->select(
                    "SELECT * FROM `wi_countries`"
                  );

		/*$query = $this->WIdb->prepare('SELECT * FROM `wi_countries`');
		$query->execute();

		$result = $query->fetchAll(PDO::FETCH_ASSOC);*/
		echo '<select id="countries' . $id . '" class="countries">';
		foreach ($result as $res) {
			echo '<option value="' . $res['country_code'] . '" title="' . $res['country_name'].'">' . $res['country_name'].'</option>';
		}
		echo '</select>';

	}


	

}

?>
