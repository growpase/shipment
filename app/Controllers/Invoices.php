<?php

namespace App\Controllers;

use App\Models\InvoiceModel;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

class Invoices extends BaseController
{
    protected $InvoiceModel;
    protected $validation;

    public function __construct()
    {
        $this->InvoiceModel = new InvoiceModel();
    }

    public function importFile()
    {
        $rules = [
            'import_file' => [
                'label' => 'File',
                'rules' => 'uploaded[import_file]|mime_in[import_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain]|ext_in[import_file,xls,xlsx,csv]'
            ]
        ];

        // Custom validation messages
        $customMessages = [
            'import_file' => [
                'uploaded' => 'Please upload a file.',
                'mime_in'  => 'Only Excel (.xls, .xlsx) or CSV files are allowed.',
                'ext_in'   => 'The file extension must be .xls, .xlsx, or .csv.'
            ]
        ];

        $this->validation->setRules($rules, $customMessages);

        // Validate the form data
        if (!$this->validation->withRequest($this->request)->run()) {
            // If validation fails, return the error messages as JSON
            $errors = $this->validation->getErrors();
            return $this->response->setJSON([
                'status' => false,
                'errors' => $errors
            ]);
        } else {

            $filename =  $this->request->getFile('import_file');
            $name = $filename->getName();
            $tempName = $filename->getTempName();
            $arr_file = explode(".", $name);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new Csv();
            } else {
                $reader = new excel();
            }
            $spreadsheet = $reader->load($tempName);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            if (!empty($sheetData)) {
                for ($i = 1; $i < count($sheetData); $i++) {
                    $inv_no = !empty($sheetData[$i][0]) ? $sheetData[$i][0] : '0';
                    $job_id = !empty($sheetData[$i][3]) ? $sheetData[$i][3] : '0';
                    $inv_date = !empty($sheetData[$i][1])
                        ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][1])))
                        : '0000-00-00';
                    $add_fee = !empty($sheetData[$i][10]) ? $sheetData[$i][10] : '0';
                    $discount = !empty($sheetData[$i][11]) ? $sheetData[$i][11] : '0';
                    $net_amt = !empty($sheetData[$i][12]) ? $sheetData[$i][12] : '0';
                    $tax_vat = !empty($sheetData[$i][13]) ? $sheetData[$i][13] : '0';
                    $amt_with_tax = !empty($sheetData[$i][14]) ? $sheetData[$i][14] : '0';
                    $realize_cost = !empty($sheetData[$i][15]) ? $sheetData[$i][15] : '0';
                    $selling_cost = !empty($sheetData[$i][16]) ? $sheetData[$i][16] : '0';

                    $data = [
                        'job_id' => $job_id,
                        'inv_no' => $inv_no,
                        'inv_date' => $inv_date,
                        'add_fee' => $add_fee,
                        'discount' => $discount,
                        'net_amt' => $net_amt,
                        'tax_vat' => $tax_vat,
                        'amt_with_tax' => $amt_with_tax,
                        'realize_cost' => $realize_cost,
                        'selling_cost' => $selling_cost,
                        'created_by' => $this->session->get('userId'),
                        'create_date' => date('Y-m-d')
                    ];
                    $this->InvoiceModel->insert($data);
                }
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'File Imported Successfully.'
                ]);
            } else {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Something Went Wrong.'
                ]);
            }
        }
    }

    
}
