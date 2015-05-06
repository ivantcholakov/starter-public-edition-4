<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <style type="text/css">

        @media print {

            /* We don't need a responsive grid while printing. */
            .container, .container-fluid {
                width: 768px;
            }

            /* Get rid of the href values. */
            a[href]:after {
                content: none !important;
            }
        }

        @page {
            size: A4;
            margin: 20mm;

            /* 06-MAY-2015: The following styles are not supported yet. */
            /* See http://en.wikipedia.org/wiki/Comparison_of_layout_engines_(Cascading_Style_Sheets) */
            @top-center {
                content: '<span style="color=red;">Printable Header</span>';
            }
            ;
            @bottom-center {
                content: '<span style="color=red;">Printable Footer</span>';
            }
        }

    </style>
