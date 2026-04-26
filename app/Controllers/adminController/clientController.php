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
        helper('audit'); // make sure helper is loaded

        $model = new addClientModel();

        $data = [
            'full_name' => $this->request->getPost('fullname'),
            'address' => $this->request->getPost('address'),
            'meter_number' => $this->request->getPost('meter_number')
        ];

        try {
            $model->insert($data);

            $insertId = $model->getInsertID();

            // ✅ SUCCESS AUDIT
            log_audit('create', 'clients', $insertId, null, $data);

            return redirect()->to('/addClient')->with('success', 'Client added successfully');

        } catch (\Exception $e) {

            // ❗ FAILED AUDIT (VERY IMPORTANT)
            log_audit(
                'create_failed',
                'clients',
                null,
                null,
                $data
            );

            return redirect()->back()->with('error', 'Meter number already exists!');
        }
    }
}