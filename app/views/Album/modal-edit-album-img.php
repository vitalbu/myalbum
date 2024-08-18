<div class="modal fade" id="edit-album-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Редактировать описание фото</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
            </div>
            <form enctype="multipart/form-data" method="post" action="/album/edit-album-img" role="form" data-toggle="validator">
                <div class="modal-body">

                    <div class="col-md-12 account-left">
                        <div class="form-group has-feedback">
                            <label for="title">Наименование изображения</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Введите наименование изображения" value="<?= h($name) ?>" required>
                            <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                        </div>

                        <div class="form-group">
                            <label for="text">Описание изображения</label>
                            <textarea name="text" class="form-control"><?= h($text) ?></textarea>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="status">Публиковать фото</label>
                            <div>
                                <input type="checkbox" name="status" id="status" value="<?= h($status) ?>"  checked />
                                <label for="status">да</label>
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?= h($id) ?>">

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div>
    </div>
</div>
