<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

    <script type="text/javascript">
    //<![CDATA[

        $(function() {

            $("#ajax").on("click", function(evt) {

                evt.preventDefault();

                $.ajax({

                    url: $(this).attr("href"), // URL from the link that was clicked on.

                }).done(function (data) {

                    // The 'data' parameter is an array of objects that can be looped over.

                    alert(window.JSON.stringify(data));

                }).fail(function () {

                    alert('Oh no! A problem with the AJAX request!');
                });
            });
        });

    //]]>
    </script>
