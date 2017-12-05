<?php
class ControllerCommonLeftMenu extends Controller {
	public function index() {
 
		// Menu
		$this->load->model('catalog/category');

		$this->load->model('catalog/product');

		$data['categories'] = array();

		$categories = $this->model_catalog_category->getCategories(0);

		foreach ($categories as $category) {
			if ($category['top']) {
				// Level 2
				$children_data = array();

				$children = $this->model_catalog_category->getCategories($category['category_id']);

				foreach ($children as $child) {
					$filter_data = array(
						'filter_category_id'  => $child['category_id'],
						'filter_sub_category' => true
					);
					
					
				// Level 3
				$child_data = array();

				$childz = $this->model_catalog_category->getCategories($child['category_id']);

				foreach ($childz as $chil) {
					$filter_data = array(
						'filter_category_id'  => $chil['category_id'],
						'filter_sub_category' => true
					);

					$child_data[] = array(
						'name'  => $chil['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $chil['category_id'])
					);
				}
					
					
					$children_data[] = array(
						'name'  => $child['name'] . ($this->config->get('config_product_count') ? ' (' . $this->model_catalog_product->getTotalProducts($filter_data) . ')' : ''),
						'href'  => $this->url->link('product/category', 'path=' . $child['category_id'] . '_' . $child['category_id']),
						'child' => $child_data,
					);
				}

				// Level 1
				$data['categories'][] = array(
					'name'     => $category['name'],
					'children' => $children_data,
					'column'   => $category['column'] ? $category['column'] : 1,
					'href'     => $this->url->link('product/category', 'path=' . $category['category_id'])
				);
			}
		}

		return $this->load->view('common/left_menu', $data);
	}
}
