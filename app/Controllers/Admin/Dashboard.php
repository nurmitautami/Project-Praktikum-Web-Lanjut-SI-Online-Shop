<?php namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    function index()
    {
        $this->data['pageTitle'] = 'Dashboard Pagess';
        return View('admin/dashboard/index', $this->data);
    }
}