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
            ->join('tbl_jobsheet', 'tbl_invoices.job_id = tbl_jobsheet.id','left') // Ensure the table name matches your database
            ->orderBy('tbl_invoices.id', 'DESC')
            ->get()->getResult();
    }
}
