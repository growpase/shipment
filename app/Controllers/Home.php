<?php

namespace App\Controllers;
use App\Models\RoleModel;
use App\Models\UserModel;
use App\Models\JobsheetModel;
use App\Models\DeliveryNotesModel;
use App\Models\InvoiceModel;

use CodeIgniter\API\ResponseTrait;
 
class Home extends BaseController
{
    use ResponseTrait;
    protected $RoleModel;
    protected $UserModel;
    protected $JobsheetModel;
    protected $InvoiceModel;
    protected $DeliveryNotesModel;

    public function __construct()
    {
        $this->RoleModel = new RoleModel();
        $this->UserModel = new UserModel();
        $this->JobsheetModel = new JobsheetModel();
        $this->InvoiceModel = new InvoiceModel();
        $this->DeliveryNotesModel = new DeliveryNotesModel();
    }

    public function dashboard()
    {
        $data['pageTitle'] = 'Dashboard';
        return view('dashboard',$data);
    }
    
    public function login()
    { 
        return view('login');
    }
 
    
    public function JobSheet()
    {
        $data['pageTitle'] = 'Manage Jobs';
        $data['dispatcherlist'] = $this->UserModel->where('user_role', 3)->get()->getResult();
        $data['handlerlist'] = $this->UserModel->where('user_role', 2)->get()->getResult();
        $data['Jobrecords'] = $this->JobsheetModel->getJobList();
        
        return view('jobsheet',$data);
    }

    public function jobsheet_detail($id)
    { 
        $data['pageTitle'] = 'Job Detail';
        $data['dispatcherlist'] = $this->UserModel->where('user_role', 3)->get()->getResult();
        $data['handlerlist'] = $this->UserModel->where('user_role', 2)->get()->getResult();
        $data['jobdetail'] = $this->JobsheetModel->where('id', $id)->get()->getRow();
       
        return view('jobsheet_detail',$data);
    }

    public function importJob()
    { 
        $data['pageTitle'] = 'Import Job Sheet';
        return view('importjob',$data);
    }
    
    public function importInvoices()
    { 
        $data['pageTitle'] = 'Import Invoices';
        return view('importinvoices',$data);
    }
    
    public function importDeliverynotes()
    { 
        $data['pageTitle'] = 'Import Delivery Notes';
        return view('importdeliverynotes',$data);
    }

    public function deliverynotes_detail($id)
    { 
        $data['pageTitle'] = 'Delivery Note Detail';
        $data['handlerlist'] = $this->UserModel->where('user_role', 2)->get()->getResult();
        $data['joblist'] = $this->JobsheetModel->get()->getResult();
        $data['dn_detail'] = $this->DeliveryNotesModel->getDeliveryNoteRow($id);
       
        return view('deliverynote_detail',$data);
    }

    public function DeliveryNotesByJobId($jobid)
    { 
        $data['pageTitle'] = 'Delivery Note Under Job';
        $data['handlerlist'] = $this->UserModel->where('user_role', 2)->get()->getResult();
        $data['jobdetails'] = $this->JobsheetModel->where('jobid',$jobid)->get()->getRow();
        $data['deliverynotes'] = $this->DeliveryNotesModel->getDeliveryNoteByJobId($jobid);
        // echo "<pre>";print_r($data);exit;
        return view('deliverynotesbyjobid',$data);
    }

    public function ManageDeliveryNotes()
    { 
        $data['pageTitle'] = 'Manage Delivery Notes';
        $data['deliverynotes'] = $this->DeliveryNotesModel->getDeliveryNoteList();
        return view('manage_deliverynotes',$data);
    }

    public function user()
    { 
        $data['pageTitle'] = 'User List';
        $data['roles'] = $this->RoleModel->where('ID !=', 1)->get()->getResult();
        $data['records'] = $this->UserModel->getQuery();
        return view('user',$data);
    }
   
    public function Invoices()
    { 
        $data['pageTitle'] = 'Manage Invoices';
        $data['Invoicerecords'] = $this->InvoiceModel->getInvoiceList();
        return view('invoiceslist',$data);
    }
    
}
