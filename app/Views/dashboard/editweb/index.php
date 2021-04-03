<style>

</style>
<?php 

// Header
   $title = "Edit web page";
   include(VIEWS.'dashboard/inc/header.php'); 
?>

<div class="wrapper">

    <?php 
   
       $navbar_title = "Edit Page";
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
                        <h4>Room Edit Page
                        </h4>
                    </div>
                    <p class="textfortabel">Select Edit Choice</p>
                </div>

                <div class="badgeSec">
                    <div class="horBadge">

                        <div class="icon1">
                            <i class="far fa-edit"></i>
                        </div>
                        <div class="text">
                            Set Room Discount
                        </div>
                        <a href="<?php url('editweb/discount/');?>"></a>
                    </div>

                    <div class="horBadge">
                        <div class="icon2">
                            <i class="far fa-images"></i>
                        </div>
                        <div class="text">
                            Select Rooms
                        </div>
                        <a href="<?php url('codetest/selectDetails/');?>"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>