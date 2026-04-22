<?php
namespace App\Controllers\adminController;

use App\Controllers\BaseController;
use App\Models\adminModel\addClientModel;

class clientController extends BaseController
{
    public function index()
    {
        return view('adminUI/addClient');
    }

    public function store()
    {
        $model = new addClientModel();

        $data = [
            'full_name' => $this->request->getPost('fullname'),
            'address' => $this->request->getPost('address'),
            'meter_number' => $this->request->getPost('meter_number')
        ];
        $model->insert($data);
        return redirect()->to('/addClient')->with('success', 'Client added successfully');
    }
}