//definindo uma animação de rolagem mais lenta do scroll
$('.smoothScroll').click(function (elem) {
    elem.preventDefault();
    let id = $(this).attr('href'),
       menuHeight = $('nav').innerHeight(),
       target = $(id).offset().top - menuHeight;
    $(document).animate({ scrollTop: target }, 800);
 })