$(document).ready(function () {
  $(".model a").hover(
    function () {
      $(this).find(".model-num").css("opacity", "1");
    },
    function () {
      $(this).find(".model-num").css("opacity", "0");
    }
  );

  $(".nav-item").click(function () {
    $(this).siblings().toggle();
  });

  var winSize = $(window).width();
  if (winSize > 768) {
    $(".model a").click(function () {
      $(this).attr("target", "_blank");
    });
  }

  // var winSize = $(window).width();
  // console.log(winSize);
  // if (winSize <= 975) {
  //   $(".nav-item").click(function () {
  //     $(this).siblings().toggle();
  //   });
  // }
});
