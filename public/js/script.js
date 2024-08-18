$(document).ready(function () {
    // like buttons
    $(".like-area a.like, .like-area a.dislike").click(function () {
        let id = $(this).parents('.album-item').data('id');
        let classes = this.className;

        $.ajax({
            url: '/album/like',
            data: {id: id, classes: classes},
            type: 'post',
            success: function(){
            },
            error: function(){
                alert('Error!');
            }
        });

        if ($(this).hasClass("active")) {
            $(this).find('.like-no').html(parseInt($(this).find('.like-no').html(), 10) - 1)
        } else {
            $(this).find('.like-no').html(parseInt($(this).find('.like-no').html(), 10) + 1)
        }
        $(this).toggleClass('active');

    });

    // Comments buttons
    $(".comment-area a.comment").click(function () {

        let id = $(this).parents('.album-item').data('id');

        $.ajax({
            url: '/album/add-comment',
            data: {id: id},
            type: 'post',
            success: function(res){
                $('.test').html(res).fadeIn();
                $('#comment').modal('show');
            },
            error: function(){
                alert('Error!');
            }
        });
    });

    // edit album
    $('body').on('click', '.edit.album', function () {

        let id = $(this).parents('.album-item').data('id');

        $(document).ready(function(){
            $.ajax({
                url: '/album/edit-album',
                data: {id: id},
                type: 'post',
                success: function (res) {
                    $('.test').html(res).fadeIn();
                    $('#edit-album').modal('show');
                },
                error: function(){
                    alert('Error!');
                }
            });
        });
    });

    // edit album-img
    $('body').on('click', '.edit.album-img', function () {

        let id = $(this).parents('.album-item').data('id');

        $(document).ready(function(){
            $.ajax({
                url: '/album/edit-album-img',
                data: {id: id},
                type: 'post',
                success: function (res) {
                    $('.test').html(res).fadeIn();
                    $('#edit-album-img').modal('show');
                },
                error: function(){
                    alert('Error!');
                }
            });
        });
    });

    // modal view image
    $('body').on('click', '.image-item', function () {
        // Получить модель
        let modal = document.getElementById("myModal");

// Получите изображение и вставьте его внутрь модального - используйте его текст "alt" в качестве подписи
        let img = this;

        let src = $(this).data('src');
        // замена миниатюры полным изображением
        let thumbSrc = $(img).attr("src");
        $(img).attr("src", window.location.protocol + '//' + window.location.hostname + src);

        let modalImg = document.getElementById("img01");
        let captionText = document.getElementById("caption");

        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;

// Получить элемент <span>, который закрывает модальный
        let span = document.getElementsByClassName("close")[0];

// Когда пользователь нажимает на <span> (x), закройте модальное окно
        span.onclick = function() {
            // вернуть миниатюру
            $(img).attr("src", thumbSrc);
            modal.style.display = "none";
        }
    });
});