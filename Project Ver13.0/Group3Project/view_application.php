<?php
session_start(); // Start up your PHP Session
require_once("config.php"); //read up on PHP includes https://www.w3schools.com/php/php_includes.asp
$username=$_SESSION['USER'];
if ($_SESSION["Login"] != "YES") {
    header("Location: login.php");
}
?>

<html>

<head>
    <title>View Application</title>
    <link rel="stylesheet" href="image/main.css">

</head>

<body>

    <div class="grid-container">
        <div class="logo">
            <a href="mainPage.php">
                <img src="image/utmlogo.png" alt="utmlogo" width="150" height="50">
            </a>
            <h1>View Application Details</h1>
            <button class="borderless-button logout" onclick="window.location.href='logout.php'">LOGOUT</button>
        </div>

        <div class="left-column2">
            <?php
            if ($_SESSION["LEVEL"] == 3) { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_application.php'" style="color:orange;"><img
                        src="image/icon/view.svg" alt="studentlogo" width="25px" height="25px" />VIEW</button>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='application_form.php'"><img src="image/icon/insert.svg"
                        alt="studentlogo" width="25px" height="25px" />APPLY</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
            <?php
            } else { ?>
            <div>
                <button class="borderless-button left-column-button"
                    onclick="window.location.href='view_application.php'" style="color:orange;"><img
                        src="image/icon/view.svg" alt="studentlogo" width="25px" height="25px" />VIEW</button>
            </div>
            <div>
                <button class="borderless-button left-column-button" onclick="window.location.href='mainPage.php'"><img
                        src="image/icon/back.svg" alt="studentlogo" width="25px" height="25px" />BACK</button>
            </div>
            <?php
            }  ?>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <div class="panel">
                <form name="sortsearch" id="sortsearch" method="POST" action="view_application.php">
                    <div class="searchbox">
                        <?php 
        if($_SESSION["LEVEL"] == 1 || $_SESSION["LEVEL"] == 3) {?>
                        <input type="search" id="search" name="search" class="searchtext"
                            value="<?php if(isset($_POST['search'])) echo $_POST['search'];?>" list="ice-cream-flavors"
                            placeholder="Search Organization">
                        <?php 
        } else if ($_SESSION["LEVEL"] == 2)  {?>
                        <input type="search" id="search" name="search" class="searchtext"
                            value="<?php if(isset($_POST['search'])) echo $_POST['search'];?>" list="ice-cream-flavors"
                            placeholder="Search Session">
                        <?php }?>

                        <datalist id="ice-cream-flavors">
                            <?php
        if($_SESSION["LEVEL"] == 1){
        $sql = "SELECT name FROM organization;";}
        else if($_SESSION["LEVEL"] == 2){
        $sql = "SELECT name FROM training_session AS t
                WHERE organization_ID = (
                SELECT organization_ID
                FROM coordinator
                WHERE username='$username');";}
        else{
        $sql = "SELECT name FROM organization AS o
                WHERE organization_ID IN (
                SELECT organization_ID
                FROM application 
                WHERE matric=(
                SELECT matric FROM student
                WHERE username='$username'));";
        }
        $result = mysqli_query($conn, $sql);
        while ($rows = mysqli_fetch_assoc($result)) {
        ?>
                            <option value="<?php echo $rows['name']; ?>">
                                <?php
        }
        ?>
                        </datalist>
                        <div class="submit">
                            <input type="submit" value="Search">
                        </div>
                    </div>

                    <div class="sortfield">
                        <select name="sort" id="sort" name="sort">
                            <option value="ASC"
                                <?php if(!isset($_POST['sort'])||$_POST['sort']==='ASC') echo 'selected'; ?>>Ascending
                            </option>
                            <option value="DESC"
                                <?php if(isset($_POST['sort'])&&$_POST['sort']==='DESC')echo 'selected'; ?>>Descending
                            </option>
                        </select>

                    </div>
            </div>
            <div class="filterselect">
                <fieldset style="width: 300px; margin: -50px auto 25px auto;">
                    <legend style="font-weight:bold;">Sort By</legend>
                    <div>
                        <input type="radio" id="Training_Session" name="SortBy" value="tname"
                            <?php if(!isset($_POST['SortBy'])||$_POST['SortBy']==='tname') echo 'checked' ?> />
                        <label for="Training_Session">Training Session Name</label>
                    </div>
                    <?php if($_SESSION['LEVEL']==1 ||$_SESSION['LEVEL']==3){ ?>
                    <div>
                        <input type="radio" id="Organization_Name" name="SortBy" value="oname"
                            <?php if(isset($_POST['SortBy'])&&$_POST['SortBy']==='oname') echo 'checked' ?> />

                        <label for="Organization_Name">Organization Name</label>
                    </div>
                    <?php } 
        if($_SESSION['LEVEL']==1 ||$_SESSION['LEVEL']==2){ ?>
                    <div>

                        <input type="radio" id="Matric" name="SortBy" value="s.matric"
                            <?php if(isset($_POST['SortBy'])&&$_POST['SortBy']==='s.matric') echo 'checked' ?> />
                        <label for="Matric">Matric</label>
                    </div>
                    <?php 
        }
        ?>
                </fieldset>
                </form>

            </div>

            <script>
            var search = document.getElementById('search');

            // Move cursor to the end of the input value
            search.setSelectionRange(search.value.length, search.value.length);

            var sort = document.getElementById('sort');
            var form = document.getElementById('sortsearch');
            var sortby = document.querySelectorAll('input[name="SortBy"]');

            sort.addEventListener('change', function() {
                form.submit();
            });

            sortby.forEach(function(radio) {
                radio.addEventListener('change', function() {
                    form.submit();
                });
            });
            </script>
            <div class="right-column-distance">


                <?php
    if(!isset($_POST['SortBy'])&&!isset($_POST['sort'])){
        $_POST['SortBy']='tname';
        $_POST['sort']='ASC';
        }
        $SortBy=$_POST['SortBy'];
        $Sort=$_POST['sort'];
        $Order=$SortBy.' '.$Sort;
        if(isset($_POST['search'])){
        $search=$_POST['search'];
        }
        else{
        $search=$_POST['search']='';
    }

    
    require_once("config.php"); //read up on PHP includes https://www.w3schools.com/php/php_includes.asp

    $username = $_SESSION["USER"];

    if ($_SESSION["LEVEL"] == 1) {
        if($search===''){
        $sql = "SELECT ApplicationID,a.address,o.name AS oname, t.name AS tname, s.firstName,s.lastName, s.matric , a.status 
        FROM application AS a
        INNER JOIN organization AS o
        ON o.organization_ID = a.organization_ID
        INNER JOIN training_session AS t
        ON t.training_ID = a.training_ID
        INNER JOIN student AS s
        WHERE a.matric=s.matric ORDER BY $Order; ";
        }
        else{
        $sql = "SELECT ApplicationID,a.address,o.name AS oname, t.name AS tname, s.firstName,s.lastName, s.matric , a.status 
        FROM application AS a
        INNER JOIN organization AS o
        ON o.organization_ID = a.organization_ID
        INNER JOIN training_session AS t
        ON t.training_ID = a.training_ID
        INNER JOIN student AS s
        WHERE a.matric=s.matric 
        and o.name = '$search' 
        ORDER BY '$Order' ; ";    
        }
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)>0){?>
                <!-- Start table tag -->
                <table class="right-column-table">
                    <tr>
                        <th>Training Session Name</th>
                        <th>Organization Name</th>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                    <?php
                // output data of each row
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $rows['tname']; ?></td>
                        <td><?php echo $rows['oname']; ?></td>
                        <td><?php echo $rows['matric']; ?></td>
                        <td><?php echo $rows['lastName']." ";echo $rows['firstName']; ?></td>
                        <td><?php echo $rows['address'] ?></td>
                        <td><?php echo $rows['status']; ?></td>

                    </tr>
                    <?php } ?>

                </table>
                <?php } 
        else {
            echo '<h3 style="text-align: center;">There are no records to show</h3>';
        }
        ?>

                <?php } else if ($_SESSION['LEVEL'] == 2) {
        $sql = "SELECT coordinate_ID FROM coordinator WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $coordinator_ID = $row['coordinate_ID'];
        if($search===''){
        $sql = "SELECT ApplicationID,a.address, t.name AS tname, s.firstName,s.lastName, s.matric , a.status, current_amount,required_amount 
        FROM application AS a
        INNER JOIN coordinator AS c
        ON a.organization_ID = c.organization_ID
        INNER JOIN training_session AS t
        ON t.training_ID = a.training_ID
        INNER JOIN student AS s
        WHERE a.matric=s.matric and c.coordinate_ID='$coordinator_ID'ORDER BY $Order ;" ;
        }
        else{
        $sql = "SELECT ApplicationID,a.address, t.name AS tname, s.firstName,s.lastName, s.matric , a.status, current_amount,required_amount 
        FROM application AS a
        INNER JOIN coordinator AS c
        ON a.organization_ID = c.organization_ID
        INNER JOIN training_session AS t
        ON t.training_ID = a.training_ID
        INNER JOIN student AS s
        WHERE a.matric=s.matric 
        and c.coordinate_ID='$coordinator_ID'
        and t.name = '$search'
        ORDER BY $Order ;" ;    
        }
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result)>0){?>
                <!-- Start table tag -->
                <table class="right-column-table">
                    <!-- Print table heading -->
                    <tr>
                        <th>Training Session Name</th>
                        <th>Matric</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th colspan="2">&nbsp;</th>
                    </tr>
                    <?php
                // output data of each row
                while ($rows = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $rows['tname']; ?></td>
                        <td><?php echo $rows['matric']; ?></td>
                        <td><?php echo $rows['lastName']." ";echo $rows['firstName']; ?></td>
                        <td style="width: 300px;"><?php echo $rows['address'] ?></td>
                        <td><?php echo $rows['status']; ?></td>
                        <td align="center"><a
                                href="update_application.php?id=<?php echo $rows['ApplicationID']."&status=Approved";?>"
                                target="_parent"><button class="Evaluate" id="Approve"
                                    <?php if($rows['status']=='Approved'||$rows['current_amount']==$rows['required_amount']) echo 'disabled' ?>>Approve</button></a>
                        </td>
                        <td align="center"><a
                                href="update_application.php?id=<?php echo $rows['ApplicationID']."&status=Rejected";?>"
                                target="_parent"><button class="Evaluate" id="Reject"
                                    <?php if($rows['status']=='Rejected'||$rows['status']=='Stopped') echo 'disabled' ?>>Reject</button></a>
                        </td>
                    </tr>
                    <?php } ?>

                </table>
                <?php } 
        else {
            echo '<h3 style="text-align: center;">There are no records to show</h3>';
        }
        ?>
                <?php } else {
       
       $sql = "SELECT matric FROM student WHERE username='$username'";
       $result = mysqli_query($conn, $sql);
       $row = mysqli_fetch_assoc($result);
       $matric = $row['matric'];
       if($search===''){

       $sql = "SELECT ApplicationID,a.address, o.name AS oname, t.name as tname, a.status 
               FROM application AS a
               INNER JOIN organization AS o
               ON o.organization_ID = a.organization_ID
               INNER JOIN training_session AS t
               ON t.training_ID = a.training_ID
               WHERE a.matric='$matric'ORDER BY $Order";
       }
       else{
        $sql = "SELECT ApplicationID,a.address, o.name AS oname , t.name as tname, a.status 
                FROM application AS a
                INNER JOIN organization AS o
                ON o.organization_ID = a.organization_ID
                INNER JOIN training_session AS t
                ON t.training_ID = a.training_ID
                WHERE a.matric='$matric'
                AND o.name='$search'
                ORDER BY $Order";
       }
       $result = mysqli_query($conn, $sql);
   
       if (mysqli_num_rows($result) > 0) { ?>
                <!-- Start table tag -->
                <table class="right-column-table">
                    <!-- Print table heading -->
                    <tr>
                        <th>Training Session Name</th>
                        <th>Organization Nam></th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Update</th>

                    </tr>
                    <?php
               // output data of each row
               while ($rows = mysqli_fetch_assoc($result)) {
                   ?>
                    <tr>
                        <td><?php echo $rows['tname']; ?></td>
                        <td><?php echo $rows['oname']; ?></td>
                        <td><?php echo $rows['address']; ?></td>
                        <td align="center">
                            <?php if($rows['status'] === 'Stopped'){ echo "Rejected"; } else { echo $rows['status']; } ?>
                        </td>
                        <?php if($rows['status'] == 'Pending' || $rows['status']=='Stopped') {?>
                        <td align="center"><button class="borderless-button update"
                                onclick="window.location.href='application_form.php?id=<?php echo $rows['ApplicationID'];?>'"><u>UPDATE</u></button>
                        </td>

                        <?php } else { ?>
                        <td align="center">NONE</td>
                        <?php } ?>
                    </tr>
                    <?php } ?>
                </table>
                <?php } 
        else {
            echo '<h3 style="text-align: center;">There are no records to show</h3>';
        }
        ?>
                <?php } ?>
            </div>
            <br /><br />
        </div>
    </div>
    </div>


</body>

</html>