<?php 
   // Header
   $title = "Search Room page";
   include(VIEWS.'dashboard/inc/header.php');
?> 


<div class="wrapper">

    <?php 
            $navbar_title = "Search Room Page";
            $search = 0;
            $search_by = '#';
       
            include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
            include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
    ?>

    
    <!-- Table design -->
    <div class="content">
        <div class="tablecard">
            <div class="card">

                <div class="cardheader">
                    <div class="options">
                        <h4>Room Search 
                        <span>
                            <a href="<?php url("room/selectOption"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>  
                       </span>
                       <?php 
                        if(isset($errors)) { ?>
                        <!-- //     echo '<script>alert("'.$errors['date'].'!!")</script>'; -->
                        <div class="notifyclass">
                            <span class="notifyError">
                                <h3 class="error-style">
                                    <?php echo "No Rooms Available For Days"; ?>
                                </h3>
                            </span>
                        </div> 
                            
                        <?php } ?>
                        </h4>  
                    </div>

                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">  
                    <?php 
                        if(!isset($customer['id'])) { 
                            $customer['id'] = 0;
                        }
                    ?>
                    <form action="<?php url("room/check/".$customer['id']); ?>" method="post" class="addnewform">

                    <div class="section1">

                        <input type="text" name="owner_user_id" value ="<?php echo $_SESSION['user_id']; ?>" hidden  >
                        

                        <div class="row">
                            <label for="#"><i class="material-icons">room</i>Room Type:</label>
                                <div class="animate-form">
                                    <select name="type_name" class="inputField" required>
                                         <option value="">-Select Room Type-</option>
                                         <?php if(isset($details['type_name'])) {?>
                                            <option value="<?php echo $details['type_name']; ?>" selected><?php echo $details['type_name']; ?></option>
                                         <?php } ?>
                                    <?php foreach($typename as $types): ?>
                                        <?php if(isset($details['type_name']) && $details['type_name'] != $types['type_name']){ ?>
                                            <option value="<?php echo $types['type_name']; ?>" style="border: none"><?php echo $types['type_name']; ?></option> 
                                        <?php }elseif(!isset($details['type_name'])){ ?>
                                            <option value="<?php echo $types['type_name']; ?>" style="border: none"><?php echo $types['type_name']; ?></option> 
                                        <?php } ?>
                                        
                                    <?php endforeach; ?>     
                                    </select>    
                                </div>     
                        </div>

                        <div class="rowdate">
                            <label for="#"><i class="material-icons">today</i>Check-In Date:</label>
                                <!-- <div class="animate-formdate"> -->
                                    <input type="date"  autocomplete="off" name="check_in_date" class="inputFieldDate"
                                    <?php 

                                        date_default_timezone_set("Asia/Colombo");
                                        $current_date = date('Y-m-d');
                                        $next_date = date('Y-m-d',(strtotime ( '+1 day' , strtotime ( $current_date) ) ));
                                        if(isset($details['check_in_date'])){
                                            echo 'value="' . $details['check_in_date'] . '"';
                                        }
                                        else {
                                            echo 'value="'.$current_date .'"';
                                        } 
                                    
                                    ?>

                                    <?php 
                                        echo 'min="'.$current_date .'"';
                                    ?>
                                    
                                    required
                                    >
                                    
                                    <label for="name" class="label-name">
                                        <?php if((isset($errors)) && (isset($details['check_in_date']))): ?>
                                            <span class="content-name"><i class="material-icons">info</i>No ROOMS Available</span>
                                        <?php endif; ?>
                                    </label>    
                                <!-- </div> -->
                        </div>
                        

                        <div class="rowdate">
                            <label for="#"><i class="material-icons">today</i>Check-Out Date:</label>
                                <!-- <div class="animate-form"> -->
                                    <input type="date"  autocomplete="off" name="check_out_date" class="inputFieldDate"
                                    <?php 
                                        date_default_timezone_set("Asia/Colombo");
                                        $current_date = date('Y-m-d');
                                        if(isset($details['check_out_date'])){
                                            echo 'value="' . $details['check_out_date'] . '"';
                                        }
                                        else {
                                            echo 'value="'.$next_date.'"';
                                        } 
                                    
                                    ?>

                                    <?php 
                                        echo 'min="'.$current_date .'"';
                                    ?>
                                    
                                    required
                                    >
                                    
                                    <label for="name" class="label-name">
                                        <?php if((isset($errors)) && (isset($details['check_out_date']))): ?>
                                            <span class="content-name"><i class="material-icons">info</i>No ROOMS Available</span>
                                        <?php endif; ?>
                                    </label>   
                                <!-- </div>      -->
                        </div>

                        
                        <div class="row">
                            <div class="button">
                                <button class="save" name="submit">Search</button>
                            </div>
                        </div>

                    </div>

                    <div class="section2"> 

                    </div>

                    </form>
                </div>  <!--End Card Body -->
            </div>  <!--End Card -->

            
        </div>
    </div>   <!-- End Table design -->
    
</div>
    
<?php include(VIEWS.'dashboard/inc/footer.php'); ?>




