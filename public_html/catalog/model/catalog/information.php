<?php
class ModelCatalogInformation extends Model {
	public function getInformation($information_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id) LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id) WHERE i.information_id = '" . (int)$information_id . "' AND id.language_id = '" . (int)$this->config->get('config_language_id') . "' AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'");

		return $query->row;
	}

	public function getInformations() {
		$query = $this->db->query("
            SELECT *, GROUP_CONCAT(i_childs.information_id) as child_ids
            FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id)
            LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
            LEFT JOIN " . DB_PREFIX . "information i_childs ON (i.information_id = i_childs.parent_id)
            WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
            AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'
            GROUP BY i.information_id
            ORDER BY i.sort_order, LCASE(id.title) ASC");

		$result = array();
			foreach ($query->rows as $row) {
			   $row['childs'] = ($row['child_ids'] == '') ? '' : $this->getChildInformationsByListIDs($row['child_ids']);
			   $result[] = $row;
			}

		return $result;
	}

   	public function getRootInformations() {
   		$query = $this->db->query("
               SELECT i.*, id.*, GROUP_CONCAT(i_childs.information_id) as child_ids
               FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id)
               LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
               LEFT JOIN " . DB_PREFIX . "information i_childs ON (i.information_id = i_childs.parent_id)
               WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
               AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'
               AND i.parent_id = 0
               GROUP BY i.information_id
               ORDER BY i.sort_order, LCASE(id.title) ASC");

   		$result = array();
   			foreach ($query->rows as $row) {
   			   $row['childs'] = ($row['child_ids'] == '') ? array() : $this->getChildInformationsByListIDs($row['child_ids']);
   			   $result[] = $row;
   			}

   		return $result;
   	}

	public function getInformationLayoutId($information_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "information_to_layout WHERE information_id = '" . (int)$information_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return (int)$query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getChildInformationsByListIDs($child_ids) {
	    if($child_ids == '') return '' ;

	    $sql = "SELECT i.*, id.*
        	    FROM " . DB_PREFIX . "information i
        		LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id)
        		WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
        		      AND i.information_id IN (".$child_ids.")";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$information_childs_data[$result['information_id']] = $result;
		}

		return $information_childs_data;
	}
}