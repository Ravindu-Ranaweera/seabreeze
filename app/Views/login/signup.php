<?php //require_once 'controllers/authControllers.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="<?php echo BURL.'assets/img/basic/favicon.png'; ?>" />
    <script type="text/javascript" src="<?php echo BURL.'assets/js/validateLogin.js'; ?>"></script>
    <title>Sign in & Sign up Form</title>
</head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body,
input {
    font-family: "Poppins", sans-serif;
}

.container {
    position: relative;
    width: 100%;
    background-color: #fff;
    min-height: 100vh;
    overflow: hidden;
}

.forms-container {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

.signin-signup {
    position: absolute;
    top: 50%;
    transform: translate(-50%, -50%);
    left: 25%;
    width: 50%;
    transition: 1s 0.7s ease-in-out;
    display: grid;
    grid-template-columns: 1fr;
    z-index: 5;
}

form {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0rem 5rem;
    transition: all 0.2s 0.7s;
    overflow: hidden;
    grid-column: 1 / 2;
    grid-row: 1 / 2;
}

/*form.sign-up-form {
  opacity: 0;
  z-index: 1;
}*/

form.sign-in-form {
    z-index: 2;
}

.title {
    font-size: 2.2rem;
    color: #444;
    margin-bottom: 10px;
}

.input-field {
    max-width: 380px;
    width: 100%;
    background-color: #fff;
    margin: 10px 0;
    height: 55px;
    border: 2px solid #000;
    border-radius: 10px;
    display: grid;
    grid-template-columns: 15% 85%;
    padding: 0 0.4rem;
    position: relative;
}

.input-field i {
    text-align: center;
    line-height: 55px;
    color: #acacac;
    transition: 0.5s;
    font-size: 1.1rem;
}

.input-field input {
    background: transparent;
    outline: none;
    border: none;
    line-height: 1;
    font-weight: 500;
    font-size: 1.1rem;
    color: #333;
}

input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
textarea:-webkit-autofill,
textarea:-webkit-autofill:hover,
textarea:-webkit-autofill:focus,
select:-webkit-autofill,
select:-webkit-autofill:hover,
select:-webkit-autofill:focus {
    -webkit-background-color: transparent;
    transition: background-color 5000s ease-in-out 0s;
}

.input-field input::placeholder {
    color: #aaa;
    font-weight: 500;
}

.btn {
    width: 150px;
    background-color: #5995fd;
    border: none;
    outline: none;
    height: 49px;
    border-radius: 49px;
    color: #fff;
    text-transform: uppercase;
    font-weight: 600;
    margin: 10px 0;
    cursor: pointer;
    transition: 0.5s;
}

.btn:hover {
    background-color: #4d84e2;
}

.panels-container {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
}

.container:before {
    content: "";
    position: absolute;
    height: 2000px;
    width: 2000px;
    top: -10%;
    left: 48%;
    transform: translateY(-50%);
    background-image: linear-gradient(109.6deg,
            rgba(31, 179, 237, 1) 11.2%,
            rgba(17, 106, 197, 1) 91.1%);
    transition: 1.8s ease-in-out;
    border-radius: 50%;
}

.image {
    width: 100%;
    transition: transform 1.1s ease-in-out;
    transition-delay: 0.4s;
}

.panel {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    justify-content: space-around;
    text-align: center;
    z-index: 6;
}

.left-panel {
    pointer-events: all;
    padding: 3rem 17% 2rem 12%;
}

.right-panel {
    pointer-events: none;
    padding: 3rem 12% 2rem 17%;
}

.panel .content {
    color: #fff;
    transition: transform 0.9s ease-in-out;
    transition-delay: 0.6s;
}

.content {
    z-index: 300;
}

.panel h3 {
    font-weight: 600;
    line-height: 1;
    font-size: 1.5rem;
}

.panel p {
    font-size: 0.95rem;
    padding: 0.7rem 0;
}

.btn.transparent {
    margin: 30 auto;
    background: none;
    border: 2px solid #fff;
    width: 130px;
    height: 41px;
    font-weight: 600;
    font-size: 0.8rem;
}

.right-panel .image,
.right-panel .content {
    transform: translateX(800px);
}

/* ANIMATION */

.container.sign-up-mode:before {
    transform: translate(100%, -50%);
    right: 52%;
}

.container.sign-up-mode .left-panel .image,
.container.sign-up-mode .left-panel .content {
    transform: translateX(-800px);
}

.container.sign-up-mode .signin-signup {
    left: 25%;
}

.container.sign-up-mode form.sign-up-form {
    opacity: 1;
    z-index: 2;
}

.container.sign-up-mode .right-panel .image,
.container.sign-up-mode .right-panel .content {
    transform: translateX(0%);
}

.container.sign-up-mode .left-panel {
    pointer-events: none;
}

.container.sign-up-mode .right-panel {
    pointer-events: all;
}

@media (max-width: 870px) {
    .container {
        min-height: 800px;
        height: 100vh;
    }

    .signin-signup {
        width: 100%;
        top: 95%;
        transform: translate(-50%, -100%);
        transition: 1s 0.8s ease-in-out;
    }

    .signin-signup,
    .container.sign-up-mode .signin-signup {
        left: 50%;
    }

    .panels-container {
        grid-template-columns: 1fr;
        grid-template-rows: 1fr 2fr 1fr;
    }

    .panel {
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
        padding: 2.5rem 8%;
        grid-column: 1 / 2;
    }

    .right-panel {
        grid-row: 3 / 4;
    }

    .left-panel {
        grid-row: 1 / 2;
    }

    .image {
        width: 200px;
        transition: transform 0.9s ease-in-out;
        transition-delay: 0.6s;
    }

    .panel .content {
        padding-right: 15%;
        transition: transform 0.9s ease-in-out;
        transition-delay: 0.8s;
    }

    .panel h3 {
        font-size: 19px;
    }

    .panel p {
        font-size: 11px;
        padding: 8px 0;
    }

    .btn.transparent {
        width: 110px;
        height: 35px;
        margin: 30px auto;
        font-size: 11px;
    }

    .container:before {
        width: 1500px;
        height: 1500px;
        transform: translateX(-50%);
        left: 30%;
        bottom: 68%;
        right: initial;
        top: initial;
        transition: 2s ease-in-out;
    }

    .container.sign-up-mode:before {
        transform: translate(-50%, 100%);
        bottom: 32%;
        right: initial;
    }

    .container.sign-up-mode .left-panel .image,
    .container.sign-up-mode .left-panel .content {
        transform: translateY(-300px);
    }

    .container.sign-up-mode .right-panel .image,
    .container.sign-up-mode .right-panel .content {
        transform: translateY(0px);
    }

    .right-panel .image,
    .right-panel .content {
        transform: translateY(300px);
    }

    .container.sign-up-mode .signin-signup {
        top: 5%;
        transform: translate(-50%, 0);
    }
}

@media (max-width: 570px) {
    form {
        padding: 0 24px;
    }

    .image {
        display: none;
    }

    .panel .content {
        padding: 8px 16px;
    }

    .container {
        padding: 24px;
    }

    .container:before {
        bottom: 72%;
        left: 50%;
    }

    .container.sign-up-mode:before {
        bottom: 28%;
        left: 50%;
    }
}

.alert {
    width: 350px;
    height: auto;
    justify-content: left;
    align-items: center;
    color: red;
    border-radius: 5px;
    padding-left: 10px;
    padding-right: 40px;
    font-size: 15px;
    margin: 0 auto;
    box-shadow: rgba(0, 0, 0, 0.06) 0px 0px 15px;
}

.error.alert {
    border-left: 6px solid #ff0000;
    background: white;
    text-align: left;
}

.error p {
    margin: 5px 2px;
    text-transform: capitalize;
    letter-spacing: 1px;
}
</style>

<body>


    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- signin -->

                <form action="<?php url("auth/signupUser"); ?>" method="post" class="sign-up-form">



                    <h2 class="title">Sign up</h2>

                    <?php if(count($errors)>0): ?>
                    <?php if(isset($errors['username'])): ?>
                    <div class="alert error" id="alert00" role="alert">
                        <p><i class="fas fa-exclamation-circle"></i><?php echo $errors['username'];  ?></p>
                    </div>
                    <?php else:  ?>
                    <div class="alert error" id="alert00" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif; ?>
                    <?php else:  ?>
                    <div class="alert error" id="alert00" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif;  ?>

                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username"
                            value="<?php if(isset($username)){ echo $username;} ?>"
                            oninput="validateUsername(this, 0,50)" />
                    </div>

                    <?php if(count($errors)>0): ?>
                    <?php if(isset($errors['email'])): ?>
                    <div class="alert error" id="alert01" role="alert">
                        <p><i class="fas fa-exclamation-circle"></i><?php echo $errors['email'];  ?></p>
                    </div>
                    <?php else:  ?>
                    <div class="alert error" id="alert01" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif; ?>
                    <?php else:  ?>
                    <div class="alert error" id="alert01" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif;  ?>

                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" value="<?php if(isset($email)){ echo $email;} ?>"
                            placeholder="Email" oninput="validateEmail(this, 0,254)" />
                    </div>

                    <?php if(count($errors)>0): ?>
                    <?php if(isset($errors['password'])): ?>
                    <div class=" alert error" id="alert02" role="alert">
                        <p><i class="fas fa-exclamation-circle"></i><?php echo $errors['password'];  ?></p>
                    </div>
                    <?php else:  ?>
                    <div class="alert error" id="alert02" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif; ?>
                    <?php else:  ?>
                    <div class="alert error" id="alert02" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif;  ?>

                    <div class="input-field" id="input-field-password">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password"
                            value="<?php if(isset($email)){ echo $password;} ?>" placeholder="Password"
                            oninput="validatePassword(this, 0,50)" />
                    </div>

                    <?php if(count($errors)>0): ?>
                    <?php if(isset($errors['password'])): ?>
                    <div class=" alert error" id="alert03" role="alert">
                        <p><i class="fas fa-exclamation-circle"></i><?php echo $errors['passwordConf'];  ?></p>
                    </div>
                    <?php else:  ?>
                    <div class="alert error" id="alert03" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif; ?>
                    <?php else:  ?>
                    <div class="alert error" id="alert03" role="alert" style="display:none">
                        <p><i class="fas fa-exclamation-circle"></i></p>
                    </div>
                    <?php endif;  ?>

                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="passwordConf" placeholder="Confirm Password"
                            value="<?php if(isset($email)){ echo $password;} ?>" placeholder="Password"
                            oninput="validatePasswordConfirm(this, 0,50)" />
                    </div>
                    <input type="submit" name="signup-btn" class="btn" value="Sign up" />

                </form>
            </div>
        </div>

        <div class="panels-container">

            <div class="panel right-panel">
                <div class="content">
                    <h3>Already Registered User?</h3>

                    <a href="<?php url('Home/login'); ?>  "><button class="btn transparent" id="sign-in-btn">Sign
                            in</button> </a>
                </div>
                <img src="<?php echo BURL.'assets/img/register.svg'; ?>" class="image" alt="" />
            </div>
        </div>
    </div>

</body>

</html>