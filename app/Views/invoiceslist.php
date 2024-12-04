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

<?= $this->endSection();
