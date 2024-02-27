<?php

Class Controller {
    public function render($view) {
		ob_start();
		include 'views/'.$view.'.php';
		$html = ob_get_clean();
		return $html;
	}
}
