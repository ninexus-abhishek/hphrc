<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">Budget and Finance <span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Minister House No. 3, Grant Lodge, Shimla-171002, HP.
        </p>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12 fadeIn animated">
                <p>
                    The Budget allocated to each of its agency , indication particulars of all plans , proposed expenditures and reports on disbursement made
                </p>
            </div>
        </div>

        <div class="row ">
            <div class="col-md-12 fadeIn">
                <h2 class="title-style-2"> Budget <?= $year ?></h2>
                <div class="mb-3 col-md-4">                                   
                    Select Year to change budget
                    <select class="form-select" id="budget_year" name="budget_year" required="">                                              
                        <option class="" value="" selected="" disabled=""i>Select budget year</option>                                                   
                        <option value="2019-2020" <?= set_selected($year, "2019-2020") ?>>2019-2020</option>
                        <option value="2020-2021" <?= set_selected($year, "2020-2021") ?>>2020-2021</option>
                        <option value="2021-2022" <?= set_selected($year, "2021-2022") ?>>2021-2022</option>
                        <option value="2022-2023" <?= set_selected($year, "2022-2023") ?>>2022-2023</option>
                        <option value="2023-2024" <?= set_selected($year, "2023-2024") ?>>2023-2024</option>
                        <option value="2024-2025" <?= set_selected($year, "2024-2025") ?>>2024-2025</option>
                        <option value="2025-2026" <?= set_selected($year, "2025-2026") ?>>2025-2026</option>
                        <option value="2026-2027" <?= set_selected($year, "2026-2027") ?>>2026-2027</option>
                        <option value="2027-2028" <?= set_selected($year, "2027-2028") ?>>2027-2028</option>
                        <option value="2028-2029" <?= set_selected($year, "2028-2029") ?>>2028-2029</option>
                        <option value="2029-2030" <?= set_selected($year, "2029-2030") ?>>2029-2030</option>                                                                                                                               
                    </select>
                </div>
                <table class="table hphrc-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SOE</th>
                            <th>Budget Allotted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($result)): ?>
                            <?php $total=0; ?>
                            <?php foreach($result as $key => $row): ?>
                                <?php $total = $total + $row['budget_amount']; ?>
                                <tr>
                                    <th scope="row"><?= $key + 1; ?></th>
                                    <td><?php echo $row['budget_soe']; ?></td>
                                    <td><?php echo $row['budget_amount']; ?></td>
                                </tr>
                            <?php endforeach; ?>                                               
                            <tr>
                                <th scope="row"></th>
                                <td><strong>Total</strong></td>
                                <td><strong><?= $total ?></strong></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
                <!-- <h4>TABLE STYLE 2</h4>
                <table class="table table-style-2">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>

                            <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table> -->					
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script nonce="<?= SCRIPT_NONCE ?>">
    document.addEventListener("DOMContentLoaded", () => {
        const budgetElem = document.getElementById('budget_year');
        budgetElem.addEventListener("change", (e) => {
            const years = e.target.value;
            const url = `<?= FRONT_BUDGET_LINK?>${years}`;
            window.location = url;
        })
    });
</script>
<?= $this->endSection() ?>