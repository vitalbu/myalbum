<div class="modal fade" id="edit-album" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактировать альбом</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form method="post" action="/album/edit-album" role="form" data-toggle="validator">
                <div class="modal-body">

                    <div class="col-md-12 account-left">
                        <div class="form-group has-feedback">
                            <label for="title">Название альбома</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Введите название альбома" value="<?= h($title) ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="description">Description</label>
                            <input type="text" name="description" class="form-control" id="description" placeholder="Введите description" value="<?= h($description) ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback">
                            <label for="keywords">Keywords</label>
                            <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Введите ключевые слова" value="<?= h($keywords) ?>">
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>
                        <div class="form-group">
                            <label for="text">Описание альбома</label>
                            <textarea name="text" class="form-control"><?= h($text) ?></textarea>
                        </div>
                        <input type="hidden" name="id" value="<?= $id ?>">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
