<div align="center">
    <?php
    echo '<h2>'.$e_item[1]['name'].'</h2><br>';
    echo '1: '.$e_item[1]['descriptions'].'<br>';
    echo '2: '.$e_item[1]['requirements'].'<br>';
    echo '3: '.$e_item[1]['fee'].'<br>';
    echo '4: '.$e_item[1]['date'].'<br>';
    echo '5: '.$e_item[1]['place'].'<br>';
    echo '6: '.$e_item[1]['amount'].'<br>';
    echo '7: '.$e_item[1]['note'].'<br>';
    ?>
    <table class="event">
        <th>ชื่อไฟล์</th>
        <th>รายละเอียด</th>
        <?php foreach ($e_item as $f):?>
            <tr>
                <td><?php echo $f['fn']; ?></td>
                <td><?php echo $f['fd']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>
    <a href="<?php echo $e_item[1]['id'];?>/satis/create/">สร้างแบบประเมินความพึงพอใจ</a>
</div>