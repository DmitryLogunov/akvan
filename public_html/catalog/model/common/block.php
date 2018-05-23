<?php
class ModelCommonBlock extends Model {
  const SLAIDSHOW_ROOT_ITEM_ID = 9;

  public function getBlocksHomeSlideshow() {
		$query = $this->db->query("
            SELECT *
            FROM " . DB_PREFIX . "information i LEFT JOIN " . DB_PREFIX . "information_description id ON (i.information_id = id.information_id)
            LEFT JOIN " . DB_PREFIX . "information_to_store i2s ON (i.information_id = i2s.information_id)
            WHERE id.language_id = '" . (int)$this->config->get('config_language_id') . "'
                  AND i2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND i.status = '1'
                  AND i.parent_id = '". self::SLAIDSHOW_ROOT_ITEM_ID. "'
            GROUP BY i.information_id
            ORDER BY i.sort_order, LCASE(id.title) ASC");
    $result = array();
    foreach ($query->rows as $row) {
      $row['description'] = strip_tags(html_entity_decode($row['description'], ENT_QUOTES));
      $result[] = $row;
    }
    return $result;    
  }
}
?>