<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// session_start();


class AuthController {

	

	public function signinUser(){
		
		$errors =array();
		$username= "";
		$email= "";
		
		if (isset($_POST['signin-btn'])){
			// var_dump($_POST);

			$email = $_POST['email'];
			$password = $_POST['password'];
			// echo $email;
			// echo $password;
			// die();
			
			$errors = $this->validationSignin($email, $password);
		
			// var_dump($errors);
			// exit;
			if(empty($errors)){

				$db = new Signin();
				
				$user = $db->getUser($email, $password); 

				
				if(!empty($user)) {
					$_SESSION['id']= $user['id'];
					$_SESSION['unreg_user_id']= $user['id'];
					$_SESSION['unreg_user_name']= $user['name'];
					$_SESSION['unreg_user_email']= $user['email'];
					$_SESSION['verified']= $user['verified'];
					$_SESSION['usertype']= $user['userType'];
					$_SESSION['message']= "You are now logged in";
					$_SESSION['alert-class']= "alert-succes";

					$data['errors'] = $errors;
					// if (ini_get('register_globals'))
					// {
					// 	print_r($_SESSION);
					// 	die();
					// }
					// print_r($_SESSION);
					// 	die();
					
					// setcookie('email', $user['email'], time()+60*60*7 );
					if(isset($_SESSION['unreg_check_in_date']) && isset($_SESSION['unreg_check_out_date'])&& isset($_SESSION['unreg_no_of_rooms']) && isset($_SESSION['unreg_no_of_guest'])) {
						$room_number = $_SESSION['unreg_room_number'];
						$max_guest = $_SESSION['unreg_max_guest'];
						$check_in_date = $_SESSION['unreg_check_in_date']; 
						$check_out_date = $_SESSION['unreg_check_out_date']; 
						$rooms= $_SESSION['unreg_no_of_rooms'];
						$guest= $_SESSION['unreg_no_of_guest']; 

						unset($_SESSION['unreg_check_in_date']);
						unset($_SESSION['unreg_check_out_date']);
						unset($_SESSION['unreg_no_of_rooms']);
						unset($_SESSION['unreg_no_of_guest']);

						$reservation = new ReservationController();
						$reservation->indexOnline($room_number,$max_guest,$check_in_date,$check_out_date,$rooms, $guest);
						// var_dump($_SESSION['reservation_data']);
						// var_dump($_SESSION['input_room_search_data']);
						// $no_of_rooms = $_SESSION['no_of_rooms'];
						// echo $no_of_rooms;
						// print_r($_SESSION);
						// die();
						
						
						// unset($_SESSION['input_room_search_data']);
					}

					if(isset($_SESSION['unreg_session_date']) && isset($_SESSION['unreg_session_time'])&& isset($_SESSION['unreg_hall_id'])) {
						$session_date = $_SESSION['unreg_session_date'];
						$session_time = $_SESSION['unreg_session_time'];
						$hall_id = $_SESSION['unreg_hall_id']; 
						

						unset($_SESSION['unreg_session_date']);
						unset($_SESSION['unreg_session_time']);
						unset($_SESSION['unreg_hall_id']);

						$banquet = new BanquetController();
						$banquet->indexOnline($session_date,$session_time,$hall_id);
						

					}
					else {
						$db = new RoomDetails();
						$data['room_details'] = $db->getRoomView(); 

						$db = new Image();
						$imageRoom =$db->viewRoom();
						$data['img_details'] = $imageRoom;
						$db = new RoomEdit();
            			$data['discount_details'] = $db->getAllDiscount();
						view::load('home', $data);
						exit();
					}
					

				}else{
					$errors['email']= "You have entered an invalid username or password";
					$data['errors'] = $errors;
					$data['email']= $_POST['email'];
				$data['password']= $_POST['password'];
					unset($_POST);
                    view::load('login/login',$data);
				}
			}else{
				$data['errors'] = $errors;
				// var_dump($data);
				$data['email']= $_POST['email'];
				$data['password']= $_POST['password'];
				unset($_POST);
                view::load('login/login',$data);
			}
		}
	}
	private function validationSignin($email, $password) {

        $errors = array();
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors['email']= "Email adress is invalid";
		}
		if(empty($email)){
			$errors['email']="email required";
		}
		if(empty($password)){
			$errors['password']="password required";
		}else{
			if(!(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,}$/',$password))){
				$errors['password']="A minimum 8 characters password contains a combination of uppercase and lowercase letter and number are required.";
			}
		}
		

