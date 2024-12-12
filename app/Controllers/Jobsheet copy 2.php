<?php

namespace App\Controllers;

use App\Models\JobsheetModel;
use App\Models\UserModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

class Jobsheet extends BaseController
{
    protected $JobsheetModel;
    protected $UserModel;
    protected $validation;

    public function __construct()
    {
        $this->JobsheetModel = new JobsheetModel();
        $this->UserModel = new UserModel();
    }

    // bk- 9-12-24...
    // public function importFile()
    // {
    //     $rules = [
    //         'branch' => [
    //             'label' => 'Branch',
    //             'rules' => 'required'
    //         ],
    //         'import_file' => [
    //             'label' => 'File',
    //             'rules' => 'uploaded[import_file]|mime_in[import_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain]|ext_in[import_file,xls,xlsx,csv]'
    //         ]
    //     ];

    //     // Custom validation messages
    //     $customMessages = [
    //         'branch' => [
    //             'required' => 'Please select a branch.'  // Custom message for branch field
    //         ],
    //         'import_file' => [
    //             'uploaded' => 'Please upload a file.',
    //             'mime_in'  => 'Only Excel (.xls, .xlsx) or CSV files are allowed.',
    //             'ext_in'   => 'The file extension must be .xls, .xlsx, or .csv.'
    //         ]
    //     ];

    //     $this->validation->setRules($rules, $customMessages);

    //     // Validate the form data
    //     if (!$this->validation->withRequest($this->request)->run()) {
    //         // If validation fails, return the error messages as JSON
    //         $errors = $this->validation->getErrors();
    //         return $this->response->setJSON([
    //             'status' => false,
    //             'errors' => $errors
    //         ]);
    //     } else {
    //         $filename =  $this->request->getFile('import_file');
    //         $name = $filename->getName();
    //         $tempName = $filename->getTempName();
    //         $arr_file = explode(".", $name);
    //         $extension = end($arr_file);
    //         if ('csv' == $extension) {
    //             $reader = new Csv();
    //         } else {
    //             $reader = new excel();
    //         }
    //         $spreadsheet = $reader->load($tempName);
    //         $sheetData = $spreadsheet->getActiveSheet()->toArray();

    //         if (!empty($sheetData)) {
    //             $headers = $sheetData[0]; // First row is considered as headers
    //             $headerPositions = [
    //                 'jobid' => array_search('JOB#', $headers),
    //                 'jobname' => array_search('PROJECT NAME', $headers),
    //                 'job_createdate' => array_search('DATE CREATION', $headers),
    //                 'manualreff' => array_search('MANUAL REF#', $headers),
    //                 'jobtype' => array_search('JOB TYPE', $headers),
    //                 'clientname' => array_search('CLIENT NAME', $headers),
    //                 'handler_id' => array_search('HANDLER', $headers),
    //                 'status' => array_search('STATUS', $headers),
    //                 'stat' => array_search('STAT', $headers),
    //                 'currency' => array_search('CURRENCY', $headers),
    //                 'project_cost' => array_search('PROJECT VALUE', $headers),
    //                 'invoice_amount' => array_search('TOTAL INV ISSUED AMOUNT', $headers),
    //                 'balance_amount' => array_search('BALANCE', $headers),
    //             ];

    //             if (in_array(false, $headerPositions, true)) {
    //                 return $this->response->setJSON([
    //                     'status' => false,
    //                     'message' => 'Error: Missing required columns in the file.',
    //                 ]);
    //             }

