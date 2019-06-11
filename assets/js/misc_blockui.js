$(function() {
  $('#block-ui-block-page').click(function() {
    $.blockUI({
      message: '<div class="sk-folding-cube sk-primary"><div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div><h5 style="color: #444">LOADING...</h5>',
      css: {
        backgroundColor: 'transparent',
        border: '0',
        zIndex: 9999999
      },
      overlayCSS:  {
        backgroundColor: '#fff',
        opacity: 0.8,
        zIndex: 9999990
      }
    });

    setTimeout(function() {
      $.unblockUI();
    }, 5000);
  });

  $('#block-ui-block-element').click(function() {
    $('#block-ui-element-example').block({
      message: '<div class="sk-wave sk-primary"><div class="sk-rect sk-rect1"></div> <div class="sk-rect sk-rect2"></div> <div class="sk-rect sk-rect3"></div> <div class="sk-rect sk-rect4"></div> <div class="sk-rect sk-rect5"></div></div>',
      css: {
        backgroundColor: 'transparent',
        border: '0'
      },
      overlayCSS:  {
        backgroundColor: '#fff',
        opacity: 0.8
      }
    });
  });

  $('#block-ui-unblock-element').click(function() {
    $('#block-ui-element-example').unblock();
  });
});
