<?php // standard sidebar ?>

<?php // latest 3 posts ?>
<?php $posts = get_posts( array('posts_per_page' => 5,'post_type' => 'post')); ?>
<section class="sidebarBlock">
    <h4>Laatste berichten</h4>
    <?php foreach ($posts as $post):  ?>
       <ul>
          <li><a href="<?php echo $post->guid ?>" title="<?php echo $post->post; ?>"><?php echo $post->post_title ?></a></li>
      </ul>
  <?php endforeach; ?>
</section>

<?php // contact form ?>
<section class="sidebarBlock">
    <h4>Kom in contact</h4>
    <div>
        <?php echo do_shortcode('[contactinfo]'); ?>
    </div>

    <h4>Deel deze pagina</h4>
    <div>
      <?php echo do_shortcode('[sharebuttons]' ); ?>
    </div>

</section>