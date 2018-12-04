$(document).ready(function () {
    $('.js-like-article').click(function (e) {
        e.preventDefault();

        let $link = $(e.currentTarget);
        let $count = $('.js-like-article-count');

        $.post($link.attr('href'), {'heart': parseInt($count.html())}, function (data) {
            $link.toggleClass('fa-heart-o').toggleClass('fa-heart');
            $count.html(data.heart);
        });
    });
});