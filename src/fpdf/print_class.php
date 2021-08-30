<?php
/*********** Clase PDF_JAVASCRIPT basandose en FPDF ***********/
class PDF_JavaScript extends FPDF {
var $javascript;
var $n_js;
function IncludeJS($script) {
$this->javascript=$script;
}
function _putjavascript() {
$this->_newobj();
$this->n_js=$this->n;
$this->_out('<<');
$this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
$this->_out('>>');
$this->_out('endobj');
$this->_newobj();
$this->_out('<<');
$this->_out('/S /JavaScript');
$this->_out('/JS '.$this->_textstring($this->javascript));
$this->_out('>>');
$this->_out('endobj');
}
function _putresources() {
parent::_putresources();
if (!empty($this->javascript)) {
$this->_putjavascript();
}
}
function _putcatalog() {
parent::_putcatalog();
if (!empty($this->javascript)) {
$this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
}
}
}
/****************************************************************/
 
/*************** Clase PDF_AutoPrint basandose en PDF_JavaScript *************/
class PDF_AutoPrint extends PDF_JavaScript
{
    function AutoPrint($printer='')
    {
        // Open the print dialog
        if($printer)
        {
            $printer = str_replace('\\', '\\\\', $printer);
            $script = "var pp = getPrintParams();";
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
            $script .= "pp.printerName = '$printer'";
            $script .= "print(pp);";
        }
        else
            $script = 'print(true);';
        $this->IncludeJS($script);
    }
}
 
function AutoPrintToPrinter($server, $printer, $dialog=false)
		{
			//Print on a shared printer (requires at least Acrobat 6)
			$script = "var pp = getPrintParams();";
			if($dialog)
				$script .= "pp.interactive = pp.constants.interactionLevel.full;";
			else
				$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
			$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
			$script .= "print(pp);";
			$this->IncludeJS($script);
		}

?>