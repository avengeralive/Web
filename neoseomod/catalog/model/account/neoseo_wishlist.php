<?php

require_once( DIR_SYSTEM . "/engine/neoseo_model.php");

class ModelAccountNeoSeoWishlist extends NeoSeoModel
{

	public function __construct($registry)
	{
		parent::__construct($registry);
		$this->_moduleSysName = "neoseo_account";
		$this->_logFile = $this->_moduleSysName . ".log";
		$this->debug = $this->config->get($this->_moduleSysName . "_debug") == 1;
	}

	public function addWishlist($product_id)
	{
		$this->event->trigger('pre.wishlist.add');

		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int) $this->customer->getId() . "' AND product_id = '" . (int) $product_id . "'");

		$this->db->query("INSERT INTO " . DB_PREFIX . "customer_wishlist SET customer_id = '" . (int) $this->customer->getId() . "', product_id = '" . (int) $product_id . "', date_added = NOW()");

		$this->event->trigger('post.wishlist.add');
	}

	public function deleteWishlist($product_id)
	{
		$this->event->trigger('pre.wishlist.delete');

		$this->db->query("DELETE FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int) $this->customer->getId() . "' AND product_id = '" . (int) $product_id . "'");

		$this->event->trigger('post.wishlist.delete');
	}

	public function getWishlist($data)
	{
		$sql = "SELECT DISTINCT ps.product_id, 
					(SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.product_id = ps.product_id AND r1.status = '1' GROUP BY r1.product_id) AS rating 
					FROM " . DB_PREFIX . "customer_wishlist ps 
						LEFT JOIN " . DB_PREFIX . "product p ON (ps.product_id = p.product_id) 
						LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) 
						LEFT JOIN " . DB_PREFIX . "product_to_store p2s ON (p.product_id = p2s.product_id) 
					WHERE p.status = '1' 
					  AND p2s.store_id = '" . (int) $this->config->get('config_store_id') . "' 
					  AND ps.customer_id = '" . (int) $this->customer->getId() . "' 
					  GROUP BY ps.product_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int) $data['start'] . "," . (int) $data['limit'];
		}

		$product_data = array();

		$query = $this->db->query($sql);

		$this->load->model("catalog/product");

		foreach ($query->rows as $result) {
			$product_data[$result['product_id']] = $this->model_catalog_product->getProduct($result['product_id']);
		}

		return $product_data;
	}

	public function getTotalWishlist()
	{
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_wishlist WHERE customer_id = '" . (int) $this->customer->getId() . "'");

		return $query->row['total'];
	}

}
