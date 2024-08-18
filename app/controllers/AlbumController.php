<?php

namespace app\controllers;

use app\models\Album;
use app\models\AlbumComment;
use app\models\AlbumImg;
use app\models\AppModel;
use app\models\Breadcrumbs;
use Myblog\App;
use Myblog\libs\FileRequest;
use app\components\Pagination;

class AlbumController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = App::$app->getProperty('pagination');

        $total = \R::count('album');
        $pagination = new Pagination($page, $perpage, $total);
        $start = $pagination->getStart();

        $albums = \R::getAll("SELECT id,title,alias FROM album LIMIT $start, $perpage");

        $images_ = \R::getAll("SELECT album_id,img FROM albumimg WHERE sort = 1");
        $images = [];
        foreach ($images_ as $item) {
            $images[$item['album_id']] = $item['img'];
        }

        foreach ($albums as $k => $v) {
            $albums[$k]['img'] = isset($images[$v['id']]) ? $images[$v['id']] : 'no-image.png';
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs(null, null, 'Альбомы');

        $this->setMeta('Альбомы', 'Описание альбомов', 'Ключевые слова для альбомов');
        $this->set(compact('albums', 'breadcrumbs', 'total', 'pagination'));
    }

    public function viewAction()
    {
        $alias = $this->route['alias'];
        $album = \R::findOne('album', 'alias = ?', [$alias]);
        if (!$album) {
            throw new \Exception('Страница не найдена', 404);
        }

        // галерея
        $gallery = \R::findAll('albumimg', 'album_id = ? AND status = ? ORDER BY sort', [$album->id, 1]);

        // комменты
        $comments_ = \R::getAll('SELECT albumimg_id, COUNT(*) AS count FROM albumcomment GROUP BY albumimg_id');
        $comments = [];
        foreach ($comments_ as $item) {
            $comments[$item['albumimg_id']] = $item['count'];
        }

        $breadcrumbs = Breadcrumbs::getBreadcrumbs('album', $album->id);

        $this->setMeta(h($album->title), h($album->description), h($album->keywords));
        $this->set(compact('album', 'gallery', 'comments', 'breadcrumbs'));
    }

    public function likeAction()
    {
        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $id = !empty($_POST['id']) ? (int)$_POST['id'] : null;

            $classes = !empty($_POST['classes']) ? $_POST['classes'] : '';
            $arr = explode(' ', $classes);
            $classes = $arr[0];

            if ($id && in_array($classes, ['like', 'dislike'])) {
                $model = \R::load('albumimg', $id);
                if ($model->id) {
                    if ($classes === 'like') {
                        if (isset($_SESSION['album.img.like'][$id])) {
                            unset($_SESSION['album.img.like'][$id]);
                            $model->like_--;
                        } else {
                            $_SESSION['album.img.like'][$id] = '';
                            $model->like_++;
                        }
                    } else {
                        if (isset($_SESSION['album.img.dislike'][$id])) {
                            unset($_SESSION['album.img.dislike'][$id]);
                            $model->dislike--;
                        } else {
                            $_SESSION['album.img.dislike'][$id] = '';
                            $model->dislike++;
                        }
                    }

                    \R::store($model);
                }
            }
        }

        redirect();
    }

    public function addAction()
    {
        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $model = new Album();
            $data = $_POST;
            $model->load($data);
            $model->attributes['user_id'] = (int)$_SESSION['user']['id'];
            $model->attributes['created_at'] = time();
            $model->attributes['updated_at'] = time();

            if (!$model->validate($data)) {
                $model->getErrors();
                redirect();
            }
            if ($id = $model->save('album')) {
                $alias = AppModel::createAlias('album', 'alias', $data['title'], $id);
                $cat = \R::load('album', $id);
                $cat->alias = $alias;
                \R::store($cat);
                $_SESSION['success'] = 'Альбом добавлен';
            }
        }

        redirect();
    }

    public function addImgAction()
    {
        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $request = new FileRequest();
            $img = $request->get('_img')->resize(
                App::$app->getProperty('thumb_width'),
                App::$app->getProperty('thumb_height'),
                App::$app->getProperty('width'),
                App::$app->getProperty('height'),
            );

            $model = new AlbumImg();
            $data = $_POST;
            $data['status'] = isset($data['status']) ? 1 : 0;
            $data['user_id'] = (int)$_SESSION['user']['id'];
            $data['created_at'] = time();
            $data['updated_at'] = time();
            $data['img'] = $img;
            $data['like_'] = 0;
            $data['dislike'] = 0;

            $count = \R::count('albumimg', ' album_id = ? ', [$data['album_id']]);
            $data['sort'] = ++$count;

            $model->load($data);

            if (!$model->validate($data)) {
                $model->getErrors();
                $_SESSION['errors'] = 'Ошибка добавления изображения';
                redirect();
            }

            if ($id = $model->save('albumimg')) {
                $_SESSION['success'] = 'Изображение добавлено';
            }
        }

        redirect();
    }

    public function editAlbumAction()
    {
        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $model = \R::findOne('album', 'id = ?', [$id]);

            if ($model) {

                if ($this->isAjax()) {
                    $title = $model['title'];
                    $description = $model['description'];
                    $keywords = $model['keywords'];
                    $text = $model['text'];

                    $this->loadView('modal-edit-album', compact('id', 'title', 'keywords', 'description', 'text'));
                }

                $album = new Album();
                $data = $_POST;
                $data['user_id'] = (int)$_SESSION['user']['id'];
                $data['updated_at'] = time();
                $data['created_at'] = $model['created_at'];
                $data['alias'] = $model['alias'];
                $album->load($data);
                if (!$album->validate($data)) {
                    $album->getErrors();
                    redirect();
                }
                if ($album->update('album', $id)) {
                    $_SESSION['success'] = 'Изменения сохранены';
                }
            }

        }

        redirect();
    }

    public function editAlbumImgAction()
    {
        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $model = \R::findOne('albumimg', 'id = ?', [$id]);

            if ($model) {
                if ($this->isAjax()) {
                    $name = $model['name'];
                    $text = $model['text'];
                    $status = $model['status'];

                    $this->loadView('modal-edit-album-img', compact('id', 'name', 'text', 'status'));
                }

                $albumImg = new AlbumImg();
                $data = $_POST;
                $data['user_id'] = (int)$_SESSION['user']['id'];
                $data['updated_at'] = time();
                $data['created_at'] = $model['created_at'];
                $data['img'] = $model['img'];
                $data['like_'] = $model['like_'];
                $data['dislike'] = $model['dislike'];
                $data['sort'] = $model['sort'];
                $data['album_id'] = $model['album_id'];
                $albumImg->load($data);
                if (!$albumImg->validate($data)) {
                    $albumImg->getErrors();
                    redirect();
                }
                if ($albumImg->update('albumimg', $id)) {
                    $_SESSION['success'] = 'Изменения сохранены';
                }
            }

        }

        redirect();
    }

    public function addCommentAction()
    {
        if ($this->isAjax()) {
            $id = isset($_POST['id']) ? (int)$_POST['id'] : null;
            $comments = \R::getAll("
SELECT c.albumimg_id, c.user_id, c.text, c.created_at, u.name FROM albumcomment c
JOIN user u ON u.id = c.user_id
WHERE albumimg_id = {$id} AND status = 1 ORDER BY created_at");

            $this->loadView('modal-comment', compact('id', 'comments'));
        }

        if (!empty($_POST) && isset($_SESSION['user']['id'])) {
            $comment = new AlbumComment();
            $data = $_POST;
            $data['status'] = 1;
            $data['user_id'] = (int)$_SESSION['user']['id'];
            $data['created_at'] = time();
            $data['updated_at'] = time();

            $comment->load($data);
            if (!$comment->validate($data)) {
                $comment->getErrors();
                redirect();
            }
            if ($comment->update('albumcomment', $id)) {
                $_SESSION['success'] = 'Комментарий добавлен';
            }
        }

        redirect();
    }
}