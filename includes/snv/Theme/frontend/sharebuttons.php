<div id="share-buttons">


<?php 

$include = false;
if (!empty($atts['include'])) {
    $include = explode(',', $atts['include']);
}

$exclude = false;
if (!empty($atts['exclude'])) {
    $exclude = explode(',', $atts['exclude']);
}

$channels = array(
        'email' => 'mailto:?Subject=<?php echo str_replace(' ', '_', bloginfo('name')); ?>&amp;Body=I%20saw%20this%20and%20thought%20of%20you!%20"',
        'facebook' => "http://www.facebook.com/sharer.php?u=<?php echo site_url(); ?>",
        'twitter' => "https://twitter.com/share?url=<?php echo site_url(); ?>&amp;name=<?php echo str_replace(' ', '_', bloginfo('name')); ?>&amp;hashtags=<?php echo str_replace(' ', '_', bloginfo('name')); ?>",
        'linkedin' => "http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo site_url(); ?>",
        'pinterest' => "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());",
        'googleplus' => "https://plus.google.com/share?url=<?php echo site_url(); ?>",
        'reddit' => "http://reddit.com/submit?url=<?php echo site_url(); ?>&amp; title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>",
        'stumbleupon' => "http://www.stumbleupon.com/submit?url=<?php echo site_url(); ?>&amp; title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>",
        'tumblr' => "http://www.tumblr.com/share/link?url=<?php echo site_url(); ?>&amp;title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>",
    );

foreach ($channels as $name =>$link) {
    
    $toPrint = true;
    // included
    if () {

    } 
    // exclude
    else if () {

    }

    ?>
    <li><a class="sharebutton <?php echo $name ?>" href="<?php echo $link; ?>"></a></li>
    
}

?>

     <!-- Google+ -->
    <a class="" href="https://plus.google.com/share?url=<?php echo site_url(); ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
    </a>
    
    <!-- Reddit -->
    <a class="" href="http://reddit.com/submit?url=<?php echo site_url(); ?>&amp; title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
    </a>
    
    <!-- StumbleUpon-->
    <a class="" href="http://www.stumbleupon.com/submit?url=<?php echo site_url(); ?>&amp; title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/stumbleupon.png" alt="StumbleUpon" />
    </a>
    
    <!-- Tumblr-->
    <a class="" href="http://www.tumblr.com/share/link?url=<?php echo site_url(); ?>&amp;title=<?php echo str_replace(' ', '_', bloginfo('name')); ?>" target="_blank">
        <img src="https://simplesharebuttons.com/images/somacro/tumblr.png" alt="Tumblr" />
    </a>

</div>