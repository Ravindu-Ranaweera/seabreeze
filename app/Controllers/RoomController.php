<?php 
// session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class RoomController {

    // private $details;

    public function selectOption($month_val=0, $year_val=0) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();  
        }
        else {
            date_default_timezone_set("Asia/Colombo");
            $dateComponents = getdate();
    
            if($month_val != 0 && $year_val != 0) {
                $month = $month_val;
                $year = $year_val;
            }
            else {
                // $month = $dateComponents['month'];
                $month = date('m');
                // $year = $dateComponents['year'];
                $year = date('Y');
            }

            $calendar = $this->bookingCalendarDetails($month, $year);
            $data['calendar'] = $calendar;

            view::load('dashboard/room/selectOption',$data);

        }
    }

    //Done
    public function index($customer_id = 0) {
        date_default_timezone_set("Asia/Colombo");
        $current_date = date('Y-m-d');
        
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            $db = new RoomType();
            $typename = $db->getRoomTypes();
            $data['typename'] = $typename;
            $data['customer'] = array("id"=>$customer_id);          
            view::load('dashboard/room/index', $data);

        }
           
    }

    public function calendarSearch($customer_id = 0) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            $db = new RoomDetails();
            $rooms = $db->getRoomAll();
            $data['rooms'] = $rooms;
            $data['customer'] = array("id"=>$customer_id);       
            view::load('dashboard/room/bookingSearch', $data);

        }
    }


    public function view() {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
                $data = array();
                $db = new RoomDetails();
                if(isset($_POST['search'])) {
                    $search = $_POST['search'];
                                      
                        $data['rooms'] = $db->getSearchRoomAll($search);
                        view::load('dashboard/room/show', $data);
                }
                else {
                    $data['rooms'] = $db->getAllRoomAll();
                    view::load('dashboard/room/show', $data);
                }
        }
    }


    public function details($room_number) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            // Get Given Room number details
            $db = new RoomDetails();
            $room = $db->getRoom($room_number);
            
            // Get Given Room number Room type
            $room_type_id = $room['type_id']; 


            // Add discount
            date_default_timezone_set("Asia/Colombo");
            $current_date = date("Y-m-d"); 

            $db1 = new RoomDiscount();
            $db1->setRoomTypeId($room_type_id);
            $discount = $db1->getRoomDiscount();
            // var_dump($discount);
            if(!empty($discount)) {
                $start_date = $discount['start_date'];
                $end_date = $discount['end_date'];
                
                if($start_date < $current_date && $end_date > $current_date) {
                    $discount_rate = $discount['discount_rate'];
                
                }
                else {
                    $discount_rate = 0;
                    
                }
            }
            else {
                $discount_rate = 0;
            }

            


            $db->setRoomTypeId($room_type_id);
            $room_type = $db->getRoomType();
            
            $room_id = $room['room_id'];
            $reservations = $db->getReservations($room_id);

            $data['discount'] = array("discount"=>$discount_rate);
            $data['room'] = $room;
            $data['room_type'] = $room_type;
            $data['reservations'] = $reservations;

            view::load("dashboard/room/view", $data);
         
            
        }
    }

    public function details1($room_number,$check_in_date,$check_out_date, $type_name) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            // Get Given Room number details
            $db = new RoomDetails();
            $room = $db->getRoom($room_number);
            
            // Get Given Room number Room type
            $room_type_id = $room['type_id']; 


            // Add discount
            date_default_timezone_set("Asia/Colombo");
            $current_date = date("Y-m-d"); 

            $db1 = new RoomDiscount();
            $db1->setRoomTypeId($room_type_id);
            $discount = $db1->getRoomDiscount();
            // var_dump($discount);
            if(!empty($discount)) {
                $start_date = $discount['start_date'];
                $end_date = $discount['end_date'];
                
                if($start_date < $current_date && $end_date > $current_date) {
                    $discount_rate = $discount['discount_rate'];
                
                }
                else {
                    $discount_rate = 0;
                    
                }
            }
            else {
                $discount_rate = 0;
            }

            


            $db->setRoomTypeId($room_type_id);
            $room_type = $db->getRoomType();
            
            $room_id = $room['room_id'];
            $reservations = $db->getReservations($room_id);
            $value = 1;
            $data['details'] = array("check_in_date"=>$check_in_date, "check_out_date"=>$check_in_date, "type_name"=>$type_name);
            $data['discount'] = array("discount"=>$discount_rate, "value"=>$value);
            $data['room'] = $room;
            $data['room_type'] = $room_type;
            $data['reservations'] = $reservations;

            view::load("dashboard/room/view", $data);
         
            
        }
    }

    //Done
    // Room Search according to given tables and about parameters
    public function preview($check_in_date, $check_out_date, $type_name) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            $db = new RoomDetails();
            
            $type_id = $db->getTypeID($type_name);
            $room_type_id = $type_id['room_type_id'];
            
            $db->setRoomTypeId($room_type_id);
            $rooms = $db->getRoomAllID();
            $update = $db->getRoomsUpdate();
                    
            if($update == 1) {
                foreach($rooms as $room) {
                    
                    $result = $db->roomAvalability($room['room_id'],$check_in_date,$check_out_date);
                    
                    if($result == 1) {
                        
                        $result = $db->roomTodayBookedUpdate($room['room_id']);
                        
                    }
    
                }
            }
                
                    $db->setRoomTypeId($room_type_id);
                    $rooms = $db->getAvailableRooms($check_in_date, $check_out_date);
                    $typename = $db->getRoomTypes();
                    $data['typename'] = $typename; 
                    $data['rooms'] = $rooms;
                    $data['details'] = array("check_in_date"=>$check_in_date, "check_out_date"=>$check_out_date, "type_name"=>$type_name);
                       
                    view::load("dashboard/room/result", $data);
        }

        
    }

    //Done
    // Room Search by room
    public function check($customer_id = 0) {

        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else { 
            if(isset($_POST['submit'])) {

                $type_name = $_POST['type_name']; 
                $errors[] = array();
                $check_in_date = $_POST['check_in_date'];
                $check_out_date = $_POST['check_out_date'];
                
                //check in date is valid
                if(!$this->is_date($_POST['check_in_date'])) {
                    $errors['check_in_date'] = 'Date is Invalid';
                }

                //check out date is valid
                if(!$this->is_date($_POST['check_out_date'])) {
                    $errors['check_out_date'] = 'Date is Invalid';
                }

                if($check_in_date > $check_out_date) {
                    $errors['chek_out_date'] = "Date is Invalid";
                }


                if($type_name == NULL) {
                    $errors['chek_in_date'] = "Room Type is Invalid";
                    $errors['chek_out_date'] = "Room Type is Invalid";
                }
                // echo $type_name;
                // var_dump($errors);
                $errors = array_filter( $errors ); 
                                
                if(count( $errors ) == 0) { 
                    $db = new RoomDetails();
                    $type_id = $db->getTypeID($type_name);
                    $room_type_id = $type_id['room_type_id'];
                    $db->setRoomTypeId($room_type_id);
                    
                    // $rooms = $db->getRoomAllID($room_type_id);
                    $rooms = $db->getRoomAllID($room_type_id);
                    // var_dump($rooms);
                    // echo "<br>";
                    // die();
                    $update = $db->getRoomsUpdate();
                    // var_dump($rooms);
                    if($update == 1) {
                        foreach($rooms as $room) {
                            // var_dump($result);
                            // echo $room['room_id'];
                            // echo "<br>";
                            $result = $db->roomAvalability($room['room_id'],$check_in_date,$check_out_date);
                            // var_dump($result);
                            // echo $result;
                            // echo "<br>";
                            if($result == 1) {
                                
                                $result = $db->roomTodayBookedUpdate($room['room_id']);
                              
                            }
            
                        }
                    }
                
                    $db->setRoomTypeId($room_type_id);
                    // $rooms = $db->getAvailableRooms($room_type_id, $check_in_date, $check_out_date);
                    $rooms = $db->getAvailableRooms($check_in_date, $check_out_date);
                    // echo "sucess1";
                    // var_dump($rooms);
                    // exit();
                    $typename = $db->getRoomTypes();
                    $data['typename'] = $typename;
    
                    if(empty($rooms)) {
                        // echo "1";
                        $data['customer'] = array("id"=>$customer_id);
                        $data['details'] = array('type_name' =>$type_name, 'check_in_date'=>$check_in_date, 'check_out_date'=>$check_out_date );
                        view::load("dashboard/room/index", ["errors"=>"Data Update Unsuccessfully", 'details'=>$data['details'], 'typename'=>$data['typename']]);
                    }
                    else {
                        // $this->details = $rooms;
                        // $filterRooms = array_filter( $rooms);
                        $data['rooms'] = $rooms;
                        $data['details'] = array("check_in_date"=>$check_in_date, "check_out_date"=>$check_out_date, "type_name"=>$type_name);
                        // var_dump($this->details);
                        $bookingCalendar = 0;
                        $data['bookingCalendar'] = $bookingCalendar;
                        $data['customer'] = array("id"=>$customer_id);
                        view::load("dashboard/room/result", $data);
                        //  echo "2";
                    }
                }
                else {
                    $db = new RoomDetails();
                    $typename = $db->getRoomTypes();
                    $data['typename'] = $typename;
                    $data['customer'] = array("id"=>$customer_id);
                    $data['details'] = array('type_name' =>$type_name, 'check_in_date'=>$check_in_date, 'check_out_date'=>$check_out_date );
                    view::load("dashboard/room/index", ["errors"=>"Data Update Unsuccessfully", 'details'=>$data['details'], 'typename'=>$data['typename']]);
                    // echo "3";
                }
                
                
                
    
                
    
            }
        }


        

    }

    public function checkCalendar($customer_id = 0, $month_val=0, $year_val=0) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            if(isset($_POST['submit'])) {
                $room_id = $_POST['room_id'];
                $errors[] = array();

                if($room_id == NULL) {
                    $errors['chek_in_date'] = "Room Type is Invalid";
                    $errors['chek_out_date'] = "Room Type is Invalid";
                }

                $errors = array_filter( $errors ); 

                if(count( $errors ) == 0) {
                    date_default_timezone_set("Asia/Colombo");
                    $dateComponents = getdate();
            
                    if($month_val != 0 && $year_val != 0) {
                        $month = $month_val;
                        $year = $year_val;
                    }
                    else {
                        // $month = $dateComponents['month'];
                        $month = date('m');
                        // $year = $dateComponents['year'];
                        $year = date('Y');
                    }
                    // echo $room_id;
                    // die();
                    $room = new RoomDetails();
                    $details = $room->getRoomDetails($room_id);
                    // echo $customer_id;
                    // die();
                    $calendar = $this->bookingCalendarDetails($month, $year, $room_id, $customer_id);
                    $data['room'] = $details;
                    $data['calendar'] = $calendar;
                    $data['customer'] = array("id"=>$customer_id);
                    view::load("dashboard/room/roomCalendar", $data);

                }
            }
        }
    }

    public function checkCalendarRetreive($customer_id = 0, $room_id, $month_val=0, $year_val=0) {
        if(!isset($_SESSION['user_id'])) {
            $dashboard = new DashboardController();
            $dashboard->index();   
        }
        else {
            date_default_timezone_set("Asia/Colombo");
            $dateComponents = getdate();
    
            if($month_val != 0 && $year_val != 0) {
                $month = $month_val;
                $year = $year_val;
            }
            else {
                // $month = $dateComponents['month'];
                $month = date('m');
                // $year = $dateComponents['year'];
                $year = date('Y');
            }
            $room = new RoomDetails();
            $details = $room->getRoomDetails($room_id);
            $data['room'] = $details;
            $calendar = $this->bookingCalendarDetails($month, $year, $room_id, $customer_id);
            $data['calendar'] = $calendar;
            $data['customer'] = array("id"=>$customer_id);
            view::load("dashboard/room/roomCalendar", $data);

        }
    }

    // $room_number, $room_type_id
    public function checkRoomCustomerRoom($room_number, $room_type_id) {
        // echo "Tharindu";
        // echo $room_number;
        if(isset($_POST['submit'])) {
            $errors[] = array();
            // echo "Tharindu1";
            $check_in_date = $_POST['check_in_date'];
            $check_out_date = $_POST['check_out_date'];
            $no_of_rooms = $_POST['no_of_rooms'];
            $no_of_guests = $_POST['no_of_guests'];
            // echo $check_in_date;

            if(!$this->is_date($_POST['check_in_date'])) {
                $errors['check_in_date'] = 'Date is Invalid';
            }

            //check out date is valid
            if(!$this->is_date($_POST['check_out_date'])) {
                $errors['check_out_date'] = 'Date is Invalid';
            }

            if($check_in_date > $check_out_date) {
                $errors['chek_out_date'] = "Date is Invalid";
            }

            if($no_of_rooms == NULL) {
                $errors['no_of_rooms'] = "No of Rooms is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }

            if($no_of_guests == NULL) {
                $errors['no_of_guests'] = "No of Guests is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }
            // echo $check_in_date;
            // echo $check_out_date;
            $errors = array_filter( $errors ); 
            if(count( $errors ) == 0) {
                $inputdata = array("check_in_date"=>$check_in_date, "check_out_date"=>$check_out_date, "no_of_rooms"=>$no_of_rooms, "no_of_guests"=>$no_of_guests);
                // echo "Tharindu";
                // var_dump($input_data);
                // exit;
                $data['$input_data'] = $inputdata;
                $db = new RoomDetails();
                $db->setRoomTypeId($room_type_id);

                $rooms = $db->getRoomAllID($room_type_id);
                $update = $db->getRoomsUpdate();
                if($update == 1) {
                    foreach($rooms as $room) {
                        $result = $db->roomAvalability($room['room_id'],$check_in_date,$check_out_date);
                        if($result == 1) {
                            $result = $db->roomTodayBookedUpdate($room['room_id']); 
                        }
                    }
                }
            
                $db->setRoomTypeId($room_type_id);
                $rooms = $db->getAvailableRooms($check_in_date, $check_out_date);
                $num_of_rooms[] = array();
                // $room_number = "000";
                $availability = 0;
                foreach($rooms as $room) {
                    
                    if($room_number == $room['room_number']) {
                        // echo $room['room_number'];
                        // $room_number = $room['room_number'];
                        // array_push($num_of_rooms,$room_number);

                        $availability = 1;
                        break;
                    }
                    
                }
                $roomAvailable = array("availability" => $availability);
                // var_dump()
                $data['roomAvailable']  = $roomAvailable;
                $db = new RoomDetails();
                $data['room_details'] = $db->getOneRoomView($room_number); 
            $room=$data['room_details'];

            $db = new Feedback(); //connection established
            $data['review_details'] = $db->getReservationId($room[0]['room_id']);

                $db = new Image();
                $imageRoom =$db->view($room_number);

                $db = new Customer();
               $data['customer_details'] = $db->getAllCustomer();
               $db = new RoomEdit();
                $data['discount_details'] = $db->getAllDiscount();
                // var_dump($imageRoom);
                $data['input_data'] = $inputdata;
                $data['img_details'] = $imageRoom;
                View::load('view-room', $data);
                
                
            }
            else {
                // echo "HEllo";
                // show one room view
                $data['errors'] = $errors;
                $db = new RoomDetails();
                $data['room_details'] = $db->getOneRoomView($room_number); 
            $room=$data['room_details'];

            $db = new Feedback(); //connection established
            $data['review_details'] = $db->getReservationId($room[0]['room_id']);
            $db = new Customer();
            $data['customer_details'] = $db->getAllCustomer();
            $db = new RoomEdit();
                $data['discount_details'] = $db->getAllDiscount();

                $db = new Image();
                $imageRoom =$db->view($room_number);
                // var_dump($imageRoom);
                $data['img_details'] = $imageRoom;
                View::load('view-room', $data);
            }
        }
    }

    public function checkRoomCustomer() {
        // if(isset($_POST['submit'])) {

        //     $type_name = $_POST['type_name']; 
        //     $errors[] = array();
        //     $check_in_date = $_POST['check_in_date'];
        //     $check_out_date = $_POST['check_out_date'];
        // echo "success1";
        if(isset($_POST['submit'])) {
            // echo "success2";
            $errors[] = array();
            $check_in_date = $_POST['check_in_date'];
            $check_out_date = $_POST['check_out_date'];
            $no_of_rooms = $_POST['no_of_rooms'];
            $no_of_guests = $_POST['no_of_guests'];

            // echo $check_in_date;
            //check in date is valid
            if(!$this->is_date($_POST['check_in_date'])) {
                $errors['check_in_date'] = 'Date is Invalid';
            }

            //check out date is valid
            if(!$this->is_date($_POST['check_out_date'])) {
                $errors['check_out_date'] = 'Date is Invalid';
            }

            if($check_in_date > $check_out_date) {
                $errors['chek_out_date'] = "Date is Invalid";
            }

            if($no_of_rooms == NULL) {
                $errors['no_of_rooms'] = "No of Rooms is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }

            if($no_of_guests == NULL) {
                $errors['no_of_guests'] = "No of Guests is Invalid";
                // $errors['no_of_rooms'] = "Room Type is Invalid";
            }
            $errors = array_filter( $errors ); 
            // var_dump($errors);
            // check_in_date, check_out_date, no_of_guest, no_of_rooms
            // echo "success3";
            // echo "<br>";
            // var_dump($errors);
            
            if(count( $errors ) == 0) {
                $this->room_search_process($check_in_date, $check_out_date, $no_of_rooms, $no_of_guests);
            }
            else {
                // echo "HEllo";
                $data['errors'] = $errors;
                $db = new RoomDetails();
                $data['room_details'] = $db->getRoomView(); 
    
                $db = new Image();
                $imageRoom =$db->viewRoom();
                // var_dump($imageRoom);
                $data['img_details'] = $imageRoom;

                $db = new RoomEdit();
                $data['discount_details'] = $db->getAllDiscount();
                // var_dump($data['discount_details']); exit;
                View::load('room', $data);
            }



        }
        
    }

    public function checkRoomCustomerFromReservation($check_in_date, $check_out_date, $no_of_rooms, $no_of_guests,$customer_id) {
            $this->room_search_process($check_in_date, $check_out_date, $no_of_rooms, $no_of_guests,$customer_id);
    }

    private function availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit) {

        $rooms[] = array();
        $details[] = array();
        $rooms = $this->availableRooms($room_type_id, $check_in_date, $check_out_date);
        // var_dump($rooms);
        // echo "</br>";
        // die();
        // $rooms = array_filter( $rooms );
        if(count($rooms) >= $limit) {
            $datails['data'] = $rooms;
            $datails['msg'] = "Rooms Available";
            // echo "Rooms Available";
            
        }
        else {
            $datails['msg'] = "No Rooms Available";
            // echo "No Rooms Available";
        }
        return $datails;
    }

    private function availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date) {
        $details[] = array();
        $rooms[] = array();
        $rooms1[] = array();
        $rooms2[] = array();
        $rooms1 = $this->availableRooms($room_type_id1, $check_in_date, $check_out_date);
        $rooms2 = $this->availableRooms($room_type_id2, $check_in_date, $check_out_date);
        if(count($rooms1) >= 1 && count($rooms2) >= 1) {
            // var_dump($rooms1);
            // var_dump($rooms2);
            $rooms=array_merge($rooms1, $rooms2);
            $datails['data'] = $rooms;
            $datails['msg'] = "Rooms Available";
            // echo "Rooms Available";
        }
        else {
            $datails['msg'] = "Rooms Not Available";
            // echo "No Rooms Available";
        }
        return $datails;
    }

    private function availableRooms($room_type_id, $check_in_date, $check_out_date) {
        // echo $room_type_id;
        // echo "</br>";
        // echo $check_in_date;
        // echo "</br>";
        // echo $check_out_date;
        // echo "</br>";
        $db = new RoomDetails();
        // echo "Level 1";
        // echo "</br>";
        // $type_id = $db->getTypeID($type_name);
        // $room_type_id = $type_id['room_type_id'];
        $db->setRoomTypeId($room_type_id);
        // echo "Level 2";
        // echo "</br>";
        
        // $rooms = $db->getRoomAllID($room_type_id);
        $rooms = $db->getRoomAllID($room_type_id);
        // echo "Level 3";
        // echo "</br>";
        // var_dump($rooms);
        // echo "<br>";
        $update = $db->getRoomsUpdate();
        // var_dump($rooms);
        if($update == 1) {
            foreach($rooms as $room) {
                // var_dump($result);
                // echo $room['room_id'];
                // echo "<br>";
                $result = $db->roomAvalability($room['room_id'],$check_in_date,$check_out_date);
                // var_dump($result);
                // echo $result;
                // echo "<br>";
                if($result == 1) {
                    
                    $result = $db->roomTodayBookedUpdate($room['room_id']);
                    
                }

            }
        }
    
        $db->setRoomTypeId($room_type_id);
        // $rooms = $db->getAvailableRooms($room_type_id, $check_in_date, $check_out_date);
        $rooms = $db->getAvailableRooms($check_in_date, $check_out_date);
        // echo "sucess1";
        // var_dump($rooms);
        // die();
        $num_of_rooms[] = array();
        $room_number = "000";
        foreach($rooms as $room) {
            
            if($room_number !== $room['room_number']) {
                // echo $room['room_number'];
                $room_number = $room['room_number'];
                array_push($num_of_rooms,$room_number);
            }
            
        }
        return $num_of_rooms;
    }

    private function room_search_process($check_in_date, $check_out_date, $no_of_rooms, $no_of_guests,$customer_id=0) {
        if($customer_id != 0) {
            $data['customer'] = array("id"=>$customer_id);
        }

        $inputdata = array("check_in_date"=>$check_in_date, "check_out_date"=>$check_out_date, "no_of_rooms"=>$no_of_rooms, "no_of_guests"=>$no_of_guests);

                // echo "success4";
                // echo "<br>";
                $result[] = array();

                if($no_of_rooms == 1 && $no_of_guests == 1) {
                    // room type_id = 1 max_guest = 1
                    $rooms[] = array();
                    $limit = 1;
                    $room_type_id = 1;
                    $rooms = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms['msg'] == "Rooms Available") {
                        $result = $rooms['data'];
                    }
                    // echo "</br>";
                    $result = array_filter( $result );
                    // var_dump($result);

                }
                if($no_of_rooms == 1 && $no_of_guests == 2) {
                    // room type_id = 2 max_guest = 2
                    $rooms1[] = array();
                    $result1[] = array();
                    $limit = 1;
                    $room_type_id = 2;
                    $rooms1 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // room type_id = 3 max_guest = 2
                    $rooms2[] = array();
                    $result2[] = array();
                    $limit = 1;
                    $room_type_id = 3;
                    $rooms2 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // room type_id = 6 max_guest = 2
                    $rooms3[] = array();
                    $result3[] = array();
                    $limit = 1;
                    $room_type_id = 6;
                    $rooms3 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // all rooms array should concatinates
                    // $rooms[] = array();
                    $result=array_merge($result1, $result2, $result3);
                }
                if($no_of_rooms == 1 && $no_of_guests == 3) {
                    // room type_id = 4 max_guest = 3
                    $rooms[] = array();
                    $limit = 1;
                    $room_type_id = 4;
                    $rooms = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms['msg'] == "Rooms Available") {
                        $result = $rooms['data'];
                    }
                    // echo "</br>";
                    $result = array_filter( $result );
                }

                if($no_of_rooms == 1 && $no_of_guests == 4) {
                    // room type_id = 5 max_guest = 4
                    $rooms1[] = array();
                    $result1[] = array();
                    $limit = 1;
                    $room_type_id = 5;
                    $rooms1 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // room type_id = 7 max_guest = 4
                    $rooms2[] = array();
                    $result2[] = array();
                    $limit = 1;
                    $room_type_id = 7;
                    $rooms2 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // all rooms array should concatinates
                    $rooms[] = array();
                    $result=array_merge($result1, $result2);
                }

                if($no_of_rooms == 2 && $no_of_guests == 2) {
                    // room type_id = 1 max_guest = 1 no_of_rooms = 2
                    $rooms[] = array();
                    $limit = 1;
                    $room_type_id = 1;
                    $rooms = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms['msg'] == "Rooms Available") {
                        $result = $rooms['data'];
                    }
                    // echo "</br>";
                    $result = array_filter( $result );
                }

                if($no_of_rooms == 2 && $no_of_guests == 3) {
                    // room type_id = 2 max_guest = 2 no_of_rooms = 2
                    // one single room and one double room
                    // room_type_id = 1 && room_type_id = 2
                    // $rooms[] = array();
                    $rooms1[] = array();
                    $resul1[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 2;
                    $rooms1 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // room_type_id = 1 && room_type_id = 3
                    $rooms2[] = array();
                    $result2[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 3;
                    $rooms2 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // room_type_id = 1 && room_type_id = 6
                    $rooms3[] = array();
                    $result3[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 6;
                    $rooms3 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result3 = array_filter( $result3 );
                    $result = array_merge($result1, $result2, $result3);
                }

                if($no_of_rooms == 2 && $no_of_guests == 4) {
                    // $rooms[] = array();
                    // 1(Single room = id(1)) + 3(Triple rooms = id(4))
                    $rooms1[] = array();
                    $result1[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 4;
                    $rooms1 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );


                    // 2(Double room = id(2)) + 2(Double room = id(2))
                    $rooms2[] = array();
                    $result2[] = array();
                    $limit = 2;
                    $room_type_id = 2;
                    $rooms2 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );


                    // 2(Double room = id(2)) + 2(Double room = id(3))
                    $rooms3[] = array();
                    $result3[] = array();
                    $room_type_id1 = 2;
                    $room_type_id2 = 3;
                    $rooms3 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result3 = array_filter( $result3 );

                    // 2(Double room = id(2)) + 2(Double room = id(6))
                    $rooms4[] = array();
                    $result4[] = array();
                    $room_type_id1 = 2;
                    $room_type_id2 = 6;
                    $rooms4 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms4['msg'] == "Rooms Available") {
                        $result4 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result4 = array_filter( $result4 );

                    // 2(Double room = id(3)) + 2(Double room = id(3))
                    $rooms5[] = array();
                    $result5[] = array();
                    $limit = 2;
                    $room_type_id = 3;
                    $rooms5 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms5['msg'] == "Rooms Available") {
                        $result5 = $rooms5['data'];
                    }
                    // echo "</br>";
                    $result5 = array_filter( $result5 );

                    // 2(Double room = id(3)) + 2(Double room = id(6))
                    $rooms6[] = array();
                    $result6[] = array();
                    $room_type_id1 = 3;
                    $room_type_id2 = 6;
                    $rooms6 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms6['msg'] == "Rooms Available") {
                        $result6 = $rooms6['data'];
                    }
                    // echo "</br>";
                    $result6 = array_filter( $result6 );
                    // print_r($result6);


                    // 2(Double room = id(6)) + 2(Double room = id(6))
                    $rooms7[] = array();
                    $result7[] = array();
                    $limit = 2;
                    $room_type_id = 6;
                    $rooms7 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    // echo $rooms7['msg'];
                    if($rooms7['msg'] == "Rooms Available") {
                        $result7 = $rooms7['data'];
                    }
                    // echo "</br>";
                    // print_r($result7);
                    // die();
                    $result7 = array_filter( $result7 );
                    

                    $result=array_merge($result1, $result2, $result3, $result4, $result5, $result6, $result7);
                    // var_dump($rooms);
                

                }

                if($no_of_rooms == 2 && $no_of_guests == 5) {
                    // $rooms[] = array();
                    // 1(Single room = id(1)) + 4(Fourth room = id(5))
                    $rooms1[] = array();
                    $result1[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 5;
                    $rooms1 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // 1(Single room = id(1)) + 4(Fourth room = id(7))
                    $rooms2[] = array();
                    $result2[] = array();
                    $room_type_id1 = 1;
                    $room_type_id2 = 7;
                    $rooms2 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // 2(Double room = id(2)) + 3(Triple room = id(4))
                    $rooms3[] = array();
                    $result3[] = array();
                    $room_type_id1 = 2;
                    $room_type_id2 = 4;
                    $rooms3 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result3 = array_filter( $result3 );

                    // 2(Double room = id(3)) + 3(Triple room = id(4))
                    $rooms4[] = array();
                    $result4[] = array();
                    $room_type_id1 = 3;
                    $room_type_id2 = 4;
                    $rooms4 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms4['msg'] == "Rooms Available") {
                        $result4 = $rooms4['data'];
                    }
                    // echo "</br>";
                    $result4 = array_filter( $result4 );

                    // 2(Double room = id(6)) + 3(Triple room = id(4))
                    $rooms5[] = array();
                    $result5[] = array();
                    $room_type_id1 = 6;
                    $room_type_id2 = 4;
                    $rooms5 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms5['msg'] == "Rooms Available") {
                        $result5 = $rooms5['data'];
                    }
                    // echo "</br>";
                    $result5 = array_filter( $result5 );

                    $result=array_merge($result1, $result2, $result3, $result4, $result5);
                    // var_dump($rooms);


                }
                if($no_of_rooms == 2 && $no_of_guests == 6) {
                    // $rooms[] = array();
                    // 3(Triple room = id(4)) + 3(Triple room = id(4))
                    $rooms1[] = array();
                    $result1[] = array();
                    $limit = 2;
                    $room_type_id = 4;
                    $rooms1 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );
                    
                    // 2(Double room = id(2)) + 4(Fourth room = id(5))
                    $rooms2[] = array();
                    $result2[] = array();
                    $room_type_id1 = 2;
                    $room_type_id2 = 5;
                    $rooms2 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // 2(Double room = id(2)) + 4(Fourth room = id(7))
                    $rooms3[] = array();
                    $result3[] = array();
                    $room_type_id1 = 2;
                    $room_type_id2 = 7;
                    $rooms3 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result3 = array_filter( $result3 );

                    // 2(Double room = id(3)) + 4(Fourth room = id(5))
                    $rooms4[] = array();
                    $result4[] = array();
                    $room_type_id1 = 3;
                    $room_type_id2 = 5;
                    $rooms4 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms4['msg'] == "Rooms Available") {
                        $result4 = $rooms4['data'];
                    }
                    // echo "</br>";
                    $result4 = array_filter( $result4 );

                    // 2(Double room = id(3)) + 4(Fourth room = id(7))
                    $rooms5[] = array();
                    $result5[] = array();
                    $room_type_id1 = 3;
                    $room_type_id2 = 7;
                    $rooms5 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms5['msg'] == "Rooms Available") {
                        $result5 = $rooms5['data'];
                    }
                    // echo "</br>";
                    $result5 = array_filter( $result5 );

                    // 2(Double room = id(6)) + 4(Fourth room = id(5))
                    $rooms6[] = array();
                    $result6[] = array();
                    $room_type_id1 = 6;
                    $room_type_id2 = 5;
                    $rooms6 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms6['msg'] == "Rooms Available") {
                        $result6 = $rooms6['data'];
                    }
                    // echo "</br>";
                    $result6 = array_filter( $result6 );

                    // 2(Double room = id(6)) + 4(Fourth room = id(7))
                    $rooms7[] = array();
                    $result7[] = array();
                    $room_type_id1 = 6;
                    $room_type_id2 = 7;
                    $rooms7 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms7['msg'] == "Rooms Available") {
                        $result7 = $rooms7['data'];
                    }
                    // echo "</br>";
                    $result7 = array_filter( $result7 );

                    $result=array_merge($result1, $result2, $result3, $result4, $result5, $result6, $result7);
                    // var_dump($rooms);
                }
                if($no_of_rooms == 2 && $no_of_guests == 7) {
                    // $rooms[] = array();
                    // 3(Triple room = id(4)) + 4(Fourth room = id(5))
                    $rooms1[] = array();
                    $result1[] = array();
                    $room_type_id1 = 4;
                    $room_type_id2 = 5;
                    $rooms1 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // 3(Triple room = id(4)) + 4(Fourth room = id(6))
                    $rooms2[] = array();
                    $result2[] = array();
                    $room_type_id1 = 4;
                    $room_type_id2 = 6;
                    $rooms2 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    $result=array_merge($result1, $result2);
                    // var_dump($rooms);
                }
                if($no_of_rooms == 2 && $no_of_guests == 8) {
                    // $rooms[] = array();
                    // 4(Foruth room = id(5)) + 4(Fourth room = id(5))
                    $rooms1[] = array();
                    $result1[] = array();
                    $limit = 2;
                    $room_type_id = 5;
                    $rooms1 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms1['msg'] == "Rooms Available") {
                        $result1 = $rooms1['data'];
                    }
                    // echo "</br>";
                    $result1 = array_filter( $result1 );

                    // 4(Foruth room = id(7)) + 4(Fourth room = id(7))
                    $rooms2[] = array();
                    $result2[] = array();
                    $limit = 2;
                    $room_type_id = 7;
                    $rooms2 = $this->availableRoomFind1($room_type_id, $check_in_date, $check_out_date, $limit);
                    if($rooms2['msg'] == "Rooms Available") {
                        $result2 = $rooms2['data'];
                    }
                    // echo "</br>";
                    $result2 = array_filter( $result2 );

                    // 4(Foruth room = id(5)) + 4(Fourth room = id(7))
                    $rooms3[] = array();
                    $result3[] = array();
                    $room_type_id1 = 5;
                    $room_type_id2 = 7;
                    $rooms3 = $this->availableRoomFind2($room_type_id1, $room_type_id2, $check_in_date, $check_out_date);
                    if($rooms3['msg'] == "Rooms Available") {
                        $result3 = $rooms3['data'];
                    }
                    // echo "</br>";
                    $result3 = array_filter( $result3 );
                    $result=array_merge($result1, $result2, $result3);

                }
                // else {
                //     // echo "Tharindu";
                //     $data['msg1']= "Invalid data enter for search";
                // }
            
                // var_dump($result);
                // redirect room page
                $dbroom = new RoomDetails();
                $dbimg = new Image();
                $roomresult[] = array();
                $imgresult[] = array();
                // $room_number1 = "";
                // $roomresult1 = $dbroom->getRoomView();
                // die();
                $uniqueResult[] = array();
                $filterResult[] = array();
                
                
                $filterResult = array_filter( $result);
                $uniqueResult = array_unique($filterResult);
                
                // if($customer_id != 0) {
                //     var_dump($uniqueResult);
                //     die();
                // }
                // var_dump($filterResult);
                // die();
                // echo $result;
                // var_dump($result);
                // die();
                
                if(empty($uniqueResult)) {
                    // echo "tharindu";
                    // die();
                    $data['msg3']= "No Result Found";
                    $db = new RoomDetails();
                    $data['room_details'] = $db->getRoomView(); 
        
                    $db = new Image();
                    $imageRoom =$db->viewRoom();
                    // var_dump($imageRoom);
                    $data['img_details'] = $imageRoom;

                    $db = new RoomEdit();
            $data['discount_details'] = $db->getAllDiscount();
            
                    View::load('room', $data);
                }
                else {
                    foreach($uniqueResult as $room_number) {
                    
                        $room = $dbroom->getOneRoomView($room_number);
                        if(empty($roomresult)) {
                            $roomresult = $room;
                        }
                        else {
                            $roomresult = array_merge($roomresult, $room);
                        }
                        $img = $dbimg->view($room_number);
                        if(empty($imgresult)) {
                            $imgresult = $img;
                        }
                        else {
                            $imgresult = array_merge($imgresult, $img);
                        }
                        // array_push($imgresult ,$img);
                    }
        
                    $roomresult = array_filter( $roomresult );
                    $imgresult = array_filter( $imgresult );
                    $inputdata = array_filter( $inputdata );
                    // var_dump($roomresult);
                    $data['room_details']= $roomresult;
        
                    $data['img_details'] = $imgresult;
                    $data['input_data'] = $inputdata;
                    // var_dump($inputdata);
                    // die();
                    $db = new RoomEdit();
            $data['discount_details'] = $db->getAllDiscount();
                    View::load('room', $data);
                }
    }


    private function is_date($date) {
        return(preg_match("/\d{4}\-\d{2}-\d{2}/", $date));
    }

    
    private function bookingCalendarDetails($month, $year, $room_id = 0, $customer_id = 0) {

        $reservation = new Reservation();
        $datesArray[] = array();
        if($room_id != 0) {
            $result = $reservation->getBookingDays($room_id);
            // echo "hello";
            // echo "<br>";
            // echo $room_id;
            // die();
            foreach($result as $d)
            {   
                // echo $result;
                    $start= $d['check_in_date'];
                    $end= $d['check_out_date'];
                    $format = 'Y-m-d';
                    // $array = array(); 
      
                    // Variable that store the date interval 
                    // of period 1 day 
                    $interval = new DateInterval('P1D'); 
                  
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval); 
                  
                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd); 
                  
                    // Use loop to store date into array 
                    foreach($period as $date) {                  
                        $datesArray[] = $date->format($format);  
                    }

                    // print_r($datesArray);
                    // die();

            }
            // die();

        }
        else {
            $result = $reservation->getDayCountReservation();
            
            foreach($result as $d)
            {
                    $datesArray[]= $d['check_in_date'];   
            }
        }
        

        // First of all create an array containing names of all days in a week
        $daysOfWeek = array('Sunday', 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        
        $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

        // Getting the number of days this month containes
        $numberofDays = date('t', $firstDayOfMonth);

        // Getting some information about the first day of this month
        $dateComponents = getdate($firstDayOfMonth);

        //  Getting the name of this month
        $monthName = $dateComponents['month'];
        

        // Getting the index value 0-6 of the first day of this month
        $dayOfWeek = $dateComponents['wday'];

        // Getting the current date
        $dateToday = date('Y-m-d');

        

        $prev_month = date('m', mktime(0,0,0,$month-1, 1, $year));
        $prev_year = date('Y', mktime(0,0,0,$month-1, 1, $year));
        $next_month = date('m', mktime(0,0,0,$month+1, 1, $year));
        $next_year = date('Y', mktime(0,0,0,$month+1, 1 , $year));
        // $month_name = get_month_name($month_val);
        
        $calendar = "<center><h2>$monthName $year</h2>";

        if($room_id != 0) {
            $calendar .= "<div class= 'buttonset'><a class='btn_seek' href='http://localhost/MVC/public/room/checkCalendarRetreive/".$customer_id."/".$room_id."/".$prev_month."/".$prev_year."'>Prev Month</a>";
            $calendar .= "<a class='btn_seek' href='http://localhost/MVC/public/room/checkCalendarRetreive/".$customer_id."/".$room_id."/".date('m')."/".date('Y')."'>Current Month</a>";
            $calendar .= "<a class='btn_seek' href='http://localhost/MVC/public/room/checkCalendarRetreive/".$customer_id."/".$room_id."/".$next_month."/".$next_year."'>Next Month</a></div></center>";    
        }
        else {
            $calendar .= "<div class= 'buttonset'><a class='btn_seek' href='http://localhost/MVC/public/room/selectOption/".$prev_month."/".$prev_year."'>Prev Month</a>";
            $calendar .= "<a class='btn_seek' href='http://localhost/MVC/public/room/selectOption/".date('m')."/".date('Y')."'>Current Month</a>";
            $calendar .= "<a class='btn_seek' href='http://localhost/MVC/public/room/selectOption/".$next_month."/".$next_year."'>Next Month</a></div></center>";    
        }

        
        
       
        $calendar .= "<br><table class='tableContent'>";
        $calendar .= "<tr>";

        foreach($daysOfWeek as $day) {
            $calendar .= "<th class='header'>$day</th>";
        }

        $calendar .= "</tr><tr>";
    

        if($dayOfWeek > 0) {
            for($k = 0; $k < $dayOfWeek; $k++) {
                $calendar .= "<td class='empty'></td>";
            }
        }

        $currentDay = 1;

        $month = str_pad($month, 2, "0", STR_PAD_LEFT);
        while($currentDay <= $numberofDays) {
            if($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            // echo $date;
            $dayName = strtolower(date('l', strtotime($date)));
            // echo $dayName;
            $today = $date==date('Y-m-d')?'today':"";
            // print_r($dayName);
            // echo $today;
            if($room_id != 0) { 
                if($date < date('Y-m-d') ) {
                    $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_danger'>N/A</button>";
                }
                else {
                    if(in_array($date, $datesArray)) {
                        $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_danger'>Booked</button>";
                    }
                    else {
                        if($_SESSION['user_level'] == "Owner") {
                            $calendar .= "<td class='$today'><h4>$currentDay</h4><a  href='#' class='btn_seek_success'>Book</a>";
                        }
                        else {
                            $room = new RoomDetails();
                            $details = $room->getRoomDetails($room_id);
                            $type_id = $details['type_id'];
                            $roomType = new RoomType();
                            $roomType->setRoomTypeId($type_id);
                            $typeDetails = $roomType->getRoomType();
                            $room_number = $details['room_number'];
                            $max_guest = $typeDetails['max_guest'];
                            $check_in_date = $date;
                            $check_out_date = "0000-00-00";
                            $type_name = $typeDetails['type_name'];
                            $bookingCalendar = 1;
                            // $customer_id =0;
                            $calendar .= "<td class='$today'><h4>$currentDay</h4><a  href='http://localhost/MVC/public/reservation/view1/".$room_number."/".$max_guest."/".$check_in_date."/".$check_out_date."/".$type_name."/".$bookingCalendar."/".$customer_id."/"."'' class='btn_seek_success'>Book</a>";
                        }
                       
                    }
                }

            }
            else {
                if($date < date('Y-m-d') ) {
                    if(in_array($date, $datesArray)) {
                        foreach($result as $d){
                            // echo $d['check_in_date'];
                            // $datesArray[]= $d['check_in_date']; 
                            if($d['check_in_date'] == $date) {
                                $booked = $d['count'];
                                break;
                            }  
                        }
                        $total = 6; // Number of Rooms
                        $booked = (int)$booked;
                        $val = $total-$booked;
                        // echo $val;
                        // echo gettype($booked);
                        $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_view'>Bookings = ".$booked." </button>";
                    }
                    else {
                        $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_danger'>N/A</button>";
                    }
                    
                }
                
                else {
                    // echo $date;
                    // $booked = $result[$date]['count'];
                    if(in_array($date, $datesArray)) {
                        foreach($result as $d){
                            // echo $d['check_in_date'];
                            // $datesArray[]= $d['check_in_date']; 
                            if($d['check_in_date'] == $date) {
                                $booked = $d['count'];
                                break;
                            }  
                        }
    
                        $total = 6; // Number of Rooms
                        $booked = (int)$booked;
                        $val = $total-$booked;
                        $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_view'>Bookings = ".$booked." </button>";
                    }
                    else {
                        $calendar .= "<td class='$today'><h4>$currentDay</h4><button class='btn_seek_view'>Bookings = 0</button>";
                    }
                
                }
            }
            
          
            $currentDay++;
            $dayOfWeek++;
        }

        if($dayOfWeek < 7) {
            $remainingDays = 7-$dayOfWeek;
            for($i=0;$i<$remainingDays;$i++){
                $calendar .= "<td class='empty'></td>";
            }
        }

        $calendar .= "</tr></table>";

        // $data['calendar'] = $calendar;
        // view::load('dashboard/room/bookingCalendar', $data);
        return $calendar;
    }
    

    
}