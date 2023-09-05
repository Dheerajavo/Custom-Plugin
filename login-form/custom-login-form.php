<?php 
function custom_login_form() {
  ?>
    <div class="container">
    <div class="login_form">
           <form method="post" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
            <img class="logimg"
                src="https://imgs.search.brave.com/39ZmUJDZJ7B5yJAXCNdYL32eUq4C2W2JKIm9nIuxH_Y/rs:fit:820:942:1/g:ce/aHR0cHM6Ly93d3cu/c2Vla3BuZy5jb20v/cG5nL2RldGFpbC8x/MTUtMTE1MDA1M19h/dmF0YXItcG5nLnBu/Zw"
                alt=""><br>
            <p style="text-align:center; font-size:30px">LOGIN</p>
            <p >
                <span>Don't have an account?</span>
                <span>
                    <a href="<?php echo site_url('register-page'); ?>">Create a new account</a></span>
</p><br>
            <input class="logsize" type="text" name="login_username" placeholder="Phone number, username, or email"
                value=""><br>
            <input class="logsize" type="password" name="login_password" placeholder="Password" value="">
            <br><br>
            <input class="submit" type="submit" name="login_submit" value="Log in"><br>
            <!-- <a class="logforget" href="#">Forgot password?</a> -->
        </form>
    </div>
</div
 
    <?php
      $redirect_url = site_url('/');

    if (isset($_POST['login_submit'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];    
        $user = wp_authenticate($login_username, $login_password);
        if (is_wp_error($user)) {
            echo '<p class="login-error" style="text-align:center;">Username and/or password do not match. Please try again.</p>';
        } else {
            wp_redirect($redirect_url);
            exit;
        }
    }
}
add_shortcode('custom_login_form', 'custom_login_form');