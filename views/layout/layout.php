<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
            	//TINYMCE
// 				'tiny_mce-lib' => xUtil::url('assets/js/tiny_mce/tiny_mce.js'),
//             	'tiny_mce-init' => xUtil::url('assets/js/init_tiny_mce.js'),
            	//JQUERY
            	'jquerys' => xUtil::url('test/js/jquery-1.8.0.min.js'),
            	
            	//APP
            	'questionnary-create' => xUtil::url('assets/js/questionnary-create.js'),
            	'jquery' => xUtil::url('test/js/jquery-ui-1.8.23.custom.min.js')
            ),
            'css' => array(
                // Bootstrap.css CSS
            	
            	//xUtil::url('assets/bootstrap.css/bootstrap-responsive.css'),
            	// Custom CSS
            	//xUtil::url('assets/css/bootstrap-tweaks.css'),
            	// Custom project CSS
            	//xUtil::url('assets/css/custom-blog.css'),
            
            		
            	
            	//xUtil::url('assets/bootstrap.css/bootstrap.css'),
            		
            	//FBM
                xUtil::url('assets/css/main.css'),
            	xUtil::url('test/css/ui-lightness/jquery-ui-1.8.23.custom.css'),
            	
            	
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}