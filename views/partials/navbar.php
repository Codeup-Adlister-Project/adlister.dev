<!-- Log-in Pop-up Modal Window -->
    <div id="loginModal" class="reveal-modal small" data-reveal aria-labelledby="login" aria-hidden="true" role="dialog">

        <!-- If not logged in, require the log-in form inside the modal -->
        <?php if(!Auth::check()){
                require_once 'auth.login.php'; 
            }
        ?>

        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

<div id="wrap" class="clearfix"> <!-- Start wrap -->

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
                    <li class=""><a href="#" data-dropdown="navdrop2" aria-controls="navdrop2" aria-expanded="false" data-options="is_hover:true">Categories</a></li>
                        <ul id="navdrop2" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                          <li><a href="#">Free</a></li>
                          <li><a href="#">Automotive</a></li>
                          <li><a href="#">Pets</a></li>
                          <li><a href="#">Tech</a></li>
                        </ul>
                    <li class="divider show-for-small-only"></li>
                    
                    <!-- If user is already logged in, show 'logout' button -->
                    <?php if(Auth::check()) { ?>
                        <li class=""><a href="users.show.php" data-dropdown="navdrop1" aria-controls="navdrop1" aria-expanded="false" data-options="is_hover:true">My Account</a><li>
                            <ul id="navdrop1" class="f-dropdown" data-dropdown-content aria-hidden="true" tabindex="-1">
                              <li><a href="users.show.php">View Profile</a></li>
                              <li><a href="users.edit.php">Edit Profile</a></li>
                              <li><a href="ads.create.php">Create a New Ad</a></li>
                            </ul>
                        <li class="divider"></li>
                        <li class=""><a href="auth.logout.php">Log out</a></li>
                    <?php } else { ?>
                        <li class=""><a href="users.create.php">Sign up</a></li>
                        <li class="divider"></li>
                        <li class=""><a href="#" data-reveal-id="loginModal">Log in</a></li>
                    <?php } ?>
                </ul>
            </section>
        </nav>
    </div>

    <div id="main"> <!-- Start main section -->