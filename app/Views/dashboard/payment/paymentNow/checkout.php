
<?php 

// Header
   $title = "Reservations page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Rooms Reservations ";
       $search = 1;
       $search_by = 'Room Number';
       $url = "reservation/details";
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>
       
    <!-- Table design -->
   <div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>All Room Reservations Page  
                       <span>
                            <?php if($_SESSION['user_level'] != "Owner"): ?>
                                <a href="<?php url("reservation/index"); ?>" class="addnew"><i class="material-icons">add_circle</i></a> 
                            <?php endif; ?>
                            <a href="<?php url("reservation/details"); ?>" class="refresh"><i class="material-icons">loop</i></a> 
                       </span> 
                        
                       </h4>
                   </div>
                   <p class="textfortabel">Rooms Reservations View Following Table</p>
               </div>
               <div class="cardbody">
               <div class="tablebody">
                                <table>
                                    <thead>
                                        <th>Room Number</th>
                                        <th>Room Name</th>
                                        <th>Room Rate</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Details</th>
                                        <?php if($_SESSION['user_level'] == "Owner" ): ?>
                                            <th>Check Out Booking</th>
                                        <?php endif; ?>                          
                                    </thead>

                                    <?php  
                                    foreach($rooms as $row):  ?>
                                   
                                    <tbody>
                                        <?php 
                                        
                                        date_default_timezone_set("Asia/Colombo");
                                        $current_date = date("Y-m-d"); 
                                        
                                        if($row['check_out_date'] >= $current_date): ?>
                                        
                                        <td><?php echo $row['room_number'];?></td>
                                        <td><?php echo $row['room_name'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td><?php  echo $row['check_in_date'];?></td>
                                        <td><?php  echo $row['check_out_date'];?></td>

                                        <td><a href="<?php url('room/details/'.$row['room_number']);?>" class="edit"><i class="material-icons">preview</i></a></td>
                                       
                                        <?php if($_SESSION['user_level'] == "Owner" || $_SESSION['user_level'] == "Reception"): ?>
                                            <?php  if($current_date <= $row['check_out_date'] ): ?>
                                                <td><a href="<?php url('pay/checkout/2/'.$row['room_number'].'/'.$row['check_in_date'].'/'.$row['check_out_date']);?>" class="edit"><i class="material-icons">check_circle</i></a>Check Out</td>
                                            <?php  endif; ?>    
                                            
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                <?php endforeach ?> 
                                </table>
                           
                           </div>
                </div>  <!--End Card Body -->
           </div> 
       </div>
   </div>

</div>   
   

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>