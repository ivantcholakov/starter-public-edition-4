function bindEvent(element, type, handler) {
    if(element.addEventListener) {
        element.addEventListener(type, handler, false);
    } else {
        element.attachEvent('on'+ type, handler);
    }
}


function activateForgeCheckoutButton(e) {
    e = e || window.event;
    var button = e.target || e.srcElement;

    if(window.outerWidth > 500) {
        var iframe = document.createElement("iframe");
        iframe.id = "forge-checkout-overlay";
        iframe.src = button.href +"?type=embedded&redirect_to="+ window.location;
        iframe.width = "100%";
        iframe.height = "100%";
        iframe.allowtransparency = true;
        iframe.style.cssText = "background-color:transparent!important;border: none!important;display:block!important;overflow:hidden!important;margin:0px!important;padding:0px!important;position:fixed!important;left:0px!important;top:0px!important;width:100%!important;height:100%!important;z-index:999999!important;visibility:hidden;";
        iframe.onload = showForgeCheckoutiFrame;

        var body = document.getElementsByTagName('body')[0];
        body.appendChild(iframe);

        e.preventDefault();
        return false;
    } else {
        // Send the person to the hosted checkout form
    }
}


function showForgeCheckoutiFrame(e) {
    var iframe = document.getElementById('forge-checkout-overlay');
    iframe.style.visibility = "visible";
}


function initializeForgeButtonClick() {
    var all = document.querySelectorAll('a.activate-forge-checkout');
    for (var i=0; i < all.length; i++) {
        all[i].onclick = activateForgeCheckoutButton;
    }
}


bindEvent(window, 'load', function() {
    initializeForgeButtonClick();

    window.onmessage = function(e) {
        if(e.data && e.data == "close checkout") {
            setTimeout(function() {
                var iframe = document.getElementById('forge-checkout-overlay');
                iframe.parentNode.removeChild(iframe);
            }, 300);
        }
    }

});