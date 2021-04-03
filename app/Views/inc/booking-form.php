<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
        <style>
        .form_submit:hover {
                background-color: #fffffff;
        }
        </style>
</head>

<body>
        <!-- have to work with this booking-form -->
       
        <form action="<?php url("room/checkRoomCustomer"); ?>" method="post" id="form" >
                <div class="bookingFormContainerX">
                        <?php 
                         date_default_timezone_set("Asia/Colombo");
                         $current_date = date('Y-m-d');
                         $next_date = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $current_date) ) ));
                        //  echo $next_date;
                        ?>
                                <div class="block chech-in">
                                        <label >Check in</label>
                                        <div id='check-in' class='form-field'>
                                                <input type="date" name="check_in_date" placeholder="9 July, 2016"
                                                <?php 
                                                
                                                echo 'min="'.$current_date .'" value="'.$current_date .'"';
                                                ?>
                                                >
                                        </div>
                                </div>

                                <div class="block check-out">
                                        <label >Check out</label>
                                        <div id='check-out' class='form-field'>
                                                <input type="date" name="check_out_date"  placeholder="19 July, 2016"
                                                <?php 
                                                echo 'min="'.$current_date .'" value="'.$next_date .'"';
                                                ?>
                                                > 	
                                        </div>
                                </div>

                                <div class="block num-of-guest">
                                        <div class='form__dropdown'>
                                                <label >Rooms</label>
                                                <div class='form-field'> 
                                                        <select id='adultsAmount' name="no_of_rooms" required>
                                                                <option value="" selected="selected">No of Rooms</option>  
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                        </select>
                                                </div>
                                        </div>
                                </div>

                                <div class="block num-of-room">
                                        <div class='form__dropdown'>
                                                <label >Guests</label>
                                                <br>
                                                <div class='form-field'> 
                                                        <select id='childrenAmount' name="no_of_guests" required> 
                                                                <option value="" selected="selected">No of Guests</option>                        
                                                                <option value="1" >1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                                <option value="7">7</option>
                                                                <option value="8">8</option>
                                                        </select>
                                                </div>
                                        </div>
                                </div>

                                <div class="block search">
                                        <input type='submit' id='bookingSubmit' name='submit' class='form__submit' value='Search rooms'>
                                </div>
                        
                </div>
                </form>
	
</body>
</html>