    //             for ($i = 1; $i < count($sheetData); $i++) {
    //                 if ($sheetData[$i][$headerPositions['handler_id']]) {
    //                     $handlerid = $this->UserModel->getByHandlerName($sheetData[$i][$headerPositions['handler_id']]);
    //                     $handler_id = !empty($handlerid) ? $handlerid->ID : '0';
    //                 }
    //                 // apply handler ID from sheet via name....
    //                 $data = [
    //                     'branch' => $_POST['branch'] ?? null,
    //                     'jobid' => $sheetData[$i][$headerPositions['jobid']] ?? null,
    //                     'jobname' => $sheetData[$i][$headerPositions['jobname']] ?? null,
    //                     'job_createdate' => isset($sheetData[$i][$headerPositions['job_createdate']]) ? date('Y-m-d', strtotime(str_replace('/', '-',$sheetData[$i][$headerPositions['job_createdate']]))) : null,
    //                     'manualreff' => $sheetData[$i][$headerPositions['manualreff']] ?? null,
    //                     'jobtype' => $sheetData[$i][$headerPositions['jobtype']] ?? null,
    //                     'clientname' => $sheetData[$i][$headerPositions['clientname']] ?? null,
    //                     'handler_id' => $handler_id,
    //                     'status' => $sheetData[$i][$headerPositions['status']] ?? null,
    //                     'stat' => $sheetData[$i][$headerPositions['stat']] ?? null,
    //                     'currency' => $sheetData[$i][$headerPositions['currency']] ?? null,
    //                     'project_cost' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['project_cost']])) ?? 0,
    //                     'invoice_amount' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['invoice_amount']])) ?? 0,
    //                     'balance_amount' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['balance_amount']])) ?? 0,
    //                     'created_by' => $this->session->get('userId'),
    //                     'create_date' => date('Y-m-d'),
    //                 ];
    //                 $this->JobsheetModel->insert($data);
    //             }
    //             return $this->response->setJSON([
    //                 'status' => true,
    //                 'message' => 'File Imported Successfully.'
    //             ]);
    //         } else {
    //             return $this->response->setJSON([
    //                 'status' => false,
    //                 'message' => 'Something Went Wrong.'
    //             ]);
    //         }
    //     }
    // }

