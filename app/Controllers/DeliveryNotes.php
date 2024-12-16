<?php

namespace App\Controllers;

use App\Models\DeliveryNotesModel;
use App\Models\JobsheetModel;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

class DeliveryNotes extends BaseController
{
    protected $DeliveryNotesModel;
    protected $JobsheetModel;
    protected $validation;

    public function __construct()
    {
        $this->DeliveryNotesModel = new DeliveryNotesModel();
        $this->JobsheetModel = new JobsheetModel();
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

                $log = [];

                // for ($i = 1; $i < count($sheetData); $i++) {

                //     $deliverynote_id = $sheetData[$i][$headerPositions['deliverynote_id']];

                //     if ($deliverynote_id) {

                //         $existingInvNo = $this->DeliveryNotesModel->where('deliverynote_id', $deliverynote_id)->first();

                //         if ($existingInvNo) {
                //             $log[] = [
                //                 'deliverynoteid' => $deliverynote_id,
                //                 'reason' => 'Duplicate entry for Delivery Number# ' . $deliverynote_id
                //             ];
                //             continue; // Skip this row
                //         } else {

                //             $data = [
                //                 'branch' => $_POST['branch'],
                //                 'deliverynote_id' => $sheetData[$i][$headerPositions['deliverynote_id']] ?? null,
                //                 'issue_date' => isset($sheetData[$i][$headerPositions['issue_date']]) ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['issue_date']]))) : null,
                //                 'warehouse' => $sheetData[$i][$headerPositions['warehouse']] ?? null,
                //                 'job_id' => $sheetData[$i][$headerPositions['job_id']] ?? null,
                //                 'created_by' => $this->session->get('userId'),
                //                 'create_date' => date('Y-m-d'),
                //             ];
                //             $this->DeliveryNotesModel->insert($data);
                //         }
                //     } else {
                //         $log[] = [
                //             'deliverynoteid' => $deliverynote_id,
                //             'reason' => 'Not Found# ' . $deliverynote_id
                //         ];
                //         continue; // Skip this row
                //     }
                // }
                // return $this->response->setJSON([
                //     'status' => true,
                //     'message' => 'File Imported Successfully.',
                //     'log' => $log
                // ]);

                $log = []; // Initialize a log array for skipped entries.

                for ($i = 1; $i < count($sheetData); $i++) {
                    $deliverynote_id = $sheetData[$i][$headerPositions['deliverynote_id']];
                    $job_id = $sheetData[$i][$headerPositions['job_id']] ?? null;

                    if ($deliverynote_id) {
                        // Check for duplicate deliverynote_id
                        $existingInvNo = $this->DeliveryNotesModel->where('deliverynote_id', $deliverynote_id)->first();
                        if ($existingInvNo) {
                            $log[] = [
                                'deliverynoteid' => $deliverynote_id,
                                'reason' => 'Duplicate entry for Delivery Number# ' . $deliverynote_id
                            ];
                            continue; // Skip this row
                        }

                        // Check if job_id exists in the jobsheet table
                        $existingJob = $this->JobsheetModel->where('jobid', $job_id)->first();
                        if (!$existingJob) {
                            $log[] = [
                                'deliverynoteid' => $deliverynote_id,
                                'reason' => 'Job ID ' . $job_id . ' Not Found.'
                            ];
                            continue; // Skip this row
                        }

                        // Insert the record
                        $data = [
                            'branch' => $_POST['branch'],
                            'deliverynote_id' => $deliverynote_id,
                            'issue_date' => isset($sheetData[$i][$headerPositions['issue_date']]) ? date('Y-m-d', strtotime(str_replace('/', '-', $sheetData[$i][$headerPositions['issue_date']]))) : null,
                            'warehouse' => $sheetData[$i][$headerPositions['warehouse']] ?? null,
                            'job_id' => $job_id,
                            'created_by' => $this->session->get('userId'),
                            'create_date' => date('Y-m-d'),
                        ];
                        $this->DeliveryNotesModel->insert($data);
                    } else {
                        $log[] = [
                            'deliverynoteid' => $deliverynote_id,
                            'reason' => 'Delivery Note ID not found or empty.'
                        ];
                        continue; // Skip this row
                    }
                }

                // Return the response with logs
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

    

    public function DeliveryNotesbyFilters()
    {
        // Handle Filters
        $filters = $this->request->getPost(); // Get POST data for filters
        $DNRecords = $this->DeliveryNotesModel->getDeliveryNotesByFilters($filters);
        $rows = '';
        if (!empty($DNRecords)) {
            foreach ($DNRecords as $deliverynote) {
                $rows .= '<tr>';
                $rows .= '<td scope="row">' . esc($deliverynote->deliverynote_id) . '</td>';
                $rows .= '<td>' . date('d-m-Y', strtotime($deliverynote->issue_date)) . '</td>';
                $rows .= '<td>' . esc($deliverynote->jobname) . '</td>';
                $rows .= '<td>' . esc($deliverynote->clientname) . '</td>';
                $rows .= '<td>' . esc($deliverynote->manualreff) . '</td>';
                $rows .= '<td>' . esc(number_format($deliverynote->est_amount, 2)) . '</td>';

                // Signed Status Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->signed_status) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'YES\',\'signed_status\')">Yes</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'NO\',\'signed_status\')">No</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'OTHER\',\'signed_status\')">Other</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-primary">' . esc($deliverynote->signed_status) . '</span>';
                }
                $rows .= '</div></td>';

                // Issue Invoice Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Handler', 'Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->is_issue_invoice) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'YES\',\'is_issue_invoice\')">Yes</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'NO\',\'is_issue_invoice\')">No</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-danger">' . esc($deliverynote->is_issue_invoice) . '</span>';
                }
                $rows .= '</div></td>';

                // Invoice Issued Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->is_invoice_issued) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'YES\',\'is_invoice_issued\')">Yes</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'NO\',\'is_invoice_issued\')">No</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-danger">' . esc($deliverynote->is_invoice_issued) . '</span>';
                }
                $rows .= '</div></td>';

                // Warehouse Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Dispatcher', 'Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->warehouse) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'RWH\',\'warehouse\')">RWH</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'MWH\',\'warehouse\')">MWH</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-info">' . esc($deliverynote->warehouse) . '</span>';
                }
                $rows .= '</div></td>';

