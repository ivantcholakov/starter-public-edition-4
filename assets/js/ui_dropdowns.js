$(function() {
  if ($('html').attr('dir') === 'rtl') {
    $('#hover-dropdown-demo .dropdown-menu').addClass('dropdown-menu-right');
    $('#nesting-dropdown-demo > .dropdown-menu').addClass('dropdown-menu-right');
    $('#btn-dropdown-demo .dropdown-menu').addClass('dropdown-menu-right');
  }
});

// Bootstrap menu
$(function() {
  var isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';

  new BootstrapMenu('#bs-menu-example', {
    menuPosition: isRtl ? 'belowRight' : 'belowLeft',
    actionsGroups: [
      ['actionName', 'anotherActionName' ],
      ['thirdActionName']
    ],
    actions: {
      actionName: {
        name: 'Action',
        onClick: function() {
          toastr.info("'Action' clicked!");
        }
      },
      anotherActionName: {
        name: 'Another action',
        iconClass: 'ion ion-md-create',
        onClick: function() {
          toastr.info("'Another action' clicked!");
        }
      },
      thirdActionName: {
        name: 'A third action',
        iconClass: 'ion ion-md-unlock',
        onClick: function() {
          toastr.info("'A third action' clicked!");
        }
      }
    }
  });
});
