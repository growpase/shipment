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
                            <h5>Job ID : 360</h5>
                            <h5>Job Name : BABAHAR VILLA</h5>
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn btn-warning btn-md text-white" data-toggle="modal" data-target="#adddeliverynotesModal"> <i class="fa fa-plus"></i> Add Delivery Note</button>
                        </div>
                    </div>
                    <hr>

                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table text-center" id="usersTable">
                                <thead class="text-uppercase bg-primary">
                                    <tr class="text-white">
                                        <th scope="col">ID</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Delivery Note</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Net Amount</th>
                                        <th scope="col">Issued Invoice</th>
                                        <th scope="col">Invoice Issue</th>
                                        <th scope="col">Signed</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td>01 / 06 / 2024</td>
                                        <td>IO28</td>
                                        <td>Private Sector</td>
                                        <td>14000</td>
                                        <td>Yes <a href="javascript:void(0)" data-toggle="modal" data-target="#jobstatusModal"><i class="fa fa-edit"></i> </a> </td>
                                        <td>No <a href="javascript:void(0)" data-toggle="modal" data-target="#jobstatusModal"><i class="fa fa-edit"></i> </a> </td>
                                        <td>Yes <a href="javascript:void(0)" data-toggle="modal" data-target="#signdnModal"><i class="fa fa-edit"></i> </a> </td>
                                        <td> <a href="<?= base_url() ?>deliverynote-detail"> <i class="fa fa-eye"></i> </a> | <i class="fa fa-trash-o delete-icon"></i></td>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- invoice issue model -->
<div class="modal fade show" id="isInvoiceIssueModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Invoice Issue </label>
                                    <select name="" class="form-control" id="">
                                        <option value="">Select Option</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- issue invoice model -->
<div class="modal fade show" id="isIssueInvoiceModel" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Delivery Note</label>
                                    <input type="text" class="form-control" value="IO9" placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Date</label>
                                    <input type="text" class="form-control" value="01-06-2024" placeholder="Enter email / Username">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Surveyor </label>
                                    <input type="text" class="form-control" value="Md. Munir Uddun" placeholder="Enter Contact Number">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Job </label>
                                    <input type="text" value="Akira Back" class="form-control" placeholder="Set a Password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- signed in status model -->
<div class="modal fade show" id="SignedStatus" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                </div>
                <div class="modal-body">
                    <form id="signedinform">
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Signed Delivery Notes </label>
                                    <select name="signed_status" class="form-control" id="signed_status">
                                        <option value="">Select Option</option>
                                        <option value="YES">Yes</option>
                                        <option value="NO">No</option>
                                        <option value="OTHER">Other</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12" id="signed_remark_div" style="display:none">
                                <div class="form-group">
                                    <label for="signed_remark">Signed Remark </label>
                                    <textarea class="form-control" name="signed_remark" placeholder="Signed Status Remark" id=""></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="update_status()" class="btn btn-danger">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>