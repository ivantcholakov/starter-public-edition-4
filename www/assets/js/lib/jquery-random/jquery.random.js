/**
 * Assembled by Ivan Tcholakov, ivantcholakov@gmail.com, 19-JAN-2012.
 * License MIT, http://www.opensource.org/licenses/mit-license.php
 *
 * Usage:
 * var my_random_number = $.random.get();
 * var my_unique_id = $.random.uuid();
 *
 * The internal functions Mash() and Kybos() are based on original scripts from:
 * http://baagoe.com/en/RandomMusings/javascript/
 * Johannes Baagøe <baagoe@baagoe.com>, 2010
 */

"use strict";

jQuery.random = (function($) {

    function Mash() {
        var n = 0xefc8249d;

        var mash = function(data) {
            data = data.toString();
            for (var i = 0; i < data.length; i++) {
                n += data.charCodeAt(i);
                var h = 0.02519603282416938 * n;
                n = h >>> 0;
                h -= n;
                h *= n;
                n = h >>> 0;
                h -= n;
                n += h * 0x100000000; // 2^32
            }
            return (n >>> 0) * 2.3283064365386963e-10; // 2^-32
        };

        mash.version = 'Mash 0.9';
        return mash;
    }

    function Kybos() {
        return (function(args) {
            // Johannes Baagøe <baagoe@baagoe.com>, 2010
            var s0 = 0;
            var s1 = 0;
            var s2 = 0;
            var c = 1;
            var s = [];
            var k = 0;
            var j = 0;

            var mash = Mash();
            s0 = mash(' ');
            s1 = mash(' ');
            s2 = mash(' ');
            for (j = 0; j < 8; j++) {
                s[j] = mash(' ');
            }

            if (args.length == 0) {
                args = [+new Date];
            }
            for (var i = 0; i < args.length; i++) {
                s0 -= mash(args[i]);
                if (s0 < 0) {
                    s0 += 1;
                }
                s1 -= mash(args[i]);
                if (s1 < 0) {
                    s1 += 1;
                }
                s2 -= mash(args[i]);
                if (s2 < 0) {
                    s2 += 1;
                }
                for (j = 0; j < 8; j++) {
                    s[j] -= mash(args[i]);
                    if (s[j] < 0) {
                        s[j] += 1;
                    }
                }
            }

            var random = function() {
                var a = 2091639;
                k = s[k] * 8 | 0;
                var r = s[k];
                var t = a * s0 + c * 2.3283064365386963e-10; // 2^-32
                s0 = s1;
                s1 = s2;
                s2 = t - (c = t | 0);
                s[k] -= s2;
                if (s[k] < 0) {
                    s[k] += 1;
                }
                return r;
            };
            random.uint32 = function() {
                return random() * 0x100000000; // 2^32
            };
            random.fract53 = function() {
                return random() +
                    (random() * 0x200000 | 0) * 1.1102230246251565e-16; // 2^-53
            };
            random.addNoise = function() {
                for (var i = arguments.length - 1; i >= 0; i--) {
                    for (j = 0; j < 8; j++) {
                        s[j] -= mash(arguments[i]);
                        if (s[j] < 0) {
                            s[j] += 1;
                        }
                    }
                }
            };
            random.version = 'Kybos 0.9';
            random.args = args;
            return random;

        } (Array.prototype.slice.call(arguments)));
    }

    function random_integer(multiplier) {
        if (typeof(multiplier) == 'undefined' || !multiplier) {
            multiplier = 1;
        } else {
            multiplier = Math.floor(multiplier);
        }
        var random_generator = Kybos();
        return Math.floor(multiplier * random_generator());
    }

    function random_integer_between(min, max) {
        if (typeof(min) == 'undefined' || !min) {
            min = 0;
        } else {
            min = Math.floor(min);
        }
        if (typeof(max) == 'undefined' || !max) {
            max = 1;
        } else {
            max = Math.floor(max);
        }
        return min + random_integer(max - min + 1);
    }

    function uuid4() {
        var random_generator = Kybos();
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'
            .replace(/[xy]/g, function (c) {
                var v;
                var r = random_generator() * 16 | 0, v = c == 'x' ? r : r & 0x3 | 0x8;
                return v.toString(16);
            });
    }

    return {
        get: Kybos(),
        integer: random_integer,
        integer_between: random_integer_between,
        uuid: uuid4
    };

}(jQuery));
