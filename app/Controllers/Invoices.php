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
                // Map column headers to their positions
                $headers = $sheetData[0]; // First row is considered as headers
                $headerPositions = [
                    'inv_no' => array_search('INV#', $headers),
                    'inv_date' => array_search('DATE', $headers),
                    'job_id' => array_search('JOB#', $headers),
                    'add_fee' => array_search('ADD. FEE', $headers),
                    'discount' => array_search('DISCOUNT', $headers),
                    'net_amt' => array_search('NET AMT', $headers),
                    'tax_vat' => array_search('TAX/VAT', $headers),
                    'amt_with_tax' => array_search('AMT WITH TAX', $headers),
                    'realize_cost' => array_search('REALIZED COST', $headers),
                    'selling_cost' => array_search('SELLING', $headers),
                ];
                // echo "<pre>";print_r($headerPositions);exit;
                if (in_array(false, $headerPositions, true)) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Error: Missing required columns in the file.',
                    ]);
                }
                $log = [];

                // for ($i = 1; $i < count($sheetData); $i++) {
                //     $inv_no = $sheetData[$i][$headerPositions['inv_no']];
                //     if ($inv_no) {
                //         $existingInvNo = $this->InvoiceModel->where('inv_no', $inv_no)->first();
                //         if ($existingInvNo) {
                //             $log[] = [
                //                 'invid' => $inv_no,
                //                 'reason' => 'Duplicate entry for INV# ' . $inv_no
                //             ];
                //             continue; // Skip this row
                //         }
                //     } 

                //     // update realize cost....
                //     if ($sheetData[$i][$headerPositions['job_id']] && $sheetData[$i][$headerPositions['realize_cost']] > 0) {
                //         $this->updaterealisecost($sheetData[$i][$headerPositions['job_id']], $sheetData[$i][$headerPositions['realize_cost']]);
                //     }
                //     // update invoice cost....
                //     if ($sheetData[$i][$headerPositions['job_id']] && $sheetData[$i][$headerPositions['selling_cost']] > 0) {
                //         $this->updateinvoiceamount($sheetData[$i][$headerPositions['job_id']], $sheetData[$i][$headerPositions['selling_cost']]);
                //     }

                //     $data = [
                //         'branch' => $_POST['branch'],
                //         'job_id' => !empty($sheetData[$i][$headerPositions['job_id']]) ? $sheetData[$i][$headerPositions['job_id']] : '0',
                //         'inv_no' => !empty($sheetData[$i][$headerPositions['inv_no']]) ? $sheetData[$i][$headerPositions['inv_no']] : '0',
                //         'inv_date' => !empty($sheetData[$i][$headerPositions['inv_date']])
                //             ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['inv_date']])))
                //             : '0000-00-00',
                //         'add_fee' => !empty($sheetData[$i][$headerPositions['add_fee']]) ? $sheetData[$i][$headerPositions['add_fee']] : '0',
                //         'discount' => !empty($sheetData[$i][$headerPositions['discount']]) ? $sheetData[$i][$headerPositions['discount']] : '0',
                //         'net_amt' => !empty($sheetData[$i][$headerPositions['net_amt']]) ? $sheetData[$i][$headerPositions['net_amt']] : '0',
                //         'tax_vat' => !empty($sheetData[$i][$headerPositions['tax_vat']]) ? $sheetData[$i][$headerPositions['tax_vat']] : '0',
                //         'amt_with_tax' => !empty($sheetData[$i][$headerPositions['amt_with_tax']]) ? $sheetData[$i][$headerPositions['amt_with_tax']] : '0',
                //         'realize_cost' => !empty($sheetData[$i][$headerPositions['realize_cost']]) ? $sheetData[$i][$headerPositions['realize_cost']] : '0',
                //         'selling_cost' => !empty($sheetData[$i][$headerPositions['selling_cost']]) ? $sheetData[$i][$headerPositions['selling_cost']] : '0',
                //         'created_by' => $this->session->get('userId'),
                //         'create_date' => date('Y-m-d'),
                //     ];
                //     $this->InvoiceModel->insert($data);
                // }
                // return $this->response->setJSON([
                //     'status' => true,
                //     'message' => 'File Imported Successfully.',
                //     'log' => $log
                // ]);

                $log = []; // Initialize a log array for skipped entries.

                for ($i = 1; $i < count($sheetData); $i++) {
                    
                    $inv_no = $sheetData[$i][$headerPositions['inv_no']];
                    $job_id = $sheetData[$i][$headerPositions['job_id']] ?? null;

                    // Check for duplicate invoice number
                    if ($inv_no) {
                        $existingInvNo = $this->InvoiceModel->where('inv_no', $inv_no)->first();
                        if ($existingInvNo) {
                            $log[] = [
                                'invid' => $inv_no,
                                'reason' => 'Duplicate entry for INV# ' . $inv_no
                            ];
                            continue; // Skip this row
                        }
                    }

                    // Check if job_id exists in jobsheet
                    if ($job_id) {

                        $existingJob = $this->JobsheetModel->where('jobid', $job_id)->first();
                        if (!$existingJob) {
                            $log[] = [
                                'invid' => $inv_no,
                                'reason' => 'Job ID ' . $job_id . ' not found in jobsheet.'
                            ];
                            continue; // Skip this row
                        }

                    }

                    // Update realized cost if applicable
                    if ($job_id && $sheetData[$i][$headerPositions['realize_cost']] > 0) {
                        $this->updaterealisecost($job_id, $sheetData[$i][$headerPositions['realize_cost']]);
                    }

                    // Update invoice amount if applicable
                    if ($job_id && $sheetData[$i][$headerPositions['selling_cost']] > 0) {
                        $this->updateinvoiceamount($job_id, $sheetData[$i][$headerPositions['selling_cost']]);
                    }

                    // Prepare data for insertion
                    $data = [
                        'branch' => $_POST['branch'],
                        'job_id' => !empty($job_id) ? $job_id : '0',
                        'inv_no' => !empty($inv_no) ? $inv_no : '0',
                        'inv_date' => !empty($sheetData[$i][$headerPositions['inv_date']])
                            ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['inv_date']])))
                            : '0000-00-00',
                        'add_fee' => !empty($sheetData[$i][$headerPositions['add_fee']]) ? $sheetData[$i][$headerPositions['add_fee']] : '0',
                        'discount' => !empty($sheetData[$i][$headerPositions['discount']]) ? $sheetData[$i][$headerPositions['discount']] : '0',
                        'net_amt' => !empty($sheetData[$i][$headerPositions['net_amt']]) ? $sheetData[$i][$headerPositions['net_amt']] : '0',
                        'tax_vat' => !empty($sheetData[$i][$headerPositions['tax_vat']]) ? $sheetData[$i][$headerPositions['tax_vat']] : '0',
                        'amt_with_tax' => !empty($sheetData[$i][$headerPositions['amt_with_tax']]) ? $sheetData[$i][$headerPositions['amt_with_tax']] : '0',
                        'realize_cost' => !empty($sheetData[$i][$headerPositions['realize_cost']]) ? $sheetData[$i][$headerPositions['realize_cost']] : '0',
                        'selling_cost' => !empty($sheetData[$i][$headerPositions['selling_cost']]) ? $sheetData[$i][$headerPositions['selling_cost']] : '0',
                        'created_by' => $this->session->get('userId'),
                        'create_date' => date('Y-m-d'),
                    ];

                    // Insert the data
                    $this->InvoiceModel->insert($data);
                }

                // Return response with logs
                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'File Imported Successfully.',
                    'log' => $log
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
