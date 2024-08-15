<?php

namespace App\Controllers;

use App\Models\CartModel;
use CodeIgniter\Controller;
use App\Models\SuppliersModel;
use App\Models\OrderModel;
use App\Models\OutboundItemModel;
use App\Models\UserModel;
use App\Models\PreOrderCartModel;
use App\Models\PreOrderItemsModel;
use App\Models\PreOrderModel;
use App\Models\OutboundModel;
use App\Models\InboundModel;
use App\Models\ListItemsModel;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController

{
    protected $cartModel;
    protected $cartItems;
    protected $itemModel;
    protected $listitemsModel;
    protected $suppliersModel;
    protected $orderModel;
    protected $orderitemModel;
    protected $outboundModel;
    protected $outboundItemModel;
    protected $usersModel;
    protected $preOrderModel;
    protected $preOrderCartModel;
    protected $preOrderItemsModel;

    public function __construct()
    {

        $this->listitemsModel = new ListItemsModel();
        $this->suppliersModel = new SuppliersModel();
        $this->outboundModel = new OutboundModel();
        $this->outboundItemModel = new OutboundItemModel();
        $this->usersModel = new UserModel();
        $this->cartModel = new CartModel();
        $this->itemModel = new ListItemsModel();
        $this->preOrderModel = new PreOrderModel();
        $this->preOrderCartModel = new PreOrderCartModel();
        $this->preOrderItemsModel = new PreOrderItemsModel();

    }

    public function stockReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $itemsModel->getStockReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Stock Report',
            'titledate' => 'Stock Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/stock', $data);
    }


    public function preOrderReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $preOrderModel->getPreOrderReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Pre Order',
            'titledate' => 'Pre Order Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/pre_order', $data);
    }

    public function preOrderdetail($preorderId)
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();


        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $preorder = $this->preOrderModel->getPreOrderById($preorderId);
        $outboundItems = $this->preOrderItemsModel->getItemsByPreorderId($preorderId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($preorder['user_id']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

        $data = [
            'title' => 'Report Pre Order Details',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'suppliersname' => $suppliersname // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('reports/pre_order_detail', $data);
    }

    public function outboundReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();
        $model = new OutboundModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $model->getOutboundReport($startDate, $endDate);

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Outbound',
            'titledate' => 'Outbound Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];
        return view('reports/outbound', $data);
    }

    public function outboundDetail($outboundId)
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();

        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $outbound = $this->outboundModel->getOutboundById($outboundId);
        $outboundItems = $this->outboundItemModel->getItemsByOutboundId($outboundId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($outbound['user_id']);
        $receivedByUsername = $this->usersModel->getUsernameById($outbound['recipient_id']);

        $data = [
            'title' => 'Outbound Details Report',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'outbound' => $outbound,
            'outboundItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'receivedByUsername' => $receivedByUsername // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('reports/outbound_detail', $data);
    }

    public function inboundReport()
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $preOrderModel = new PreOrderModel();
        $preOrderCartModel = new PreOrderCartModel();

        $startDate = $this->request->getPost('start_date');
        $endDate = $this->request->getPost('end_date');

        // Log debug
        log_message('debug', 'Start Date: ' . $startDate);
        log_message('debug', 'End Date: ' . $endDate);

        // Ambil data user dari session
        $session = session();

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $preOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // Fetch the reports based on the date range
        $report = $preOrderModel->getInboundReport($startDate, $endDate); // Ensure the method name matches

        // Log debug
        log_message('debug', 'Report Data: ' . json_encode($report));

        $data = [
            'title' => 'Report Inbound',
            'titledate' => 'Inbound Report from ',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'),
            'pocount' => $preOrderCartCount,
            'cartcount' => $cartItemCount,
            'reports' => $report
        ];

        return view('reports/inbound', $data);
    }

    public function inboundDetail($preorderId)
    {
        // Pastikan pengguna sudah login
        if (!session()->has('user_id')) {
            return redirect()->to('/login');
        }

        $cartModel = new CartModel();
        $itemsModel = new ListItemsModel();
        $preOrderCartModel = new PreOrderCartModel();
        $preOrderItemsModel = new PreOrderItemsModel();


        // Ambil data user dari session
        $session = session();
        $user_id = $session->get('user_id');
        $username = $session->get('user_name');
        $user_email = $session->get('user_email');

        // Hitungan di navigasi bar
        $cartItemCount = $cartModel->getCartItemCount();
        $PreOrderCartCount = $preOrderCartModel->getPreorderCartCount();

        // data inti per controller
        $preorder = $this->preOrderModel->getPreOrderById($preorderId);
        $outboundItems = $this->preOrderItemsModel->getItemsByPreorderId($preorderId);

        // Mendapatkan username dari ID pengguna
        $notedByUsername = $this->usersModel->getUsernameById($preorder['noted_by']);
        $checkedByUsername = $this->usersModel->getUsernameById($preorder['checked_by']);
        $suppliersname = $this->suppliersModel->getSuppliersnameById($preorder['supplier_id']); //Seharusnya bukan di QC tapi ID Supplier dan informasi kontaknya

        $data = [
            'title' => 'Report Inbound Details',
            'subtitle' => '',
            'username' => $session->get('user_name'), // Mengambil username dari session
            'user_email' => $session->get('user_email'), // Mengambil useremail dari session
            'pocount' => $PreOrderCartCount,
            'cartcount' => $cartItemCount,
            'preorder' => $preorder,
            'preorderItems' => $outboundItems,
            'notedByUsername' => $notedByUsername, // Menyertakan username untuk noted by
            'checkedByUsername' => $checkedByUsername, // Menyertakan username untuk checked by
            'suppliersname' => $suppliersname // Menyertakan username untuk received by
        ];

        // Kirim data outbound dan item outbound ke view
        return view('reports/inbound_detail', $data);
    }

    public function downloadPDFReportStock($startDate, $endDate)
    {
        $report = $this->listitemsModel->getStockReport($startDate, $endDate);

        $dompdf = new Dompdf();
        $html = view('reports/pdf/pdf_stock', ['reports' => $report, 'startdate' => $startDate, 'enddate' => $endDate]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream('Stock_Report_' . date('Ymd') . '.pdf');
    }

    public function downloadExcelReportStock($startDate, $endDate)
    {
        $report = $this->listitemsModel->getStockReport($startDate, $endDate);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Name');
        $sheet->setCellValue('B1', 'Previous Stock');
        $sheet->setCellValue('C1', 'Stock');
        $sheet->setCellValue('D1', 'Last Updated');

        $row = 2;
        foreach ($report as $data) {
            $sheet->setCellValue('A' . $row, $data['name_items']);
            $sheet->setCellValue('B' . $row, $data['previous_stock']);
            $sheet->setCellValue('C' . $row, $data['stock_items']);
            $sheet->setCellValue('D' . $row, date('d M Y', strtotime($data['updated_at'])));
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Stock_Report_' . date('Ymd') . '.xlsx';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    public function downloadPDFReportPreorder($startDate, $endDate)
    {
        // Ambil data laporan berdasarkan rentang tanggal
        $report = $this->preOrderModel->getPreOrderReport($startDate, $endDate);

        // Siapkan view untuk PDF
        $data = [
            'title' => 'Report Pre Order',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'reports' => $report
        ];

        // Load view dan jadikan outputnya HTML
        $html = view('reports/pdf/pdf_pre_order', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output file PDF
        $dompdf->stream("pre_order_report_" . $startDate . "_to_" . $endDate . ".pdf", ["Attachment" => 1]);
    }


    public function downloadExcelReportPreorder($startDate, $endDate)
    {
        // Ambil data laporan berdasarkan rentang tanggal
        $report = $this->preOrderModel->getPreOrderReport($startDate, $endDate);

        // Inisialisasi PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul dan header
        $sheet->setCellValue('A1', 'ID Pre Order');
        $sheet->setCellValue('B1', 'Status');
        $sheet->setCellValue('C1', 'Suppliers');
        $sheet->setCellValue('D1', 'Amount Item');
        $sheet->setCellValue('E1', 'Delivery Note');
        $sheet->setCellValue('F1', 'Order Date');
        $sheet->setCellValue('G1', 'Check Date');

        // Isi data ke dalam sheet
        $row = 2;
        foreach ($report as $reportItem) {
            $sheet->setCellValue('A' . $row, $reportItem['id']);
            $sheet->setCellValue('B' . $row, $reportItem['status']);
            $sheet->setCellValue('C' . $row, $reportItem['name_suppliers']);
            $sheet->setCellValue('D' . $row, $reportItem['amount_item']);
            $sheet->setCellValue('E' . $row, $reportItem['delivery_note']);
            $sheet->setCellValue('F' . $row, date('d M Y', strtotime($reportItem['pre_order_date'])));
            $sheet->setCellValue('G' . $row, date('d M Y', strtotime($reportItem['check_date'])));
            $row++;
        }

        // Menulis file Excel ke output
        $writer = new Xlsx($spreadsheet);
        $filename = 'pre_order_report_' . $startDate . '_to_' . $endDate;

        // Redirect output ke browser agar bisa didownload langsung
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function downloadPDFReportOutbound($startDate, $endDate)
    {
        // Pastikan pengguna sudah login
        // if (!session()->has('user_id')) {
        //     return redirect()->to('/login');
        // }

        // $startDate = $this->request->getPost('start_date');
        // $endDate = $this->request->getPost('end_date');

        $report = $this->outboundModel->getOutboundReport($startDate, $endDate);

        $data = [
            'title' => 'Outbound Report',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'reports' => $report
        ];

        // Load view menjadi string untuk digunakan dalam PDF
        $html = view('reports/pdf/pdf_outbound', $data);

        // Initialize Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output the generated PDF (Download)
        $dompdf->stream('outbound_report_' . date('YmdHis') . '.pdf', ['Attachment' => 1]);
    }

    public function downloadExcelReportOutbound($startDate, $endDate)
    {
        // // Pastikan pengguna sudah login
        // if (!session()->has('user_id')) {
        //     return redirect()->to('/login');
        // }

        // $startDate = $this->request->getPost('start_date');
        // $endDate = $this->request->getPost('end_date');

        $report = $this->outboundModel->getOutboundReport($startDate, $endDate);

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header
        $sheet->setCellValue('A1', 'ID Outbound');
        $sheet->setCellValue('B1', 'Status');
        $sheet->setCellValue('C1', 'Noted By');
        $sheet->setCellValue('D1', 'Recipient By');
        $sheet->setCellValue('E1', 'Amount Item');
        $sheet->setCellValue('F1', 'Outbound Date');

        // Set isi dari report
        $row = 2;
        foreach ($report as $data) {
            $sheet->setCellValue('A' . $row, $data['id']);
            $sheet->setCellValue('B' . $row, $data['status']);
            $sheet->setCellValue('C' . $row, $data['noted_by_username']);
            $sheet->setCellValue('D' . $row, $data['recipient_username']);
            $sheet->setCellValue('E' . $row, $data['amount_item']);
            $sheet->setCellValue('F' . $row, date('d M Y', strtotime($data['outbound_date'])));
            $row++;
        }

        // Set nama file
        $filename = 'outbound_report_' . date('YmdHis') . '.xlsx';

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

    public function downloadPDFReportInbound($startDate, $endDate)
    {
        // // Pastikan pengguna sudah login
        // if (!session()->has('user_id')) {
        //     return redirect()->to('/login');    
        // }

        // $startDate = $this->request->getPost('start_date');
        // $endDate = $this->request->getPost('end_date');
        
        // Ambil data laporan berdasarkan rentang tanggal
        $report = $this->preOrderModel->getInboundReport($startDate, $endDate);

        // Siapkan view untuk PDF
        $data = [
            'title' => 'Report Inbound',
            'startdate' => $startDate,
            'enddate' => $endDate,
            'reports' => $report
        ];

        // Load view dan jadikan outputnya HTML
        $html = view('reports/pdf/pdf_inbound', $data);

        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Output file PDF
        $dompdf->stream("inbound_report_" . $startDate . "_to_" . $endDate . ".pdf", ["Attachment" => 1]);
    }


    public function downloadExcelReportInbound($startDate, $endDate)
    {
        $preOrderModel = new PreOrderModel();

        // // Pastikan pengguna sudah login
        // if (!session()->has('user_id')) {
        //     return redirect()->to('/login');
        // }

        // $startDate = $this->request->getPost('start_date');
        // $endDate = $this->request->getPost('end_date');

        // Ambil data laporan berdasarkan rentang tanggal
        $report = $this->preOrderModel->getInboundReport($startDate, $endDate);

        // Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul dan header
        $sheet->setCellValue('A1', 'ID Inbound');
        $sheet->setCellValue('B1', 'Status');
        $sheet->setCellValue('C1', 'Suppliers');
        $sheet->setCellValue('D1', 'Amount Item');
        $sheet->setCellValue('E1', 'Noted By');
        $sheet->setCellValue('F1', 'Checked By');
        $sheet->setCellValue('G1', 'Delivery Note');
        $sheet->setCellValue('H1', 'Order Date');
        $sheet->setCellValue('I1', 'Check Date');

        // Isi data ke dalam sheet
        $row = 2;
        foreach ($report as $reportItem) {
            $sheet->setCellValue('A' . $row, $reportItem['id']);
            $sheet->setCellValue('B' . $row, $reportItem['status']);
            $sheet->setCellValue('C' . $row, $reportItem['name_suppliers']);
            $sheet->setCellValue('D' . $row, $reportItem['amount_item']);
            $sheet->setCellValue('E' . $row, $reportItem['created_by_username']);
            $sheet->setCellValue('F' . $row, $reportItem['checked_by_username']);
            $sheet->setCellValue('G' . $row, $reportItem['delivery_note']);
            $sheet->setCellValue('H' . $row, date('d M Y', strtotime($reportItem['pre_order_date'])));
            $sheet->setCellValue('I' . $row, date('d M Y', strtotime($reportItem['check_date'])));
            $row++;
        }

        // Menulis file Excel ke output
        $writer = new Xlsx($spreadsheet);
        $filename = 'inbound_report_' . $startDate . '_to_' . $endDate;

        // Redirect output ke browser agar bisa didownload langsung
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
