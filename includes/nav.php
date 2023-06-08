<header>
    BANNER
</header>
<nav>
    <div class="logo">ODGC</div>
    <div class="nav-menu">
        <ul>
            <li>
                <a href="https://enos.itcollege.ee/~mgoroz/ics0008_group_project/index.php"><span>Home</span></a>
            </li>
            <li>
                <a href="https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/requests.php"><span>Requests</span></a>
            </li>
            <li>
                <a href="https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/profile.php"><span>Profile</span></a>
            </li>
        </ul>
    </div>
    <div class="logindrop">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span class="username-display"><a href = https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/public/profile.php> <?php echo $_SESSION['username']; ?> </a></span>
            <span><button onclick="window.location.href='https://enos.itcollege.ee/~mgoroz/ics0008_group_project/utility/logout.php'">Logout</button></span>
        <?php else: ?>
            <button id="login-button"> 
                Login
            </button>
            <button onclick="window.location.href='https://enos.itcollege.ee/~mgoroz/ics0008_group_project/pages/private/register.php'">
                Sign Up
            </button>
            <div id="login-container"> 
                <form method="POST" onsubmit="return submitLoginForm(this, 'nav-login-error-message');" class="dropdown-login">
                    <div id="nav-login-error-message" style="display:none;color:red;"></div>
                    <label for="username">Username</label>
                    <input type="text" name="username" placeholder="Username" class="input-field">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Password" class="input-field">
                    
                    <a href="">Forgot Password?</a>
                    <input type="submit" value="Login">
                </form>
            </div>

        <?php endif; ?>
    </div>

</nav>


