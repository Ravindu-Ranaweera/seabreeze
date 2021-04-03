<?php 
   // Header
   
   $title = "Add-Room page";
   
   include(VIEWS.'dashboard/inc/header.php');
?>
<style>

</style>
<div class="wrapper">

    <?php 
            $navbar_title = "Add New Room Page";
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
                        <h4>Add New Room
                            <span>
                                <a href="<?php url("editweb/index"); ?>" class="addnew"><i
                                        class="material-icons">reply_all</i></a>
                            </span>
                        </h4>
                    </div>

                    <p class="textfortabel">Complete Following Details</p>
                </div>

                <div class="cardbody">
                    <form action="<?php url("editweb/create"); ?>" method="post" class="addnewform"
                        enctype="multipart/form-data">

                        <div class="section1">


                            <div class="row">
                                <label for="#"><i class="material-icons">hotel</i>Room Type:</label>
                                <div class="animate-form">
                                    <select name="type_id" class="inputField" selected="" required>
                                        <option value="" style="border: none">Select Room Type</option>
                                        <option value="1"
                                            <?php if ($room['type_id'] == 1 ) echo ' selected="selected"'; ?>
                                            style="border: none">Single Room</option>
                                        <option value="2"
                                            <?php if ($room['type_id'] == 2 ) echo ' selected="selected"'; ?>
                                            style="border: none">Double Room with King Size Bed </option>
                                        <option value="3"
                                            <?php if ($room['type_id'] == 3 ) echo ' selected="selected"'; ?>
                                            style="border: none">Double Room with Queen Size Bed</option>
                                        <option value="4"
                                            <?php if ($room['type_id'] == 4 ) echo ' selected="selected"'; ?>
                                            style="border: none">Triple Room</option>
                                        <option value="5"
                                            <?php if ($room['type_id'] == 5 ) echo ' selected="selected"'; ?>
                                            style="border: none">Twin Double Room</option>
                                        <option value="6"
                                            <?php if ($room['type_id'] == 6 ) echo ' selected="selected"'; ?>
                                            style="border: none">Twin Room</option>
                                        <option value="7"
                                            <?php if ($room['type_id'] == 7 ) echo ' selected="selected"'; ?>style="border: none">
                                            Family Room</option>

                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <label for="#"><i class="material-icons">room</i>Floor Type:</label>
                                <div class="animate-form" id="animate-form-floor_type">
                                    <select name="floor_type" class="inputField" selected=""
                                        onchange="validateFloor(this)" required>
                                        <option value="" style="border: none">Select Floor Type </option>
                                        <option value="0"
                                            <?php if ($room['floor_type'] == 0 ) echo ' selected="selected"'; ?>
                                            style="border: none">Ground Floor</option>
                                        <option value="1"
                                            <?php if ($room['floor_type'] == 1 ) echo ' selected="selected"'; ?>
                                            style="border: none">First Floor </option>
                                        <option value="2"
                                            <?php if ($room['floor_type'] == 2 ) echo ' selected="selected"'; ?>
                                            style="border: none">Scond Floor</option>
                                        <option value="3"
                                            <?php if ($room['floor_type'] == 3 ) echo ' selected="selected"'; ?>
                                            style="border: none">Third Floor</option>
                                        <option value="4"
                                            <?php if ($room['floor_type'] == 4 ) echo ' selected="selected"'; ?>
                                            style="border: none">Fourth Floor</option>
                                    </select>

                                </div>
                            </div>


                            <div class="row" id="room-no">
                                <label for="#"><i class="material-icons">admin_panel_settings</i>Room Number:</label>
                                <div class="animate-form" id="animate-form-room-no">
                                    <input type="number" autocomplete="off" name="room_number" class="inputField" <?php 
                                        if(isset($room['room_number'])){
                                            echo 'value="' . $room['room_number'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="B102"';
                                        } 
                                    
                                    ?> oninput="validateRoomNo(this, 0,3)">

                                    <label for="name" class="label-name">
                                        <?php if((isset($errorsNew['room_number'])) && (isset($room['room_number']))): ?>
                                        <div id="alert01">
                                            <span class="content-name"><i
                                                    class="material-icons">info</i><?php echo $errorsNew['room_number']; ?></span>
                                        </div>
                                        <?php else: ?>
                                        <div style="display: none;" id="alert01">
                                            <span class="content-name"></span>
                                        </div>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>


                            <div class="row">
                                <label for="#"><i class="material-icons">hotel</i>Room Name:</label>
                                <div class="animate-form">
                                    <input type="text" autocomplete="off" name="room_name" class="inputField" <?php 
                                        if(isset($room['room_name'])){
                                            echo 'value="' . $room['room_name'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="Budget Single Room"';
                                        } 
                                    
                                    ?> oninput="validateRoomName(this, 0,50)">

                                    <label for="name" class="label-name">
                                        <?php if((isset($errorsNew['room_name'])) && (isset($room['room_name']))): ?>
                                        <div id="alert02">
                                            <span class="content-name"><i
                                                    class="material-icons">info</i><?php echo $errorsNew['room_name']; ?></span>
                                        </div>
                                        <?php else: ?>
                                        <div style="display: none;" id="alert02">
                                            <span class="content-name"></span>
                                        </div>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">description</i>Room Description:</label>
                                <div class="animate-form">
                                    <textarea id="story" name="room-desc" rows=8 cols=55 maxlength=250 required
                                        oninput="validateRoomDesc(this, 0,255)">

                                    </textarea>

                                    <label for="name" class="label-name">
                                        <?php if((isset($errorsNew['room_name'])) && (isset($room['room_name']))): ?>
                                        <div id="alert002">
                                            <div style="display: none;" id="alert002"><span class="content-name"><i
                                                        class="material-icons">info</i><?php echo $errorsNew['room_name']; ?></span>
                                            </div>
                                            <?php else: ?>
                                            <div style="display: none;" id="alert002">
                                                <span class="content-name"></span>
                                            </div>
                                            <?php endif; ?>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">deck</i>Room View:</label>
                                <div class="animate-form">
                                    <select name="room_view" class="inputField"
                                        selected="<?php echo $room['room_view']; ?>" required>
                                        <option value="" style="border: none">-Select Room View-</option>
                                        <option value="Garden View"
                                            <?php if ($room['room_view'] == "Garden View" ) echo ' selected="selected"'; ?>
                                            style="border: none">Garden View</option>
                                        <option value="Sea View"
                                            <?php if ($room['room_view'] == "Sea View" ) echo ' selected="selected"'; ?>
                                            style="border: none">Sea View </option>
                                        <option value="City View"
                                            <?php if ($room['room_view'] == "City View" ) echo ' selected="selected"'; ?>
                                            style="border: none">City View</option>
                                    </select>


                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">cast_for_education</i>Room Size (sqft):</label>
                                <div class="animate-form">
                                    <input type="text" autocomplete="off" name="room_size" class="inputField" <?php 
                                        if(isset($room['room_size'])){
                                            echo 'value="' . $room['room_size'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="45"';
                                        } 
                                    
                                    ?> oninput="validateRoomSize(this, 0,10)">

                                    <label for="name" class="label-name">
                                        <?php if((isset($errorsNew['room_size'])) && (isset($room['room_size']))): ?>
                                        <div id="alert04">
                                            <span class="content-name"><i
                                                    class="material-icons">info</i><?php echo $errorsNew['room_size']; ?></span>
                                        </div>
                                        <?php else: ?>
                                        <div style="display: none;" id="alert04">
                                            <span class="content-name"></span>
                                        </div>
                                        <?php endif; ?>

                                    </label>
                                </div>
                            </div>



                            <div class="row">
                                <label for="#"><i class="material-icons">local_offer</i>Room Price (LKR):</label>
                                <div class="animate-form">
                                    <input type="text" autocomplete="off" name="price" class="inputField" <?php 
                                        if(isset($room['price'])){
                                            echo 'value="' . $room['price'] . '"';
                                        }
                                        else {
                                            echo 'placeholder="1000"';
                                        } 
                                    
                                    ?> oninput="validateRoomPrice(this, 0,10)">

                                    <label for="name" class="label-name">
                                        <?php if((isset($errorsNew['price'])) && (isset($room['price']))): ?>
                                        <div id="alert05">
                                            <span class="content-name"><i
                                                    class="material-icons">info</i><?php echo $errorsNew['price']; ?></span>
                                        </div>
                                        <?php else: ?>
                                        <div style="display: none;" id="alert05">
                                            <span class="content-name"></span>
                                        </div>
                                        <?php endif; ?>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">ac_unit</i>Air Condition:</label>
                                <div class="animate-form">
                                    <select name="air_condition" class="inputField new">
                                        <option value="0" style="border: none">No</option>
                                        <option value="1" style="border: none">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">no_meeting_room</i>Free Cancelaration:</label>
                                <div class="animate-form">
                                    <select name="free_canseleration" class="inputField new">
                                        <option value="0" style="border: none">No</option>
                                        <option value="1" style="border: none">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">hot_tub</i>Hot Water:</label>
                                <div class="animate-form">
                                    <select name="hot_water" class="inputField new">
                                        <option value="0" style="border: none">No</option>
                                        <option value="1" style="border: none">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">room_service</i>Breakfast Included:</label>
                                <div class="animate-form">
                                    <select name="breakfast_included" class="inputField new">
                                        <option value="0" style="border: none">No</option>
                                        <option value="1" style="border: none">Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <label for="#"><i class="material-icons">insert_photo</i>Room Photo:</label>
                                <div class="imgLine1">
                                    <div class="line">
                                        <img id="previewImg" src="<?php echo BURL.'assets/img/addImg.svg'; ?>"
                                            alt="Placeholder">
                                    </div>
                                    <div class="line">
                                        <!-- <input type="file" name="file"  onchange="previewFile(this);" required> -->
                                        <label class="addFile1"> Select File
                                            <input type="file" name="imgfile" size="60" onchange="previewFile(this);"
                                                required>
                                        </label>
                                    </div>

                                    <div class="line">
                                        <?php if((isset($errorsNew['img'])) ): ?>
                                        <p class=""><i class="material-icons">info</i><?php echo $errorsNew['img']; ?>
                                        </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="button">
                                    <button class="save" name="submit">Create</button>
                                </div>

                                <label for="name" class="label-name">
                                    <span class="content-name"><i class="material-icons">info</i>success</span>
                                </label>
                            </div>
                        </div>

                        <div class="section2">


                        </div>

                    </form>
                </div>
                <!--End Card Body -->

            </div>
            <!--End Card -->


        </div>
    </div> <!-- End Table design -->

</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function previewFile(input) {

    console.log(input);
    var file = input.files[0];
    console.log(file);

    if (file) {
        var reader = new FileReader();
        reader.onload = function() {
            $(input).closest('.imgLine1').find('#previewImg').attr("src", reader.result);
        }
        reader.readAsDataURL(file);
    }
}
</script>

<?php include(VIEWS.'dashboard/inc/footer.php'); ?>