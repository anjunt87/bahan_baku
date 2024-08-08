<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\Controller;
use App\Models\ListItemsModel;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\CartModel;
use App\Models\OutboundModel;
use App\Models\OutboundItemModel;
use App\Models\PreOrderModel;
use App\Models\PreOrderCartModel;
use App\Models\DivisionModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $cartModel;
    protected $cartItems;
    protected $itemModel;
    protected $inventoryModel;
    protected $listitemsModel;
    protected $suppliersModel;
    protected $orderModel;
    protected $orderitemModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $preOrderModel;
    protected $preOrderCartModel;
    protected $divisionModel;

    public function __construct()
    {
        $this->usersModel = new UserModel();
        $this->listitemsModel = new ListItemsModel();
        $this->suppliersModel = new SuppliersModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();
        $this->divisionModel = new DivisionModel();
    }

    public function getUsers()
    {
        $usersModel = new UserModel();
        $users = $usersModel->findAll();
        return $this->response->setJSON($users);
    }

    public function getUsersByDivision($divisionId)
    {
        $usersModel = new UserModel();
        $users = $usersModel->where('division_id', $divisionId)->findAll();
        return $this->response->setJSON($users);
    }

    public function getDivisions()
    {
        $divisions = $this->divisionModel->getDivisionsWithDepartment();
        return $this->response->setJSON($divisions);
    }

    public function getDivisionsByDepartment($departmentId)
    {
        $divisions = $this->divisionModel->where('department_id', $departmentId)->findAll();
        return $this->response->setJSON($divisions);
    }

}
