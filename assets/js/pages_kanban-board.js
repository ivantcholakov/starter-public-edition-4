$(function() {

  // Drag&Drop

  dragula(
    Array.prototype.slice.call(document.querySelectorAll('.kanban-box'))
  );

  // RTL

  if ($('html').attr('dir') === 'rtl') {
    $('.kanban-board-actions .dropdown-menu').removeClass('dropdown-menu-right');
  }

});
