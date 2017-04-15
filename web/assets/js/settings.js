if (window.location.hash && window.location.hash == '#_=_') {
  // for facebook oauth
  // https://developers.facebook.com/blog/post/552/
  // This week, we started adding a fragment #_=_ to the redirect_uri when this field is left blank. Please ensure that your app can handle this behavior

  if (window.history && history.pushState) {
    window.history.pushState("", document.title, window.location.pathname);
  } else {
    // Prevent scrolling by storing the page's current scroll offset
    var scroll = {
      top: document.body.scrollTop,
      left: document.body.scrollLeft
    };
    window.location.hash = '';
    // Restore the scroll offset, should be flicker free
    document.body.scrollTop = scroll.top;
    document.body.scrollLeft = scroll.left;
  }
}