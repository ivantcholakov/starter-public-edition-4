/**
* Ellipsis plugin (jQuery) - For when text is too l ...
*
* @fileOverview  A slightly smarter way of truncating text
* @author        Dan Beam <dan@danbeam.org>
* @param         {object} conf - configuration objects to override the defaults
* @return        {jQuery} an instance of jQuery with the original nodes
*
* Copyright (c) 2010 Dan Beam
* Licensed under the MIT License: http://www.opensource.org/licenses/mit-license.php
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
*/

(function ($) {

        // the allowable difference when comparing floating point numbers
    var fp_epsilon  = 0.01,

        // floating point comparison
        fp_equals   = function (a, b) { return Math.abs(a - b) <= fp_epsilon; },
        fp_greater  = function (a, b) { return a - b >= fp_epsilon; },
        fp_lesser   = function (a, b) { return a - b <= fp_epsilon; },

        // the name of the field we use to store .data() in
        dataKey     = 'ellipsis-original-text',

        // this is populated later if native support is available
        nativeRule  = false,

        // if these styles are already set, resetting them isn't that big of a deal (performance wise)
        nativeStyles = {
            'white-space'       : 'nowrap',
            'overflow'          : 'hidden'
        };
 
    // add this on all Y.Node instances (but only if imported
    $.fn.ellipsis = function (conf) {

        // augment our conf object with some default settings
        conf = $.extend({
            // end marker
            'ellipsis' : '\u2026',
                
            // for stuff we *really* don't want to wrap, increase this number just in case
            'fudge'    : 0,

            // target number of lines to wrap
            'lines'    : 1,

            // whether or not to remember the original text to able to de-truncate
            'remember' : true,

            // should we use native browser support when it exists? (on by default)
            'native'   : true
        }, conf || {});

        // console.log(conf);

        // iterate over all things in our collection
        return this.each(function () {

                // the element we're trying to truncate
            var $el = $(this),

                // original text
                originalText  = conf.remember && $el.data(dataKey) || $el.text(),

                // keep the current length of the text so far
                currentLength = originalText.length,
                
                // the number of characters to increment or decrement the text by
                charIncrement = currentLength,

                // copy the element so we can string length invisibly
                $clone = $(document.createElement($el[0].nodeName)),
          
                // some current values used to cache .getComputedStyle() accesses and compare to our goals
                lineHeight, targetHeight, currentHeight, lastKnownGood;

            // console.log($el.css('line-height'));
            // console.log($el.css('font-size'));

            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            // @ NOTE: I'm intentionally ignoring padding as .css('height') @
            // @ NOTE: and .css('width') both ignore this as well (I think) @
            // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@

            // copy styles to $clone object
            $clone.css({
                'overflow'      : 'hidden',   // just at first
                'position'      : 'absolute',
                'visibility'    : 'hidden',
                'bottom'        : '-10px',
                'right'         : '-10px',
                'display'       : 'block',
                'width'         : $el.css('width'),
                'fontSize'      : $el.css('font-size'),
                'fontFamily'    : $el.css('font-family'),
                'fontWeight'    : $el.css('font-weight'),
                'letterSpacing' : $el.css('letter-spacing')
            });

            // insert some sample text to get the line-height
            $clone.text('s');

            // unfortunately, we must insert into the DOM, :(
            $('body').append($clone);

            // get the computed height of node when only 1 line
            lineHeight = $clone.height();

            // quick case - if we have native support and the stars align
            if (nativeRule && conf['native'] && conf.lines == 1 && conf.ellipsis === '\u2026') {
                // set all the styles and terminate early by returning the set
                $el.css(nativeStyles);
                // this is needed to trigger the overflow in some browser (*cough* Opera *cough*)
                $el.css('height', lineHeight + 'px');
                // clean-up and return early
                $clone.remove();
                return;
            }

            // set overflow back to visible
            $clone.css('overflow', 'visible');

            // compute how high the node should be if it's the right number of lines
            targetHeight  = conf.lines * lineHeight;

            // insert original text so we can judge height
            $clone.text(originalText);

            // get computed height of $clone element
            currentHeight = $clone.height();

            // console.log('lineHeight', lineHeight);
            // console.log('currentHeight', currentHeight);
            // console.log('targetHeight', targetHeight);
            // console.log('originalText.length', originalText.length);
            // console.log('$clone.text().length', $clone.text().length);

            // quick sanity check
            if ((fp_lesser(currentHeight, targetHeight) || fp_equals(currentHeight, targetHeight)) && originalText.length === $el.text().length) {
                // console.log('no wrapping necessary!');
                $clone.remove();
                return;
            }
            
            // now, let's start looping through and slicing the text as necessary
            for (; charIncrement >= 1; ) {

                // increment decays by half every time 
                charIncrement = Math.floor(charIncrement / 2);

                // if the height is too big, remove some chars, else add some
                currentLength += fp_greater(currentHeight, targetHeight) ? -charIncrement : +charIncrement;
                
                // try text at current length
                $clone.text(originalText.slice(0, currentLength - conf.ellipsis.length) + conf.ellipsis);
                
                // compute the current height
                currentHeight = $clone.height();

                // we only want to store values that aren't too big
                if (fp_lesser(currentHeight, targetHeight) || fp_equals(currentHeight, targetHeight)) {
                    lastKnownGood = currentLength;
                }

                // console.log('currentLength', currentLength);
                // console.log('currentHeight', currentHeight);
                // console.log('targetHeight' , targetHeight );
                // console.log('charIncrement', charIncrement);
                // console.log('lastKnownGood', lastKnownGood);

            }

            // remove from DOM
            $clone.remove();
            
            // remember the original text before it's munged
            if (conf.remember && !$el.data(dataKey)) {
                $el.data(dataKey, originalText);
            }

            // if the text matches
            if (originalText.length === ($clone.text().length - conf.ellipsis.length)) {
                // this means we *de-truncated* and can fit fully in the new space
                // console.log('de-truncated!');
                $el.text(originalText);
            }
            // this should NEVER happen, but doesn't hurt to check...
            else if ('undefined' !== typeof lastKnownGood) {
                // do this thing, already!
                $el.text(originalText.slice(0, lastKnownGood - conf.ellipsis.length - conf.fudge) + conf.ellipsis);
            }

        });

    };

    // innocent until proven guilty
    $.extend({'ellipsis':{'nativeSupport' : false}});

    // do a quick feature test to see if we're natively supported
    $(function () {

        // a hidden node we're testing
        var hidden      = $('<div style="visibility:hidden;position:absolute;white-space:nowrap;overflow:hidden;"></div>'),

            // give any possible rules that would give native support (omit -ms-text-overflow - does the same thing)
            nativeRules = ['text-overflow', '-o-text-overflow'];

        // add each of the prospective native rules
        $(nativeRules).each(function (i, rule) {
            hidden.css(rule, 'ellipsis');
        });

        // add to <body> when DOM is ready
        $('body').append(hidden);

        // deep clone the node (include attributes)
        var cloned = hidden.clone(true);

        // check to see which survived
        $(nativeRules).each(function (i, rule) {
            if ('ellipsis' === $(cloned).css(rule)) {
                nativeRule = rule;
                nativeStyles[nativeRule] = 'ellipsis';
                $.ellipsis.nativeSupport = true;
                return false;
            }
        });

        // clean-up
        hidden.remove();
        cloned = hidden = null;

    });

})(jQuery);
