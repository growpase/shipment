<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>

<!-- page title area end -->
<div class="main-content-inner">
    <div class="row">
        <!-- table primary start -->
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-md-9">
                            <h5>Job ID : <?= $jobdetails->jobid ?></h5>
                            <h5>Job Name : <?= $jobdetails->jobname ?></h5>
                        </div>
                        <div class="col-md-3">
                            <!-- <button type="button" class="btn btn-warning btn-md text-white" data-toggle="modal" data-target="#adddeliverynotesModal"> <i class="fa fa-plus"></i> Add Delivery Note</button> -->
                            <?php if (session()->get('userRoleName') === 'Admin') : ?>
                                <button type="button" class="btn btn-warning btn-md text-white" data-toggle="modal" data-target="#adddeliverynotesModal">
                                    <i class="fa fa-plus"></i> Add Delivery Note
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="single-table dntable">
                        <?php if (!empty($deliverynotes) and is_array($deliverynotes)): ?>
                            <div class="table-responsive">
                                <div class="data-tables datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-uppercase bg-primary">
                                            <tr class="text-white">
                                            <th scope="col">Delivery Note</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Net Amount</th>
                                                <th scope="col">Signed</th>
                                                <th scope="col">Issued Invoice</th>
                                                <th scope="col">Invoice Issue</th>
                                                <th scope="col">WareHouse</th>
                                                <th scope="col">Transpotation Type</th>
                                                <th scope="col">Delivery Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php function formatNumber($number)
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
                                            foreach ($deliverynotes as $deliverynote): ?>
                                                <tr>
                                                    <td scope="row"><?= esc($deliverynote->deliverynote_id) ?></td>
                                                    <td><?= date('d-m-Y', strtotime($deliverynote->issue_date)) ?></td>
                                                    <td><?= esc($deliverynote->jobname) ?></td>
                                                    <td><?= esc(formatNumber($deliverynote->est_amount)) ?></td>


                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->signed_status) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','signed_status')">Yes</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','signed_status')">No</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'OTHER','signed_status')">Other</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-primary"><?= esc($deliverynote->signed_status) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>



                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Handler', 'Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->is_issue_invoice) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_issue_invoice')">Yes</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_issue_invoice')">No</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-danger"><?= esc($deliverynote->is_issue_invoice) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->is_invoice_issued) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_invoice_issued')">Yes</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_invoice_issued')">No</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-danger"><?= esc($deliverynote->is_invoice_issued) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Dispatcher','Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->warehouse) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'RWH','warehouse')">RWH</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'MWH','warehouse')">MWH</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-info"><?= esc($deliverynote->warehouse) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>


                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Dispatcher', 'Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->transport_type) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'Naqel','transport_type')">Naqel</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'Private Car','transport_type')">Private Car</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-success"><?= esc($deliverynote->transport_type) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div class="btn-group">
                                                            <?php if (in_array(session()->get('userRoleName'), ['Dispatcher', 'Admin'])) { ?>
                                                                <span type="button"><?= esc($deliverynote->delivery_status) ?></span>
                                                                <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                                                                <div class="dropdown-menu">
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'DELIVERED','delivery_status')">DELIVERED</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NOT DELIVERED','delivery_status')">NOT DELIVERED</a>
                                                                    <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'OTHER','delivery_status')">OTHER</a>
                                                                </div>
                                                            <?php } else { ?>
                                                                <span class="text-warning"><?= esc($deliverynote->delivery_status) ?></span>
                                                            <?php } ?>
                                                        </div>
                                                    </td>

                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->signed_status) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','signed_status')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','signed_status')">No</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'OTHER','signed_status')">Other</a>
                                                            </div>
                                                        </div>
                                                    </td> -->

                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->is_issue_invoice) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_issue_invoice')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_issue_invoice')">No</a>
                                                            </div>
                                                        </div>
                                                    </td> -->


                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->is_invoice_issued) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'YES','is_invoice_issued')">Yes</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NO','is_invoice_issued')">No</a>
                                                            </div>
                                                        </div>
                                                    </td> -->

                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->warehouse) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'RWH','warehouse')">RWH</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'MWH','warehouse')">MWH</a>
                                                            </div>
                                                        </div>
                                                    </td> -->

                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->transport_type) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'Naqel','transport_type')">Naqel</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'Private Car','transport_type')">Private Car</a>
                                                            </div>
                                                        </div>
                                                    </td> -->

                                                    <!-- <td>
                                                        <div class="btn-group">
                                                            <span type="button" class=""><?= esc($deliverynote->delivery_status) ?></span>
                                                            <a class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            </a>
                                                            <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(72px, 43px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'DELIVERED','delivery_status')">DELIVERED</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'NOT DELIVERED','delivery_status')">NOT DELIVERED</a>
                                                                <a class="dropdown-item" href="javascript:void(0)" onclick="updateChanges(<?= $deliverynote->id ?>,'OTHER','delivery_status')">OTHER</a>
                                                            </div>
                                                        </div>
                                                    </td> -->

                                                    <td> <a href="<?= base_url() ?>deliverynotes-detail/<?= $deliverynote->id ?>"> <i class="fa fa-eye"></i> </a> <?php if (session()->get('userRoleName') === 'Admin') : ?>
                                                            | <i class="fa fa-trash-o delete-icon" onclick="delete_data(<?= $deliverynote->id ?>)"></i>
                                                        <?php endif; ?></td>
                                                    </td>

                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                <?php else: ?>
                    <div class="card-body text-warning"> No Users Found! </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- invoice issue model -->
