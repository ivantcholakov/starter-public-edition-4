$(function() {

  // Drag&Drop

  dragula(Array.prototype.slice.call(document.querySelectorAll('.task-list')), {
    moves: function (el, container, handle) {
      return handle.classList.contains('task-list-handle');
    }
  });

  // RTL

  if ($('html').attr('dir') === 'rtl') {
    $('.task-list-actions .dropdown-menu').removeClass('dropdown-menu-right');
  }

});
