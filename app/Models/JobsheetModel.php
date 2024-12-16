<?php

namespace App\Models;

use CodeIgniter\Model;

class JobsheetModel extends Model
{
    protected $table = "tbl_jobsheet";
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'branch',
        'jobid',
        'jobname',
        'job_createdate',
        'manualreff',
        'jobtype',
        'clientname',
        'dispatcher_id',
        'handler_id',
        'status',
        'stat',
        'currency',
        'project_cost',
        'realize_cost',
        'invoice_amount',
        'balance_amount',
        'handler_id',
        'dispatcher_id',
        'created_by',
        'modified_by',
        'create_date',
        'update_date'
    ];

    protected $returnType    = \App\Entities\Jobsheet::class;

    public function getJobList()
    {
        $builder = $this->select('tbl_jobsheet.*, dispatcher.name as dispatcher_name, handler.name as handler_name')
            ->join('tbl_user as dispatcher', 'dispatcher.ID = tbl_jobsheet.dispatcher_id', 'left')  // Join for dispatcher
            ->join('tbl_user as handler', 'handler.ID = tbl_jobsheet.handler_id', 'left')  // Join for handler
            ->orderBy('tbl_jobsheet.id', 'DESC');
        // Check if the logged-in user is a handler
        if (session()->get('userRoleName') == 'Handler') {
            $loggedInHandlerId = session()->get('userId'); // Assuming 'userID' holds the logged-in handler's ID
            $builder->where('tbl_jobsheet.handler_id', $loggedInHandlerId);
        }
        return $builder->get()->getResult();
    }

    public function getJobById($jobid)
    {
        return $this->where('jobid', $jobid)->first();
    }

    public function getJobNameList()
    {
        return $this->select('MIN(jobid) as jobid, jobname') // Use MIN to select the id
            ->groupBy('jobname') // Group by clientname to ensure distinct names
            ->orderBy('jobname', 'ASC') // Sort client names alphabetically
            ->get()->getResult(); // Fetch all rows
    }

    public function getClientNameList()
    {
        return $this->select('MIN(jobid) as jobid, clientname') // Use MIN to select the id
            ->groupBy('clientname') // Group by clientname to ensure distinct names
            ->orderBy('clientname', 'ASC') // Sort client names alphabetically
            ->get()->getResult(); // Fetch all rows
    }

    public function getManualReffList()
    {
        return $this->select('MIN(jobid) as jobid, manualreff') // Use MIN to select the id
            ->groupBy('manualreff') // Group by clientname to ensure distinct names
            ->orderBy('manualreff', 'ASC') // Sort client names alphabetically
            ->get()->getResult(); // Fetch all rows
    }

    public function getJobCount()
    {
        return $this->db->table('tbl_jobsheet')->countAllResults();
    }


    public function getJobRecordsByFilters(array $filters = [])
    {
        $builder = $this->select('tbl_jobsheet.*, dispatcher.name as dispatcher_name, handler.name as handler_name')
            ->join('tbl_user as dispatcher', 'dispatcher.ID = tbl_jobsheet.dispatcher_id', 'left')  // Join for dispatcher
            ->join('tbl_user as handler', 'handler.ID = tbl_jobsheet.handler_id', 'left')  // Join for handler
            ->orderBy('tbl_jobsheet.id', 'DESC');

        // Apply filters if set
        if (!empty($filters['datetimes'])) {
            $dates = explode(' - ', $filters['datetimes']);
            $builder->where('job_createdate >=', $dates[0])
                ->where('job_createdate <=', $dates[1]);
        }

        if (!empty($filters['clientname'])) {
            $builder->where('clientname', $filters['clientname']);
        }

        if (!empty($filters['manualreff'])) {
            $builder->where('manualreff', $filters['manualreff']);
        }

        if (!empty($filters['searchjobtype'])) {
            $builder->where('jobtype', $filters['searchjobtype']);
        }

        // Fetch all filtered records
        return $builder->get()->getResult();
    }
}
