<?php

class ModelLocalisationNeoSeoAddress extends Model
{

	public function getAddresses($zone_id, $city, $shipping_method)
	{
		$language_id = $this->config->get('config_language_id');

		$sql = "SELECT name 
		          FROM " . DB_PREFIX . "city_address_description 
		         WHERE language_id = " . (int) $language_id . "
		           AND zone_id = " . (int) $zone_id . "
		           AND city = '" . $this->db->escape($city) . "'
		           AND shipping_method = '" . $this->db->escape($shipping_method) . "'
		           
		           ";

		$query = $this->db->query($sql);

		return $query->rows;
	}

}
