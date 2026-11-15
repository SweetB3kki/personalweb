<?php
require_once __DIR__ . '/auth.php';
class AdminController extends Controller
{
    public function __construct() { parent::__construct(); Auth::requireAdmin(); }
}
