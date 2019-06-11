$(function() {

  // Drag&Drop

  dragula(Array.prototype.slice.call(document.querySelectorAll('.project-task-list')), {
    moves: function (el, container, handle) {
      return handle.classList.contains('project-task-handle');
    }
  });

  // RTL

  if ($('html').attr('dir') === 'rtl') {
    $('.project-task-actions .dropdown-menu, .project-priority .dropdown-menu').removeClass('dropdown-menu-right');
  }

});
