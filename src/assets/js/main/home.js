$("[data-target=\'#navbar-links\']").click(() => $("span.navbar-toggle-icon").toggleClass("active-toggle"))

$("main .container").click(() => {
  if ($("#navbar-links").hasClass("show")) {
    $("#navbar-links").removeClass("show")
    $("span.navbar-toggle-icon").toggleClass("active-toggle")
  }
})

$("#registerGoogle").on("click", function (evt) {
  evt.preventDefault()

  let pathName = location.pathname.replace("\/www/ecomais","");
  let options = {
    method: 'POST',
    mycustomtype: "application/json",
    url: `${BASE_URL}/manager/getoauthurl`,
    dataType: "json",
    data: {requestOauthUrl: pathName},
    success: (res) => {
      location.href = res.oauthgoogleUrl
    },
    error: (err) =>  console.log(err)
  }
  reqAjax(options)
})