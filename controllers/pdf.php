<?php
//@require_once("dompdf/dompdf_config.inc.php");

class PdfController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}
	
	function indexAction() {
		
	}
	
	protected function printStatsAction() {
		xController::load('vignette')->loading($_SESSION['questionnary']['questionnary']['questionnary']['id']);
		$html = xController::load('stats')->statsAction();
		return $this->_print($html);
	}
	
	protected function printFeedbackAction() {
		$d = $_SESSION['questionnary'];
		$html = xView::load('vignette/feedbackHTML', $d)->render();
		return $this->_print($html);
	}

	function _print($html) {
		// PDF formatting parameters
		$orientation = @$this->params['xorientation'];
		if (!$orientation) $orientation = 'portrait';
		$paper = @$this->params['xpaper'];
		$paper = strtolower($paper);
		if (!$paper) $paper = 'a4';
		// Renders $html within print template
		$html = xView::load('layout/print', array(
				'content' => $html
		))->render();
		// Returns HTML if required
		if (isset($this->params['html'])) die($html);
		// Creates PDF file
		require_once(xContext::$basepath.'/lib/dompdf/dompdf_config.inc.php');
		$dompdf = new DOMPDF();
		$dompdf->set_paper($paper, $orientation);
		$dompdf->set_base_path(xContext::$baseurl);
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream("print.pdf");
		exit();
	}
}
?>