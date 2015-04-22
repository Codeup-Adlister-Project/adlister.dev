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

</div> <!-- End wrap (that began in navbar.php)-->

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

