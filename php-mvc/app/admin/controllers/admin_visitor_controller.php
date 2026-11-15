<?php
class AdminVisitorController extends AdminController
{
    public function index(): void
    {
        $this->model->loadPage((int)($_GET['page'] ?? 1));
        $this->view->render('visits_view.php', 'Статистика посещений', $this->model, 'admin_layout.php');
    }
}
