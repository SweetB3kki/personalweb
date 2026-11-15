<?php
declare(strict_types=1);

require_once __DIR__ . '/custom_form_validation.php';

class ResultsVerification extends CustomFormValidation
{
    public array $Results = [];
    public int $Score = 0;

    public function CheckResults(array $postArray): void
    {
        $this->Results = [];
        $this->Score = 0;

        $normalizedFormula = $this->normalizeFormula((string) ($postArray['question1'] ?? ''));
        $firstAnswerCorrect = in_array($normalizedFormula, ['f=ma', 'f=a*m', 'f=m*a'], true);
        $this->appendResult(
            'Вопрос 1',
            $firstAnswerCorrect,
            $firstAnswerCorrect ? 'Формула второго закона Ньютона указана верно.' : 'Ожидался ответ вида F = m * a.'
        );

        $secondAnswerCorrect = ($postArray['question2'] ?? '') === 'Ньютон';
        $this->appendResult(
            'Вопрос 2',
            $secondAnswerCorrect,
            $secondAnswerCorrect ? 'Единица измерения силы выбрана верно.' : 'Правильный ответ: Ньютон.'
        );

        $question3 = (array) ($postArray['question3'] ?? []);
        sort($question3);
        $expectedQuestion3 = ['Масса измеряется в килограммах', 'Скорость измеряется в м/с'];
        sort($expectedQuestion3);
        $thirdAnswerCorrect = $question3 === $expectedQuestion3;
        $this->appendResult(
            'Вопрос 3',
            $thirdAnswerCorrect,
            $thirdAnswerCorrect ? 'Физические утверждения выбраны верно.' : 'Верные варианты: «Скорость измеряется в м/с» и «Масса измеряется в килограммах».'
        );
    }

    public function ShowResults(): string
    {
        if (count($this->Results) === 0) {
            return '';
        }

        $html = '<div class="message-box message-box--success"><h3 class="pixel-text">Результаты проверки</h3>';
        $html .= '<p>Правильных ответов: ' . $this->Score . ' из ' . count($this->Results) . '.</p><ul>';

        foreach ($this->Results as $result) {
            $status = $result['status'] ? 'Верно' : 'Ошибка';
            $html .= '<li><strong>' . htmlspecialchars($result['question'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . ':</strong> ';
            $html .= $status . '. ' . htmlspecialchars($result['message'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    private function appendResult(string $question, bool $status, string $message): void
    {
        if ($status) {
            $this->Score++;
        }

        $this->Results[] = [
            'question' => $question,
            'status' => $status,
            'message' => $message,
        ];
    }

    private function normalizeFormula(string $value): string
    {
        $value = strtolower(trim($value));
        return preg_replace('/\s+/', '', $value) ?? '';
    }
}
