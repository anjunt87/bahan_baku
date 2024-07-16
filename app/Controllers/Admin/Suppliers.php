<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SuppliersModel;

class Suppliers extends BaseController
{
    protected $suppliersModel;

    public function __construct()
    {
        $this->suppliersModel = new SuppliersModel();
    }

    public function index()
    {
        $suppliers = $this->suppliersModel->findAll();

        $data = [
            'title' => 'Data Suppliers',
            'suppliers' => $suppliers
        ];
        return view('admin/suppliers', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'name_suppliers' => $this->request->getPost('nameSuppliersInput'),
                'production_suppliers' => $this->request->getPost('productionInput'),
                'contact_suppliers' => $this->request->getPost('contactInput')
            ];

            if ($this->suppliersModel->saveSuppliers($data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier added successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to add supplier.']);
            }
        }
    }

    public function edit($id)
    {
        if ($this->request->isAJAX()) {
            $suppliers = $this->suppliersModel->find($id);
            if ($suppliers) {
                return $this->response->setJSON(['success' => true, 'data' => $suppliers]);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Supplier not found.']);
            }
        }
    }


    public function update()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_suppliers');
            $data = [
                'name_suppliers' => $this->request->getPost('nameSuppliersEdit'),
                'production_suppliers' => $this->request->getPost('productionEdit'),
                'contact_suppliers' => $this->request->getPost('contactEdit')
            ];

            if ($this->suppliersModel->update($id, $data)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier updated successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to update supplier.']);
            }
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $id = $this->request->getPost('id_suppliers');
            if ($this->suppliersModel->delete($id)) {
                return $this->response->setJSON(['success' => true, 'message' => 'Supplier deleted successfully.']);
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete supplier.']);
            }
        }
    }
}
