<div class="fl-example-text">
    <!DOCTYPE html>
    <html>
    <body style="text-align:center;">
    <h6>Display user-entered text #2</h6>
    <form method="post">
        <input type="text" name="user_input" id="user_input" placeholder="Enter your text here">
        <input type="submit" name="button2" value="Button2"/>
    </form>
    <?php
    if (isset($_POST['button2'])) {
        $settings->user_input = htmlspecialchars($_POST['user_input']);
        $module->render();
    }
    ?>

    <h6>Loop through a key-value array to build HTML for output #3</h6>
    <?php
    $array = [
        'small' => '10x10',
        'medium' => '100x100',
        'large' => '1000x1000'
    ];
    ?>

    <table id="sizeTable">
        <thead>
        <tr>
            <th>Size</th>
            <th>Dimensions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($array as $size => $dimensions): ?>
            <tr>
                <td><?php echo $size; ?></td>
                <td class="dimensionCell" data-size="<?php echo $size; ?>"><?php echo $dimensions; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </body>
    </html>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var dimensionCells = document.querySelectorAll('.dimensionCell');
        dimensionCells.forEach(function(cell) {
            cell.addEventListener('click', function() {
                console.log("This cell has been clicked");
                var size = this.getAttribute('data-size');
                var newValue = prompt('Enter new dimensions for ' + size);
                if (newValue !== null) {
                    <?php foreach ($array as $size => $dimensions): ?>
                    if (size === '<?php echo $size; ?>') {
                        cell.textContent = newValue;
                        <?php $array[$size] = "' + newValue + '"; ?>
                    }
                    <?php endforeach; ?>
                }
            });
        });
    });
</script>