                // Transport Type Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Dispatcher', 'Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->transport_type) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'Naqel\',\'transport_type\')">Naqel</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'Private Car\',\'transport_type\')">Private Car</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-success">' . esc($deliverynote->transport_type) . '</span>';
                }
                $rows .= '</div></td>';

                // Delivery Status Dropdown
                $rows .= '<td><div class="btn-group">';
                if (in_array(session()->get('userRoleName'), ['Dispatcher', 'Admin'])) {
                    $rows .= '<span type="button">' . esc($deliverynote->delivery_status) . '</span>';
                    $rows .= '<a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>';
                    $rows .= '<div class="dropdown-menu">';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'DELIVERED\',\'delivery_status\')">DELIVERED</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'NOT DELIVERED\',\'delivery_status\')">NOT DELIVERED</a>';
                    $rows .= '<a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(' . $deliverynote->id . ',\'OTHER\',\'delivery_status\')">OTHER</a>';
                    $rows .= '</div>';
                } else {
                    $rows .= '<span class="text-warning">' . esc($deliverynote->delivery_status) . '</span>';
                }
                $rows .= '</div></td>';

                // Actions (View and Delete)
                $rows .= '<td><a href="' . base_url('deliverynotes-detail/' . $deliverynote->id) . '"><i class="fa fa-eye"></i></a>';
                if (session()->get('userRoleName') === 'Admin') {
                    $rows .= ' | <i class="fa fa-trash-o delete-icon" onclick="delete_data(' . $deliverynote->id . ')"></i>';
                }
                $rows .= '</td>';

                $rows .= '</tr>';
            }
        } else {
            // If no records are found, display a message
            $rows .= '<tr>';
            $rows .= '<td colspan="14" class="text-center text-danger">No job sheet found</td>';
            $rows .= '</tr>';
        }
        // Return the rows as a JSON response
        return $this->response->setJSON(['DNRecords' => $rows]);
    }
}
