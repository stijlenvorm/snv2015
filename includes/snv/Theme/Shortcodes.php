<?php
namespace snv\Theme;

/**
 * class for all shortcodes used in the theme
 */
class Shortcodes
{
    public function __construct()
    {
        add_shortcode('googlemaps', array($this, 'googleMapsShortcode'));
        add_shortcode('staticmap', array($this, 'googleMapsStatic'));
        add_shortcode('contactinfo', array($this, 'contactInfo'));
        add_shortcode('socialbuttons', array($this, 'socialButtons'));
        add_shortcode('sharebuttons', array($this, 'sharebuttons'));
        add_shortcode('childpages', array($this, 'childPages'));
        add_shortcode('button', array($this, 'button'));
        add_shortcode('counter', array($this, 'counterBox'));
        add_shortcode('pageblock', array($this, 'pageBlock'));
        // counter circle

    }

    // wp hack call for init
    public function theInit()
    {

    }

    // print the title, content and readmore button for the given page
    public function pageBlock($atts)
    {
        // attritbute setup
        $atts = shortcode_atts(array(
            'class' => '',
            'buttonclass' => 'btn btn-primary',
            'pageid' => null,
            'header' => 'h2',
            'length' => 200,
            'buttonlabel' => 'lees meer', 
        ), $atts);

        if($atts['pageid'] === null || !is_numeric($atts['pageid'])) {
            return false;
        }

        $post = get_post($atts['pageid']);
        if ($post) {
            $title = '<' . $atts['header'] . '>' . $post->post_title . '</'.$atts['header'] . '>' ;
            $exerpt = '<p>' . substr($post->post_content, 0, $atts['length']) . '</p>';
            $readMore = '<p class="ctaHolder"><a class="'.$atts['buttonclass'].'" href="'.$post->guid.'">'.$atts['buttonlabel'] . '</a></p>';

            return '<div class="pageBlock">' . $title . $exerpt . $readMore . '</div>'; 
        }

        return false;
    }
    // create a counter
    public function counterBox($atts)
    {
        // attritbute setup
        $atts = shortcode_atts(array(
            'class' => '',
            'start' => '0',
            'end' => null,
            'title' => '',
            'speed' => '20',
            'step' => '1'
        ), $atts);

        if ($atts['end'] === null) {
            return false;
        }

        return '<div class="counterBox '.$atts['class'].'" data-start="'.$atts['start'].'" data-end="'.$atts['end'].'" data-title="'.$atts['title'].'" data-speed="'.$atts['speed'].'" data-step="'.$atts['step'].'"></div>';
    }

    // call to action button
    public function button($atts)
    {
        // attritbute setup
        $atts = shortcode_atts(array(
            'label' => 'geef een label op!',
            'link' => '#',
            'target' => '_self',
            'class' => '',
        ), $atts);
        $atts['link'] = str_replace('http://', '//', $atts['link']);
        $atts['link'] = str_replace('https://', '//', $atts['link']);

        return '<a class="btn btn-cta '.$atts['class'].'" href="'.$atts['link'].'" target="'.$atts['target'].'">'.$atts['label'].'</a>';
    }

