<?php

class LayoutLayoutView extends xView {

    function init() {
        $this->meta = xUtil::array_merge($this->meta, array(
            'layout' => array(
                'template' => 'layout.tpl',
            ),
            'js' => array(
				/*'tiny_mce-lib' => xUtil::url('assets/js/tiny_mce/tiny_mce.js'),
            	'tiny_mce-init' => xUtil::url('assets/js/init_tiny_mce.js'),*/
            	'jquery' => xUtil::url('assets/js/jquery/jquery-1.8.0.min.js'),
            	'questionnary-create' => xUtil::url('assets/js/questionnary-create.js')
            ),
            'css' => array(
                // Bootstrap.css CSS
                xUtil::url('assets/css/main.css')
            )
        ));
    }

    function render() {
        return $this->apply($this->meta['layout']['template']);
    }
}