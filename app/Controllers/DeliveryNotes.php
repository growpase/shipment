<?php

namespace App\Controllers;

use App\Models\DeliveryNotesModel;

use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

class DeliveryNotes extends BaseController
{
    protected $DeliveryNotesModel;
    protected $validation;

    public function __construct()
    {
        $this->DeliveryNotesModel = new DeliveryNotesModel();
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

                    $job_id = !empty($sheetData[$i][0]) ? $sheetData[$i][0] : '0';
                    $handler_id = !empty($sheetData[$i][1]) ? $sheetData[$i][1] : '0';

                    $issue_date = !empty($sheetData[$i][3])
                        ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][3])))
                        : '0000-00-00';

                    $region = !empty($sheetData[$i][2]) ? $sheetData[$i][2] : '0';

                    $signed_status = !empty($sheetData[$i][4]) ? $sheetData[$i][4] : '0';
                    $signed_remark = !empty($sheetData[$i][5]) ? $sheetData[$i][5] : '0';
                    $delivery_status = !empty($sheetData[$i][6]) ? $sheetData[$i][6] : '0';
                    $delivery_status_remark = !empty($sheetData[$i][7]) ? $sheetData[$i][7] : '0';
                    $transport = !empty($sheetData[$i][11]) ? $sheetData[$i][11] : '0';
                    $is_issue_invoice = !empty($sheetData[$i][8]) ? $sheetData[$i][8] : '0';
                    $is_invoice_issued = !empty($sheetData[$i][9]) ? $sheetData[$i][9] : '0';
                    $est_amount = !empty($sheetData[$i][10]) ? $sheetData[$i][10] : '0';

                    $data = [
                        'job_id' => $job_id,
                        'handler_id' => $handler_id,
                        'issue_date' => $issue_date,
                        'region' => $region,
                        'signed_status' => $signed_status,
                        'signed_remark' => $signed_remark,
                        'delivery_status' => $delivery_status,
                        'delivery_status_remark' => $delivery_status_remark,
                        'transport_type' => $transport,
                        'is_issue_invoice' => $is_issue_invoice,
                        'is_invoice_issued' => $is_invoice_issued,
                        'est_amount' => $est_amount,
                        'created_by' => $this->session->get('userId'),
                        'create_date' => date('Y-m-d')
                    ];
                    $this->DeliveryNotesModel->insert($data);
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

    public function editRow($id)
    {
        $data = $this->DeliveryNotesModel->find($id);
        echo json_encode($data);
    }

    public function deleteRow($id)
    {
        $data = $this->DeliveryNotesModel->delete($id);
        echo json_encode(['status' => true, 'message' =>  $data]);
    }

    public function updateDelivery()
    {
        $_POST['updated_by'] =  $this->session->get('userId');;
        $_POST['updated_date'] = date('Y-m-d');
        $update = $this->DeliveryNotesModel->save($_POST);
     
        if ($update > 0) {
            return $this->response->setJSON(['status' => true, 'message' => 'Update Successfully']);
        } else {
            // Log error when update fails
            return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
        }

    }
}
