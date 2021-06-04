/**
 * Check if browser is IE 11 or worse
 */

 function isBrowserIE() {
    var ua = window.navigator.userAgent; // Check the userAgent property of the window.navigator object
    var msie = ua.indexOf('MSIE '); // IE 10 or older
    var trident = ua.indexOf('Trident/'); //IE 11
    
    if (msie > 0 || trident > 0) { // If IE 11 or worse
        return true;
    }
    
    return false;
}

/**
 * Adds passive event listening to touch scrolling events
 * Lighthouse link for more info: https://developers.google.com/web/updates/2016/06/passive-event-listeners
 */

 function jQueryTouchEvents() {
    // Passive event listeners
    jQuery.event.special.touchstart = {
        setup: function( _, ns, handle ) {
            this.addEventListener("touchstart", handle, { passive: !ns.includes("noPreventDefault") });
        }
    };
    jQuery.event.special.touchmove = {
        setup: function( _, ns, handle ) {
            this.addEventListener("touchmove", handle, { passive: !ns.includes("noPreventDefault") });
        }
    };
}