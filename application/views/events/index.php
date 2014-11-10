<div align="center">
    <table class="event">
        <th>ชื่อ</th>
        <th>สถานที่</th>
        <th>วัน/เวลา</th>
        <th>จำนวน</th>
        <th>รับสมัคร?</th>
        <th>แสดง?</th>
        <th>ประเมินหลังอบรม?</th>
        <th>วันที่สร้าง</th>
        <th>ผู้สร้าง</th>

        <?php foreach ($event as $e_item){ ?>
            <tr>
                <td><a href="<?php echo $e_item['id'].'/'; ?>"> <?php echo $e_item['name']; ?></a></td>
                <td><?php echo $e_item['place']; ?></td>
                <td><?php echo $e_item['date']; ?></td>
                <td><?php echo $e_item['amount']; ?></td>
                <td><?php echo $e_item['regis_state']; ?></td>
                <td><?php echo $e_item['display_state']; ?></td>
                <td><?php echo $e_item['satis_state']; ?></td>
                <td><?php echo $e_item['create_date']; ?></td>
                <td><?php echo $e_item['create_by']; ?></td>
            </tr>
        <?php } ?>

    </table>
</div>