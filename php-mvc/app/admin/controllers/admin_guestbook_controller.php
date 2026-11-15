<?php
require_once __DIR__ . '/../../controllers/guestbook_controller.php';
class AdminGuestbookController extends GuestbookController
{
    public function __construct() { parent::__construct(); Auth::requireAdmin(); }
}
