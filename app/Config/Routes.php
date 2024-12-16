<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::login');
$routes->get('user', 'Home::user',['filter' => 'sessionCheck']);
$routes->get('/dashboard', 'Home::dashboard',['filter' => 'sessionCheck']);
$routes->get('job-sheet', 'Home::JobSheet',['filter' => 'sessionCheck']);
$routes->get('delivery-notes/(:num)', 'Home::DeliveryNotesByJobId/$1',['filter' => 'sessionCheck']);
$routes->get('manage-delivery-notes', 'Home::ManageDeliveryNotes',['filter' => 'sessionCheck']);
$routes->get('invoices', 'Home::Invoices',['filter' => 'sessionCheck']);
$routes->get('jobsheet-detail','Home::jobsheet_detail',['filter' => 'sessionCheck']);
$routes->get('deliverynote-detail','Home::deliverynote_detail',['filter' => 'sessionCheck']);
$routes->get('import-job','Home::importJob',['filter' => 'sessionCheck']);
$routes->get('import-deliverynotes','Home::importDeliverynotes',['filter' => 'sessionCheck']);
$routes->get('import-invoices','Home::importInvoices',['filter' => 'sessionCheck']);

// system login
$routes->post('login','Login::login');
$routes->get('logout','Login::logout');
$routes->post('user-registration','User::register');

// user crud
$routes->get('deleteuser/(:num)','User::deleteuser/$1');
$routes->get('edituser/(:num)','User::edituser/$1');
$routes->post('updatestatus','User::updatestatus');
$routes->post('update-user','User::updateuser');

// import jobsheet
$routes->post('import-jobsheet','Jobsheet::importFile');
$routes->get('edit-jobsheet/(:num)','Jobsheet::editRow/$1');
$routes->get('get-by-jobid/(:num)','Jobsheet::getByJobId/$1');
$routes->get('jobsheet-detail/(:num)','Home::jobsheet_detail/$1',['filter' => 'sessionCheck']);
$routes->post('insert-jobsheet','Jobsheet::insertJob');
$routes->post('update-jobsheet','Jobsheet::updateJob');

// delivery notes...
$routes->get('edit-deliverynotes/(:num)','DeliveryNotes::editRow/$1');
$routes->post('update-deliverynotes','DeliveryNotes::updateDelivery');
$routes->get('deliverynotes-detail/(:num)','Home::deliverynotes_detail/$1',['filter' => 'sessionCheck']);
$routes->post('import-deliverynotes','DeliveryNotes::importFile');
$routes->get('delete-deliverynote/(:num)','DeliveryNotes::deleteRow/$1');
$routes->post('insert-deliverynote','DeliveryNotes::insertDeliveryNote');


// invoices....
$routes->post('import-invoices','Invoices::importFile');


// filters
$routes->post('jobsheet-filter','Jobsheet::JobFilters');
$routes->post('deliverynotes-filter','DeliveryNotes::DeliveryNotesbyFilters');
$routes->post('invoice-filter','Invoices::InvoicesFilters');
 