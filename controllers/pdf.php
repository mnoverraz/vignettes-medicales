<?php
//@require_once("dompdf/dompdf_config.inc.php");

class PdfController extends xWebController {

	function defaultAction() {
		return $this->indexAction();
	}
	
	function indexAction() {
		
	}
	
	/**
	 * Return html format from a template (just the specify template not the entire webpage)
	 * @return string Html from the template stats
	 */
	protected function printStatsAction() {
		xController::load('vignette')->loading($_SESSION['questionnary']['questionnary']['questionnary']['id']);
		$html = xController::load('stats')->statsAction();
		return $this->_print($html);
	}
	
	/**
	 * Return html format from a template (just the specify template not the entire webpage)
	 * @return string Html from the template vignette/feedbackHTML
	 */
	protected function printFeedbackAction() {
		$d = $_SESSION['questionnary'];
		$html = xView::load('vignette/feedbackHTML', $d)->render();
		return $this->_print($html);
	}

	/**
	 * Generate the pdf with the dompdf lib
	 * @param string $html
	 * @return stream Return a stream (pdf)
	 */
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