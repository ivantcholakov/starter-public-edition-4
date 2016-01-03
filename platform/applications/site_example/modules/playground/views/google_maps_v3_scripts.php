<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/chosen/chosen.jquery.min.js');
echo js('lib/chosen-image/chosenImage.jquery.js');

?>

    <script type="text/javascript" src="<?php echo is_https() ? 'https:' : 'http:'; ?>//maps.google.com/maps/api/js"></script>

    <script type="text/javascript">
    //<![CDATA[

    var map;
    var map_marker;

    function refresh_map() {

        $.ajax({
            type: 'post',
            mode: 'queue',
            url: '<?php echo site_url('playground/google-maps-v3-ajax'); ?>',
            data: {
                country_id: $('#country_id').val()
            },
            success: function(data) {

                var position = new google.maps.LatLng(data.latitude, data.longitude);

                if (typeof map != 'object') {

                   var options = {
                        center: position,
                        zoom: data.zoom,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };

                    map = new google.maps.Map(document.getElementById('map_canvas'), options);

                } else {

                    map.setCenter(position);
                    map.setZoom(data.zoom);
                }

                if (typeof map_marker != 'object') {
                    map_marker = new google.maps.Marker({map: map, position: position});
                } else {
                    map_marker.setPosition(position);
                }

                map_marker.setVisible(data.found);

                if (data.found) {

                    $('#larger_map').html('<a href="' + data.link + '" target="_blank">' + <?php echo json_encode((string) $this->lang->line('ui_see_a_larger_map')); ?> + '</a>');
                    $('#larger_map').show();

                } else {

                    $('#larger_map').hide();
                    $('#larger_map').html('');
                }
            }
        });
    }

    $(function() {

        $('#country_id').chosenImage({
            disable_search: true,
            width: '100%'
        });

        $('#country_id').on('change', function() {
            refresh_map();
        });

        refresh_map();
    });

    //]]>
    </script>
