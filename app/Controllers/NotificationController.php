<?php 
session_start();
require_once 'Libs/vendor/autoload.php';

class NotificationController {

    public function option() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            view::load('dashboard/notification/selectOption');
        }
    }

    public function reservationIndex() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            $dbreservation = new Reservation();
            
            $data = array();
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                $data['rooms'] = $dbreservation->requestNotificationSearch($search);
                view::load('dashboard/notification/reservationIndex', $data);

                
            }
            else {
                $data['rooms'] = $dbreservation->requestNotification();
                view::load('dashboard/notification/reservationIndex', $data);
            }
            
        }

    }

    public function accept($reservation_id, $room_number, $check_in_date, $check_out_date) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            // reservation table update
            $dbreservation = new Reservation();
            // $reservationDates = $dbreservation->reservationDetails($reservation_id);
            // $check_in_date1 = $reservationDates['check_in_date'];
            // $check_out_date1 = $reservationDates['check_out_date'];
            $result = $dbreservation->reservationDateToZero($reservation_id);   
                   
            $result = $dbreservation->getAvalabilityhRoom($room_number, $check_in_date, $check_out_date);
            // echo $result;
            // echo "Success";
            // die(); 
            if($result == 1) {
                $errors['check_in_date'] = 'Date already reserved Sorry';
                $errors['check_out_date'] = 'Date already reserved Sorry';
                
                $result = $dbreservation->resetReservationDates($reservation_id, $check_in_date, $check_out_date);
                
                if($result == 1) {
                    $data['errors'] = $errors;
                    $data['rooms'] = $dbreservation->requestNotification();
                    // echo "Error";
                    // die();
                    view::load('dashboard/notification/reservationIndex', $data);   
                }
            }    
            else {
                    
                    //have to todo
                    //have to send mail
                    // Create the Transport
                    // $userEmail, $token, $userName;
                    //email have to grab from customer table
                    $reservation = $dbreservation->reservationDetails($reservation_id);
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
                    $reservation_id = $reservation['reservation_id'];
                    
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
                    ->setUsername('seabreezesrilanka@gmail.com')
                    ->setPassword('seabreeze123')
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
                                    <button style="background: #2EE59D; border: none; border-radius: 5px; padding: 10px; "><a style="color: #fff; text-decoration: none; font-size: 20px; " href="http://localhost/MVC/public/reservation/paymentOnline/'.$customer_id.'/'.$reservation_id.'">Payment</a></button>
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
                    ->setFrom(['seabreezesrilanka@gmail.com'=> 'SEABREEZE'])
                    ->setTo([$userEmail])
                    ->setBody($body, 'text/html');
                    
                        // Send the message
                    $result = $mailer->send($message);
                    
                    //update the reservation database
                    $result = $dbreservation->resetReservationRequest($reservation_id, $check_in_date, $check_out_date);
                    
                    $this->reservationIndex();
                }
            }
        
    }

    public function decline($reservation_id) {
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
            $dbreservation = new Reservation();
           
            $reservation = $dbreservation->reservationDetails($reservation_id);
            $customer_id = $reservation['customer_id'];
            $dbcustomer = new Customer();
            $customer = $dbcustomer->getCustomer($customer_id);
            $userEmail = $customer['email'];
            $userName = $customer['first_name']." ".$customer['last_name'];

            // $userEmail = 'wtgihan@gmail.com';
            // $userName = 'Online Customer';

            
            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 587,'tls'))
            ->setUsername('seabreezesrilanka@gmail.com')
            ->setPassword('seabreeze123')
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
            ->setFrom(['seabreezesrilanka@gmail.com'=> 'SEABREEZE'])
            ->setTo([$userEmail])
            ->setBody($body, 'text/html');
            
                // Send the message
            $result = $mailer->send($message);
            
            //update the reservation database
            // $result = $dbreservation->resetReservationRequest($reservation_id, $check_in_date, $check_out_date);
            $result = $dbreservation->getDeclineReservation($reservation_id);
            $this->reservationIndex();
            
            
        } 
    }

    public function checkInMark() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {

            $dbreservation = new Reservation();
            
            $data = array();
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                                
                    // $data['rooms'] = $db->getSearchRoomAll($search);
                    $data['rooms'] = $dbreservation->checkInSearchNotification($search);
                    view::load('dashboard/notification/checkInReservation', $data);
            }
            else {
                $data['rooms'] = $dbreservation->checkInNotification();
                view::load('dashboard/notification/checkInReservation', $data);
            }
            
        }
    }

    public function arrivedCustomer($reservation_id) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            $dbreservation = new Reservation();
            // update reservation table
            $dbreservation->checkedInUpdate($reservation_id);
            $data = array();
            $data['rooms'] = $dbreservation->checkInNotification();
            view::load('dashboard/notification/checkInReservation', $data);

            
        }
    }
    

    public function checkOutMark() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {

            $dbreservation = new Reservation();
            
            $data = array();
            if(isset($_POST['search'])) {
                $search = $_POST['search'];
                                
                    // $data['rooms'] = $db->getSearchRoomAll($search);
                    $data['rooms'] = $dbreservation->checkOutSearchNotification($search);
                    view::load('dashboard/notification/checkOutReservation', $data);
            }
            else {
                $data['rooms'] = $dbreservation->checkOutNotification();
                view::load('dashboard/notification/checkOutReservation', $data);
            }
            
        }
    }

    public function departuredCustomer($reservation_id) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();
        }
        else {
            $dbreservation = new Reservation();
            // update reservation table
            $dbreservation->checkedOutUpdate($reservation_id);
            $data = array();
            $data['rooms'] = $dbreservation->checkOutNotification();
            view::load('dashboard/notification/checkOutReservation', $data);

            
        }
    }
}