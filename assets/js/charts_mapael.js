$(function() {
  $('#mapael-example').mapael({
    map: {
      name: 'world_countries',
      defaultArea: {
        attrs: {
          fill: '#f4f4e8',
          stroke: '#ced8d0'
        },
        attrsHover: {
          fill: '#a4e100'
        }
      }
    }
  });
});
