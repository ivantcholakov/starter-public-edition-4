// Nestable
$(function() {
  function updateOutput(e) {
    var list   = e.length ? e : $(e.target);
    var output = list.data('output');

    output.val(window.JSON ? window.JSON.stringify(list.nestable('serialize')) :
                             'JSON browser support required for this demo.');
  };

  $('#nestable').nestable({ group: 1 }).on('change', updateOutput);
  $('#nestable2').nestable({ group: 1 }).on('change', updateOutput);

  // output initial serialised data
  updateOutput($('#nestable').data('output', $('#nestable-output')));
  updateOutput($('#nestable2').data('output', $('#nestable2-output')));

  $('#nestable-menu').on('click', function(e) {
    var target = $(e.target);
    var action = target.data('action');

    if (action === 'expand-all') {
      $('.dd').nestable('expandAll');
    }
    if (action === 'collapse-all') {
      $('.dd').nestable('collapseAll');
    }
  });

  $('#nestable3').nestable();
});

// jsTree
$(function() {
  $('#jstree-example-1').jstree();
  $('#jstree-example-2').jstree({
    core : {
      data : [
        {
          text: 'css',
          children: [
            { text: 'app.css', type: 'css' },
            { text: 'style.css', type: 'css' },
          ],
        },
        {
          text: 'img',
          state: {
            opened: true
          },
          children: [
            { text: 'bg.jpg', type: 'img' },
            { text: 'logo.png', type: 'img' },
            { text: 'avatar.png', type: 'img' },
          ],
        },
        {
          text: 'js',
          state: {
            opened: true
          },
          children: [
            { text: 'jquery.js', type: 'js' },
            { text: 'app.js', type: 'js' },
          ],
        },
        { text: 'index.html', type: 'html' },
        { text: 'page-one.html', type: 'html' },
        { text: 'page-two.html', type: 'html' }
      ]
    },
    plugins: [ 'types' ],
    types: {
      default: { icon: 'ion ion-ios-folder' },
      html: { icon: 'ion ion-logo-html5 text-danger' },
      css: { icon: 'ion ion-logo-css3 text-info' },
      img: { icon: 'ion ion-ios-image text-success' },
      js: { icon: 'ion ion-logo-nodejs text-warning' }
    }
  });
});
