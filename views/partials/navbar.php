    <div class="fixed">
        <nav class="top-bar" data-topbar data-options="scrolltop:false">
            <ul class="title-area">
                <li class="name">
                    <h1 id="site-name"><a href="/"><i class="fa fa-rocket"></i> ad<span class="logo-liste">liste</span>r</a></h1>
                </li>
                <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
            </ul>

            <section class="top-bar-section">
                <!-- Right Nav Section -->
                <ul class="right">
                    <li class="divider show-for-small-only"></li>
                    <li class="active"><a href="index.php#featured">Featured ads</a></li>
                    <li class="divider show-for-small-only"></li>
                    <li class=""><a href="ads.index.php">All ads</a></li>
                    <li class="divider show-for-small-only"></li>
                    <li class=""><a href="#">Categories</a></li>
                    <li class="divider show-for-small-only"></li>
                    
                    <!-- If user is already logged in, show 'logout' button -->
                    <?php if(Auth::check()) { ?>
                        <li class=""><a href="users.show.php">My Account</a><li>
                        <li class="divider"></li>
                        <li class=""><a href="auth.logout.php">Logout</a></li>
                    <?php } else { ?>
                        <li class=""><a href="users.create.php">Sign up</a></li>
                        <li class="divider"></li>
                        <li class=""><a href="auth.login.php">Login</a></li>
                    <?php } ?>
                </ul>
            </section>
        </nav>
    </div>

