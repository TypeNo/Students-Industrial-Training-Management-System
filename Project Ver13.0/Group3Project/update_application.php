<?php
session_start();
require_once ("config.php");
if ($_SESSION['LEVEL'] == 2) {
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT status,training_ID FROM application WHERE ApplicationID = '$id'";
    $result = mysqli_query($conn, $sql);
    $previous_status = mysqli_fetch_assoc($result);
    $training_ID = $previous_status['training_ID'];
    $sql = "UPDATE application SET status = '$status' WHERE ApplicationID = '$id'";
    mysqli_query($conn, $sql);
    if ($status == 'Approved' && $previous_status['status'] !== 'Approved') {
        $sql = "UPDATE training_session AS t 
            INNER JOIN application AS a
            ON  t.training_ID = a.training_ID
            SET current_amount=current_amount +1 where ApplicationID='$id'";
        mysqli_query($conn, $sql);
        $sql = "SELECT required_amount,current_amount 
            FROM training_session AS t
            INNER JOIN application AS a 
            ON ApplicationID='$id'
            WHERE t.training_ID =a.training_ID ;";
        $result = mysqli_query($conn, $sql);
        $current_amount = mysqli_fetch_assoc($result);
        if ($current_amount['current_amount'] === $current_amount['required_amount']) {
            $sql = "UPDATE application AS a SET status = 'Stopped'
                WHERE training_ID='$training_ID'&& status ='Pending';";
            mysqli_query($conn, $sql);
        }
    }
    if ($status == 'Rejected' && $previous_status['status'] == 'Approved' && $previous_status['status'] !== 'Rejected') {
        $sql = "UPDATE training_session AS t 
               INNER JOIN application AS a
               ON  t.training_ID = a.training_ID
               SET current_amount=current_amount -1 where ApplicationID='$id'";
        mysqli_query($conn, $sql);
        $sql = "UPDATE application AS a 
                SET status = 'Pending'
                WHERE training_ID='$training_ID'&& status ='Stopped';";
        mysqli_query($conn, $sql);
    }
    header('Location:view_application.php');
} else {
    $sql = "SELECT * FROM application";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
    $process = $_POST['submit_button'];
    $training_ID = $_POST['training_session'];
    $sql = "SELECT required_amount, current_amount FROM training_session WHERE training_ID='$training_ID'; ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $diff = $row['required_amount'] - $row['current_amount'];
    if ($diff == 0) { ?>
<script>
// Display the alert box
alert("Alert: This training session had stopped received any application");
// Redirect to another page
window.location.href = "application_form.php"; //Provide a view for update purpose
</script>
<?php
    }
    if ($process === "Apply") {
        $ID = 'A' . ($count + 1);
    } else {
        $ID = $_POST['application_id'];
    }
    $username = $_SESSION['USER'];
    $sql = "SELECT matric FROM student WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $matric = $row['matric'];
    $address = $_POST['address'];
    $address = ucwords(strtolower($address));
    $organization_ID = $_POST['selected_organization'];
    $status = 'Pending';
    $sql = "SELECT ApplicationID,address FROM application where matric='$matric' and training_ID='$training_ID' "; //Address Here
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($_POST['submit_button'] == 'Apply') {
        if (isset($row['ApplicationID'])) {
            $id = $row['ApplicationID'];
?>
<script>
// Display the alert box
alert("Alert: You had already made an application to this training session! Now move to update this application");

window.location.href = "application_form.php?id=<?php echo $id ?>";
</script>
<?php
        } else {
            $sql = "INSERT INTO application(ApplicationID,matric,address,organization_ID,training_ID,status) VALUES ('$ID','$matric','$address','$organization_ID','$training_ID','$status');";
            mysqli_query($conn, $sql);
?>
<script>
// Display the alert box
alert(
    "Alert: You had successfully made an application to this training session! Now move to view the list of your application"
);
// Redirect to another page
window.location.href = "view_application.php";
</script>
<?php
        }
    } else {
        $id = $row['ApplicationID']; ?>
<?php
        $sql = "UPDATE application SET address = '$address', organization_ID='$organization_ID', training_ID='$training_ID' WHERE ApplicationID='$ID';";
        mysqli_query($conn, $sql);
?>
<script>
// Display the alert box
alert("Alert: The application had been successfully updated!Now move to view the list of your application");
// Redirect to another page
window.location.href = "view_application.php";
</script>
<?php
    }
}
?>