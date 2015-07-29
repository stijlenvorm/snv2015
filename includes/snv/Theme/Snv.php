<?php

namespace snv\Theme;

class Snv
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'themeScripts'));
    }

    // wp hack call for init
    public function theInit()
    {

    }

    public function themeScripts()
    {
        // deregister some wp stuff
        wp_deregister_style('open-sans');
        wp_register_style('open-sans', false);
        wp_deregister_script('jquery');
        wp_deregister_script('jquery-migrate');

        if (get_option('jquery.stellar.js') == '1'|| !get_option('skrollr_js')) {
            wp_enqueue_script('stellar', get_template_directory_uri() . '/js/jquery.stellar.js', array('jquery' ), '1.0.0', true);
        }

        if (get_option('smoothscroll_js') == '1'|| !get_option('smoothscroll_js')) {
            wp_enqueue_script('smoothscroll', get_template_directory_uri() . '/js/SmoothScroll.js', array('jquery' ), '1.0.0', true);
        }

        // prepare data to be send to javascript, before script.js
        wp_register_script('script', get_template_directory_uri() . '/js/script.js', array('jquery'), '1.0.0', true);

        wp_register_script('jquery', get_template_directory_uri().'/js/jquery-1.11.3.min.js', array(), '1.0.0', false);
        wp_localize_script('script', 'MAPS_API_KEY', MAPS_API_KEY);
        wp_localize_script('script', 'MAPS_COLORS_JSON', get_option('googlemapsjson'));
        wp_enqueue_script('script');

        if (get_option('bootstrap_css') == '1' || !get_option('bootstrap_css')) {
            wp_enqueue_style('bootstrap', get_template_directory_uri().'/css/bootstrap.min.css', array(), '1.0', 'all');
        }
        
        if (get_option('font_awesome') == '1' || !get_option('font_awesome')) {
            wp_enqueue_style('font-awesome', get_template_directory_uri().'/css/font-awesome.min.css', array(), '1.0', 'all');
        }
        
        if (get_option('animate_css') == '1' || !get_option('animate_css')) {
            wp_enqueue_style('animate', get_template_directory_uri().'/css/animate.min.css', array(), '1.0', 'all');
        }

        if (get_option('jquery') == '1'|| !get_option('jquery')) {
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-migrate', get_template_directory_uri().'/js/jquery-migrate-1.2.1.min.js', array(), '1.0.0', false);
        }
        
        if (get_option('bootstrap_js') == '1'|| !get_option('bootstrap_js')) {
            wp_enqueue_script('bootstrap', get_template_directory_uri().'/js/bootstrap.min.js', array('jquery'), '1.0.0', false);
        }
        
        if (get_option('wow_js') == '1'|| !get_option('wow_js')) {
            wp_enqueue_script('wow', get_template_directory_uri() . '/js/wow.min.js', array('jquery' , 'bootstrap'), '1.0.0', true);
        }

        
        
    }
}
