<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
            	
             	
            	//JQUERY
            	'jquerys' => xUtil::url('assets/jquery/js/jquery-1.8.0.min.js'),
            	'jquery' => xUtil::url('assets/jquery/js/jquery-ui-1.8.23.custom.min.js'),
            	
            	//APP
            	'init' => xUtil::url('assets/js/init.js'),
            	'questionnary-create' => xUtil::url('assets/js/create-form/questionnary-create.js'),
            	'questionnary-create-paramedicalTest' => xUtil::url('assets/js/create-form/questionnary-create-paramedicalTest.js'),
            	'questionnary-create-picture' => xUtil::url('assets/js/create-form/questionnary-create-picture.js'),
            	'questionnary-helper' => xUtil::url('assets/js/helper.js'),

            	

            	//FancyBox
            	'fancyBox' => xUtil::url('assets/fancyBox/source/jquery.fancybox.js'),
            	'fancyBoxPack' => xUtil::url('assets/fancyBox/source/jquery.fancybox.pack.js'),


            		
            	//TINYMCE
            	'tiny_mce-lib' => xUtil::url('assets/tiny_mce/tiny_mce.js'),
            	'tiny_mce-init' => xUtil::url('assets/js/init_tiny_mce.js'),
            		
            	//Bootstrap.css
            	//'bootstrap' => xUtil::url('assets/bootstrap/js/bootstrap.min.js')
            	
            ),
            'css' => array(
                //Bootstrap.css CSS
            	//xUtil::url('assets/bootstrap/css/bootstrap.min.css'),
            	//xUtil::url('assets/bootstrap/css/bootstrap-responsive.min.css'),
            	xUtil::url('assets/bootstrap.css/bootstrap.css'),
            		
            	//FBM
                xUtil::url('assets/css/main.css'),
            		
            	//Jquery UI
            	xUtil::url('assets/jquery/css/ui-lightness/jquery-ui-1.8.23.custom.css'),
            	
            	//fancyBox
            	'fancyBox' => xUtil::url('assets/fancyBox/source/jquery.fancybox.css'),
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}