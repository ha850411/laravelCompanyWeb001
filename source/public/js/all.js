$('.menu li a').click(function (e) { 
    e.preventDefault();
    $(this).toggleClass('active');
});