    // for showing childpages
    public function childPages($atts)
    {
        global $post;

        // attritbute setup
        $atts = shortcode_atts(array(
            'type' => 'list',
            'col' => 'col-xs-6 col-sm-3',
            'imagesize' => 'thumbnail',
            'max' => -1,
            'post_status' => 'publish',
            'post_type' => 'any',
        ), $atts);

        // get data
        $children = get_children(array(
            'number_post' => $atts['max'],
            'post_parent' => $post->ID,
            'post_type' => $atts['post_type'],
        ));

        // setup the header
        if ($atts['type'] === 'list') {
            $rs = '<ul class="childPageUl">';
        } else if ($atts['type'] === 'block') {
            $rs = '<div class="row">';
        }

        // the content
        foreach ($children as $child) {

            if ($atts['type'] === 'list') {
                $rs .= '<li id="childpage_'.$child->ID.'" class="childPageLi">';
                $rs .= '<a href="' . $child->guid . '">' . $child->post_title . '</a>';
                $rs .= '</li>';
            } else if ($atts['type'] === 'block') {
                $thumb_url = '';
                if (has_post_thumbnail($child->ID)) {
                    $thumb_url = wp_get_attachment_image_src( get_post_thumbnail_id($child->ID), $atts['imagesize'])[0];
                }
                $rs .= '<a href="'.$child->guid.'">';
                $rs .= '<div class="childPageBlock '.$atts['col'].'" id="childpage_'.$child->ID.'">';
                $rs .= '<div class="childPageBlockInner" style="background: url('.$thumb_url.'); background-size: cover;">';
                $rs .= '<div class="childPageBlockLabel">'.$child->post_title. '</div>';
                $rs .= '</div>';
                $rs .= '</div>';
                $rs .= '</a>';
            }
        }

        // the footer
        if ($atts['type'] === 'list') {
            $rs .= '</ul>';
        } else if ($atts['type'] === 'block') {
            $rs .= '</div>';
        }

        // time to return
        return $rs;
    }

