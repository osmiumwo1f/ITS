<table>
    <th rowspan="2">ชื่อผู้ใช้งาน</th>
    <th rowspan="2">ชื่อ นามสกุล</th>
    <th rowspan="2">ตำแหน่ง</th>
    <th rowspan="2">เบอร์โทรศัพท์</th>
    <th rowspan="2">E-mail</th>
    <th colspan="3">สิทธิ์เกี่ยวกับกิจกรรม</th>
    <th colspan="3">สิทธิ์เกี่ยวกับผู้ใช้งาน</th>
    <th rowspan="2">ลบผู้ใช้งาน?</th>
    <tr id="priv">
        <td>เพิ่ม</td>
        <td>แก้ไข</td>
        <td>ลบ</td>
        <td>เพิ่ม</td>
        <td>แก้ไข</td>
        <td>ลบ</td>
    </tr>


    <?php foreach ($usr as $u_item): ?>
        <tr>
            <td><a href="users/<?php echo $u_item['id']; ?>"> <?php echo $u_item['usr']; ?></a></td>
            <td><?php echo $u_item['f_name'].' '.$u_item['l_name']; ?></td>
            <td><?php echo $u_item['rank']; ?></td>
            <td><?php echo $u_item['phone']; ?></td>
            <td><?php echo $u_item['email']; ?></td>
            <td><?php priv($u_item['create']); ?></td>
            <td><?php priv($u_item['edit']); ?></td>
            <td><?php priv($u_item['delete']); ?></td>
            <td><?php priv($u_item['usr_create']); ?></td>
            <td><?php priv($u_item['usr_edit']); ?></td>
            <td><?php priv($u_item['usr_delete']); ?></td>
            <td><a href="users/delete/<?php echo $u_item['id'];?>">ลบ</a></td>
        </tr>
    <?php endforeach;
        function priv($priv)
        {
            if($priv == '0')
            {
                echo json_decode('"\u2716"');
            }
            else
            {
                echo json_decode('"\u2714"');
            }
        }
    ?>

</table>
<button onclick="window.location.href='users/create'">เพิ่มผู้ใช้งาน</button>
