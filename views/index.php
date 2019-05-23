<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Battleships</title>
</head>
<body>
    <pre>
        <table>
            <tr>
                <td></td>
                <?php for ($i = 1; $i <= $columnsCount; $i++): ?>
                    <td><?= $i ?></td>
                <?php endfor; ?>
            </tr>
            <?php foreach ($layout as $rowKey => $row): ?>
                <tr>
                    <td><?= $view['row']->output($rowKey) ?></td>
                    <?php foreach ($row as $columnKey => $column): ?>
                        <td><?= (isset($shipPositions)) ? $view['grid']->output($column, $shipPositions, [$rowKey, $columnKey]) : $column  ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </pre>

    <?= isset($message) ? $message : '' ?>

    <form action="/shoot" method="post">
        <label for="position">Coordinates: </label>
        <input type="text" name="position" />
        <input type="submit" value="Send" />
    </form>

    <a href="/reset">Reset</a>
</body>
</html>