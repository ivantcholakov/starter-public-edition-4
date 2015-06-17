<?php defined('BASEPATH') or exit('No direct script access allowed');

// See http://viralpatel.net/blogs/jquery-ajax-handling-unauthenticated-request-ajax/

?>

    <script type="text/javascript">
    //<![CDATA[
    $(function () {
        $(document).ajaxError(function(e, request) {
            if (request.status == 403) {
                //window.location.href = site_url + 'login';
                window.location.href = site_url + 'login?continue=' + encodeURIComponent(CURRENT_URL);
            }
        });
    });
    //]]>
    </script>
