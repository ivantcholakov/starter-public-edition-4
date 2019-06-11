$(function() {
  $('#numeral-example-1').html(numeral(1000.1234).format('0,0'));
  $('#numeral-example-2').html(numeral(1000.1234).format('0,0.00'));
  $('#numeral-example-3').html(numeral(1000.1234).format('+0,0'));
  $('#numeral-example-4').html(numeral(1000.1234).format('.00'));
  $('#numeral-example-5').html(numeral(1000.1234).format('$0,0.00'));
});