		return $errors;
        
	}

	public function signupUser()
	{
		if (isset($_POST['signup-btn'])){
			
			$errors = $this->validationSignup();

			if(count($errors)== 0){

				$username = $_POST['username'];
				$email = $_POST['email'];
				$password = $_POST['password'];
				$passwordConf = $_POST['passwordConf'];

				$password = password_hash($password, PASSWORD_DEFAULT);
				$token = bin2hex(random_bytes(50));
				$verified = false;

				$data =array($username, $email, $password, $token ,$verified);

				$db = new Signin();
		   		$result = $db->createUser($data);
				
				if ($result == 1) {
					
					// $user_id = $conn->insert_id;
					// $_SESSION['id']= $user_id;
					$_SESSION['unreg_user_name']= $username;
					$_SESSION['unreg_user_email']= $email;
					$_SESSION['verified']= $verified;

					$sendMail = new EmailController;
		
					$sendMail->sendVerificationEmail($email, $token, $username);
		
					$_SESSION['message']= "You are now logged in";
					$_SESSION['alert-class']= "alert-succes";
					// echo $_SESSION['username'];
					view::load('login/email-verify');
					unset($sendMail);
					unset($_POST);
					exit();
					 
		
				}else{
					// echo $stmt->error;
					$errors['usernamer']= "Database error: faild to register";
					unset($_POST);
				}
			}else{
				// var_dump($errors);
				// $data['id'] = 1;	
				$data['username']= $_POST['username'];
				$data['email']= $_POST['email'];
				$data['password']= $_POST['password'];
				$data['passwordConf']= $_POST['passwordConf'];
				$data['errors'] = $errors;
				unset($_POST);
				view::load('login/signup', $data);
			}
		
		}
		
	}

	
	
	private function validationSignup() {
		$errors =array();

        if(empty($_POST['username'])){
			$errors['username']="username field required";
		}else{
			if(!(preg_match('/^[a-zA-Z0-9]+$/',$_POST['username']))){
				$errors['username']="Username Must Contain Letters & Digits Only";
			}
		}
	
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$errors['email']= "Email address is invalid";
		}
		if(empty($_POST['email'])){
			$errors['email']="Email field Required";
		}
	
		if(empty($_POST['password'])){
			$errors['password']="password field required";
		}else{
			if(!(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,}$/',$_POST['password']))){
			$errors['password']="A minimum 8 characters password contains a combination of uppercase and lowercase letter and number are required.";
		}
	}
		if(empty($_POST['passwordConf'])){
			$errors['passwordConf']="password confirm field required";
		}else{
		if($_POST['password'] !== $_POST['passwordConf']){
			$errors['passwordConf']="password does not match";
		}}
		$db = new Signin();
		$result = $db->findEmail($_POST['email']);

            if($result == 1) {
                $errors['email'] = 'that email is already registered!';
			}
		unset($db);
		return $errors;
	}
	
	public function logout()
	{
		
		
			unset($_SESSION['unreg_user_id']);
			unset($_SESSION['unreg_user_name']);
			unset($_SESSION['unreg_user_email']);
			unset($_SESSION['verified']);
			// For room search process
			unset($_SESSION['id']);
			unset($_SESSION['reservation_data']);
			unset($_SESSION['input_room_search_data']);
			unset($_SESSION['unreg_check_in_date']);
			unset($_SESSION['unreg_check_out_date']);
			unset($_SESSION['unreg_no_of_rooms']);
			unset($_SESSION['unreg_no_of_guest']);
			$db = new RoomDetails();
					$data['room_details'] = $db->getRoomView(); 

					$db = new Image();
					$imageRoom =$db->viewRoom();
					$data['img_details'] = $imageRoom;

					$db = new RoomEdit();
            $data['discount_details'] = $db->getAllDiscount();
			view::load('home', $data);
			exit();
		
	}

	public function verifyUser($token)
	{
		

			$db = new Signin();
			$user = $db->verify($token);
			// var_dump($user);

			if (!empty($user)) {
				$_SESSION['id']= $user['id'];
				$_SESSION['username']= $user['name'];
				$_SESSION['username']= $user['name'];
				
				$_SESSION['verified']= 1;

				$_SESSION['message']= "You are now verified user";
				$_SESSION['alert-class']= "alert-succes";
				

			}else{
				echo "not found";
			}

			unset($db);
	}

	public function frogotUser()
	{
		if (isset($_POST['frogot-password'])) {
			
			$errors =array();
			$email = $_POST['email'];
		
			if(empty($email)){
				$errors['email']="Email field Required";
			}
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email']= "Invalid Email Address";
			}

			$db = new Signin();
		   
			$result = $db->findEmail($_POST['email']);

				if($result == 0) {
					$errors['email'] = 'that email is not registered!';
				}
			unset($db);
		
			if(count($errors)== 0){
				
				$db = new Signin();
				$user = $db->frogot($email);

				$token= $user['token'];
				$userName = $user['name'];

				$sendMail = new EmailController;
				
				$sendMail->sendPasswordResultLink($email, $token, $userName);
				$data['email']= $email;
				unset($_POST);
				view::load('login/password_message', $data);
				unset($sendMail);
				exit();
		
			}else{
				$data['errors'] = $errors;
				$data['email']= $_POST['email'];
				unset($_POST);
            	View::load('login/frogot', $data);
			}

				
			
		
		}
	}

	public function resetPassword($token)
	{
		
		$db = new Signin();
		$user = $db->verify($token);
		$data['errors']= [];
		$data['token'] =$token;
		View::load('login/reset_password',$data);
	}

	public function resetUserPassword($token)
	{
		// echo $token;
		// exit;
		if (isset($_POST['reset-btn'])) {
			$errors =array();
			$password= $_POST['password'];
			$passwordConf= $_POST['passwordConf'];
		
			if(empty($password)){
				$errors['password']="password field required";
			}
			if(!(preg_match('/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,}$/',$password))){
				$errors['password']="A minimum 8 characters password contains a combination of uppercase and lowercase letter and number are required";
			}
			if($password !== $passwordConf){
				$errors['password']="password does not match";
			}
			$password = password_hash($password, PASSWORD_DEFAULT);
			// $email= $_SESSION['email'];
		
			if(count($errors)== 0){
				$db = new Signin();
				$result =$db->resetPw($password , $token);
				if ($result) {
					$data['errors'] =[];
					unset($_POST);
					View::load('login/login',$data);
					exit();
				}
			}else{
				$data['errors'] = $errors;
				$data['password']= $_POST['password'];
				$data['passwordConf']= $_POST['passwordConf'];
				unset($_POST);
				View::load('login/reset_password',$data);
			}
		}
		
	}


}
?>