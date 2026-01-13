<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>
    <?= $title ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-heading text-center">
    <div class="container zoomIn animated">
        <h1 class="page-title">Former Members of HP HRC<span class="title-under"></span></h1>
    </div>
</div>

<div class="main-container">
    <div class="container">
        <div class="row">
            <table class="table hphrc-table">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th> Name of Members, HP Human Rights Commission Shimla.</th>
                        <th>Tenure</th>
                    </tr>
                </thead>
                <tbody> 
                    <tr>
                        <td>1.</td>
                        <td>Sh. Avtar Chand Dogra (District & Sessions Judge Retd.), Member (Judicial)</td>
                        <td>24-10-2020 to 23-10-2023</td>
                    </tr>                            
                    <tr>
                        <td>2.</td>
                        <td>Dr. Ajai Bhandari (IAS Retd.), Member (Admin)</td>
                        <td>01-07-2020 to 30-06-2023 thereafter 24-07-2023 to 15-02-2024</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>