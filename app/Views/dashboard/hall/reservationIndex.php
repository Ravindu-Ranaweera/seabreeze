
<?php 

// Header
   $title = "Reservations page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Rooms Reservations ";
       $search = 1;
       $search_by = 'Hall Name';
       $url = "banquet/hallReservationIndex";
       
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
                            <a href="<?php url("banquet/selectOption"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>
                            <a href="<?php url("banquet/hallReservationIndex"); ?>" class="refresh"><i class="material-icons">loop</i></a> 
                       </span> 
                        
                       </h4>
                   </div>
                   <p class="textfortabel">Hall Reservations View Following Table</p>
               </div>
               <div class="cardbody">
               <div class="tablebody">
                                <table>
                                    <thead>
                                        <th>Hall Name</th>
                                        <th>Customer</th>
                                        <th>Email</th>
                                        <th>Hall Price</th>
                                        <th>Session Date</th>
                                        <th>Session Type</th>
                                                                   
                                    </thead>

                                    <?php foreach($rooms as $row): ?>
                                    <tbody>
                                        
                                        <td><?php echo ucwords($row['name']);?></td>
                                        <td><?php echo $row['first_name'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td>
                                            <div class="outofdate">
                                                <?php echo $row['session_date'];?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="in">
                                                <?php echo ucfirst($row['session_type']);?>
                                            </div>
                                        </td>
                                        <?php 
                                            date_default_timezone_set("Asia/Colombo");
                                            $current_date = date("Y-m-d");
                                        ?>

                                       
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