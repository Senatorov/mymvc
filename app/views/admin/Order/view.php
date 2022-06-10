<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Order №<?= $order['id'] ?>
        <?php if (! $order['status']) : ?>
            <a href="<?= ADMIN ?>/order/change?id=<?=$order['id']?>&status=1" class="btn btn-success btn-xs">Approved</a>
        <?php endif; ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMIN; ?>"><i class="fa fa-dashboard"></i>Main</a></li>
        <li><a href="<?= ADMIN ?>/order">Order list</a></li>
        <li class="active">Order №<?= $order['id'] ?></li>
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
                            <tbody>
                                <tr>
                                    <td>Order number</td>
                                    <td><?= $order['id'] ?></td>
                                </tr>
                                <tr>
                                    <td>Order date</td>
                                    <td><?= $order['date'] ?></td>
                                </tr>
                                <tr>
                                    <td>Order update at</td>
                                    <td><?= $order['update_at'] ?></td>
                                </tr>
                                <tr>
                                    <td>Qty position in order</td>
                                    <td>--</td>
                                </tr>
                                <tr>
                                    <td>Order sum</td>
                                    <td><?= $order['sum'] ?> <?= $order['currency'] ?></td>
                                </tr>
                                <tr>
                                    <td>Customer name</td>
                                    <td><?= $order['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td><?= $order['status'] ? "Close" : "New"?></td>
                                </tr>
                                <tr>
                                    <td>Notes</td>
                                    <td><?= $order['note']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <h3>Order details</h3>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-border table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>QTY</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $qty = 0; foreach ($orderProducts as $product) : ?>
                                <tr>
                                    <td><?= $product->id ?></td>
                                    <td><?= $product->title ?></td>
                                    <td><?= $product->qty; $qty += $product->qty ?></td>
                                    <td><?= $product->price ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="active">
                                <td colspan="2">
                                    <b>Total</b>
                                </td>
                                <td>
                                    <b><?= $qty ?></b>
                                </td>
                                <td>
                                    <b><?= $order['sum']?> <?= $order['currency']?></b>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<!-- /.content -->

