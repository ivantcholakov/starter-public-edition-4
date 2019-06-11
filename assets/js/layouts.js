// isSmallScreen

$('#helpers-isSmallScreen').click(function() {
  alert(window.layoutHelpers.isSmallScreen());
});

// isLayout1

$('#helpers-isLayout1').click(function() {
  alert(window.layoutHelpers.isLayout1());
});

// isCollapsed

$('#helpers-isCollapsed').click(function() {
  alert(window.layoutHelpers.isCollapsed());
});

// isFixed

$('#helpers-isFixed').click(function() {
  alert(window.layoutHelpers.isFixed());
});

// isOffcanvas

$('#helpers-isOffcanvas').click(function() {
  alert(window.layoutHelpers.isOffcanvas());
});

// isNavbarFixed

$('#helpers-isNavbarFixed').click(function() {
  alert(window.layoutHelpers.isNavbarFixed());
});

// isFooterFixed

$('#helpers-isFooterFixed').click(function() {
  alert(window.layoutHelpers.isFooterFixed());
});

// isReversed

$('#helpers-isReversed').click(function() {
  alert(window.layoutHelpers.isReversed());
});

// setCollapsed

$('#helpers-setCollapsed-false-true').click(function() {
  window.layoutHelpers.setCollapsed(false, true);
});
$('#helpers-setCollapsed-true-true').click(function() {
  window.layoutHelpers.setCollapsed(true, true);
});
$('#helpers-setCollapsed-false-false').click(function() {
  window.layoutHelpers.setCollapsed(false, false);
});
$('#helpers-setCollapsed-true-false').click(function() {
  window.layoutHelpers.setCollapsed(true, false);
});

// toggleCollapsed

$('#helpers-toggleCollapsed-true').click(function() {
  window.layoutHelpers.toggleCollapsed(true);
});
$('#helpers-toggleCollapsed-false').click(function() {
  window.layoutHelpers.toggleCollapsed(false);
});

// setPosition

$('#helpers-setPosition-collapse').click(function() {
  window.layoutHelpers.setCollapsed(true, false);
});
$('#helpers-setPosition-false-false').click(function() {
  window.layoutHelpers.setPosition(false, false);
});
$('#helpers-setPosition-true-false').click(function() {
  window.layoutHelpers.setPosition(true, false);
});
$('#helpers-setPosition-false-true').click(function() {
  window.layoutHelpers.setPosition(false, true);
});
$('#helpers-setPosition-true-true').click(function() {
  window.layoutHelpers.setPosition(true, true);
});

// setNavbarFixed

$('#helpers-setNavbarFixed-reset').click(function() {
  window.layoutHelpers.setPosition(false, false);
});
$('#helpers-setNavbarFixed-true').click(function() {
  window.layoutHelpers.setNavbarFixed(true);
});
$('#helpers-setNavbarFixed-false').click(function() {
  window.layoutHelpers.setNavbarFixed(false);
});

// setFooterFixed

$('#helpers-setFooterFixed-true').click(function() {
  window.layoutHelpers.setFooterFixed(true);
});
$('#helpers-setFooterFixed-false').click(function() {
  window.layoutHelpers.setFooterFixed(false);
});

// setReversed

$('#helpers-setReversed-true').click(function() {
  window.layoutHelpers.setReversed(true);
});
$('#helpers-setReversed-false').click(function() {
  window.layoutHelpers.setReversed(false);
});
