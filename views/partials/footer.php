    </div> <!-- End main section -->

    <footer>
        <div class="row">
            <div class="small-12 columns">

                <hr/>

                <div class="row">
                    <div class="small-10 columns">
                        <p>© Copyright 2015 Adlister.</p>
                    </div>
                </div>

            </div>
        </div>
    </footer>
    
<!-- Log-in Pop-up Modal Window -->
    <div id="loginModal" class="reveal-modal small" data-reveal aria-labelledby="login" aria-hidden="true" role="dialog">

        <!-- If not logged in, require the log-in form inside the modal -->
        <?php if(!Auth::check()){
                require_once 'auth.login.php'; 
            }
        ?>

        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>

</div> <!-- End wrap -->

<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
    $(document).foundation(
        <?php if (!empty($errorMessage)): ?>
            {
                reveal : {
                    animation_speed: 0
                }
            }
        <?php endif; ?>
    );

    <?php if (!empty($errorMessage)): ?>
        $(document).ready(function(){
            $('#loginModal').foundation('reveal', 'open')
        });
    <?php endif; ?>
</script>

