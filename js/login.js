$(document).ready(function() {
  $(".back").click(function() {
    window.location.assign("index.php");
  });

  $("#send_login").click(function() {
    let m_name = $("#xm_name").val();
    let m_pass = $("#xm_pass").val();
    let data = "m_name=" + m_name + "&m_pass=" + m_pass;
    location.assign("../admin/admin.html");
    // alert(data);
    // $.ajax({
    //   method: "post",
    //   url: "ctrls/login.php",
    //   data: data,
    //   success: function(data) {
    //     $("#errors").html(data);
    //   }
    // });
  });
});
