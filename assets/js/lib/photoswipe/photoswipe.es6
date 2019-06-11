import PhotoSwipe from '../../node_modules/photoswipe/dist/photoswipe.js';
import PhotoSwipeUI_Default from '../../node_modules/photoswipe/dist/photoswipe-ui-default.js';

// Utility function
// See the plugin docs: http://photoswipe.com/documentation/getting-started.html
//
const initPhotoSwipeFromDOM = function(gallerySelector, galleryOptions, events, cb) {
  if (!$('.pswp').length) {
    $('body').append(
`<!-- PhotoSwipe Template -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="pswp__bg"></div>
  <div class="pswp__scroll-wrap">
    <div class="pswp__container">
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
      <div class="pswp__item"></div>
    </div>
    <div class="pswp__ui pswp__ui--hidden">
      <div class="pswp__top-bar">
        <div class="pswp__counter"></div>
        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
        <button class="pswp__button pswp__button--share" title="Share"></button>
        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

        <div class="pswp__preloader">
          <div class="pswp__preloader__icn">
            <div class="pswp__preloader__cut">
              <div class="pswp__preloader__donut"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
        <div class="pswp__share-tooltip"></div>
      </div>

      <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
      <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>

      <div class="pswp__caption">
        <div class="pswp__caption__center"></div>
      </div>
    </div>
  </div>
</div>
<!-- / PhotoSwipe Template -->`
    );
  }

  // parse slide data (url, title, size ...) from DOM elements
  function getItems() {
    var items = [];

    $(gallerySelector).find('figure a').each(function() {
      const $img  = $(this).find('img');
      const size  = this.getAttribute('data-size').split('x');
      const title = this.getAttribute('data-title');
      const item  = {
        src: this.getAttribute('href'),
        w: parseInt(size[0], 10),
        h: parseInt(size[1], 10)
      };

      if ($img.length > 0) { item.msrc = $img[0].getAttribute('src'); }
      if (title) { item.title = title; }

      item.el = $(this).parents('figure')[0]; // save link to element for getThumbBoundsFn

      items.push(item);
    });

    return items;
  };

  function getClickedItem(target) {
    return target.tagName.toUpperCase() === 'FIGURE' ? target : $(target).parents('figure')[0];
  }

  function getClickedItemIndex(clickedListItem) {
    if(!clickedListItem) { return null; }

    const $gallery = $(gallerySelector).find('figure');
    let curIndex = 0;
    let index    = null;

    $gallery.each(function() {
      if (this === clickedListItem) {
        index = curIndex;
      }
      curIndex++;
    });

    return index;
  }

  $(gallerySelector).on('click', 'figure a', function(e) {
    e.preventDefault();
    e.stopPropagation()

    const item  = getClickedItem(e.target);
    const index = getClickedItemIndex(item);

    if (index === null) { return; }

    const items   = getItems();
    const options = $.extend({}, galleryOptions, {
      index: index,
      getThumbBoundsFn: function(index) {
        const thumbnail   = $(items[index].el).find('img')[0];
        const pageYScroll = window.pageYOffset || document.documentElement.scrollTop;
        const rect        = thumbnail.getBoundingClientRect();

        return { x: rect.left, y: rect.top + pageYScroll, w: rect.width };
      }
    });

    const gallery = new PhotoSwipe($('.pswp')[0], PhotoSwipeUI_Default, items, options);

    gallery.init();

    if (events) {
      Object.keys(events).forEach(function(key) {
        gallery.listen(key, events[key].bind(gallery));
      });
    }

    if (cb) {
      cb.call(gallery);
    }

    return false;
  });
};

export { PhotoSwipe, PhotoSwipeUI_Default, initPhotoSwipeFromDOM };
