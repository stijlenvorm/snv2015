<div class="container-fluid">
    

        <form method="post" action="options.php">
            <?php settings_fields('contact-settings-group'); ?>

            <?php // algemene info ?>
            <div class="admin-table">
                <h3 class="customH3">Contact Informatie - Algemeen</h3>
                <div class="inputHolder">
                    <div class="lefty">
                        Logo
                    </div>
                    <div class="righty">
                        <input class="hidden" type="text" id="image_location" name="home-logo" id="logo_field" value="<?php echo esc_attr( get_option('home-logo') ); ?>">
                        <input data-name="algemeen" class="onetarek-upload-button button" type="button" value="Kies Nieuw Logo" /><br>

                        <img id="algemeen_logo_show" src="<?php echo esc_attr( get_option('home-logo') ); ?>" alt="">
                    </div>
                </div>

                <div class="row">

                    <div class="col-xs-12 col-sm-6">
                        <h2>Contactinformatie</h2>

                        <div class="row">
                            <div class="col-xs-5">
                                E-mail
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="email" value="<?php echo esc_attr( get_option('email') ); ?>" placeholder="info@stijlenvorm.nl">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Telefoon
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="telefoon" value="<?php echo esc_attr( get_option('telefoon') ); ?>" placeholder="06-12345678">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Adres
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="adres" value="<?php echo esc_attr( get_option('adres') ); ?>" placeholder="Velperweg 35">
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-xs-5">
                                postcode
                            </div>
                            <div class="col-xs-7">
                                <input type="text"   name="postcode"  value="<?php echo esc_attr( get_option('postcode') ); ?>" placeholder="6531DN">
                                <input type="hidden" name="latitude"  value="">
                                <input type="hidden" name="longitude" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                woonplaats
                            </div>
                            <div class="col-xs-7">
                                <input type="text" name="woonplaats" value="<?php echo esc_attr( get_option('woonplaats') ); ?>" placeholder="Arnhem">
                            </div>
                        </div>
                    </div>
                

                    <div class="col-xs-12 col-sm-6">
                        <h2>Socialmedia opties</h2>

                        <?php 
                        $smOptions = explode(',', SOCIAL_MEDIA_OPTIONS);
                        foreach ($smOptions as $channel)  : ?>

                            <div class="row">
                                <div class="col-xs-5">
                                    <?php echo $channel ?> page URL
                                </div>
                                <div class="col-xs-7">
                                    <input type="text" name="<?php echo $channel ?>" value="<?php echo esc_attr( get_option($channel) ); ?>" placeholder="einde van URL">
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
            </div>

            <?php submit_button(); ?>

        </form>
    </div>
</div>