<html>

<head>
    <link rel="stylesheet" href="<?php echo PATH_URL_STYLE . 'user.css' ?>">
</head>
<div id="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">

                <div class="login-panel panel panel-default">

                    <div class="panel-body">

                        <div class="form-login">
                            <form method="post" action="?url=user/login&api=1" role="form">
                                <div class="loginForm">
                                    <div class="form-group">
                                        <p class="font-bold">Username</p>
                                        <input class="form-control" placeholder="username" name="username" type="text" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <p class="font-bold">Password</p>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="" />
                                    </div>
                                    <div style="width:412px">
                                        <label>
                                            <input name="remember" type="checkbox" value="Remember Me"> Remember me
                                        </label>
                                    </div>
                                    <div class="message"><?php if (!empty($message)) {
                                                                echo $message;
                                                            } ?></div>
                                    <button class="btn-submit" type="submit">Login</button>
                                    <div class="direct"><span style="color:#656767">Don't have an account yet?</span><a href="?url=user/signup&api=1" class=" color-green"> Register</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>