    public function importFile()
    {
        $rules = [
            'branch' => [
                'label' => 'Branch',
                'rules' => 'required'
            ],
            'import_file' => [
                'label' => 'File',
                'rules' => 'uploaded[import_file]|mime_in[import_file,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,text/plain]|ext_in[import_file,xls,xlsx,csv]'
            ]
        ];

        // Custom validation messages
        $customMessages = [
            'branch' => [
                'required' => 'Please select a branch.'  // Custom message for branch field
            ],
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
                $headers = $sheetData[0]; // First row is considered as headers
                $headerPositions = [
                    'jobid' => array_search('JOB#', $headers),
                    'jobname' => array_search('PROJECT NAME', $headers),
                    'job_createdate' => array_search('DATE CREATION', $headers),
                    'manualreff' => array_search('MANUAL REF#', $headers),
                    'jobtype' => array_search('JOB TYPE', $headers),
                    'clientname' => array_search('CLIENT NAME', $headers),
                    'handler_id' => array_search('HANDLER', $headers),
                    'status' => array_search('STATUS', $headers),
                    'stat' => array_search('STAT', $headers),
                    'currency' => array_search('CURRENCY', $headers),
                    'project_cost' => array_search('PROJECT VALUE', $headers),
                    'invoice_amount' => array_search('TOTAL INV ISSUED AMOUNT', $headers),
                    'balance_amount' => array_search('BALANCE', $headers),
                ];

                if (in_array(false, $headerPositions, true)) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Error: Missing required columns in the file.',
                    ]);
                }

                for ($i = 1; $i < count($sheetData); $i++) {
                    
                    if ($sheetData[$i][$headerPositions['handler_id']]) {
                        $handlerid = $this->UserModel->getByHandlerName($sheetData[$i][$headerPositions['handler_id']]);
                        $handler_id = !empty($handlerid) ? $handlerid->ID : '0';
                    }

                    // apply handler ID from sheet via name....
                    $data = [
                        'branch' => $_POST['branch'] ?? null,
                        'jobid' => $sheetData[$i][$headerPositions['jobid']] ?? null,
                        'jobname' => $sheetData[$i][$headerPositions['jobname']] ?? null,
                        'job_createdate' => isset($sheetData[$i][$headerPositions['job_createdate']]) ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['job_createdate']]))) : null,
                        'manualreff' => $sheetData[$i][$headerPositions['manualreff']] ?? null,
                        'jobtype' => $sheetData[$i][$headerPositions['jobtype']] ?? null,
                        'clientname' => $sheetData[$i][$headerPositions['clientname']] ?? null,
                        'handler_id' => $handler_id,
                        'status' => $sheetData[$i][$headerPositions['status']] ?? null,
                        'stat' => $sheetData[$i][$headerPositions['stat']] ?? null,
                        'currency' => $sheetData[$i][$headerPositions['currency']] ?? null,
                        'project_cost' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['project_cost']])) ?? 0,
                        'invoice_amount' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['invoice_amount']])) ?? 0,
                        'balance_amount' => floatval(str_replace(',', '', $sheetData[$i][$headerPositions['balance_amount']])) ?? 0,
                        'created_by' => $this->session->get('userId'),
                        'create_date' => date('Y-m-d'),
                    ];

                    $this->JobsheetModel->insert($data);
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

    public function insertJob()
    {
        $validationRules = [
            'branch'         => ['label' => 'Branch', 'rules' => 'required'],
            'jobid'          => ['label' => 'Job ID', 'rules' => 'required'],
            'jobname'        => ['label' => 'Job Name', 'rules' => 'required'],
            'job_createdate' => ['label' => 'Job Creation Date', 'rules' => 'required'],
            'manualreff'     => ['label' => 'Manual Reference', 'rules' => 'required'],
            'jobtype'        => ['label' => 'Job Type', 'rules' => 'required'],
            'clientname'     => ['label' => 'Client Name', 'rules' => 'required'],
            'dispatcher_id'  => ['label' => 'Dispatcher ID', 'rules' => 'required'],
            'handler_id'     => ['label' => 'Handler ID', 'rules' => 'required'],
            'status'         => ['label' => 'Status', 'rules' => 'required'],
            'stat'           => ['label' => 'Stat', 'rules' => 'required'],
            'currency'       => ['label' => 'Currency', 'rules' => 'required'],
            'project_cost'   => ['label' => 'Project Cost', 'rules' => 'required'],
            'invoice_amount' => ['label' => 'Invoice Amount', 'rules' => 'required'],
        ];

        $validationMessages = [
            'branch' => [
                'required' => 'Please provide a branch name.',
                'max_length' => 'Branch name cannot exceed 100 characters.'
            ],
            'jobid' => [
                'required' => 'Please provide a Job ID.',
                'numeric' => 'Job ID must be numeric.',
                'max_length' => 'Job ID cannot exceed 20 characters.'
            ],
            'jobname' => [
                'required' => 'Please enter the job name.',
                'max_length' => 'Job name cannot exceed 255 characters.'
            ],
            'job_createdate' => [
                'required' => 'Please specify the job creation date.',
                'valid_date' => 'Job creation date must be in the format YYYY-MM-DD.'
            ],
            'manualreff' => [
                'required' => 'Please specify Manual Reference.',
            ],
            'jobtype' => [
                'required' => 'Please specify the job type.',
                'max_length' => 'Job type cannot exceed 50 characters.'
            ],
            'clientname' => [
                'required' => 'Client name is required.',
                'max_length' => 'Client name cannot exceed 100 characters.'
            ],
            'dispatcher_id' => [
                'required' => 'Dispatcher ID is required.',
                'numeric' => 'Dispatcher ID must be numeric.'
            ],
            'handler_id' => [
                'required' => 'Handler ID is required.',
                'numeric' => 'Handler ID must be numeric.'
            ],
            'status' => [
                'required' => 'Status is required.',
                'in_list' => 'Status must be one of the following: pending, approved, rejected.'
            ],
            'stat' => [
                'required' => 'Stat is required.',
            ],
            'currency' => [
                'required' => 'Currency is required.',
                'alpha' => 'Currency must only contain letters.',
                'exact_length' => 'Currency must be a 3-letter code.'
            ],
            'project_cost' => [
                'required' => 'Project cost is required.',
                'decimal' => 'Project cost must be a valid decimal number.'
            ],
            // 'realize_cost' => [
            //     'decimal' => 'Realized cost must be a valid decimal number.'
            // ],
            'invoice_amount' => [
                'required' => 'Invoice amount is required.',
                'decimal' => 'Invoice amount must be a valid decimal number.'
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
            $_POST['create_date'] = date('Y-m-d');

            $isInsert = $this->JobsheetModel->insert($_POST);
            if ($isInsert > 0) {
                return $this->response->setJSON(['status' => true, 'message' => 'Job Inserted Successfully']);
            } else {
                return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
            }
        }
    }

    public function getByJobId($jobid)
    {
        $data = $this->JobsheetModel->where('jobid', $jobid)->get()->getRow();
        echo json_encode($data);
    }

    public function editRow($id)
    {
        $data = $this->JobsheetModel->find($id);
        echo json_encode($data);
    }

    public function updateJob()
    {
        $update = $this->JobsheetModel->save($_POST);
        if ($update > 0) {
            return $this->response->setJSON(['status' => true, 'message' => 'Update Successfully']);
        } else {
            return $this->response->setJSON(['status' => false, 'message' => 'Something Went Wrong']);
        }
    }

    public function stuff()
    {
        //     $user_name = !empty($sheetData[$i][7]) ? $sheetData[$i][7] : '0'; 
        //     // apply handler ID from sheet via name....
        //     $handlerid = $this->UserModel->getByHandlerName($user_name);

        //     $handler_id = !empty($handlerid) ? $handlerid->ID : '0';
        //     $branch = $_POST['branch'];
        //     $jobid = !empty($sheetData[$i][2]) ? $sheetData[$i][0] : '0';
        //     $jobname = !empty($sheetData[$i][2]) ? $sheetData[$i][2] : '0';

        //     $job_createdate = !empty($sheetData[$i][3])
        //         ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][3])))
        //         : '0000-00-00';

        //     $manualreff = !empty($sheetData[$i][4]) ? $sheetData[$i][4] : '0';
        //     $jobtype = !empty($sheetData[$i][5]) ? $sheetData[$i][5] : '0';
        //     $clientname = !empty($sheetData[$i][6]) ? $sheetData[$i][6] : '0';
        //     $stat = !empty($sheetData[$i][18]) ? $sheetData[$i][18] : '0';
        //     $currency = !empty($sheetData[$i][19]) ? $sheetData[$i][19] : '0';
        //     $status = !empty($sheetData[$i][13]) ? $sheetData[$i][13] : '0';
        //     $project_cost = !empty($sheetData[$i][22]) ? floatval(str_replace(',', '', $sheetData[$i][22])) : 0;
        //     $invoice_amount = !empty($sheetData[$i][22]) ? floatval(str_replace(',', '', $sheetData[$i][23])) : 0;
        //     $balance_amount = !empty($sheetData[$i][24]) ? floatval(str_replace(',', '', $sheetData[$i][24])) : 0;

        //     $data = [
        //         'branch' => $branch,
        //         'jobid' => $jobid,
        //         'jobname' => $jobname,
        //         'job_createdate' => $job_createdate,
        //         'manualreff' => $manualreff,
        //         'jobtype' => $jobtype,
        //         'clientname' => $clientname,
        //         'stat' => $stat,
        //         'currency' => $currency,
        //         'handler_id' => $handler_id,
        //         'status' => $status,
        //         'project_cost' => $project_cost,
        //         'invoice_amount' => $invoice_amount,
        //         'balance_amount' => $balance_amount,
        //         'created_by' => $this->session->get('userId'),
        //         'create_date' => date('Y-m-d')
        //     ];

        //     $this->JobsheetModel->insert($data);
    }
}
