<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>
<?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add Expense</h2>
                <div class="clearfix"></div>
            </div>
            <?= form_open(route_to('admin.add_expense'), ['class' => 'form-horizontal form-label-left', 'id' => 'add_expense1', 'name' => 'addexpense']) ?>
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <br />

                    <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label class="control-label form-label label_class" for="budget_soe">SOE</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="budget_soe" placeholder="Enter SOE" class="form-control <?= $validation->hasError('budget_soe') ? 'is-invalid' : '' ?> " autocomplete="off" value="<?= old('budget_soe') ?>">
                                <div class="invalid-feedback"><?= esc($validation->getError('budget_soe')) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label form-label label_class" for="budget_amount">Amount</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <input type="number" step="0.1" name="budget_amount" placeholder="Enter Amount" class="form-control  <?= $validation->hasError('budget_amount') ? 'is-invalid' : '' ?> " autocomplete="off" value="<?= old('budget_amount') ?>">
                                <div class="invalid-feedback"><?= esc($validation->getError('budget_amount')) ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-12">
                                <label class="control-label form-label label_class" for="budget_year">Year</label>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <select class="form-select <?= $validation->hasError('budget_year') ? 'is-invalid' : '' ?>" id="budget_year" name="budget_year">
                                    <option value="" selected="" disabled="" i>Select budget year</option>
                                    <option value="2019-2020">2019-2020</option>
                                    <option value="2020-2021">2020-2021</option>
                                    <option value="2021-2022">2021-2022</option>
                                    <option value="2022-2023">2022-2023</option>
                                    <option value="2023-2024">2023-2024</option>
                                    <option value="2024-2025">2024-2025</option>
                                    <option value="2025-2026">2025-2026</option>
                                    <option value="2026-2027">2026-2027</option>
                                    <option value="2027-2028">2027-2028</option>
                                    <option value="2028-2029">2028-2029</option>
                                    <option value="2029-2030">2029-2030</option>
                                </select>
                                <div class="invalid-feedback"><?= esc($validation->getError('budget_year')) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ln_solid"></div>
        
            <div class="row justify-content-center">
                <div class="col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="mb-3">
                            <div class="col-md-3 col-sm-3 col-xs-12"></div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button class="btn btn-primary" type="reset">Reset</button>
                                    <button type="submit" class="btn btn-success" id="btnLogin">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div></div>
            <br><br>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>