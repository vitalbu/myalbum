<?php
/* @var $comments array */
/* @var $id integer */
?>
<?php if($comments || isset($_SESSION['user'])) : ?>
<div class="modal fade" id="comment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Комментарии к фото</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>

            <div class="modal-body">
                <?php foreach ($comments as $item) : ?>
                    <div class="comments">
                        <div class="top">
                            <div><?= h($item['name']) ?></div>
                            <div><?= date('d-m-Y H:i', $item['created_at']) ?></div>
                        </div>
                        <div class="text"><?= h($item['text']) ?></div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if(isset($_SESSION['user'])): ?>
            <form method="post" action="/album/add-comment" role="form" data-toggle="validator">
                <div class="modal-body">

                    <div class="col-md-12 account-left">
                        <div class="form-group">
                            <label for="text">Написать комментарий</label>
                            <textarea name="text" class="form-control" required></textarea>
                        </div>

                        <input type="hidden" name="albumimg_id" value="<?= h($id) ?>">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
            <?php endif; ?>

        </div>
    </div>
</div>
<?php endif; ?>
