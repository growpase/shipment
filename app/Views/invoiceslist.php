<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <button type="button" class="btn btn-danger btn-md mt-3 mb-3" data-toggle="modal" data-target="#jobsheetModal"> <i class="fa fa-upload"></i> Upload Invoice Sheet</button>
                    </div>
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
                                                <th scope="col">Job </th>
                                                <th scope="col">Handler </th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($Invoicerecords as $record): ?>
                                                <tr>
                                                    <th scope="row"><?= $i++; ?></th>
                                                    <td><?= esc($record->inv_no) ?></td>
                                                    <td><?= esc($record->inv_date) ?></td>
                                                    <td><?= esc($record->clientname) ?></td>
                                                    <td><?= esc($record->jobname) ?></td>
                                                    <td>Omar Mrayati</td>
                                                    <!-- <td><button class="btn btn-sm btn-success" data-toggle="modal" data-target="#jobstatusModal"><i class="fa fa-edit"></i> Status</button> </td> -->
                                                    <td><i data-toggle="modal" data-target="#editdeliverynotesModal" class="ti-pencil"></i> | <i class="fa fa-trash-o delete-icon"></i></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card-body text-warning"> No Jobs Found! </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection();
