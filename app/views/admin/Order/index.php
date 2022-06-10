<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Список заказов
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li class="active">Список заказов</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-border table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>User name</th>
                                <th>Status</th>
                                <th>Sum</th>
                                <th>Date create</th>
                                <th>Date change</th>
                                <th>Info</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <?php $class =  $order['status'] ? 'success' : ''?>
                                <tr class="<?= $class ?>">
                                    <td><?= $order['id'] ?></td>
                                    <td><?= $order['name'] ?></td>
                                    <td><?= $order['status'] ? 'completed' : 'processed' ?></td>
                                    <td><?= $order['sum'] ?> <?= $order['currency'] ?></td>
                                    <td><?= $order['date'] ?></td>
                                    <td><?= $order['update_at'] ?></td>
                                    <td><a href="<?= ADMIN; ?>/order/view?id=<?= $order['id'] ?>"><i class="fa fa-fw fa-eye"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
                        <p>(<?= count($orders); ?> из <?= $count; ?>)</p>
                        <?php if ($pagination->countPages > 1) : ?>
                            <?= $pagination ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
<!-- /.content -->
