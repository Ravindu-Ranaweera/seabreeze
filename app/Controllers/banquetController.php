<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'Libs/vendor/autoload.php';

class BanquetController{
    
    public function index()
    {
        View::load('banquet');
    }

    public function ViewSubPage($id)
    {
        $data['id'] = $id;
        View::load('sub/banquetView', $data);
    }

    public function selectOption() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            view::load('dashboard/hall/selectOption');
        }

    }

    // public function createIndex() {
    //     if(!isset($_SESSION['user_id'])) {
    //         $dashboard = new DashboardController();
    //         $dashboard->index();
    //     }
    //     else {
    //         view::load('dashboard/hall/createReservation');
    //     }
    // }

    public function notificationIndex() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            $dbreservation = new HallBanquet();
            
            $data = array();
            
            if(isset($_POST['search'])) { //this must modify
                $search = $_POST['search'];
                $data['rooms'] = $dbreservation->requestNotificationSearch($search);
                view::load('dashboard/hall/reservationNotification', $data);
                
            }
            else {
                $data['rooms'] = $dbreservation->requestNotification();
                view::load('dashboard/hall/reservationNotification', $data);
            }
        }
    }

    public function hallReservationIndex() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            $dbreservation = new HallBanquet();
            
            $data = array();
            
            if(isset($_POST['search'])) { //this must modify
                $search = $_POST['search'];
                $data['rooms'] = $dbreservation->allReservationDetailsSearch($search);
                view::load('dashboard/hall/reservationIndex', $data);
                
            }
            else {
                $data['rooms'] = $dbreservation->allReservationDetails();
                view::load('dashboard/hall/reservationIndex', $data);
            }
        }
    }

    public function notificationAccept($id,$hall_id, $session_date,$session_time) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            // reservation table update
            $hall_id;
            $dbreservation = new HallBanquet();
            $result = $dbreservation->reservationDateToZero($id);   
                   
            $result = $dbreservation->searchBanquet($hall_id, $session_date, $session_time);
            // echo $result;
            // echo "Success";
            // die(); 
            if($result == 1) {
                $errors['session_date'] = 'Date already reserved Sorry';
                $errors['session_type'] = 'Type already reserved Sorry';
                
                $result = $dbreservation->resetReservationDates($id, $session_date, $session_time);
                if($result == 1) {
                    $data['errors'] = $errors;
                    $data['rooms'] = $dbreservation->requestNotification();
                    view::load('dashboard/hall/reservationNotification', $data);
                }
            }    
            else {
                    
                    //have to todo
                    //have to send mail
                    // Create the Transport
                    // $userEmail, $token, $userName;
                    //email have to grab from customer table
                    $reservation = $dbreservation->reservationDetails($id);
                    $customer_id = $reservation['customer_id'];
                    $dbcustomer = new Customer();
                    $customer = $dbcustomer->getCustomer($customer_id);
                    $userEmail = $customer['email'];
                    $userName = $customer['first_name']." ".$customer['last_name'];

                    // $userEmail = 'wtgihan@gmail.com';
                    // $userName = 'Online Customer';
                    // echo $reservation['reservation_id'];
                    // echo $customer['customer_id'];
                    $customer_id = $customer['customer_id'];
                    $reservation_id = $reservation['id'];
                    
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
                    ->setUsername('bayfrontweli45@gmail.com')
                    ->setPassword('Bayfront@1998')
                    ;
            
                    // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);
                    if($reservation['payment_method'] === "ONLINEONLINE") {
                        $body = ' <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Verify Email</title>
                            </head>
                            <body>
                                <div class="wrapper" style=" border-radius: 2px;
                                height: auto;
                                background-color: black;
                                color: white;
                                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.3);
                                border: 2px solid black;
                                padding: 40px;
                                margin: 10px auto;
                                text-align: center;
                                position: relative;
                                width: 800px;">
                                    <h1>Hi <strong> '. $userName .'</strong></h1>
                                    <h3 class="top">You recently requested to reset your reservation for your SEABREEZE hotel Use the button below to get Payment it. <strong>Thank you very much for select our hotel for reservation</strong></h3> 
                                    <button style="background: #2EE59D; border: none; border-radius: 5px; padding: 10px; "><a style="color: #fff; text-decoration: none; font-size: 20px; " href="http://localhost/seabreeze/public/banquet/paymentOnline/'.$customer_id.'/'.$id.'">Payment</a></button>
                                    <p>If not Pay now decline it</p>
                                    <h4>Welcome</h4>
                                </div> 
                            </body>
                            </html>'; 
                    }
                    else {
                        $body = ' <!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Verify Email</title>
                            </head>
                            <body>
                                <div class="wrapper" style=" border-radius: 2px;
                                height: auto;
                                background-color: black;
                                color: white;
                                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.3);
                                border: 2px solid black;
                                padding: 40px;
                                margin: 10px auto;
                                text-align: center;
                                position: relative;
                                width: 800px;">
                                    <h1>Hi <strong> '. $userName .'</strong></h1>
                                    <h3 class="top">You recently requested to reset your reservation for your SEABREEZE hotel Use the button below to get Payment it. <strong>Thank you very much for select our hotel for reservation</strong></h3> 
                                    <h4>Welcome</h4>
                                    
                                    
                                </div> 
                            </body>
                            </html>'; 
                    }
                    

                        // Create a message
                    $message = (new Swift_Message('Reservation Accepted'))
                    ->setFrom(['bayfrontweli45@gmail.com'=> 'BAYFRONT'])
                    ->setTo([$userEmail])
                    ->setBody($body, 'text/html');
                    
                        // Send the message
                    $result = $mailer->send($message);
                    
                    //update the reservation database
                    $result = $dbreservation->resetReservationRequest($id, $session_date, $session_time);
                    
                    $this->notificationIndex();
                }
            }
    }

    public function notificationDecline($reservation_id) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();    
        }
        else {
            // $db = new Reservation();
            // $dbroom = new RoomDetails();
            // $room = $dbroom->getRoomID($room_number);
            // $room_id = $room['room_id'];
            
            // get that reservation
            $dbreservation = new HallBanquet();
           
            $reservation = $dbreservation->reservationDetails($reservation_id);
            $customer_id = $reservation['customer_id'];
            $dbcustomer = new Customer();
            $customer = $dbcustomer->getCustomer($customer_id);
            $userEmail = $customer['email'];
            $userName = $customer['first_name']." ".$customer['last_name'];

            // $userEmail = 'wtgihan@gmail.com';
            // $userName = 'Online Customer';

            
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
            ->setUsername('bayfrontweli45@gmail.com')
            ->setPassword('Bayfront@1998')
            ;
    
            // Create the Mailer using your created Transport
            $mailer = new Swift_Mailer($transport);
            
            $body = ' <!DOCTYPE html>
                    <html lang="en">
                    <head>
                        <meta charset="UTF-8">
                        <title>Verify Email</title>
                    </head>
                    <body>
                        <div class="wrapper" style=" border-radius: 2px;
                        height: auto;
                        background-color: black;
                        color: white;
                        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 6px 6px rgba(0, 0, 0, 0.3);
                        border: 2px solid black;
                        padding: 40px;
                        margin: 10px auto;
                        text-align: center;
                        position: relative;
                        width: 800px;">
                            <h1>Hi <strong> '. $userName .'</strong></h1>
                            <h3 class="top">You recently requested to reservation denied Already book the room<strong>Sorry For that Try again</strong></h3> 
                            <button style="background: #2EE59D; border: none; border-radius: 5px; padding: 10px; "><a style="color: #fff; text-decoration: none; font-size: 20px; " href="http://localhost/MVC/public/">Website</a></button>
                            <p>Another rooms may be can reserve</p>
                            <h4>Thanks</h4>
                            
                            
                        </div> 
                    </body>
                    </html>'; 

                // Create a message
            $message = (new Swift_Message('Reservation Accepted'))
            ->setFrom(['bayfrontweli45@gmail.com'=> 'BAYFRONT'])
            ->setTo([$userEmail])
            ->setBody($body, 'text/html');
            
                // Send the message
            $result = $mailer->send($message);
            
            //update the reservation database
            // $result = $dbreservation->resetReservationRequest($reservation_id, $check_in_date, $check_out_date);
            $result = $dbreservation->getDeclineReservation($reservation_id);
            $this->notificationIndex();
            
            
        } 
    }

    public function paymentOnline($customer_id, $id) {
        //have to Modify
        $dbcustomer = new Customer();
        $customer = $dbcustomer->getCustomer($customer_id);
        
        $dbreservation = new HallBanquet();
        $reservation = $dbreservation->reservationDetails($id);

        $hall_id = $reservation['hall_id'];
        $dbroom = new Hall();
        $hall = $dbroom->getHallDetails($hall_id);
        
        $data['customer'] = $customer;
        $data['reservation'] = $reservation;
        $data['room'] = $hall;
            // echo $customer_id;
            // echo $reservation_id;
        // print_r($data);
        // die();
        view::load('dashboard/hall/payment',$data);
    }

    public function checkHallAvailability($id) {

        if(isset($_POST['submit'])) {
            $errors[] = array();
            $session_date = $_POST['session_date'];
            $session_time = $_POST['session_time'];

            // echo $session_time;
            // echo $id;
            // die();
            
            date_default_timezone_set("Asia/Colombo");
            $current_date = date('Y-m-d');
            if($session_date < $current_date) {
                $errors['session_date'] = "Date is Invalid";
            }

            

            if($session_time == "none") {
                $errors['session_time'] = "Session time is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }

            // print_r($errors);
            // die();

            $errors = array_filter( $errors ); 

            if(count( $errors ) == 0) {
                
                $inputdata = array("session_date"=>$session_date, "session_time"=>$session_time);
               
                
              
                $db = new HallBanquet();
                $hall_id = $id;
                $result = $db->searchBanquet($hall_id, $session_date, $session_time);
                // echo "Tharindu";
                // var_dump($inputdata);
                // exit;
                // echo $result;
                // die();
                $availability = 0;
                if($result == 0) {
                    $availability = 1;
                }

                $roomAvailable = array("availability" => $availability);
                // var_dump()
                $data['roomAvailable']  = $roomAvailable;
                $data['id'] = $id;
                
                $data['input_data'] = $inputdata;
                // print_r($data['input_data']);
                // die();
                // print_r($data);
                // die();
                View::load('sub/banquetView', $data);
                   
            }
            else {
                // echo "HEllo";
                // show one room view
                $data['errors'] = $errors;
                $data['id'] = $id;
                View::load('sub/banquetView', $data);
            }
        }
    }

    public function hallBanquetBook($id) {
        if(isset($_SESSION['unreg_user_id'])) { // if check user logged in unreg not mean unregistered
            // echo 
            if(isset($_POST['submitbooknow'])) {
                
                $session_date = $_POST['session_date'];
                $session_time = $_POST['session_time'];
                //get data from user
                $user = new User();
                $new_user = $user->getUserEmail($_SESSION['unreg_user_id']);
                $user_email = $new_user['email'];
            
                $hall = new HallBanquet();
                $hall_details = $hall->getOneHalleView($id);
                // var_dump($room_details);
                $price =  $hall_details[0]['price'];
                $hall_name = $hall_details[0]['name'];
                // echo $price;
                // die();
                
                $customer = new Customer();
                // echo $user_email;
                // die();
                $customer_details = $customer->getEmailData($user_email);
                $customer_details = array_filter( $customer_details );
                if(!empty($customer_details)) {
                    $reservation = array('first_name'=>$customer_details['first_name'], 'last_name'=>$customer_details['last_name'],'age'=>$customer_details['age'],'location'=>$customer_details['location'],'contact_number'=>$customer_details['contact_number'],'email'=>$customer_details['email'],'check_in_date'=>$session_date , 'session_type'=>$session_time,'price'=>$price, 'hall_name'=>$hall_name );
                }
                else {
                    // above thing do again doesnot matter
                    // if($customer_id != 0) {
                    //     $customer = new Customer();
                    //     $customer_details = $customer->getCustomer($customer_id);
                    //     $reservation = array('first_name'=>$customer_details['first_name'], 'last_name'=>$customer_details['last_name'],'age'=>$customer_details['age'],'location'=>$customer_details['location'],'contact_number'=>$customer_details['contact_number'],'email'=>$customer_details['email'],'check_in_date'=>$session_date, 'session_type'=>$session_time, 'price'=>$price, 'hall_name'=>$hall_name );
                    // }
                    // else {
                        $reservation = array('email'=>$user_email,'check_in_date'=>$session_date, 'session_type'=>$session_time, 'price'=>$price, 'hall_name'=>$hall_name );
                    // }
                    
                // }
            }
                
                $data['id'] = $id;
                $data['reservation'] = $reservation;
                
                view::load('dashboard/reservation/onlineBanquetCreate',$data);
            }
            
        }
        else {
            // when user is not log in redirect to signup page
            $data['id'] = $id;
            
            $data['msg2'] = "Plaese login then Reserve Room";
            View::load('sub/banquetView', $data);
 
        }
    }

    public function indexOnline($session_date,$session_time,$hall_id) {
        if(isset($_SESSION['unreg_user_id'])) {
            
            $user = new User();
            $new_user = $user->getUserEmail($_SESSION['unreg_user_id']);
            $user_email = $new_user['email'];
            
            $hall = new HallBanquet();
            $hall_details = $hall->getOneHalleView($hall_id);
            // var_dump($hall_details);
            // die();
            $price =  $hall_details[0]['price'];
            $hall_name = $hall_details[0]['name'];
                
            
            $customer = new Customer();
            
            $customer_details = $customer->getEmailData($user_email);
            $customer_details = array_filter( $customer_details );
            if(!empty($customer_details)) {
                $reservation = array('first_name'=>$customer_details['first_name'], 'last_name'=>$customer_details['last_name'],'age'=>$customer_details['age'],'location'=>$customer_details['location'],'contact_number'=>$customer_details['contact_number'],'email'=>$customer_details['email'],'check_in_date'=>$session_date , 'session_type'=>$session_time,'price'=>$price, 'hall_name'=>$hall_name );
            }
            else {
                // above thing do again doesnot matter
                if($customer_id != 0) {
                    $customer = new Customer();
                    $customer_details = $customer->getCustomer($customer_id);
                    $reservation = array('first_name'=>$customer_details['first_name'], 'last_name'=>$customer_details['last_name'],'age'=>$customer_details['age'],'location'=>$customer_details['location'],'contact_number'=>$customer_details['contact_number'],'email'=>$customer_details['email'],'check_in_date'=>$session_date, 'session_type'=>$session_time, 'price'=>$price,  'hall_name'=>$hall_name );
                }
                else {
                    $reservation = array('email'=>$user_email,'check_in_date'=>$session_date, 'session_type'=>$session_time, 'price'=>$price , 'hall_name'=>$hall_name );
                }
                
                
            }
            $data['id'] = $hall_id;
            $data['reservation'] = $reservation;
            
            view::load('dashboard/reservation/onlineBanquetCreate',$data);
        }
        else {
            // when user is not log in redirect to signup page
            $data['id'] = $hall_id;
            
            $data['msg2'] = "Plaese login then Reserve Room";
            View::load('sub/banquetView', $data);
            
            
        }
    }

    public function create($discountValue = 0) {
        if(isset($_POST['submit'])) {

            // Validation
            $first_name = $_POST['first_name'];
            $first_name = ucwords($first_name);
            $last_name = $_POST['last_name'];
            $last_name = ucwords($last_name);
            $location = $_POST['location'];
            // echo $location;
            // die();
            $contact_num = $_POST['contact_number'];
            // $date_of_birth = $_POST['date_of_birth'];
            $age = $_POST['age'];
            $email = $_POST['email'];
            $email = strtolower($email);

            $session_date = $_POST['session_date'];
            $session_time = $_POST['session_time'];
            $hall_id = $_POST['hall_id'];
            $price = $_POST['price'];
            $hall_name = $_POST['hall_name'];
           

            $payment_method = $_POST['payment_method'];
            // echo $payment_method;
            $payment_method = strtoupper($payment_method);
            
            
            

            // Check input is empty
            $errors[] = array();
            $req_fields = array('first_name', 'last_name', 'location', 'contact_number', 'age', 'email', 'session_date', 'payment_method');
            $errors = array_merge($errors, $this->check_req_fields($req_fields));
            

            $max_len_fields = array('first_name' => 20, 'last_name' => 20, 'location' => 30, 'contact_number' => 10, 'age' => 3, 'email' => 30, 'session_date' => 10, 'payment_method' => 13);
            $errors = array_merge($errors, $this->check_max_len($max_len_fields));

            
            
            // Check Email is valid
            if(!$this->is_valid($_POST['first_name'])) {
                $errors['first_name'] = 'First Name is Invalid';
            }

            //check Last Name is valid
            if(!$this->is_valid($_POST['last_name'])) {
                $errors['last_name'] = 'Last Name is Invalid';
            }


            // Check Email is valid
            if(!$this->is_email($_POST['email'])) {
                $errors['email'] = 'Email address is Invalid';
            }

            

            //check Phone number is valid
            if(!$this->is_num($_POST['contact_number'])) {
                $errors['contact_number'] = 'Contact Number is Invalid';
            }

            // Check In Date validation
            if(!$this->is_date($_POST['session_date'])) {
                $errors['check_in_date'] = 'Check In Date is Invalid';
            }
            
            
            
            $errors = array_filter( $errors ); 
           
            
            if(count( $errors ) == 0) {
                // Check customer already user
                $dbcustomer = new Customer();
                $result = $dbcustomer->getEmail($email);
                
                if($result == 0) {
                    // Customer already not user

                    $data = array($first_name, $last_name, $location, $contact_num, $age, $email);
                    $result = $dbcustomer->getCreateCustomer($data);

                    if($result == 0) {
                        $errors[] = "Data Created Unsuccessful";
                    }
                     
                }    
                

                // Make Reservation
                
                // Get Customer Id
                $customer= $dbcustomer->getCustomerID($email);
                $customer_id = $customer['customer_id'];

                // Get Hall Id
               
                $hall_id;
                

                if(!empty($hall_id)) {
                    // Date Strings convert to Date data types
                    
                    $time1 = strtotime($session_date);
                    $session_date = date('Y-m-d',$time1);
                    $customer_id = (int)$customer_id;
                    
                    $hall_id = (int)$hall_id;
                    // $no_of_guest = (int)$no_of_guest;

                    if($payment_method == "CASHONLINE" || $payment_method == "ONLINEONLINE") {
                        $reception_user_id = 1; // Online Reception bot not visible as Reception
                    }
                    else {
                        $reception_user_id = $_SESSION['user_id'];
                        $reception_user_id = (int)$reception_user_id;
                    }
                
                    //Request or not should check
                    if($payment_method == "CASHONLINE" || $payment_method == "ONLINEONLINE") {
                        // Reception should accept this process 
                        $request = 1;
                    }
                    else {
                        $request = 0;
                    }
                    
                    $data = array($customer_id, $reception_user_id, $hall_id, $session_date, $session_time,  $request, $payment_method);
                    $dbreservation = new HallBanquet();
                    $result = $dbreservation->getCreateReservation($data);

                    if($result == 1) {
                            if($discountValue == 0) {
                                // only payment is online create payment details(idea)
                                if($payment_method === "ONLINEONLINE" || $payment_method === "CASHONLINE") {
                                    view::load('dashboard/reservation/reservationThanks');
                                }
                                else { // Manual Reservation process
                                    $val = 1; // represent main reservation not room search reservation
                                    $data['create'] = array("value"=>$val);
                                    $data['customer'] = array("id"=>$customer_id);
                                    view::load('dashboard/reservation/reservationOption', $data);
                                }
                                
                            }
                            else {
                                
                                // Success the Process
                                // Reservation Option Page
                                // Customer Details should pass next page
                                $data['customer'] = array("id"=>$customer_id);
                                view::load('dashboard/reservation/reservationOption', $data);
                            }
                    }
                        
                    
   
                }
                
                

            }
            else {
                // break process
                if($discountValue == 1) {
                    $data['errors'] = $errors;
                    $data['discount'] = array("value"=>$discountValue);
                    $data['reservation'] = array('first_name' => $first_name, 'last_name' => $last_name, 'location' => $location, 'contact_number' => $contact_num, 'age' => $age, 'email' => $email, 'check_in_date' => $session_date, 'session_type' => $session_time, 'payment_method' => $payment_method, 'price'=>$price,'hall_name'=>$hall_name);
                    
                    if($payment_method == "CASHONLINE" || $payment_method == "ONLINEONLIE" || $payment_method == "ONLINE") {
                        $inputreservationdata=array('no_of_rooms'=>$no_of_rooms, 'no_of_guest'=>$no_of_guest);
                        $data['id'] = $hall_id;
                        view::load('dashboard/reservation/onlineBanquetCreate', $data);
                        // echo "Succes1";
                    }
                    else {
                        view::load('dashboard/reservation/create', $data);
                        // echo "Succes2";
                    }
                }
                else {
                    $data['errors'] = $errors;
                    $data['reservation'] = array('first_name' => $first_name, 'last_name' => $last_name, 'location' => $location, 'contact_number' => $contact_num, 'age' => $age, 'email' => $email, 'check_in_date' => $session_date, 'session_type' => $session_time, 'payment_method' => $payment_method, 'price'=>$price,'hall_name'=>$hall_name);
                    // echo $payment_method;
                    if($payment_method == "CASHONLINE" || $payment_method == "ONLINEONLIE" || $payment_method == "ONLINE") {
                        $data['id'] = $hall_id;
                        view::load('dashboard/reservation/onlineBanquetCreate', $data);
                    }
                    else {
                        // echo "Succes4";
                        view::load('dashboard/reservation/create', $data);
                    }
                }
                
                
                
            }

        }
    }

    private function date_validation($check_in_date, $check_out_date) {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        $time1 = strtotime($check_in_date);
        $time2 = strtotime($check_out_date);
        $check_in_date = date('Y-m-d',$time1);
        $check_out_date = date('Y-m-d',$time2);
        $result = 0;
        $validation = 0;
        if($current_date > $check_in_date || $check_in_date >= $check_out_date) {
            $result = 1;
            
        }

        return $result;
    }

    private function date_validationEdit($check_in_date, $check_out_date, $old_check_in_date) {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        $time1 = strtotime($check_in_date);
        $time2 = strtotime($check_out_date);
        $check_in_date = date('Y-m-d',$time1);
        $check_out_date = date('Y-m-d',$time2);
        $result = 0;
        $validation = 0;


        // $current_date < $check_in_date can ahead reservation change
        if($old_check_in_date > $check_in_date || $check_in_date >= $check_out_date || $current_date > $check_out_date) {
            $result = 1;
            
        }

        return $result;
    }

    private function check_req_fields($req_fields) {
        
        $errors[] = array();

        foreach($req_fields as $field) {
            if(empty(trim($_POST[$field]))) {
                // echo "1";
                $errors[$field] = ' is required';
            }
        }

        return $errors;
    }

    private function check_max_len($max_len_fields) {
        // Check max lengths
        $errors[] = array();
    
        foreach($max_len_fields as $field => $max_len) {
            if(strlen(trim($_POST[$field])) > $max_len ) {
                // echo "2";
                $errors[$field] = ' must be less than ' . $max_len . ' characters';
            }
        }
        return $errors;
    }
    
    private function is_email($email) {
        return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i" ,$email));
    }

    private function is_valid($text) {
        return(preg_match("/^([a-zA-Z' ]+)$/", $text));
    }

    private function is_num($num) {
        return(preg_match('/^[0-9]+$/', $num));
    }

    private function is_date($date) {
        return(preg_match("/\d{4}\-\d{2}-\d{2}/", $date));
    }

}

?>