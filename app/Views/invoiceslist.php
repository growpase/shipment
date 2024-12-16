<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-danger btn-md mt-3 mb-3" data-toggle="modal" data-target="#jobsheetModal"> <i class="fa fa-upload"></i> Upload Invoice Sheet</button>
                    </div> -->
                    <form id="filterForm" method="POST">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="dateRange">Job Date</label>
                                    <input type="text" id="" name="datetimes" class="form-control" placeholder="d">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="clientName">Job Name</label>
                                    <select name="searchjobid" id="jobtype" class="form-control ">
                                        <option value="">Select Job Name</option>
                                        <?php foreach ($jobnamelist as $jobname): ?>
                                            <option value="<?= esc($jobname->jobid) ?>"><?= esc($jobname->jobname) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="clientName">Client Name</label>
                                    <select name="searchclientid" id="clientName" class="form-control">
                                        <option value="">Select Client Name</option>
                                        <?php foreach ($clientlist as $client): ?>
                                            <option value="<?= esc($client->jobid) ?>"><?= esc($client->clientname) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="btn-group mt-4 w-100" role="group" aria-label="Button group example">
                                    <button type="button" id="searchBtn" class="btn btn-info btn-sm text-white">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                    <button type="button" id="resetBtn" class="btn btn-dark btn-sm text-white">
                                        <i class="fa fa-refresh"></i> Reset
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <div class="single-table">
                        <?php if (!empty($Invoicerecords) and is_array($Invoicerecords)): ?>
                            <div class="table-responsive">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-uppercase bg-primary">
                                            <tr class="text-white">
                                                <th scope="col">ID</th>
                                                <th scope="col">Invoice No</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Client </th>
                                                <th scope="col">Project Name </th>
                                                <th scope="col">ADD. Fee </th>
                                                <th scope="col">Discount</th>
                                                <th scope="col">Net Amt</th>
                                                <th scope="col">Tax/Vat</th>
                                                <th scope="col">Amt With Tax</th>
                                                <th scope="col">Realize Cost</th>
                                                <th scope="col">Selling Cost</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            function formatNumber($number)
                                            {
                                                if ($number == 0) {
                                                    return '0.00';
                                                }
                                                $exploded = explode('.', $number);
                                                $integerPart = $exploded[0];
                                                $decimalPart = isset($exploded[1]) ? $exploded[1] : '00';
                                                // Format the integer part
                                                $formattedIntegerPart = preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', substr($integerPart, 0, -3)) . ',' . substr($integerPart, -3);
                                                return $formattedIntegerPart . '.' . str_pad($decimalPart, 2, '0', STR_PAD_RIGHT);
                                            }

                                            foreach ($Invoicerecords as $record): ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= esc($record->inv_no) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($record->inv_date)) ?></td>
                                                    <td><?= esc($record->clientname) ?></td>
                                                    <td><?= esc($record->jobname) ?></td>
                                                    <td><?= esc(formatNumber($record->add_fee)) ?></td>
                                                    <td><?= esc(formatNumber($record->discount)) ?></td>
                                                    <td><?= esc(formatNumber($record->net_amt)) ?></td>
                                                    <td><?= esc(formatNumber($record->tax_vat)) ?></td>
                                                    <td><?= esc(formatNumber($record->amt_with_tax)) ?></td>
                                                    <td><?= esc(formatNumber($record->realize_cost)) ?></td>
                                                    <td><?= esc(formatNumber($record->selling_cost)) ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card-body text-danger"> No Invoices Found ! </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('pagescripts'); ?>

<script>
    $(document).ready(function() {


        $('input[name="datetimes"]').daterangepicker({
            timePicker: false,
            startDate: moment().startOf('hour'),
            endDate: moment().startOf('hour').add(32, 'hour'),
            autoUpdateInput: true, // Prevents the input field from being auto-filled
            locale: {
                format: 'YYYY-MM-DD'
            }
        });



        // Handle Search Button Click
        $('#searchBtn').click(function() {
            $('#dataTable2 tbody').html('');
            // Serialize form data
            var filters = $('#filterForm').serialize();
            $.ajax({
                url: '<?= base_url('invoice-filter') ?>',
                type: 'POST',
                data: filters,
                success: function(response) {
                    $('#dataTable2 tbody').html(response.InvoiceRecords);
                    initializeDataTable();
                },
                error: function(xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        });
    });

    // Handle Reset Button Click
    $('#resetBtn').click(function() {
        window.location.href = '<?= base_url('invoices') ?>';
    });

    // Function to reload the table content and reinitialize the DataTable
    function reloadTableContent() {
        // Reload the table section using jQuery .load()
        $('.table-responsive').load(window.location.href + ' .table-responsive', function() {
            // After the content is loaded, reinitialize DataTable to restore functionality
            initializeDataTable();
        });
    }

    // Initialize DataTable with the desired options
    function initializeDataTable() {
        // If DataTable is already initialized, destroy it before reinitializing
        if ($.fn.dataTable.isDataTable('#dataTable2')) {
            $('#dataTable2').DataTable().destroy();
        }
        // Reinitialize DataTable
        $('#dataTable2').DataTable({
            "paging": true, // Enable pagination
            "searching": true, // Enable search
            "ordering": false, // Enable column sorting
            "info": false, // Display info about the number of records
            "lengthChange": false, // Enable the option to change the number of records per page
            "responsive": false // Make the table responsive
        });
    }
</script>
<?= $this->endSection(); ?>