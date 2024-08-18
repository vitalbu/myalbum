<?php
use Myblog\libs\Pagination;

/* @var $breadcrumbs string */
/* @var $total string */
/* @var $pagination Pagination */
?>
<div class="breadcrumbs-main">
    <ol class="breadcrumb">
        <?= $breadcrumbs ?>
    </ol>
</div>

<div class="body-content">
    <div class="row">
        <?php if(!empty($albums)): ?>

            <?php foreach($albums as $album): ?>
                <div class="col-lg-4 col-md-6">

                    <div class="album-item" data-id="<?= $album['id'] ?>">
                        <div class="img">
                            <a href="/album/<?= $album['alias'] ?>">
                                <img src="/images/albums/thumb/<?= $album['img'] ?>">
                            </a>
                        </div>
                        <div class="list">
                            <h3><?= h($album['title']) ?></h3>

                            <?php if (isset($_SESSION['user'])) : ?>
                                <div class="actions">
                                    <div class="add-to-links">
                                        <div class="like-outer">
                                            <ul>
                                                <li>
                                                    <a class="edit album">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>



                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <h3>Альбомов пока нет...</h3>
        <?php endif; ?>
    </div>

    <div class="text-center">
        <p><?= count($albums) ?> из <?= $total; ?></p>

        <nav aria-label="Page navigation">
            <?php if ($pagination->countPages > 1): ?>
                <?= $pagination; ?>
            <?php endif; ?>
        </nav>
    </div>

    <?php // Modal add-album ?>
    <?php if(isset($_SESSION['user'])): ?>
    <div class="d-grid gap-2 d-md-block" style="text-align: center;">
        <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#add-album">
            Добавить новый альбом
        </button>
    </div>
        <div class="modal fade" id="add-album" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Новый альбом</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>

                    <form method="post" action="/album/add" role="form" data-toggle="validator">
                        <div class="modal-body">

                            <div class="col-md-12 account-left">
                                <div class="form-group has-feedback">
                                    <label for="title">Название альбома</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Введите название альбома" value="<?= $_SESSION['form_data']['title'] ?? '' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="description">Description</label>
                                    <input type="text" name="description" class="form-control" id="description" placeholder="Введите description" value="<?= $_SESSION['form_data']['description'] ?? '' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="keywords">Keywords</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Введите ключевые слова" value="<?= $_SESSION['form_data']['keywords'] ?? '' ?>">
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                </div>
                                <div class="form-group">
                                    <label for="text">Описание альбома</label>
                                    <textarea name="text" class="form-control"><?= $_SESSION['form_data']['text'] ?? '' ?></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                        </div>
                    </form>
                    <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="test" ></div>

<?php // Modal edit-album ?>
<?php if(isset($_SESSION['user'])): ?>
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
                                <input type="text" name="title" class="form-control" id="title" placeholder="Введите название альбома" value="<?= $_SESSION['form_data']['title'] ?? '' ?>" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="description">Description</label>
                                <input type="text" name="description" class="form-control" id="description" placeholder="Введите description" value="<?= $_SESSION['form_data']['description'] ?? '' ?>" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label for="keywords">Keywords</label>
                                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Введите ключевые слова" value="<?= $_SESSION['form_data']['keywords'] ?? '' ?>">
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>
                            <div class="form-group">
                                <label for="text">Описание альбома</label>
                                <textarea name="text" class="form-control"><?= $_SESSION['form_data']['text'] ?? '' ?></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
