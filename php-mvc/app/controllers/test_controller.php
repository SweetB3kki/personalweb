<?php
declare(strict_types=1);

class TestController extends Controller
{
    public function index(): void
    {
        $this->view->render('test_view.php', 'Тест по дисциплине', $this->model);
    }

    public function validate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); return; }
        Auth::requireAuthenticated();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->model->submit($_POST)) {
                require_once __DIR__ . '/../models/testresult_model.php';
                $record = new TestresultModel();
                $record->fio = $this->model->formData['fio'];
                $record->group_name = $this->model->formData['group'];
                $record->answers = json_encode($this->model->formData, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
                $record->results = json_encode($this->model->validator->Results, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
                $record->score = $this->model->validator->Score;
                $record->created_at = date('Y-m-d H:i:s');
                $record->save();
            }
        }

        $this->view->render('test_view.php', 'Тест по дисциплине', $this->model);
    }

    public function history(): void
    {
        Auth::requireAuthenticated();
        require_once __DIR__ . '/../models/testresult_model.php';
        $this->model->history = TestresultModel::findAll();
        $this->view->render('test_history_view.php', 'Результаты тестирования', $this->model);
    }
}
