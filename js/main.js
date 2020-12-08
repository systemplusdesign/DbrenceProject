$(document).ready(function () {
  $("#toggle").click(function () {
    $("#toggle").toggleClass("active");
    $(".my_menu").toggleClass("activemenu");
  });
});