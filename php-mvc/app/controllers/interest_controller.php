<?php
declare(strict_types=1);

class InterestController extends Controller
{
    public function index(): void
    {
        $category = isset($_GET['category']) ? (string) $_GET['category'] : 'all';
        $this->model->setCurrentCategory($category);

        $this->view->render('interests_view.php', 'Мои интересы', $this->model);
    }
}
