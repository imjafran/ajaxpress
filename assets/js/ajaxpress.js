

// // a click event
// $(document).on("click", "a", function (e) {
//   let a = $(this),
//     href = a.prop("href");
//   if (
//     $(_ap.selector).length > 0 &&
//     href.search(_ap.hostname) != -1 &&
//     a.prop("target") != "_blank" &&
//     href.search(_ap.hostname + "/wp-admin") == -1 &&
//     href.search(_ap.hostname + "/wp-login") == -1 &&
//     href.indexOf("#") == -1
//   ) {
//     e.preventDefault();
//     $(".ap_container").find("h4").html(_ap.loading);
//     $(".ap_container").addClass(_ap.theme).fadeIn();
//     $.get(a.prop("href"), function (data) {
//       $(".ap_container").removeClass(_ap.theme).fadeOut();
//       let html = $.parseHTML(data);
//       let title = $(html).filter("title").text(),
//         content = $(html).filter(_ap.selector).html();
//       if (!content) {
//         title = $("title", data).text();
//         content = $(_ap.selector, data).html();
//       }
//       if (content) {
//         window.history.pushState("ap_container", title, href);
//         $(_ap.selector).html(content);
//         $("html,body").animate(
//           { scrollTop: $(_ap.selector).offset().top },
//           "slow"
//         );
//       } else {
//         window.location = href;
//       }
//     });
//   }
// });

// // ajax search wordpress
// $(document).on("submit", "[role=search]", function (e) {
//   e.preventDefault();
//   let form = $(this),
//     data = form.serialize(),
//     s = form.find("[name=s]").val(),
//     button = false,
//     button_content = false;

//   if (form.find('input[type="submit"]').length > 0) {
//     button = form.find('input[type="submit"]');
//     button_content = false;
//   } else {
//     button = form.find('button[type="submit"]');
//   }

//   if (form.find("[name=s]").val().length == 0) {
//     alert("Please write some words");
//     return false;
//   }

//   button.wait("Searching...", button_content);
//   $(".ap_container").find("h4").html(_ap.loading);
//   $(".ap_container").addClass(_ap.theme).fadeIn();
//   $.ajax({
//     url: form.attr("action"),
//     // type: form.attr("method").length > 0 ? form.attr("method") : "GET",
//     type: "GET",
//     data: data,
//     success: function (data) {
//       // console.log(data, s);
//       $(".ap_container").removeClass(_ap.theme).fadeOut();
//       let title = $($.parseHTML(data)).filter("title").text();
//       let content = $($.parseHTML(data)).filter(_ap.selector).html();
//       if (content) {
//         window.history.pushState(
//           "ap_container",
//           title,
//           _ap.hostname + "/?s=" + s
//         );
//         $(_ap.selector).html(content);
//       }
//     },
//     error: function (response) {
//       // console.log(response);
//     },
//     complete: function (response) {
//       button.wait(false, button_content);
//     },
//   });
// });

// $(document).on("submit", "#commentform", function (e) {
//   e.preventDefault();
//   let form = $(this),
//     data = form.serialize(),
//     button = false,
//     button_content = true;

//   if (form.find('input[type="submit"]').length > 0) {
//     button = form.find('input[type="submit"]');
//     button_content = false;
//   } else {
//     button = form.find('button[type="submit"]');
//   }

//   if (form.find("[name=comment]").val().length == 0) {
//     alert("Please write some comments");
//     return false;
//   }

//   button.wait("Posting...", button_content);
//   // return;

//   $.ajax({
//     url: "wp-comments-post.php",
//     // type: form.attr("method").length > 0 ? form.attr("method") : "GET",
//     type: "POST",
//     data: data,
//     success: function (data) {
//       // console.log(data, s);
//       $(".ap_container").removeClass(_ap.theme).fadeOut();
//       let title = $($.parseHTML(data)).filter("title").text(),
//         content = $($.parseHTML(data)).filter(_ap.selector).html();
//       if (content) {
//         // window.history.pushState("ap_container", title, _ap.hostname + "/?s=");
//         $(_ap.selector).html(content);

//         $("html,body").animate(
//           { scrollTop: $("#comments").offset().bottom },
//           "slow"
//         );
//       }
//     },
//     error: function (response) {
//       // console.log(response);
//     },
//     complete: function (response) {
//       button.wait(false, button_content);
//     },
//   });
// });
