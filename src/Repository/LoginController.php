<?php 

class LoginController extends Controller
{
	public function welcome() {
		return $this->render('welcome');
	}

	public function userExists($username) {
		$_SESSION['username'] = $username;
		$this->checkUserInitialized();
		$exists = $this->user->userExists($username);
		if ($exists) {
			return $this->render('login');
		} else {
			return $this->render('new-user');
		}
	}

	public function verifyLogin($password) {
		$this->checkUserInitialized();
		$userPassword = $this->user->getPassword();
		if (password_verify($password, $userPassword[0]->password)) {
			return true;
		} else {
			return false;;
		}
	}

	public function login($password) {
		$this->checkUserInitialized();
		$userPassword = $this->user->getPassword();
		
		if (password_verify($password, $userPassword[0]->password)) {
			$_SESSION['loggedIn'] = true;
			return $this->render('tasks');
		} else {
			return $this->render('login');
		}
	}

	public function createNewUser($password) {
		$username = $this->user->getUsername();
		$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
		$created = $this->user->createNewUser($username, $hashedPassword);
		if ($created) {
			$_SESSION['loggedIn'] = true;
			return $this->render('tasks');
		} else {
			return "User creation failed";
		}
	}
}
