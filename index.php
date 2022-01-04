<?php
    include('layouts/header.php');
    include('functions/db_config.php');
    session_start();
?>
<style>
html,
body {
    position: relative;
    min-height: 100vh;
    background-color: #E1E8EE;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: "Fira Sans", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>

<div class="form-structor">

    <div class="login">
        <div class="center">
            <h2 class="form-title" id="login"><span>or</span>Log in</h2>
            <form action="functions/function.php" method="post">
                <div class="form-holder">
                    <input type="email" name="email" class="input" placeholder="Email" />
                    <input type="password" name="pass" class="input" placeholder="Password" />
                </div>
                <button name="login" class="submit-btn">Log in</button>
            </form>
        </div>
    </div>

    <div class="signup slide-up">
        <?php 
            if(isset($_SESSION['msg'])){?>
                <span class="badge badge-danger"><?php
                            echo $_SESSION['msg'];
                        }
                        unset($_SESSION['msg']);
                    ?>
                </span>
        <h2 class="form-title" id="signup"><span>or</span>Sign up</h2>
        <form action="functions/function.php" method="post">
            <div class="form-holder">
                <input type="text" class="input" name="name" placeholder="Name" />
                <input type="email" class="input" name="email" placeholder="Email" />
                <input type="password" class="input" name="pass" placeholder="Password" />
            </div>
            <button name="signup" class="submit-btn">Sign up</button>
        </form>
    </div>
</div>

<?php
    include('layouts/footer.php');
?>