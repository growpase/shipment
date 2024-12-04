<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\JobsheetModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $JobsheetModel;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ['url', 'form', 'session'];
    protected $session;
    protected $validation;
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        date_default_timezone_set('Asia/Kolkata');
        // Preload any models, libraries, etc, here.
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
    }

    // update realize cost while uploading invoice sheet
    public function updaterealisecost($job_id, $realize_cost)
    {
        $this->JobsheetModel = new JobsheetModel();
        $jobData = $this->JobsheetModel->getJobById($job_id); // Replace with your method to fetch job data
        if (!$jobData) {
            // Log an error when the job record is not found
            log_message('error', "Job record not found for Job ID: {$job_id} while updating realize cost.");
            return false; // Job record not found
        }

        $id = $jobData ? $jobData->id : 0;
        $currentCost = $jobData ? $jobData->realize_cost : 0;
        $newCost = $currentCost + $realize_cost;
        return $this->JobsheetModel->update($id, ['realize_cost' => $newCost]);
    }

    // update Invoice amount while uploading invoice sheet.
    public function updateinvoiceamount($job_id, $inv_amount)
    {
        $this->JobsheetModel = new JobsheetModel();
        $jobData = $this->JobsheetModel->getJobById($job_id); // Replace with your method to fetch job data
        if (!$jobData) {
            // Log an error when the job record is not found
            log_message('error', "Job record not found for Job ID: {$job_id} while updating invoice amount.");
            return false; // Job record not found
        }
        $id = $jobData ? $jobData->id : 0;
        $projectCost = $jobData ? $jobData->project_cost : 0;
        $currentInvAmount = $jobData ? $jobData->inv_amount : 0;
        $newInvAmount = $currentInvAmount + $inv_amount;
        $newbalanceAmount = $projectCost - $newInvAmount;

        $updateArray = [
            'invoice_amount' => $newInvAmount,
            'balance_amount' => $newbalanceAmount
        ];
        return $this->JobsheetModel->update($id, $updateArray);
    }
}
