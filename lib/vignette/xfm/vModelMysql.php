<?php
abstract class vModelMysql extends xModelMysql {
	
	
	/**
	 * Checks that the model is allowed for the given $operation.
	 * @param string Operation (get, putm post, delete).
	 * @param string Model name (optional, defaults to current model).
	 */
	function check_allowed($operation, $modelname=null) {
		if (!$modelname) $modelname = $this->name;
		if (!xContext::$auth->is_allowed_model($modelname, $operation)) {
			$roles = implode(', ', xContext::$auth->roles());
			throw new xException ("You are not allowed to '{$operation}' on '{$modelname}' with roles '{$roles}'", 403);
		}
	}
	
	
	/**
	 * Enhanced get method.
	 * Manages versioning.
	 */
	function get($rownum=null) {
		$this->check_allowed('get');
		return parent::get($rownum);
	}
	
	
	/**
	* Enhanced post method.
	* Manages versioning.
	*/
    function post() {
        $this->check_allowed('post');
        $t = new xTransaction();
        $t->start();
        try {
            $result = parent::post();
        } catch (Exception $e) {
            $t->rollback();
            throw $e;
        }
        $t->end();
        return $result;
    }
    
    /**
     * Enhanced put method.
     * Manages versioning.
     */
    function put() {
    	$this->check_allowed('put');
		return parent::put();
    }
    
    /**
     * Enhanced delete method.
     * Manages versioning.
     */
    function delete() {
    	$this->check_allowed('delete');
    	return parent::delete();
    }
    
}