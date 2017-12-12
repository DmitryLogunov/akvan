<?php
class ControllerCommonLeftMenu extends Controller {
	public function index() {
        $data = array();
        $this->load->model('catalog/category');
        $categories = $this->model_catalog_category->getCategories();

        $data['categories'] = array();
        foreach ($categories as $category) {
          $children = $this->model_catalog_category->getCategories($category['category_id']);

          if(count($children) > 0) {
            foreach ($children as $child) {
              $child['children'] = $this->model_catalog_category->getCategories($child['category_id']);
              $child['href'] = (count($child['children']) > 0) ?
                               'javascript:void(0)' :
                               '/index.php?route=product/category&path='.$child['category_id'];
              $category['children'][] = $child;
            }
            $category['href'] = 'javascript:void(0)';
          } else {
            $category['href'] = '/index.php?route=product/category&path='.$category['category_id'];
          }
          $data['categories'][] = $category;
        }

        return $this->load->view('common/left_menu', $data);
	}
}
