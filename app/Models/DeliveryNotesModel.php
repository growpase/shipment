<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryNotesModel extends Model
{

    protected $table = "tbl_deliverynotes";
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'job_id',
        'handler_id',
        'region',
        'deliverynote_id',
        'issue_date',
        'signed_status',
        'signed_remark',
        'transport_type',
        'delivery_status',
        'delivery_status_remark',
        'is_issue_invoice',
        'is_invoice_issued',
        'est_amount',
        'created_by',
        'created_date',
        'updated_by',
        'updated_date',
    ];

    protected $returnType    = \App\Entities\DeliveryNotesModel::class;

    // // Validation rules for the model
    // protected $validationRules = [
    //     'job_id'                  => 'required|numeric',
    //     'handler_id'              => 'required|numeric',
    //     'region'                  => 'required|string|max_length[100]',
    //     'deliverynote_id'         => 'required',
    //     'issue_date'              => 'required|valid_date',
    //     'signed_status'           => 'required',
    //     'signed_remark'           => 'permit_empty|string|max_length[255]',
    //     'transport_type'          => 'required|string|max_length[50]',
    //     'delivery_status'         => 'required|in_list[DELIVERED,NOT DELIVERED,OTHER]',
    //     'delivery_status_remark' => 'permit_empty|string|max_length[255]',
    //     'is_issue_invoice'        => 'required|in_list[YES,NO]',
    //     'is_invoice_issued'       => 'required|in_list[YES,NO]',
    //     'est_amount'              => 'required|numeric',
    // ];

    // // Custom error messages
    // protected $validationMessages = [
    //     'job_id' => [
    //         'required' => 'Job ID is required.',
    //         'numeric'  => 'Job ID must be a number.',
    //     ],
    //     'handler_id' => [
    //         'required' => 'Handler ID is required.',
    //         'numeric'  => 'Handler ID must be a number.',
    //     ],
    //     'region' => [
    //         'required' => 'Region is required.',
    //         'string'   => 'Region must be a string.',
    //         'max_length' => 'Region cannot be longer than 100 characters.',
    //     ],
    //     'deliverynote_id' => [
    //         'required' => 'Delivery Note ID is required.',
    //         'numeric'  => 'Delivery Note ID must be a number.',
    //     ],
    //     'issue_date' => [
    //         'required'   => 'Issue date is required.',
    //         'valid_date' => 'Please provide a valid issue date.',
    //     ],
    //     'signed_status' => [
    //         'required'  => 'Signed status is required.',
    //         'in_list'   => 'Signed status must be one of: YES, NO, OTHER.',
    //     ],
    //     'signed_remark' => [
    //         'permit_empty' => 'Signed Remark is optional.',
    //         'string'        => 'Signed Remark must be a string.',
    //         'max_length'    => 'Signed Remark cannot be longer than 255 characters.',
    //     ],
    //     'transport_type' => [
    //         'required' => 'Transport type is required.',
    //         'string'   => 'Transport type must be a string.',
    //         'max_length' => 'Transport type cannot be longer than 50 characters.',
    //     ],
    //     'delivery_status' => [
    //         'required' => 'Delivery status is required.',
    //         'in_list'  => 'Delivery status must be one of: DELIVERED, NOT DELIVERED, OTHER.',
    //     ],
    //     'delivery_status_remark' => [
    //         'permit_empty' => 'Delivery status remark is optional.',
    //         'string'        => 'Delivery status remark must be a string.',
    //         'max_length'    => 'Delivery status remark cannot be longer than 255 characters.',
    //     ],
    //     'is_issue_invoice' => [
    //         'required'  => 'Invoice issue status is required.',
    //         'in_list'   => 'Invoice issue status must be either 0 (No) or 1 (Yes).',
    //     ],
    //     'is_invoice_issued' => [
    //         'required'  => 'Invoice issued status is required.',
    //         'in_list'   => 'Invoice issued status must be either 0 (No) or 1 (Yes).',
    //     ],
    //     'est_amount' => [
    //         'required' => 'Estimated amount is required.',
    //         'numeric'  => 'Estimated amount must be a valid number.',
    //     ],
    // ];

    public function getDeliveryNoteList()
    {
        return $this->select('tbl_deliverynotes.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname,tbl_jobsheet.manualreff')
            ->join('tbl_jobsheet', 'tbl_deliverynotes.job_id = tbl_jobsheet.jobid', 'left', false) // Ensure the table name matches your database
            ->orderBy('tbl_deliverynotes.id', 'DESC')
            ->get()->getResult();
    }

    public function getDeliveryNoteRow($dnid)
    {
        return $this->select('tbl_deliverynotes.*,tbl_jobsheet.jobname,tbl_jobsheet.clientname,tbl_user.name')
            ->where('tbl_deliverynotes.id', $dnid)
            ->join('tbl_jobsheet', 'tbl_jobsheet.jobid = tbl_deliverynotes.job_id', 'left')  // Join for dispatcher
            ->join('tbl_user', 'tbl_user.ID = tbl_deliverynotes.handler_id', 'left')  // Join for handler
            ->get()
            ->getRow();
    }
}
