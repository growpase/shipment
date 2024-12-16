<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{

    protected $table = "tbl_invoices";
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'job_id',
        'inv_no',
        'branch',
        'delivery_id',
        'inv_date',
        'add_fee',
        'discount',
        'net_amt',
        'tax_vat',
        'amt_with_tax',
        'realize_cost',
        'selling_cost',
        'created_by',
        'create_date',
        'updated_by',
        'update_date',
    ];

    protected $returnType    = \App\Entities\Invoices::class;

    public function getInvoiceList()
    {
        return $this->select('tbl_invoices.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname')
            ->join('tbl_jobsheet', 'tbl_invoices.job_id = tbl_jobsheet.jobid', 'left') // Ensure the table name matches your database
            ->orderBy('tbl_invoices.id', 'DESC')
            ->get()->getResult();
    }

    public function getInvoicesByFilters(array $filters = [])
    {
        $builder = $this->select('tbl_invoices.*, tbl_jobsheet.jobname,tbl_jobsheet.clientname')
            ->join('tbl_jobsheet', 'tbl_invoices.job_id = tbl_jobsheet.jobid', 'left') // Ensure the table name matches your database
            ->orderBy('tbl_invoices.id', 'DESC');

        // Apply filters if set
        if (!empty($filters['datetimes'])) {
            $dates = explode(' - ', $filters['datetimes']);
            $builder->where('inv_date >=', $dates[0])
                ->where('inv_date <=', $dates[1]);
        }
        if (!empty($filters['searchjobid'])) {
            $builder->where('tbl_invoices.job_id', $filters['searchjobid']);
        }
        if (!empty($filters['searchclientid'])) {
            $builder->where('tbl_invoices.job_id', $filters['searchclientid']);
        }
    
        // Fetch all filtered records
        return $builder->get()->getResult();
    }

    public function getTotalInvCount()
    {
        return $this->db->table('tbl_invoices')->countAllResults();
    }
}
