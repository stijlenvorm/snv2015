<?php
function checkIfSelected($option, $value)
{
    if (get_option($option) == $value) {
        return 'selected="selected"';
    }
}
?>
<div class="container-fluid">

    <div class="wrap">

        <form method="post" action="options.php">
            <?php settings_fields('theme-settings-group'); ?>
            <div class="admin-table">

                <h3 class="customH3">Scripts &amp; Styles</h3>

                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-5">
                                Jquery inschakelen
                                <div><a href="https://api.jquery.com/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="jquery">
                                    <option value="1" <?php echo checkIfSelected( 'jquery', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'jquery', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Bootstrap javascript inschakelen
                                <div><a href="http://getbootstrap.com/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="bootstrap_js">
                                    <option value="1" <?php echo checkIfSelected( 'bootstrap_js', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'bootstrap_js', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Bootstrap CSS inschakelen
                                <div><a href="http://getbootstrap.com/" target="_blank">docs</a></div>

                            </div>
                            <div class="col-xs-7">
                                <select name="bootstrap_css">
                                    <option value="1" <?php echo checkIfSelected( 'bootstrap_css', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'bootstrap_css', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                wow-js inschakelen
                                <div><a href="http://mynameismatthieu.com/WOW/docs.html" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="wow_js">
                                    <option value="1" <?php echo checkIfSelected( 'wow_js', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'wow_js', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Animate CSS inschakelen
                                <div><a href="https://daneden.github.io/animate.css/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="animate_css">
                                    <option value="1" <?php echo checkIfSelected( 'animate_css', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'animate_css', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Font awesome
                                <div><a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="font_awesome">
                                    <option value="1" <?php echo checkIfSelected( 'font_awesome', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'font_awesome', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Stellar (parallax)
                                <div><a href="http://markdalgleish.com/projects/stellar.js/docs/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="stellar_js">
                                    <option value="1" <?php echo checkIfSelected( 'stellar_js', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'stellar_js', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Smoothscroll js
                                <div><a href="https://gist.github.com/galambalazs/6477177/" target="_blank">docs</a></div>
                            </div>
                            <div class="col-xs-7">
                                <select name="smoothscroll_js">
                                    <option value="1" <?php echo checkIfSelected( 'smoothscroll_js', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'smoothscroll_js', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php submit_button(); ?>

            <div class="admin-table">
                <h3 class="customH3">Thema opt-ins</h3>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <div class="row">
                            <div class="col-xs-5">
                                Header Titles <br>
                                titel en sub titel optie bij de contentHeader
                            </div>
                            <div class="col-xs-7">
                                <select name="header_titles">
                                    <option value="1" <?php echo checkIfSelected( 'header_titles', 1) ?> >ja</option>
                                    <option value="2" <?php echo checkIfSelected( 'header_titles', 2) ?> >nee</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <?php submit_button(); ?>

            <div class="admin-table">

                <h3 class="customH3">Google API's</h3>

                <div class="row">
                    
                    <div class="col-xs-12 col-sm-6">
                        
                        <div class="row">
                            <div class="col-xs-5">
                                Google API key
                            </div>
                            <div class="col-xs-7">
                                <input name="googleAPIkey" value="<?php echo get_option('googleAPIkey') ?>">                            
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-5">
                                Google maps JSON color
                            </div>
                            <div class="col-xs-7">
                                <textarea name="googlemapsjson" style="width:100%; height: 200px;"><?php echo get_option('googlemapsjson') ?></textarea>                            
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php submit_button(); ?>

            <div class="admin-table">
                <h3 class="customH3">Child Thema opties</h3>
                <?php echo do_action('templateChildThemeOptions'); ?>
            </div>
            <?php submit_button(); ?>

        </form>
    </div>
</div>