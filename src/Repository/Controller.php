<?php

Class Controller {
	protected $user;

	public function __construct() {	
		$this->checkUserInitialized();
	}

    public function render($view) {
		ob_start();
		include 'views/'.$view.'.php';
		$html = ob_get_clean();
		return $html;
	}

	protected function checkUserInitialized() {
		$username = $_SESSION['username'] ?? '';
		if (!$this->user) {
			if ($username) {
				$this->user = new User($username);
			}
		}
	}
}
