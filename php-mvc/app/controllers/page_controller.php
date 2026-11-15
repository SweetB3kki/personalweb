<?php
declare(strict_types=1);

class PageController extends Controller
{
    public function index(): void
    {
        $this->view->render('home_view.php', 'Рабочий стол', $this->model);
    }

    public function about(): void
    {
        $this->view->render('about_view.php', 'Обо мне', $this->model);
    }

    public function study(): void
    {
        $this->view->render('study_view.php', 'Учёба', $this->model);
    }
}
