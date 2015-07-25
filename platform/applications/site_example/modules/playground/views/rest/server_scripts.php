<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

    <script type="text/javascript">
    //<![CDATA[

        $(function() {

            $('#ajax').on('click', function (event) {

                event.preventDefault();

                $.ajax({

                    // URL from the link that was clicked on.
                    url: $(this).attr('href')

                }).done(function (data) {

                    // The 'data' parameter is an array of objects that can be looped over.

                    alert(JSON.stringify(data));

                }).fail(function () {

                    alert('Oh no! A problem with the Ajax request!');

                });
            });

        });

    //]]>
    </script>
