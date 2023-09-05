<?php
function custom_registration_form()
{
    if (isset($_POST['register'])) {

        $uname = isset($_POST['reg_username']) ? sanitize_text_field($_POST['reg_username']) : '';
        $email = isset($_POST['reg_email']) ? sanitize_email($_POST['reg_email']) : '';
        $pass = isset($_POST['reg_password']) ? $_POST['reg_password'] : '';
        $cpass = isset($_POST['reg_cpassword']) ? $_POST['reg_cpassword'] : '';

        $error = array();
        if (username_exists($uname)) {
            $error['reg_username'] = "Username exists";
        }
        if (email_exists($email)) {
            $error['reg_email'] = "Email exists";
        }
        if ($pass !== $cpass) {
            $error['reg_password'] = "Passwords do not match";
        }
        if (empty($error)) {
            $user_id = wp_create_user($uname, $pass, $email);
            if (!is_wp_error($user_id)) {
                echo "<h1>Register Successfully</h1>";

            } else {
                echo "<h2>Error: " . $user_id->get_error_message() . "</h2>";
            }
        } else {
            foreach ($error as $e) {
                echo "<h2>$e</h2>";
            }
        }
    }
    if (is_user_logged_in()) {
        return '<p>You are already logged in and have no need to create a user profile.</p>';
    } else {
        ?>
        <div class="reg_form">
            <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">

                <p style="text-align:center; font-size:30px">REGISTER FORM</p><br>
                <input class="boxsize" type="text" name="reg_username" placeholder="Username"><br>
                <input class="boxsize" type="text" name="reg_email" placeholder="Email"><br>
                <input class="boxsize" type="password" name="reg_password" placeholder="Password"><br>
                <input class="boxsize" type="password" name="reg_cpassword" placeholder="Confirm Password">
                <br><br>
                <label>Gender:</label>
                <input type="radio" name="gender" class="radio" checked>Male
                <input type="radio" name="gender" class="radio">Female
                <input type="radio" name="gender" class="radio">Other
                <br><br>
                <div class="button">
                    <input class="register" type="submit" name="register" value="Register">
                </div>
                <br>

                <a class="back-to" href="<?php echo site_url('login-page'); ?>"><- Back to Login</a>

            </form>
        </div>
        <br>
        <?php
    }
}
add_shortcode('custom_registration_form', 'custom_registration_form');
?>
