<?php
    $dir_url = "../";
    include('../layouts/headerLogin.php');

    // Xử lý thông báo nếu tồn tại
    $alert = isset($_GET['alert']) ? htmlspecialchars($_GET['alert']) : '';
    $err = isset($_GET['err']) ? (int)$_GET['err'] : '';

    // Hiển thị thông báo
    if (!empty($alert)) { ?>
        <div class="alert <?php echo $err === 1 ? 'alert-danger' : 'alert-success'; ?>">
            <?php echo $alert; ?>
        </div>
    <?php } ?>
        
    <div class="container-login100">
        <div class="wrap-login100">
            <!-- Form đăng nhập -->
            <form class="login100-form validate-form" action="action/login.php" method="post">
                <a href="../index.php">
                    <img src="<?php echo $dir_url ?>assets/img/logo.png" alt="logo" 
                         style="width: 100px; height: 100px; margin-left: 40%; border-radius: 50%; margin-bottom: 10px">
                </a>
                <span class="login100-form-title p-b-43">
                    Login for Owner
                </span>

                <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Email</span>
                </div>
                
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" required>
                    <span class="focus-input100"></span>
                    <span class="label-input100">Password</span>
                </div>

                <div class="flex-sb-m w-full p-t-3 p-b-32">
                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div>
                        <a href="#" class="txt1">
                            Forgot Password?
                        </a>
                    </div>
                </div>

                <div class="container-login100-form-btn">
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
                
                <div class="text-center p-t-46 p-b-20">
                    <a href="register.php" class="txt2">
                        or sign up
                    </a>
                </div>
            </form>

            <div class="login100-more" style="background-image: url('../assets/img/bg-01.jpg');">
            </div>
        </div>
    </div>
<?php
    include('../layouts/footerLogin.php');
?>
