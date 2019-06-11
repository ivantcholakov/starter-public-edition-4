<h1>Manage Users</h1>

<ul>
    <li><?php echo anchor('/admin/manage', 'Back to admin'); ?></li>
</ul>

<table>
    <thead>
    <tr>
        <th>Email</th>
        <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($users as $user) : ?>
        <tr>
            <td><?php echo $user->email; ?></td>
            <td>
                <a href="/admin/manage-user/<?php echo $user->id; ?>">Manage User</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>