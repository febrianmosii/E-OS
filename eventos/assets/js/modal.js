$("#modal_trigger").leanModal({top : 140, overlay : 0.6, closeButton: ".modal_close" });
$("#modal_trigger_content").leanModal({top : 75, overlay : 0.6, closeButton: ".modal_close" });

$(function(){
  // Calling Login Form
  $("#login_form").click(function(){
    $(".social_login").hide();
    $(".user_login").show();
    return false;
  });

  // Calling Register Form
  $("#register_form").click(function(){
    $(".social_login").hide();
    $(".user_register").show();
    $(".header_title").text('Register');
    return false;
  });

  // Going back to Social Forms
  $(".back_btn").click(function(){
    $(".user_login").hide();
    $(".user_register").hide();
    $(".social_login").show();
    $(".header_title").text('Login');
    return false;
  });

  $("#modal_event_content").click(function(){
    $("#modal-content").hide();
    return false;
  });
})

$(document).ready(function() {
  $('#save-content').click(function(){
      $.ajax({
        type: "POST",
        url: "save_content.php",
        data: $('#form-content').serialize(), 
        success: function(res){
          if (res == 1) {
            location.reload();
          } else {
            alert("error");
          }
        },
        // Alert status code and error if fail
        error: function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
      });
  });
  $('.login').click(function(){
      $.ajax({
        type: "POST",
        url: "login.php",
        data: $('#login').serialize(), 
        success: function(res){
          if (res == 1) {
            location.reload();
          } else {
            $("#alert").html('Login Failed!');
          }
        },
        // Alert status code and error if fail
        error: function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
    });
  });
  $('.logout').click(function(){
      $.ajax({
        type: "POST",
        url: "logout.php",
        data: $('#login').serialize(), 
        success: function(res){
            location.reload();
        },
        // Alert status code and error if fail
        error: function (xhr, ajaxOptions, thrownError){
            alert(xhr.status);
            alert(thrownError);
        }
    });
  });
});