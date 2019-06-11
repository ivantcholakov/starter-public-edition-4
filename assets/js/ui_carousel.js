// Swiper
$(function() {
  var defaultSwiper = new Swiper('#swiper-default');

  var swiperWithArrows = new Swiper('#swiper-with-arrows', {
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });

  var swiperWithPagination = new Swiper('#swiper-with-pagination', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    }
  });

  var swiperWithFractionPagination = new Swiper('#swiper-with-fraction-pagination', {
    pagination: {
      el: '.swiper-pagination',
      type: 'fraction'
    }
  });

  var swiperWithProgress = new Swiper('#swiper-with-progress', {
    pagination: {
      el: '.swiper-pagination',
      type: 'progressbar'
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });

  var swiperWithScrollbar = new Swiper('#swiper-with-scrollbar', {
    scrollbar: {
      el: '.swiper-scrollbar',
      hide: true
    }
  });

  var verticalSwiper = new Swiper('#swiper-vertical', {
    direction: 'vertical',
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    }
  });

  var swiperMultipleSlides = new Swiper('#swiper-multiple-slides', {
    slidesPerView: 3,
    spaceBetween: 30,
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    }
  });

  var swiperFadeEffect = new Swiper('#swiper-fade-effect', {
    effect: 'fade',
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });

  var swiper3dCubeEffect = new Swiper('#swiper-3d-cube-effect', {
    effect: 'cube',
    grabCursor: true,
    cubeEffect: {
      shadow: true,
      slideShadows: true,
      shadowOffset: 20,
      shadowScale: 0.94
    },
    pagination: {
      el: '.swiper-pagination'
    }
  });

  var swiper3dCoverflowEffect = new Swiper('#swiper-3d-coverflow-effect', {
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: 'auto',
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true
    },
    pagination: {
      el: '.swiper-pagination'
    }
  });

  var swiper3dFlipEffect = new Swiper('#swiper-3d-flip-effect', {
    effect: 'flip',
    grabCursor: true,
    pagination: {
      el: '.swiper-pagination'
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });
});
