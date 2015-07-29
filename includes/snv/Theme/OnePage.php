<?php

namespace snv\Theme;

class OnePage
{
    public function __construct()
    {
        $this->createCustomPostType();

        add_action('pageBlock', array($this, 'getCptBlock'), 10, 3);
        add_action('pageBlockContent', array($this, 'getCptContent'), 10, 1);
        add_action('template_redirect', array($this, 'redirectPost'));
    }

    // wp hack call for init
    public function theInit()
    {

    }

    public function createCustomPostType()
    {
        $cpt  = new \Cuztom_Post_Type('onepageblock', array(
            'has_archive'        => false,
            'supports'           => array( 'title', 'editor')
            ));

        $cpt->add_meta_box(
            'achtergrond',
            'set background for this block',
            array(
                array(
                    'name'          => 'position',
                    'label'         => 'Positie',
                    'description'   => 'gefixeert of scroll',
                    'type'          => 'select',
                    'options'       => array(
                        'fixed'       => 'fixed',
                        'parrallax'   => 'parrallax',
                        'scroll'      => 'scroll',
                        ),
                    ),
                array(
                    'name'          => 'image',
                    'label'         => 'Afbeelding',
                    'description'   => 'Selecteer afbeelding',
                    'type'          => 'image',
                    )
                )
        );
    }

    public function getCptBlock($id, $showTitle = true, $wrapper = array('type'=>'div','class'=>'pageBlock','container'=>true))
    {

        $post = $this->queryPosts(array($id));
        if (!isset($post[0])) {
            return false;
        }

        // set to article wrap for seo
        if ($showTitle && $wrapper['type'] == 'div') {
            $wrapper['type'] = 'article';
        }

        // get meta
        $title    = $post[0]->post_title;
        $content  = $post[0]->post_content;
        $back_pos = get_post_meta($post[0]->ID, '_achtergrond_position', true);
        $back_id  = get_post_meta($post[0]->ID, '_achtergrond_image', true);

        $back_src = '';
        if (isset($back_id)) {
            $back_src = wp_get_attachment_url($back_id);
        }

        $back_pos_append = '';
        if ($back_pos == 'fixed') {
            $back_pos_append = ' background-attachment:fixed; background-size: cover; ';
        }

        $wrapper_start = '<'.$wrapper['type'].' id="pageBlock_'.$id.'" class="'.$wrapper['class'].'" style="background: url('.$back_src.'); '.$back_pos_append.'">';
        if ($wrapper['container']) {
            $wrapper_start .= '<div class="container"><div class="inner">';
        }

        $wrapper_end = '';
        if ($wrapper['container']) {
             $wrapper_end = '</div></div>';
        }
        $wrapper_end .= '</'.$wrapper['type'].'>';

        $returnContent = '';
        if ($showTitle) {
            $returnContent .= '<h2>' . $title . '</h2>';
        }
        $returnContent .= $content;

        echo $wrapper_start . $returnContent . $wrapper_end;
    }

    public function getCptContent($id)
    {
        $post = $this->queryPosts(array($id));

        if (isset($post[0]) && isset($post[0]->post_content)) {
            echo  $post[0]->post_content;
            return true;
        }

        return false;
    }

    // redirects the single page to the homepage...
    public function redirectPost()
    {
        $queried_post_type = get_query_var('post_type');
        if (is_single() && 'onepageblock' ==  $queried_post_type) {
            wp_redirect(home_url(), 301);
            exit;
        }
    }

    private function queryPosts($ids)
    {
        return $post = get_posts(array(
            'post_type' => 'onepageblock',
            'posts_per_page' => 1,
            'include' => $ids,
            ));
    }
}
