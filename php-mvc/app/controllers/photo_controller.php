<?php
declare(strict_types=1);

class PhotoController extends Controller
{
    public function index(): void
    {
        $photoIndex = isset($_GET['photo']) ? (int) $_GET['photo'] : 0;
        $this->model->setCurrentPhoto($photoIndex);

        $this->view->render('gallery_view.php', 'Фотоальбом', $this->model);
    }
}
