<div align="center">

    <table class="event">
        <th>�������</th>
        <th>��������´</th>
        <?php foreach ($files as $f)?>
            <tr>
                <td><?php echo $f['name']; ?></td>
                <td><?php echo $f['descriptions']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>