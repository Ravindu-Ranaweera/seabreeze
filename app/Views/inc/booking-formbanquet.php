<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<style>
.form_submitBook {
    width: 100%;
    margin-top: 30px;
    height: 45px;
    border: 1px solid transparent;
    font-size: 15px;
    background-color: #000;
    color: white;
    text-transform: uppercase;
    box-shadow: 0px 1px 1px 0 darkgrey;
    border-radius: 5px;
    cursor: pointer; 
}
</style>
<body>  
<!-- .'/'.$room_details[0]['room_number'].'/'.$room_details[0]['room_type_id'] -->
<!-- $room_number,$max_guest,$check_in_date,$check_out_date -->
        <?php if(isset($roomAvailable) && $roomAvailable['availability'] == 1){ ?>
                <form action="<?php url("banquet/hallBanquetBook".'/'.$id); ?>" method="post" id="form" >     
        <?php } else {?>
                <form action="<?php url("banquet/checkHallAvailability".'/'.$id); ?>" method="post" id="form" >
        <?php } ?>
                <!-- <input type="hidden" name="room_number" value="$room_details[0]['room_number']">
                <input type="hidden" name="room_type_id" value="$room_details[0]['room_type_id']"> -->
       
	<div class="bookingFormContainerY">
		<div class="blockY chech-in">
			<label >Date</label>
           	<div id='check-in' class='form-fieldY'>

                <?php 
                        date_default_timezone_set("Asia/Colombo");
                        $current_date = date('Y-m-d');
                ?>

                <input type="date" name="session_date"   placeholder="9 July, 2016"
                <?php 
                        if(isset($input_data['session_date'])) { ?>
                                <?php 
                                        $orgDate = $input_data['session_date'];;  
                                        $newDate = date("Y-m-d", strtotime($orgDate));
                                ?>
                                 
                                value= "<?php echo $newDate; ?>"
                <?php   } else {
                                echo 'min="'.$current_date .'" value="'.$current_date .'"';
                 } ?>

                >
                <!-- <div class='datepicker'><i class="fa fa-calendar" aria-hidden="true"></i></div> -->
            </div>
		</div>
                <?php ; ?>
		<div class="blockY num-of-guest">
			<div class='form__dropdownY'>
                                <label >Sessions</label>
                                <div class='form-fieldY'> 
                                <select id='adultsAmount' name="session_time"> 
                                <?php   
                                        $session_time = "None";
                                        if(isset($input_data['session_time']) && $roomAvailable['availability'] == 1) { ?>
                                               <option value="<?php echo $input_data['session_time']; ?>" selected>
                                                        <?php 
                                                                if($input_data['session_time'] == "morning") {
                                                                        echo "Morning Session (9.00AM-3.00PM)";
                                                                }
                                                                if($input_data['session_time'] == "night") {
                                                                        echo "Night Session (7.00PM-1.00AM)";
                                                                }
                                                                if($input_data['session_time'] == "both") {
                                                                        echo "Both";
                                                                }
                                                                // echo $input_data['session_time']; 
                                                        ?></option> 
                                <?php   } else { ?>
                                                <option value="none" selected>Select Session</option>   
                                                <option value="morning">Morning Session (9.00AM-3.00PM)</option>
                                                <option value="night">Night Session (7.00PM-1.00AM)</option>
                                                <option value="both">Both</option>
                                <?php } ?>
                                        
                                        
                                </select>
                            </div>
                            </div>
		</div>
		
		
                <!-- when avilable room then book now display -->
                <?php if(isset($roomAvailable) && $roomAvailable['availability'] == 1){ ?>
                        <?php 
                        if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                        }
                        $_SESSION['unreg_session_date'] = $input_data['session_date'];
                        $_SESSION['unreg_session_time'] = $input_data['session_time'];
                        $_SESSION['unreg_hall_id'] = $id;

                        // $_SESSION['unreg_no_of_rooms'] = $input_data['no_of_rooms'];
                        // $_SESSION['unreg_no_of_guest'] = $input_data['no_of_guests'];	
                                
                        ; ?>
                        <div class="blockY search">
                                <input type="submit" id='bookingSubmit' class='form__submitY' name='submitbooknow' value='Book Now'>
                        </div>
                <?php }else { ?>
                        <div class="blockY search">
			        <input type="submit" id='bookingSubmit' class='form__submitY' name='submit' value='Check  Availability'>
			 <!-- <input type="submit" id='bookingSubmit' class='form__submitY' value="<?php echo $room_details[0]['room_number']  ?>">  -->
		        </div>
                <?php } ?>     
	</div>
        </form>
</body>
</html>