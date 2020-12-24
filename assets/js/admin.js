if (typeof ($) == 'undefined') {
  var $ = jQuery
}

$(document).on("submit", "#ap_settings_form form", function (e) {
  e.preventDefault();
  let data = $(this).serialize();
  Swal.fire({
    title: 'Please wait..'
  })
  Swal.showLoading()

  setTimeout(() => {
    
  }, 1000)

  data += '&action=ap_save_settings'

  // console.log(data);
  $.post(ajaxurl, data, function (response) {
    console.log(response);
    if (response.success == true) {
      Swal.update({
        title: 'Options Saved!',
        icon: 'success'
      })
      Swal.hideLoading()
    } else {
      Swal.update({
        title: response.data.length > 0 ? response.data : 'Something is wrong',
        icon: 'error'
      })
      Swal.hideLoading()
    }
  });
  // $.post("options.php", data, function (response, status, xhr) {
  //   $(".ap_button button").wait(false);
  //   if (status == "success") {
  //     $(".ap_button button").temp("Updated");
  //   } else {
  //     $(".ap_button button").temp("Not Updated");
  //     console.log("Not updated");
  //   }
  // });
});
