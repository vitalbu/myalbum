<?php
use Myblog\App;

/* @var $breadcrumbs string */
?>
<div class="breadcrumbs-main">
    <ol class="breadcrumb">
        <?=$breadcrumbs;?>
    </ol>
</div>

<div class="body-content">
    <h2><?= h($album->title) ?></h2>
    <div class="warn-info"><?= h($album->text) ?></div>
    <div class="row">
        <?php if ($gallery): ?>
            <?php foreach ($gallery as $item): ?>
                <div class="col-xxl-3 col-lg-4 col-md-6">

                    <div class="album-item" data-id="<?= $item->id ?>">
                        <div class="img">
                            <a>
                                <img class="image-item" src="/images/albums/thumb/<?= $item->img ?>"
                                     alt="<?= $item->name ?>" data-src="/images/albums/<?= $item->img ?>">
                            </a>
                        </div>
                        <div class="list">
                            <h3><?= h($item->name) ?></h3>
                            <div class="actions">
                                <div class="add-to-links">

                                    <div class="like-outer">

                                        <div class="like-area">
                                            <ul>
                                                <li>
                                                    <a class="<?= isset($_SESSION['user']) ? 'like' : ''?><?= isset($_SESSION['album.img.like'][$item->id]) ? ' active' : '' ?>">
                                                        <i class="fas fa fa-thumbs-up"></i>
                                                        <i class="far fa fa-thumbs-o-up"></i>
                                                        <span class="like-no"><?= $item->like_ ?></span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="<?= isset($_SESSION['user']) ? 'dislike' : ''?><?= isset($_SESSION['album.img.dislike'][$item->id]) ? ' active' : '' ?>">
                                                        <i class="fas fa fa-thumbs-down"></i>
                                                        <i class="far fa fa-thumbs-o-down"></i>
                                                        <span class="like-no"><?= $item->dislike ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="comment-area">
                                            <ul>
                                                <li>
                                                    <a class="comment">
                                                        <i class="fa fa-comment"></i>
                                                        <span class="like-no"><?= $comments[$item->id] ?? 0 ?></span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <?php if (isset($_SESSION['user'])) : ?>
                                            <div>
                                                <ul>
                                                    <li>
                                                        <a class="edit album-img">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </div>

                            <div class="text">
                                <?= h($item->text) ?>
                            </div>

                        </div>
                    </div>


                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-md-3">
                <div class="album-item">
                    <div class="img">
                        <img class="image-item" src="/images/albums/thumb/no-image.png"
                             alt="no image" data-src="/images/albums/no-image.png">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php // Modal add image ?>
<?php if(isset($_SESSION['user'])): ?>
    <div class="d-grid gap-2 d-md-block" style="text-align: center;">
        <button type="button" class="btn btn-lg btn-success" data-bs-toggle="modal" data-bs-target="#add-img">
            Добавить изображение
        </button>
    </div>
    <div class="modal fade" id="add-img" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Добавить новое фото</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                </div>
                <form enctype="multipart/form-data" method="post" action="/album/add-img" role="form" data-toggle="validator">
                    <div class="modal-body">

                        <div class="col-md-12 account-left">
                            <div class="form-group has-feedback">
                                <label for="title">Наименование изображения</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Введите наименование изображения" value="<?= $_SESSION['form_data']['name'] ?? '' ?>" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                            <div class="form-group">
                                <label for="text">Описание изображения</label>
                                <textarea name="text" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <div class="box box-danger box-solid file-upload">
                                    <div class="box-body">

                                        <p><small>Рекомендуемые размеры: <?= App::$app->getProperty('width'); ?>px X <?= App::$app->getProperty('height'); ?>px</small></p>
                                        <div class="single"></div>
                                    </div>
                                    <div class="overlay">
                                        <i class="fa fa-refresh fa-spin"></i>
                                    </div>
                                </div>

                                <div>
                                    <input type="file" name="_img" accept="image/*" required>
                                </div>

                                <input type="hidden" name="album_id" value="<?= $album->id ?>">
                            </div>

                            <br>
                            <div class="form-group has-feedback">
                                <label for="status">Публиковать фото</label>
                                <div>
                                    <input type="checkbox" name="status" id="status" value="1"  checked />
                                    <label for="status">да</label>
                                </div>
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

<div class="test"></div>

<div id="myModal" class="modal-img">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>