<div class="modal fade show" id="adddeliverynotesModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="deliverynotesform">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Delivery Note Id.</label>
                                <input class="form-control" name="deliverynote_id" type="text" placeholder="Delivery Notes Id.">
                                <span class="text-danger" id="deliverynote_id_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">Date </label>
                                <input type="date" name="issue_date" class="form-control" value="">
                                <span class="text-danger" id="issue_date_error"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="example-text-input" class="col-form-label">EST. Amount </label>
                                <input type="text" name="est_amount" class="form-control" placeholder="Enter Amount Here">
                                <span class="text-danger" id="est_amount_error"></span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job List</label>
                                <input type="text" name="job_id" class="form-control" readonly value="<?= $jobdetails->jobid ?>" id="">
                            </div>

                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Handler</label>
                                <select name="handler_id" class="form-control select2" id="handler_id">
                                    <option value="">Select Handler Here</option>
                                    <?php foreach ($handlerlist as $handler) { ?>
                                        <option value="<?= $handler->ID ?>"><?= $handler->name ?></option>
                                    <?php } ?>
                                </select>
                                <span class="text-danger" id="handler_id_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="example-text-input" class="col-form-label">Region </label>
                                <select name="region" class="form-control">
                                    <option value="">Select Region</option>
                                    <?php foreach (REGIONS as $region): ?>
                                        <option value="<?= $region ?>"><?= ucfirst($region) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger" id="region_error"></span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Job Name</label>
                                <input class="form-control" readonly type="text" placeholder="<?= $jobdetails->jobname ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="example-text-input" class="col-form-label">Client Name </label>
                                <input type="text" readonly class="form-control" placeholder="<?= $jobdetails->clientname ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Transport Type</label>
                                <select name="transport_type" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="Naqel"> Naqel</option>
                                    <option value="Private Car">Private car</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Issue Invoice</label>
                                <select name="is_issue_invoice" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="YES"> Yes</option>
                                    <option value="NO" selected>No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Invoice Issued</label>
                                <select name="is_invoice_issued" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="YES"> Yes</option>
                                    <option value="NO" selected>No</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Ware House</label>
                                <select name="warehouse" class="custom-select">
                                    <option value="">Select Option</option>
                                    <option value="MWH"> MWH</option>
                                    <option value="RWH">RWH</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="delivery_status">Delivery Status</label>
                                <select name="delivery_status" class="form-control" id="delivery_status">
                                    <option value="">Select Status</option>
                                    <option value="DELIVERED">DELIVERED</option>
                                    <option value="NOT DELIVERED" selected>NOT DELIVERED</option>
                                    <option value="OTHER">Other</option>
                                </select>
                            </div>

                            <div class="col-md-8">
                                <label for="delivery_status_remark">Delivery Remark</label>
                                <input type="text" name="delivery_status_remark" id="delivery_status_remark" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4 signed_status_div">
                                <label for="signed_status">Signed In</label>
                                <select name="signed_status" class="form-control" id="signed_status">
                                    <option value="">Select Status</option>
                                    <option value="YES">Yes</option>
                                    <option value="NO" selected>No</option>
                                    <option value="OTHER">Other</option>
                                </select>
                            </div>

                            <div class="col-md-8 signed_status_div">
                                <label for="signed_remark">Signed In Remark</label>
                                <input type="text" name="signed_remark" id="signed_remark" value="" class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="SaveDeliveryNote()" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!--  remarkModal -->
