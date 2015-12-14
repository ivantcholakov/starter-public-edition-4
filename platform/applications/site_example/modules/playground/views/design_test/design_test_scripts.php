<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script>
    (function () {

        var $button = $("<div id='source-button' class='btn btn-primary btn-xs'>&lt; &gt;</div>").click(function () {
            var index = $('.bs-component').index($(this).parent());
            $.get(window.location.href, function (data) {
                var html = $(data).find('.bs-component').eq(index).html();
                html = cleanSource(html);
                $("#source-modal pre").text(html);
                $("#source-modal").modal();
            })

        });

        $('.bs-component [data-toggle="popover"]').popover();
        $('.bs-component [data-toggle="tooltip"]').tooltip();

        $(".bs-component").hover(function () {
            $(this).append($button);
            $button.show();
        }, function () {
            $button.hide();
        });

        function cleanSource(html) {
            var lines = html.split(/\n/);

            lines.shift();
            lines.splice(-1, 1);

            var indentSize = lines[0].length - lines[0].trim().length,
                    re = new RegExp(" {" + indentSize + "}");

            lines = lines.map(function (line) {
                if (line.match(re)) {
                    line = line.substring(indentSize);
                }

                return line;
            });

            lines = lines.join("\n");

            return lines;
        }

        $(".icons-material .icon").each(function () {
            $(this).after("<br><br><code>" + $(this).attr("class").replace("icon ", "") + "</code>");
        });

    })();

</script>

<script>
    $(function () {

    var slider_1 = document.getElementById('slider_1'),
        slider_2 = document.getElementById('slider_2'),
        slider_3 = document.getElementById('slider_3'),
        slider_4 = document.getElementById('slider_4'),
        slider_5 = document.getElementById('slider_5'),
        slider_6 = document.getElementById('slider_6');

        noUiSlider.create(slider_1, {
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        noUiSlider.create(slider_2, {
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        noUiSlider.create(slider_3, {
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        noUiSlider.create(slider_4, {
            orientation: "vertical",
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        noUiSlider.create(slider_5, {
            orientation: "vertical",
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

        noUiSlider.create(slider_6, {
            orientation: "vertical",
            start: 40,
            connect: "lower",
            range: {
                min: 0,
                max: 100
            }
        });

    });
</script>
