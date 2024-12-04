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

                // Define headers
                $headers = $sheetData[0]; // First row is the headers
                $headerPositions = [
                    'deliverynote_id' => array_search('delivery number', $headers),
                    'issue_date' => array_search('date', $headers),
                    'warehouse' => array_search('warehouse', $headers),
                    'job_id' => array_search('job #', $headers),
                ];

                if (in_array(false, $headerPositions, true)) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Error: Missing required columns in the file.',
                    ]);
                }

                for ($i = 1; $i < count($sheetData); $i++) {
                    $data = [
                        'deliverynote_id' => $sheetData[$i][$headerPositions['deliverynote_id']] ?? null,
                        'issue_date' => isset($sheetData[$i][$headerPositions['issue_date']]) ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['issue_date']]))) : null,
                        'warehouse' => $sheetData[$i][$headerPositions['warehouse']] ?? null,
                        'job_id' => $sheetData[$i][$headerPositions['job_id']] ?? null,
                        'created_by' => $this->session->get('userId'),
                        'create_date' => date('Y-m-d'),
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

    public function insertDeliveryNote()
    {
        $validationRules = [
            'deliverynote_id' => ['label' => 'Delivery Note Id', 'rules' => 'required'],
            'region' => ['label' => 'Region', 'rules' => 'required'],
            'issue_date'     => ['label' => 'Issue Date', 'rules' => 'required'],
            'est_amount'        => ['label' => 'Estimate Amount', 'rules' => 'required'],
            'handler_id'     => ['label' => 'Handler ID', 'rules' => 'required'],
        ];

        $validationMessages = [
            'deliverynote_id' => [
                'required' => 'Please Mentioned DeliveryNoteId',
            ],
            'region' => [
                'required' => 'Please Select Region',
            ],
            'issue_date' => [
                'required' => 'Please Select Issue Date',
            ],
            'est_amount' => [
                'required' => 'Enter Amount.',
            ],
            'handler_id' => [
                'required' => 'Assign Handler.',
            ],
        ];

        $this->validation->setRules($validationRules, $validationMessages);

        // Validate form data
        if (!$this->validation->withRequest($this->request)->run()) {
            // If validation fails, return the error messages as JSON
            $errors = $this->validation->getErrors();
            return $this->response->setJSON([
                'status' => false,
                'errors' => $errors
            ]);
        } else {

            $_POST['created_by'] =  $this->session->get('userId');;
            $_POST['created_date'] = date('Y-m-d');

            $isInsert = $this->DeliveryNotesModel->insert($_POST);
            if ($isInsert > 0) {
                return $this->response->setJSON(['status' => true, 'message' => 'Job Inserted Successfully']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
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

    public function stuff()
    {

        // for ($i = 1; $i < count($sheetData); $i++) {

        //     $job_id = !empty($sheetData[$i][8]) ? $sheetData[$i][8] : '0';
        //     $deliverynote_id = !empty($sheetData[$i][0]) ? $sheetData[$i][0] : '0';

        //     $issue_date = !empty($sheetData[$i][1])
        //         ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][1])))
        //         : '0000-00-00';

        //     $warehouse = !empty($sheetData[$i][5]) ? $sheetData[$i][5] : '0';

        //     $data = [
        //         'job_id' => $job_id,
        //         'deliverynote_id' => $deliverynote_id,
        //         'issue_date' => $issue_date,
        //         'warehouse' => $warehouse,
        //         'created_by' => $this->session->get('userId'),
        //         'created_date' => date('Y-m-d')
        //     ];
        //     $this->DeliveryNotesModel->insert($data);
        // }

        // $data = [
        //     'job_id' => $job_id,
        //     'deliverynote_id' => $deliverynote_id,
        //     'issue_date' => $issue_date,
        //     'warehouse' => $warehouse,
        //     'created_by' => $this->session->get('userId'),
        //     'created_date' => date('Y-m-d')
        // ];
    }
}
