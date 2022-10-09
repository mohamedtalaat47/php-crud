<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    require_once "connection.php";

    $id = $_POST["id"];
    $sql = "DELETE FROM users WHERE id = $id";
    $deleteUser =mysqli_query($link, $sql);
        if (!$deleteUser) {
            echo "Error : " . mysqli_error($link);
        }
        header("location: index.php");
    mysqli_close($link);
} else {
    if (empty(trim($_GET["id"]))) {
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "header.php" ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this employee record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php include "footer.php" ?>
