$(document).ready(function () {
    $('.js-like-article').click(function (e) {
        e.preventDefault();

        let $link = $(e.currentTarget);
        let $count = $('.js-like-article-count');

        $link.toggleClass('fa-heart-o').toggleClass('fa-heart');

        $count.html(parseInt($count.html()) + 1);
    });
});