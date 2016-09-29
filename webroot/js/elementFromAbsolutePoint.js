(function() {
  var api;
  api = function(x,y) {
    var elm, scrollX, scrollY, newX, newY;
    /* Stash current Window Scroll */
    scrollX = window.pageXOffset;
    scrollY = window.pageYOffset;
    /* Scroll to element */
    window.scrollTo(x,y);
    /* Calculate new relative element coordinates */
    newX = x - window.pageXOffset;
    newY = y - window.pageYOffset;
    /* Grab the element */
    elm = this.elementFromPoint(newX,newY);
    /* revert to the previous scroll location */
    window.scrollTo(scrollX,scrollY);
    /* returned the grabbed element at the absolute coordinates */
    return elm;
  };
  this.document.elementFromAbsolutePoint = api;
}).call(this);
