<?php
declare(strict_types=1);

class ContactController extends Controller
{
    public function index(): void
    {
        $this->view->render('contact_view.php', 'Контакты', $this->model);
    }

    public function submit(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->submit($_POST);
        }

        $this->view->render('contact_view.php', 'Контакты', $this->model);
    }
}