<div class="modal fade show" id="remarkModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="signedinform">
                        <input type="hidden" id="deliveyid" value="">
                        <input type="hidden" id="signed_status_value" value="">
                        <div class="row">
                            <div class="col-md-12" id="signed_remark_div">
                                <div class="form-group">
                                    <label for="signed_remark">Signed Remark </label>
                                    <textarea class="form-control" name="signed_remark" id="type_signed_remark" placeholder="Signed Status Remark" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges($('#deliveyid').val(), $('#signed_status_value').val(),'signed_remark')" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- delivery status model -->
<div class="modal fade show" id="deliveryremarkModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="signedinform">
                        <input type="hidden" id="deliveryid_" value="">
                        <input type="hidden" id="delivery_status_value" value="">
                        <div class="row">
                            <div class="col-md-12" id="delivery_status_remark_div">
                                <div class="form-group">
                                    <label for="delivery_status">Delivery Status Remark </label>
                                    <textarea class="form-control" name="delivery_status_remark" id="type_delivery_remark" placeholder="Add Status Remark" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateChanges($('#deliveryid_').val(), $('#delivery_status_value').val(),'delivery_status_remark')" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
<?= $this->section('pagescripts'); ?>
<script>
    let save_method = 'add';
    $(document).ready(function() {
        // For input fields
        $("input").on("change", function() {
            $(this).closest('.form-group ').find('.error-text').text('');
        });
        // For select elements
        $("select").on("change", function() {
            $(this).closest('.form-group ').find('.error-text').text('');
        });

        // Check the current delivery status on page load and adjust the input field accordingly
        var deliveryStatus = $('#delivery_status').val();
        toggleDeliveryRemarkField(deliveryStatus); // Call function on page load

        // Listen to changes in the delivery status select dropdown
        $('#delivery_status').change(function() {
            var selectedStatus = $(this).val();
            toggleDeliveryRemarkField(selectedStatus); // Adjust the input field when changed
        });

        // Function to enable/disable the delivery remark field based on selected delivery status
        function toggleDeliveryRemarkField(status) {
            if (status == 'OTHER') {
                // Enable the delivery remark field if status is 'OTHER'
                $('#delivery_status_remark').prop('disabled', false); // Enable input field
            } else {
                // Disable the delivery remark field if status is not 'OTHER'
                $('#delivery_status_remark').prop('disabled', true); // Disable input field
            }

            if (status == 'DELIVERED') {
                // Enable the delivery remark field if status is 'OTHER'
                $('.signed_status_div').css('display', 'block'); // Enable input field

            } else {
                // Disable the delivery remark field if status is not 'OTHER'
                $('.signed_status_div').css('display', 'none'); // Enable input field
            }
        }

        // Check the current signed status on page load and adjust the signed_remark field accordingly
        var signedStatus = $('#signed_status').val();
        toggleSignedRemarkField(signedStatus); // Call function on page load

        // Listen to changes in the signed_status select dropdown
        $('#signed_status').change(function() {
            var selectedStatus = $(this).val();
            toggleSignedRemarkField(selectedStatus); // Adjust the signed_remark field when changed
        });

        // Function to enable/disable the signed remark field based on selected signed status
        function toggleSignedRemarkField(status) {
            if (status == 'OTHER') {
                // Enable the signed remark field if status is 'OTHER'
                $('#signed_remark').prop('disabled', false); // Enable input field
            } else {
                // Disable the signed remark field if status is not 'OTHER'
                $('#signed_remark').prop('disabled', true); // Disable input field
            }
        }


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
            "ordering": true, // Enable column sorting
            "info": true, // Display info about the number of records
            "lengthChange": true, // Enable the option to change the number of records per page
            "responsive": false // Make the table responsive
        });
    }

    // function updateChanges(id, record, coloum) {
    //     var url = '<?= base_url() ?>update-deliverynotes'; // The URL to send the AJAX request to
    //     if (coloum == 'signed_status') {
    //         if (record == 'OTHER') {
    //             // Show modal to enter remark when "Other" is selected
    //             $('#remarkModal').modal('show');
    //             $("#deliveyid").val(id);
    //             $("#signed_status_value").val(record);
    //         } else {
    //             // For "Yes" or "No", proceed with the update directly
    //             var data = {
    //                 id: id,
    //                 signed_status: record
    //             };
    //             sendUpdateRequest(data);
    //         }
    //     } else {
    //         var data = {
    //             id: id
    //         };
    //         if (coloum == 'is_issue_invoice') {
    //             data.is_issue_invoice = record;
    //         } else if (coloum == 'is_invoice_issued') {
    //             data.is_invoice_issued = record;
    //         } else if (coloum == 'signed_remark') {
    //             data.signed_remark = $('#type_signed_remark').val();
    //             data.signed_status = record;
    //             $('#remarkModal').modal('hide');
    //         }
    //         sendUpdateRequest(data);
    //     }
    // }

    function updateChanges(id, record, coloum) {
        var url = '<?= base_url() ?>update-deliverynotes'; // The URL to send the AJAX request to
        if (coloum == 'signed_status') {
            if (record == 'OTHER') {
                // Show modal to enter remark when "Other" is selected
                $('#remarkModal').modal('show');
                $("#deliveryid").val(id);
                $("#signed_status_value").val(record);
            } else {
                // For "Yes" or "No", proceed with the update directly
                var data = {
                    id: id,
                    signed_status: record
                };
                sendUpdateRequest(data);
            }
        } else if (coloum == 'delivery_status') {
            if (record == 'OTHER') {
                // Show modal to enter remark when "Other" is selected
                $('#deliveryremarkModal').modal('show');
                $("#deliveryid_").val(id);
                $("#delivery_status_value").val(record);
            } else {
                // For "Yes" or "No", proceed with the update directly
                var data = {
                    id: id,
                    delivery_status: record
                };
                sendUpdateRequest(data);
            }
        } else {
            var data = {
                id: id
            };
            if (coloum == 'is_issue_invoice') {
                data.is_issue_invoice = record;
            } else if (coloum == 'is_invoice_issued') {
                data.is_invoice_issued = record;
            } else if (coloum == 'warehouse') {
                data.warehouse = record;
            } else if (coloum == 'transport_type') {
                data.transport_type = record;
            } else if (coloum == 'signed_remark') {
                data.signed_remark = $('#type_signed_remark').val();
                data.signed_status = record;
                $('#remarkModal').modal('hide');
            } else if (coloum == 'delivery_status_remark') {
                data.delivery_status_remark = $('#type_delivery_remark').val();
                data.delivery_status = record;
                $('#deliveryremarkModal').modal('hide');
            }
            sendUpdateRequest(data);
        }
    }

    function sendUpdateRequest(data) {
        var url = '<?= base_url() ?>update-deliverynotes';
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json",
            success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            reloadTableContent();
                        }
                    });
                } else {
                    Swal.fire({
                        position: "bottom-end",
                        text: response.message,
                        icon: "error"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            reloadTableContent();
                        }
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });
    }

    function delete_data(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?php echo base_url() ?>delete-deliverynote/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data) {
                        // console.log(data);
                        if (data.status == true) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            location.reload()
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            }
        })
    }

    // save delivery notes.....
    function SaveDeliveryNote() {
        var form = $('#deliverynotesform');
        var formData = form.serialize();
        var url;
        url = '<?= base_url() ?>insert-deliverynote';
        $.ajax({
            url: url,
            type: "POST",
            data: formData, // Send serialized form data
            dataType: "json",
            success: function(response) {

                if (response.errors) {
                    // Loop through each error and display it next to the respective field
                    for (const field in response.errors) {
                        if (response.errors.hasOwnProperty(field)) {
                            // Find the input field and display the error message
                            const inputField = $('[name="' + field + '"]');

                            if (inputField.length) {
                                // Add an 'error' class to the parent container (optional for styling)
                                inputField.closest('.form-group ').addClass('has-error');

                                // Display the error message in a sibling element with the class 'text-danger'
                                inputField.siblings('.text-danger').text(response.errors[field]);
                            } else {
                                console.error('Input field not found for:', field);
                            }
                        }
                    }
                } else {

                    Swal.fire({
                        position: "bottom-end",
                        title: "Good job!",
                        text: response.message,
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload(); // Reloads the page when "OK" is clicked
                        }
                    });
                }
                // location.reload()
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('AJAX request failed:', textStatus, errorThrown);
            }
        });
    }
</script>
<?= $this->endSection(); ?>