    // register shortcode for google maps in header
    public function googleMapsShortcode($atts)
    {
        $atts = shortcode_atts(array(
            'lat' => null,
            'lng' => null,
            'adres' => null,
            'postcode' => null,
            'canvas' => 'mapsHeader_canvas',
            'label' => 'onze locatie',
            'zoom' => '15',
            'scrollwheel' => 'false',
            'disableDefaultUI' => 'true',
        ), $atts);

        $script = '<script type="text/javascript">';

        // enque the script
        wp_enqueue_script('maps-key', '//maps.googleapis.com/maps/api/js?key=' . MAPS_API_KEY . '&amp;sensor=false', array(), '1.0.0', true);

        if ($atts['lat'] != null && $atts['lng'] != null) {
            // use the given lat and long to render the map
            $script .= "jQuery(document).ready(function($) {
                var gMaps = new GoogleMaps();

                gMaps.renderMap('" . $atts['canvas'] . "', '" .
            $atts['lat'] . "', '" .
            $atts['lng'] . "', '" .
            $atts['label'] . "', '" .
            $atts['disableDefaultUI'] . "', '" .
            $atts['scrollwheel'] . "', '" .
            $atts['zoom'] . "' );
                });";
        } else if ($atts['adres'] != null && $atts['postcode'] != null) {
            $script .= "jQuery(document).ready(function($) {
                var gMaps = new GoogleMaps();
                gMaps.geocode('" . str_replace(' ', '+', get_option('adres')) . "', '" . str_replace(' ', '', get_option('adres')) . "', '" . $atts['canvas'] . "' , '" . $atts['label'] . "' , true);
            });";
        } else {
            // check if lat/lon ar filled in
            if (!get_option('latitude') || !get_option('longitude')) {
                $url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . str_replace(' ', '+', get_option('adres')) . '+' . str_replace(' ', '+', get_option('postcode')) . '&key=' . MAPS_API_KEY;
                $geocode = file_get_contents($url);

                $output = json_decode($geocode);

                $lat = $output->results[0]->geometry->location->lat;
                $lng = $output->results[0]->geometry->location->lng;
                update_option('latitude', $lat);
                update_option('longitude', $lng);

                //use the lat/lon form the information page
                $script .= "jQuery(document).ready(function($) {
                    var gMaps = new GoogleMaps();
                    gMaps.geocode('" . str_replace(' ', '+', get_option('adres')) . "', '" . str_replace(' ', '', get_option('postcode')) . "', '" . $atts['canvas'] . "' , '" . $atts['label'] . "' , true);
                });";
            } else {
                // use the given lat and long to render the map
                $script .= "jQuery(document).ready(function($) {
                    var gMaps = new GoogleMaps();
                    gMaps.renderMap('" .
                $atts['canvas'] . "', '" .
                get_option('latitude') . "', '" .
                get_option('longitude') . "', '" .
                $atts['label'] . "', '" .
                $atts['disableDefaultUI'] . "', '" .
                $atts['scrollwheel'] . "', '" .
                $atts['zoom'] . "' );
            });";
            }
        }

        $script .= "</script>";
        return '<div id="mapsHeader_canvas">Vul de correcte adres gegevens in...</div>' . $script;
    }

    // load a static map
    public function googleMapsStatic($atts)
    {
        if (empty($atts['center'])) {
            return false;
        }

        if (empty($atts['height'])) {
            $atts['height'] = '640';
        }
        if (empty($atts['width'])) {
            $atts['width'] = '640';
        }
        if (empty($atts['zoom'])) {
            $atts['zoom'] = '15';
        }

        $height = $atts['height'];
        $width = $atts['width'];
        $zoom = $atts['zoom'];
        $center = htmlspecialchars(strtolower(trim($atts['center'])));
        return '<img src="https://maps.googleapis.com/maps/api/staticmap?center=' . $center . '&zoom=' . $zoom . '&size=' . $width . 'x' . $height . '&markers=' . $center . '" alt="google static map">';
    }

    // load a UL list of all given contact info
    public function contactInfo($atts)
    {
        $adres = get_option('adres');
        $postcode = get_option('postcode');
        $woonplaats = get_option('woonplaats');
        $tel = get_option('telefoon');
        $mail = get_option('email');

        $smOptions = explode(',', SOCIAL_MEDIA_OPTIONS);

        $class = '';
        if (!empty($atts['class'])) {
            $class = $atts['class'];
        }

        $ra_start = '<ul class="contactInfo ' . $class . '">';
        $ra_end = '</ul>';
        $ra = array(
            'adres' => '<li class="adres">' . $adres . '</li>' . '<li class="adres2">' . $postcode . ' ' . $woonplaats . '</li>',
            'tel' => '<li class="tel">' . $tel . '</li>',
            'mail' => '<li class="mail"><a href="mailto:' . $mail . '">' . $mail . '</a></li>',
        );

        foreach ($smOptions as $socialChannel) {
            $option = get_option($socialChannel);
            if ($option == true && $option !== '') {
                $option = str_replace('http://', '', $option);
                $option = str_replace('https://', '', $option);
                $ra[$socialChannel] = '<li class="social ' . $socialChannel . '"><a href="//' . $option . '" title="' . $socialChannel . ' pagina" target="_blank">' . $socialChannel . '</a></li>';
            }
        }

        if (!empty($atts['include'])) {
            $items = explode(',', $atts['include']);
            $rs = $ra_start;
            foreach ($items as $item) {
                // trim and lower
                $item = strtolower(trim($item));
                
                foreach ($ra as $name => $returnItem) {
                    if ($item == $name) {
                        $rs .= $returnItem;
                    }
                }
            }
            $rs .= $ra_end;

        } else if (!empty($atts['exclude'])) {
            $items = explode(',', $atts['exclude']);
            $rs = $ra_start;
            foreach ($ra as $name => $returnItem) {
                $toPrint = true;
                foreach ($items as $item) {
                    // trim and lower
                    $item = strtolower(trim($item));    
                    if ($item == $name) {
                        $toPrint = false;
                    }
                }
                if ($toPrint) {
                    $rs .= $returnItem;
                }
            }
            $rs .= $ra_end;
           

        } else {
            $rs = $ra_start;
            foreach ($ra as $name => $returnItem) {
                $rs .= $returnItem;
            }
            $rs .= $ra_end;
        }

         return $rs;
    }

    // list off all filled in social media channels
    public function socialButtons($atts)
    {
         $atts = shortcode_atts(array(
            'class' => '',
            'include' => null,
            'exclude' => null,
        ), $atts);

        $rs = '<ul class="socialButtons '.$atts['class'].'">';
        $smOptions = explode(',', SOCIAL_MEDIA_OPTIONS);

        if (!empty($atts['include'])) {
            $items = explode(',', $atts['include']);
            foreach ($smOptions as $socialChannel) {
                $option = get_option($socialChannel);
                $load = false;
                foreach ($items as $item) {
                    if ($socialChannel == $item) {
                        $load = true;
                    }
                }
                if ($load) {
                    if ($option == true && $option !== '') {
                        $option = str_replace('http://', '', $option);
                        $option = str_replace('https://', '', $option);
                        $rs .= '<li><a target="_blank" class="socialButton ' . $socialChannel . '" href="//' . $option . '"></a></li>';
                    }
                }
            }
        } else if (!empty($atts['exclude'])) {
            $items = explode(',', $atts['exclude']);
            foreach ($smOptions as $socialChannel) {
                $option = get_option($socialChannel);
                $load = true;
                foreach ($items as $item) {
                    if ($socialChannel == $item) {
                        $load = false;
                    }
                }
                if ($load) {
                    if ($option == true && $option !== '') {
                        $option = str_replace('http://', '', $option);
                        $option = str_replace('https://', '', $option);
                        $rs .= '<li><a target="_blank" class="socialButton ' . $socialChannel . '" href="//' . $option . '"></a></li>';
                    }
                }
            }
        } else {
            foreach ($smOptions as $socialChannel) {
                $option = get_option($socialChannel);
                if ($option == true && $option !== '') {
                    $option = str_replace('http://', '', $option);
                    $option = str_replace('https://', '', $option);
                    $rs .= '<li><a target="_blank" class="socialButton ' . $socialChannel . '" href="//' . $option . '"></a></li>';
                }
            }
        }

        $rs .= '</ul>';
        return $rs;
    }

    // list of buttons to share the page or its content
    public function sharebuttons($atts)
    {

        $class = '';
        if (!empty($atts['class'])) {
            $class = $atts['class'];
        }

        $include = false;
        if (!empty($atts['include'])) {
            $include = explode(',', $atts['include']);
        }

        $exclude = false;
        if (!empty($atts['exclude'])) {
            $exclude = explode(',', $atts['exclude']);
        }

        $channels = array(
            'email' => "mailto:?Subject=" . urlencode(get_bloginfo('name') . ': ' . get_the_title()) . "&amp;Body=" . urlencode("dit kwam ik tegen op " . get_bloginfo('name') . ": http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"),
            'facebook' => "http://www.facebook.com/sharer.php?u=" . site_url(),
            'twitter' => "https://twitter.com/share?url=" . site_url() . "&amp;name=" . str_replace(' ', '_', get_bloginfo('name')) . "&amp;hashtags=" . str_replace(' ', '_', get_bloginfo('name')),
            'linkedIn' => "http://www.linkedin.com/shareArticle?mini=true&amp;url=" . site_url(),
            'pinterest' => "javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());",
            'googleplus' => "https://plus.google.com/share?url=" . site_url(),
            'reddit' => "http://reddit.com/submit?url=" . site_url() . "&amp;title=" . str_replace(' ', '_', get_bloginfo('name')),
            'tumblr' => "http://www.tumblr.com/share/link?url=" . site_url() . "&amp;title=" . str_replace(' ', '_', get_bloginfo('name')),
        );
        $rs = '<ul class="sharebuttons ' . $class . '">';
        foreach ($channels as $name => $link) {

            $toPrint = true;

            // included
            if ($include) {
                $toPrint = false;
                foreach ($include as $item) {
                    if ($item == $name) {
                        $toPrint = true;
                    }
                }
            }

            // exclude
            else if ($exclude) {
                foreach ($exclude as $item) {
                    if ($item == $name) {
                        $toPrint = false;
                    }
                }
            }

            if ($toPrint) {
                $target = 'target=blank';
                if ($name === 'email') {
                    $target = '';
                }
                $rs .= '<li><a class="sharebutton ' . $name . '" href="' . $link . '" ' . $target . '></a></li>';
            }
        }
        $rs .= '</ul>';
        return $rs;
    }
}
