/* 
 * 
 * all javascript inside the unnamed function pls, and use $ instead of jQuery here. 
 * 
 * variables from php given by Wordpress in functions.php:
 *
 * var gMaps_APIkey;     // API key used for google maps
 * var MAPS_COLORS_JSON  // 
 * var cInfo;            // array, stores all the contact data
 */


(function($) {

    $(document).ready(function() {
        counterBox();
        $(window).scroll(counterBox);
    });

    function counterBox() {
        var boxes = $('.counterBox').not('.hasCounted');
        $.each(boxes, function(index, val) {

            var currentScroll = $(window).scrollTop();
            var CounterBoxOffset = $(val).offset().top - $(window).height() + 100;

            if(currentScroll >= CounterBoxOffset) {

                var box = $(val);
                var start = box.attr('data-start');
                var end = box.attr('data-end');
                var title = box.attr('data-title');
                var counter = '<div class="counterBoxCounterHolder">' + start + '</div>';
                var title = '<div class="counterBoxTitleHolder">' + title + '</div>';


                var speed = parseInt(box.attr('data-speed'), 10);
                if (typeof speed === 'undefined' || isNaN(speed)) {
                    speed = 20;
                }

                var step = parseInt(box.attr('data-step'), 10);
                if (typeof step === 'undefined' || isNaN(step)) {
                    step = 1;
                }
                
                // set the html to start with
                box.html(counter + title);

                // create an interval for the numbers to appear
                var interval = setInterval(function() {
                    var counterBox = box.children('.counterBoxCounterHolder');
                    var currentVal = parseInt(counterBox.html(), 10);
                    if (currentVal >= parseInt(end, 10)) {
                        clearInterval(interval);
                    } else {
                        if(currentVal+step > parseInt(end, 10)){
                            counterBox.html(end);
                        } else {
                            counterBox.html(currentVal + step)
                        }
                    }
                }, speed);

                // set the box as 'counted'
                box.addClass('hasCounted');
            }
        });
    }

})(jQuery);

// all maps functions
function GoogleMaps() {
    var _this = this;

    // returns google maps latLng coordinates from the given adress
    this.geocode = function(adres, postcode, canvas, markerLabel, render, color_json, disableDefaultUI, scrollwheel, zoom) {

        if (typeof render == undefined) {
            render = false;
        }

        maps_address = adres.replace(' ', '+');
        maps_poscode = postcode.replace(' ', '');

        $.get('https://maps.googleapis.com/maps/api/geocode/json?address=' + adres + '+' + postcode + '&key=' + MAPS_API_KEY, function(data) {
            var location = data.results[0].geometry.location;
            if (render) {
                _this.renderMap(canvas, location.lat, location.lng, color_json, disableDefaultUI, scrollwheel, zoom);
            } else {
                return location;
            }
        });
    }

    // renders the map
    this.renderMap = function(canvas, lat, lng, markerLabel, disableDefaultUI, scrollwheel, zoom) {

        try {
            color_json = JSON.parse(MAPS_COLORS_JSON);
        } catch (e) {
            color_json = [];
        }
        console.log(color_json);

        if (typeof disableDefaultUI == 'undefined') {
            disableDefaultUI = true;
        }

        if (typeof zoom == 'undefined') {
            zoom = 15;
        }
        zoom = parseInt(zoom, 10);

        if (typeof scrollwheel == 'undefined') {
            scrollwheel = false;
        }
        if (scrollwheel == 'false') {
            scrollwheel = false;
        }
        if (scrollwheel == 'true') {
            scrollwheel = true;
        }

        var map;
        var marker_location = new google.maps.LatLng(lat, lng);

        var roadAtlasStyles = color_json;

        var mapOptions = {
            zoom: zoom,
            center: marker_location,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas'],
            },
            scrollwheel: scrollwheel,
            disableDefaultUI: disableDefaultUI
        }

        var map = new google.maps.Map(document.getElementById(canvas),
            mapOptions);

        var marker = new google.maps.Marker({
            position: marker_location,
            map: map,
            title: markerLabel
        });

        var usRoadMapType = new google.maps.StyledMapType(
            color_json, {});

        map.mapTypes.set('usroadatlas', usRoadMapType);
        map.setMapTypeId('usroadatlas');
    }
}
