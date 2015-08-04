<?php

namespace snv\Theme;

class ContentHeader
{

    public function __construct()
    {
        $this->contentHeaderCustomField('page');
        $this->contentHeaderCustomField('post');

        add_action('contentheader', array($this, 'setHeader'));
    }

    // wp hack call for init
    public function theInit()
    {

    }

    /* returns the header by echoing */
    public function setHeader()
    {
        global $post;
        $id = $post->ID;

        // get the meta data
        $meta = get_post_meta($id);
        if (!isset($meta['_header_type'])) {
            return '<div class="paginaHeader"></div>';
        }

        $header = $meta['_header_type'][0];
        
        // set the content if option is enabled
        $content = '';
        if(isset($meta['_header_titel']) && isset($meta['_header_subtitel']) ) {
            $titel = $meta['_header_titel'][0];
            $titelAls = $meta['_header_titelals'][0];
            $subtitel = $meta['_header_subtitel'][0];
            $subtitelAls = $meta['_header_subtitelals'][0];

            
            if (!empty($titel) || !empty($subtitel)) {
                $content = '<div class="paginaHeaderContent">';
                if(!empty($titel)) {
                    if(empty($titelAls)){
                        $titelAls = 'div';
                    }
                    $content .= '<'.$titelAls.' class="paginaHeaderContentTitel">' .$titel . '</' .$titelAls. '>';
                }
                if(!empty($subtitel)) {
                    if(empty($subtitelAls)){
                        $subtitelAls = 'div';
                    }
                    $content .= '<'.$subtitelAls.'  class="paginaHeaderContentSubtitel">' .$subtitel . '</' .$subtitelAls. '>';
                }
                $content.= '</div>';
            }
        }

        $returnString = '<div class="paginaHeader">';
        if ($header === 'image') {
            $image = $meta['_header_image'][0];
            if (!empty($image)) {
                $image_url_large = wp_get_attachment_image_src($image, 'header-image-large');
                $image_url_medium = wp_get_attachment_image_src($image, 'header-image-medium');
                $image_url_small = wp_get_attachment_image_src($image, 'header-image-small');
                $returnString .= '
                <!--[if !IE]><!-->
                    <picture>
                        <source srcset="' . $image_url_large[0] . '" media="(min-width: 1000px)">
                        <source srcset="' . $image_url_medium[0] . '" media="(min-width: 500px)">
                        <img src="' . $image_url_small[0] . '" alt="' . get_post_meta($image, '_wp_attachment_image_alt', true) . '">
                    </picture>
                <!--<![endif]-->
                <!--[if IE]>
                    <img src="' . $image_url_small[0] . '" alt="' . get_post_meta($image, '_wp_attachment_image_alt', true) . '">
                <![endif]-->';
            }
            
        } else if ($header === 'shortcode') {
            $shortcode = $meta['_header_shortcode'][0];
            $returnString .= do_shortcode($shortcode);
        } else if ($header === 'video') {
            $video_url = $meta['_header_video'][0];
            if(!empty($video_url)) {
                $extension = explode('.', $video_url);
                $extension = $extension[count($extension)-1];
                if(strtolower($extension) === 'mp4'){
                    $returnString .= '<video id="headerVideo" autoplay="autoplay" loop="loop" muted="muted"><source src="'. $video_url .'" type="video/mp4"></video>';
                } else{
                    $returnString .= '<div class="container"><div class="row"><div style="padding-top:50px;padding-bottom:50px;" class="col-xs-12 col-md-8 col-md-offset-2"><div class="alert alert-danger" role="alert">Header: Alleen .mp4 bestanden worden ondersteund, selecteer een ander bestand.</div></div></div></div>';
                }
            }
        }

        $returnString .= $content;

        $returnString .= '</div>';

        echo $returnString;
    }

    /* creates the extra custom fields */
    public function contentHeaderCustomField($post_type)
    {

        $title = null;
        $titleAs = null;
        $subtitle = null;
        $subtitleAs = null;
        if(HEADER_TITLES) :
            $title = array(
                        'name' => 'titel',
                        'label' => 'Titel',
                        'description' => 'Selecteer afbeelding',
                        'type' => 'text',
                    );
            $titleAs = array(
                        'name' => 'titelals',
                        'label' => 'titel als :',
                        'description' => 'Hoe moet de titel worden weergegeven',
                        'type' => 'select',
                        'options' => array(
                            'div' => 'div',
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'h5' => 'H5',
                            'h6' => 'H6'
                        ),
                        'default_value' => 'div'
                    );
            $subtitle = array(
                        'name' => 'subtitel',
                        'label' => 'Subtitel',
                        'description' => 'Welke subtitel wil je weergeven',
                        'type' => 'text',
                    );
            $subtitleAs = array(
                        'name' => 'subtitelals',
                        'label' => 'Subtitel als :',
                        'description' => 'Hoe moet de subtitel worden weergegeven',
                        'type' => 'select',
                        'options' => array(
                            'div' => 'div',
                            'h1' => 'H1',
                            'h2' => 'H2',
                            'h3' => 'H3',
                            'h4' => 'H4',
                            'h5' => 'H5',
                            'h6' => 'H6'
                        ),
                        'default_value' => 'div'
                    );
        endif;



        // create metaBox with select option
        $page = register_cuztom_post_type($post_type);
        $page->add_meta_box(
            'header',
            'Page Header Options',
            array(
                array(
                    'name' => 'type',
                    'label' => 'type header',
                    'description' => 'selecteer het type header',
                    'type' => 'select',
                    'options' => array(
                        'noHeader' => 'Geen header',
                        'image' => 'Afbeelding',
                        'shortcode' => 'Shortcode',
                        'video' => 'Video',
                    ),
                ),
                array(
                    'name' => 'shortcode',
                    'label' => 'shortcode',
                    'description' => 'geef de shortcode in ',
                    'type' => 'text',
                ),
                array(
                    'name' => 'image',
                    'label' => 'image',
                    'description' => 'Selecteer afbeelding',
                    'type' => 'image',
                ),
                array(
                    'name' => 'video',
                    'label' => 'Video',
                    'description' => 'Selecteer afbeelding',
                    'type' => 'file',
                ),
                $title,
                $titleAs,
                $subtitle,
                $subtitleAs,
            )
        );
    }
}
