<!doctype html>
<html lang="en" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?= $this->getMeta() ?>
</head>
<body style="height: 100%">
<div style="display: flex; flex-direction: column; height: 100%; padding: 10px;">
    <h2 style="font-style: italic; text-align: center;">Layout: DEFAULT</h2>

        <div style="flex: 1 1 auto;">
            <?= $content ?>
        </div>

    <h2 style="font-style: italic; text-align: center">Layout: DEFAULT</h2>

    <div>
        <?php
            if (DEBUG) {
                $logs = \R::getDatabaseAdapter()->getDatabase()->getLogger();
                debug($logs->grep('SELECT'));
            }
        ?>
    </div>

</div>
</body>
</html>
