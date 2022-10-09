<?php

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {

    require_once "connection.php";

    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = $id";
    $userDetails =mysqli_query($link, $sql);

    mysqli_close($link);
} else {
    header("location: error.php");
    exit();
}

function receive_emails_status($x){
    if ($x == 1) {
        return 'yes';
    }elseif ($x == 0) {
        return 'no';
    }
}
?>

<?php include "header.php" ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <?php while($row = mysqli_fetch_array($userDetails)){ ?>
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p><b><?php echo $row["gender"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Subscribed to emails service</label>
                        <p><b><?php echo receive_emails_status($row["receive_emails"]); ?></b></p>
                    </div>
                    <?php } ?>
                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
<?php include "footer.php" ?>