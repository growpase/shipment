<?= $this->extend('commanfile/header'); ?>
<?= $this->section('content'); ?>
<div class="main-content-inner">
    <div class="row">
        <!-- seo fact area start -->
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-4 mt-5 mb-3">
                    <div class="card">
                        <a href="<?= base_url() ?>invoices">
                            <div class="seo-fact sbg1">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-thumb-up"></i> Invoices</div>
                                    <h2><?= esc($invcount) ?></h2>
                                </div>
                                <canvas id="seolinechart1" height="50"></canvas>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mt-md-5 mb-3">
                    <div class="card">
                        <a href="<?= base_url() ?>job-sheet">
                            <div class="seo-fact sbg2">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-share"></i> Jobs</div>
                                    <h2><?= esc($jobcount) ?></h2>
                                </div>
                                <canvas id="seolinechart2" height="50"></canvas>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-4 mt-md-5 mb-3">
                    <div class="card">
                        <a href="<?= base_url() ?>manage-delivery-notes">
                            <div class="seo-fact sbg3">
                                <div class="p-4 d-flex justify-content-between align-items-center">
                                    <div class="seofct-icon"><i class="ti-file"></i> Delivery Notes</div>
                                    <h2><?= esc($dncount) ?></h2>
                                </div>
                                <canvas id="seolinechart2" height="50"></canvas>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>