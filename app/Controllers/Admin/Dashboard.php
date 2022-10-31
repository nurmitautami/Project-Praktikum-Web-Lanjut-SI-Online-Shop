<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function index()
    {
        $this->data['pageTitle'] = 'Dashboard Pagess';
        $this->data['currentAdminMenu'] = 'dashboard';
        $this->data['currentAdminSubMenu'] = 'dashboard';
        return View('admin/dashboard/index', $this->data);
    }
}