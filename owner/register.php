<?php
    $dir_url = "../";
    include('../layouts/headerLogin.php');
?>
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="action/register.php" method="post" enctype="multipart/form-data">
                <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" style="width: 100px; height: 100px; margin-left: 40%; border-radius: 50%; margin-bottom: 10px"></a>    
                <span class="login100-form-title p-b-43">
                        Register for Owner
                    </span>
                    
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Username</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>
                    
                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Phone is required">
                        <input class="input100" type="text" name="phone" required>
                        <span class="focus-input100"></span>
                        <span class="label-input100">Phone Number</span>
                    </div>


                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                    
                    <div class="text-center p-t-46 p-b-20">
                        <a href="login.php" class="txt2">
                            or login
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