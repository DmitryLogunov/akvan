<?php
class ControllerExtensionModuleSku extends Controller {
	public function index() {
  
		$this->load->model('catalog/product');
		$sku = $this->request->get['sku'];
		$results = $this->model_catalog_product->getProductByScu($sku);

		if ($results) {
			$this->response->setOutput($results['product_id']);
		}
 
	
	}
}
