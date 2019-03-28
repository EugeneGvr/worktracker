$(document).ready(function() {
    $('.day').click(function(e) {
      var day = $(this).children('input[type=hidden]');
      if(day.val()==0) {
        day.val(1);
        $(this).css("background-color", "yellow");
        let cookie_user   = $('#user-id').val().trim();
            cookie_month  = $('.cal-controller .cal-current-month').text().trim(),
            cookie_day    = day.parent().text().trim(),
            cookie_name   = (cookie_user+"/"+cookie_month+"/"+cookie_day).trim(),
            cookie_val    = day.val();
        document.cookie = cookie_name+"="+cookie_val;
      } else {
        day.val(0);
        $(this).css("background-color", "transparent");
        let cookie_month  = $('.cal-controller .cal-current-month').text().trim(),
            cookie_day    = day.parent().text().trim(),
            cookie_name   = (cookie_month+"/"+cookie_day).trim(),
            cookie_val    = day.val();
        document.cookie = cookie_name+"=;expires=; expires=Thu, 06 May 1997 00:00:00 UTC;";
      }
    });
});

// $(document).ready( function() {
//   if(window.location.pathname=='/cabinet') {
//     var cookie_ar = document.cookie.split(';'),
//         cookies_array = [];
//     for (var i = 0; i < cookie_ar.length; i++) {
//       var local = cookie_ar[i].split('=');
//       var day = $('input[name="'+local[0].trim()+'"]');
//       console.log('input[name="'+local[0].trim()+'"]');
//       day.val(local[1]);
//       day.parent().css("background-color", "yellow");
//     }
//   }
// });
