<style>

</style>
<?php 

// Header
   $title = "Hall Select page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">
      
   <?php 
   
       $navbar_title = "Select Option Page";
       $search = 0;
       $search_by = 'name';
       $url = "employee/index";
       
       include(VIEWS.'dashboard/inc/sidebar.php'); //Sidebar
       include(VIEWS.'dashboard/inc/navbar.php'); //Navbar
   ?>

<div class="content">
       <div class="tablecard">
           <div class="card">
               <div class="cardheader">
                   <div class="options">
                       <h4>Hall Select Option Page
                       <a href="<?php url("reservation/allReservationOptions"); ?>" class="addnew"><i class="material-icons">reply_all</i></a>  
                       </h4>
                   </div>
                   <p class="textfortabel">Select Hall Choice</p>
               </div>
               
                    <div class="badgeSec">
                        <div class="horBadge">
                        
                            <div class="icon1">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="text">
                                Notifications
                            </div>
                            <a href="<?php url('banquet/notificationIndex');?>"></a>
                        </div>

                        <div class="horBadge">
                        
                            <div class="icon1">
                                <i class="fas fa-user-tag"></i>
                            </div>
                            <div class="text">
                                Reservations
                            </div>
                            <a href="<?php url('banquet/hallReservationIndex');?>"></a>
                        </div>

                    </div>
           </div> 
       </div>
   </div>

</div>   

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>
