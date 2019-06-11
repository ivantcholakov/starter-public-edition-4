$(function() {
  var tour = new Tour({
    backdrop: true,
    steps: [
      {
        element: "#tour-1",
        title: "Title of first step",
        content: "Content of first step",
        smartPlacement: true
      },
      {
        element: "#tour-2",
        title: "Title of second step",
        content: "Content of second step",
        smartPlacement: true
      },
      {
        element: "#tour-3",
        title: "Title of third step",
        content: "Content of third step",
        smartPlacement: true
      },
      {
        element: "#tour-4",
        title: "Title of fourth step",
        content: "Content of fourth step",
        smartPlacement: true
      },
      {
        element: "#tour-5",
        title: "Title of fifth step",
        content: "Content of fifth step",
        smartPlacement: true
      }
    ]
  });
  // Initialize the tour
  tour.init();

  $('#bs-tour-example').click(function() {
    tour.restart();
  });
});
