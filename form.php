<?php
function validate_message($message)
{
    // function to check if message is correct (must have at least 10 caracters (after trimming))
    $trimmedMessage = trim($message);
    if (strlen($trimmedMessage) >= 10) {
        return true;
    } else {
        return false;
    }
}
function validate_username($username)
{ // function to check if username is correct (must be alphanumeric => Use the function 'ctype_alnum()')
    if (ctype_alnum($username)) {
        return true;
    } else {
        return false;
    }
}
function validate_email($email)
{
    // function to check if email is correct (must contain '@')
    if (strpos($email, '@') !== false) {
        return true;
    } else {
        return false;
    }
}
$user_error = "";
$email_error = "";
$terms_error = "";
$message_error = "";
$username = "";
$email = "";
$message = "";
$form_valid = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Here is the list of error messages that can be displayed:
    $message = $_POST['message'];
    if (empty($message)) {
        $message_error = "Message is required";
    } elseif (strlen(trim($message)) < 10) {
        $message_error = "Message must be at least 10 characters long";
    }
    // "You must accept the Terms of Service"

    if (!isset($_POST['terms'])) {
        $terms_error = "You must accept the Terms of Service";
    }
    // "Please enter a username"
    // "Username should contains only letters and numbers"
    $username = $_POST['username'];
    if (empty($username)) {
        $user_error = "Please enter a username";
    } elseif (!ctype_alnum($username)) {
        $user_error = "Username should contain only letters and numbers";
    }
    $email = $_POST['email'];
    if (empty($email)) {
        $email_error = "Please enter an email";
    } elseif (strpos($email, '@') === false) {
        $email_error = "Email must contain '@'";
    }
    if (empty($message_error) && empty($terms_error) && empty($user_error) && empty($email_error)) {
        $form_valid = true;
    }
}
?>
<form action="#" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>">
            <small class="form-text text-danger"><?= isset($user_error) ? htmlspecialchars($user_error) : '' ?></small>
        </div>
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
            <small class="form-text text-danger"><?= isset($email_error) ? htmlspecialchars($email_error) : '' ?></small>
        </div>
    </div>
    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"><?= isset($message) ? htmlspecialchars($message) : '' ?></textarea>
        <small class="form-text text-danger"><?= isset($message_error) ? htmlspecialchars($message_error) : '' ?></small>
    </div>
    <div class="mb-3">
        <input type="checkbox" class="form-control-check" name="terms" id="terms" value="terms" <?= isset($terms) && $terms === "terms" ? 'checked' : '' ?>>
        <label for="terms">I accept the Terms of Service</label>
        <small class="form-text text-danger"><?= isset($terms_error) ? htmlspecialchars($terms_error) : '' ?></small>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<hr>
<hr>

<?php
if ($form_valid) :
?>
    <div class="card">
        <div class="card-header">
            <p><?php echo $username; ?></p>
            <p><?php echo $email; ?></p>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo $message; ?></p>
        </div>
    </div>
<?php
endif;
