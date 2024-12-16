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
        'branch',
        'region',
        'warehouse',
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

    public function getDeliveryNoteList()
    {
        $builder = $this->select('tbl_deliverynotes.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname,tbl_jobsheet.manualreff')
            ->join('tbl_jobsheet', 'tbl_deliverynotes.job_id = tbl_jobsheet.jobid', 'left', false) // Ensure the table name matches your database
            ->orderBy('tbl_deliverynotes.id', 'DESC');
        if (session()->get('userRoleName') == 'Handler') {
            $loggedInHandlerId = session()->get('userId'); // Assuming 'userID' holds the logged-in handler's ID
            $builder->where('tbl_deliverynotes.handler_id', $loggedInHandlerId);
        }
        return $builder->get()->getResult();
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
    public function getDeliveryNoteByJobId($jobID)
    {
        return $this->select('tbl_deliverynotes.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname,tbl_jobsheet.manualreff')
            ->join('tbl_jobsheet', 'tbl_deliverynotes.job_id = tbl_jobsheet.jobid', 'left', false) // Ensure the table name matches your database
            ->where('tbl_deliverynotes.job_id', $jobID)
            ->orderBy('tbl_deliverynotes.id', 'DESC')
            ->get()->getResult();
    }

    public function getDeliveryNotesByFilters(array $filters = [])
    {
        $builder = $this->select('tbl_deliverynotes.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname,tbl_jobsheet.manualreff')
            ->join('tbl_jobsheet', 'tbl_deliverynotes.job_id = tbl_jobsheet.jobid', 'left', false) // Ensure the table name matches your database
            ->orderBy('tbl_deliverynotes.id', 'DESC');

        // Apply filters if set
        if (!empty($filters['datetimes'])) {
            $dates = explode(' - ', $filters['datetimes']);
            $builder->where('issue_date >=', $dates[0])
                ->where('issue_date <=', $dates[1]);
        }
        if (!empty($filters['searchjobid'])) {
            $builder->where('tbl_deliverynotes.job_id', $filters['searchjobid']);
        }
        if (!empty($filters['searchclientid'])) {
            $builder->where('tbl_deliverynotes.job_id', $filters['searchclientid']);
        }

        if (!empty($filters['searchmanualid'])) {
            $builder->where('tbl_deliverynotes.job_id', $filters['searchmanualid']);
        }

        // Fetch all filtered records
        return $builder->get()->getResult();
    }

    public function getTotalDNCount()
    {
        return $this->db->table('tbl_deliverynotes')->countAllResults();
    }
}
