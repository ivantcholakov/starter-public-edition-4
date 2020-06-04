/*
 * This document is licensed as free software under the terms of the
 * MIT License: <a href="http://www.opensource.org/licenses/mit-license.php" title="http://www.opensource.org/licenses/mit-license.php">http://www.opensource.org/licenses/mit-license.php</a>
 *
 * Adapted by Rahul Singla.
 * http://www.rahulsingla.com/blog/2010/05/jquery-encode-decode-arbitrary-objects-to-and-from-json
 *
 * Brantley Harris wrote this plugin. It is based somewhat on the JSON.org
 * website's <a href="http://www.json.org/json2.js" title="http://www.json.org/json2.js">http://www.json.org/json2.js</a>, which proclaims:
 * "NO WARRANTY EXPRESSED OR IMPLIED. USE AT YOUR OWN RISK.", a sentiment that
 * I uphold.
 *
 * It is also influenced heavily by MochiKit's serializeJSON, which is
 * copyrighted 2005 by Bob Ippolito.
 */

/**
 * jQuery.JSON.encode( json-serializble ) Converts the given argument into a
 * JSON respresentation.
 *
 * If an object has a "toJSON" function, that will be used to get the
 * representation. Non-integer/string keys are skipped in the object, as are
 * keys that point to a function.
 *
 * json-serializble: The *thing* to be converted.
 */
jQuery.JSON = {
    encode: function(o) {
        if (typeof (JSON) == 'object' && JSON.stringify)
            return JSON.stringify(o);

        var type = typeof (o);

        if (o === null)
            return "null";

        if (type == "undefined")
            return undefined;

        if (type == "number" || type == "boolean")
            return o + "";

        if (type == "string")
            return this.quoteString(o);

        if (type == 'object') {
            if (typeof o.toJSON == "function")
                return this.encode(o.toJSON());

            if (o.constructor === Date) {
                var month = o.getUTCMonth() + 1;
                if (month < 10)
                    month = '0' + month;

                var day = o.getUTCDate();
                if (day < 10)
                    day = '0' + day;

                var year = o.getUTCFullYear();

                var hours = o.getUTCHours();
                if (hours < 10)
                    hours = '0' + hours;

                var minutes = o.getUTCMinutes();
                if (minutes < 10)
                    minutes = '0' + minutes;

                var seconds = o.getUTCSeconds();
                if (seconds < 10)
                    seconds = '0' + seconds;

                var milli = o.getUTCMilliseconds();
                if (milli < 100)
                    milli = '0' + milli;
                if (milli < 10)
                    milli = '0' + milli;

                return '"' + year + '-' + month + '-' + day + 'T' + hours + ':'
                        + minutes + ':' + seconds + '.' + milli + 'Z"';
            }

            if (o.constructor === Array) {
                var ret = [];
                for ( var i = 0; i < o.length; i++)
                    ret.push(this.encode(o[i]) || "null");

                return "[" + ret.join(",") + "]";
            }

            var pairs = [];
            for ( var k in o) {
                var name;
                var type = typeof k;

                if (type == "number")
                    name = '"' + k + '"';
                else if (type == "string")
                    name = this.quoteString(k);
                else
                    continue; // skip non-string or number keys

                if (typeof o[k] == "function")
                    continue; // skip pairs where the value is a function.

                var val = this.encode(o[k]);

                pairs.push(name + ":" + val);
            }

            return "{" + pairs.join(", ") + "}";
        }
    },

    /**
     * jQuery.JSON.decode(src) Evaluates a given piece of json source.
     */
    decode: function(src) {
        if (typeof (JSON) == 'object' && JSON.parse)
            return JSON.parse(src);
        return eval("(" + src + ")");
    },

    /**
     * jQuery.JSON.decodeSecure(src) Evals JSON in a way that is *more* secure.
     */
    decodeSecure: function(src) {
        if (typeof (JSON) == 'object' && JSON.parse)
            return JSON.parse(src);

        var filtered = src;
        filtered = filtered.replace(/\\["\\\/bfnrtu]/g, '@');
        filtered = filtered
                .replace(
                        /"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,
                        ']');
        filtered = filtered.replace(/(?:^|:|,)(?:\s*\[)+/g, '');

        if (/^[\],:{}\s]*$/.test(filtered))
            return eval("(" + src + ")");
        else
            throw new SyntaxError("Error parsing JSON, source is not valid.");
    },

    /**
     * jQuery.JSON.quoteString(string) Returns a string-repr of a string, escaping
     * quotes intelligently. Mostly a support function for JSON.encode.
     *
     * Examples: >>> jQuery.JSON.quoteString("apple") "apple"
     *
     * >>> jQuery.JSON.quoteString('"Where are we going?", she asked.') "\"Where
     * are we going?\", she asked."
     */
    quoteString: function(string) {
        if (string.match(this._escapeable)) {
            return '"' + string.replace(this._escapeable, function(a) {
                var c = this._meta[a];
                if (typeof c === 'string')
                    return c;
                c = a.charCodeAt();
                return '\\u00' + Math.floor(c / 16).toString(16)
                        + (c % 16).toString(16);
            }) + '"';
        }
        return '"' + string + '"';
    },

    _escapeable: /["\\\x00-\x1f\x7f-\x9f]/g,

    _meta: {
        '\b': '\\b',
        '\t': '\\t',
        '\n': '\\n',
        '\f': '\\f',
        '\r': '\\r',
        '"': '\\"',
        '\\': '\\\\'
    }
}
