;;(function($) {

    $.fn.chosenImage = function(options) {

        return this.each(function() {

            var $select = $(this),
                imgMap  = {};


            // Added by Ivan Tcholakov, 27-OCT-2014.
            // 0. Assign a random id (if there is no any) to the form field.
            if (typeof $select.attr('id') === 'undefined') {
                $select.attr('id', generate_random_id());
            }
            //

            // 1. Retrieve img-src from data attribute and build object of image sources for each list item
            $select.find('option').filter(function(){
                return $(this).text();
            }).each(function(i) {
                    var imgSrc   = $(this).attr('data-img-src');
                    imgMap[i]    = imgSrc;
            });


            // 2. Execute chosen plugin
            $select.chosen(options);

            // Modified by Ivan Tcholakov, 27-OCT-2014.
            // 2.1 update (or create) div.chzn-container id
            //var chzn_id = $select.attr('id').length ? $select.attr('id').replace(/[^\w]/g, '_') : this.generate_field_id();
            //chzn_id += "_chzn";
            // 2.1 update (or create) div.chosen-container id
            var container_id = $select.attr('id').replace(/[^\w]/g, '_') + '_chosen';
            //

            // Modified by Ivan Tcholakov, 27-OCT-2014.
            //var  chzn      = '#' + chzn_id,            
            //    $chzn      = $(chzn).addClass('chznImage-container');
            var container = '#' + container_id;
            var $container = $(container);
            $container.addClass('chosenImage-container');
            //


            // 3. Style list with image sources
            // Modified by Ivan Tcholakov, 27-OCT-2014.
            //$chzn.find('.chzn-results li').each(function(i) {
            //    $(this).css(cssObj(imgMap[i]));
            //});
            $select.on('chosen:showing_dropdown', function() {
                setTimeout(function() {
                    $container.find('.chosen-results li').each(function(i) {
                        $(this).css(cssObj(imgMap[i]));
                    });
                }, 80);
            });
            //


            // 4. Change image on chosen selected element when form changes
            $select.change(function() {
                var imgSrc = ($select.find('option:selected').attr('data-img-src')) 
                                ? $select.find('option:selected').attr('data-img-src') : '';
                // Modified by Ivan Tcholakov, 27-OCT-2014.
                //$chzn.find('.chzn-single span').css(cssObj(imgSrc));
                $container.find('.chosen-single span').css(cssObj(imgSrc));
                //
            });

            $select.trigger('change');


            // Utilties
            function cssObj(imgSrc) {
                if(imgSrc) {
                    return {
                        'background-image': 'url(' + imgSrc + ')',
                        'background-repeat': 'no-repeat'
                    }
                } else {
                    return {
                        'background-image': 'none'
                    }
                }
            }

            // Added by Ivan Tcholakov, 27-OCT-2014.
            function generate_random_char() {
                var chars, newchar, rand;
                chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                rand = Math.floor(Math.random() * chars.length);
                return newchar = chars.substring(rand, rand + 1);
            }
            //

            // Added by Ivan Tcholakov, 27-OCT-2014.
            function generate_random_id() {
                var string;
                string = "sel" + generate_random_char() + generate_random_char() + generate_random_char();
                while ($("#" + string).length > 0) {
                    string += generate_random_char();
                }
                return string;
            }
            //

        });
    }

})(jQuery);
