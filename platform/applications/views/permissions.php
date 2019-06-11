<h1>Manage Permissions</h1>

<ul>
    <li><?php echo anchor('/admin/add-permission', 'Add Permission'); ?></li>
    <li><?php echo anchor('/admin/manage', 'Back to admin'); ?></li>
</ul>

<table>
    <thead>
        <tr>
            <th>Key</th>
            <th>Name</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($permissions as $permission) : ?>
        <tr>
            <td><?php echo $permission['key']; ?></td>
            <td><?php echo $permission['name']; ?></td>
            <td>
                <a href="/admin/update-permission/<?php echo $permission['id']; ?>">Edit</a>
                <a href="/admin/delete-permission/<?php echo $permission['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>