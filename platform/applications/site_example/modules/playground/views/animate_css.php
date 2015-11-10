<?php defined('BASEPATH') OR exit('No direct script access allowed');

echo css('lib/animate/animate.min.css');

?>

<style>

    /*-----------------------------------*\
      $LAYOUT
    \*-----------------------------------*/

    .wrap {
        max-width: 38rem;
        margin: 0 auto;
    }

    .island {
        padding: 1.5rem;
    }

    .isle {
        padding: .75rem;
    }

    .spit {
        padding: .375rem;
    }

    /*-----------------------------------*\
      $HEADER
    \*-----------------------------------*/

    .site__header {
        -webkit-animation: bounceInUp 1s;
    }

    .site__title {
        color: #f35626;
        background-image: -webkit-linear-gradient(92deg,#f35626,#feab3a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -webkit-animation: hue 60s infinite linear;
    }

    .site__content {
        -webkit-animation: bounceInUp 1s;
        -webkit-animation-delay: .1s;
    }

    .site__content form {
        -webkit-animation: bounceInUp 1s;
        -webkit-animation-delay: .1s;
    }

    /*-----------------------------------*\
      $ANIMATIONS
    \*-----------------------------------*/

    @-webkit-keyframes hue {
        from {
            -webkit-filter: hue-rotate(0deg);
        }

        to {
            -webkit-filter: hue-rotate(-360deg);
        }
    }

</style>
