<?php

require_once "connection.php";

$name = $email = $gender = $receive_email = "";
$name_err = $address_err = $salary_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_name = trim($_POST["name"]);
    if (empty($input_name)) {
        $name_err = "Please enter a name.";
    } elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $name_err = "Please enter a valid name.";
    } else {
        $name = $input_name;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Please enter an email.";
    } else {
        $email = $input_email;
    }

    $input_gender = trim($_POST["gender"]);
    if (empty($input_gender)) {
        $gender_err = "Please select a gender.";
    } else {
        $gender = $input_gender;
    }

    if (isset($_POST['receive_emails'])) {
        $receive_emails = 1;
    } else {
        $receive_emails = 0;
    }

    if (empty($name_err) && empty($email_err) && empty($gender_err)) {
        $sql = "INSERT INTO users (name, email, gender, receive_emails) VALUES ('$name', '$email', '$gender', $receive_emails)";
        $addUser =mysqli_query($link, $sql);
        if (!$addUser) {
            echo "Error : " . mysqli_error($link);
        }
        header("location: index.php");
    }

    mysqli_close($link);
}
?>

<?php include "header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-5">Add new User</h2>
            <p>Please fill this form and submit to add user record to the database.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                    <span class="invalid-feedback"><?php echo $name_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <select name="gender" class="<?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>">
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                    <span class="invalid-feedback"><?php echo $gender_err; ?></span>
                </div>
                <div class="form-group">
                    <input type="checkbox" name="receive_emails" value="<?php echo $receive_emails; ?>">
                    <label for="receive_emails">Do you want to receive emails from us?</label>
                    <span class="invalid-feedback"><?php echo $receive_emails_err; ?></span>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php include "footer.php" ?>