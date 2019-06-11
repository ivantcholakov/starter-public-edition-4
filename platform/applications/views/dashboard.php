<h1>Dashboard</h1>

<a href="/logout">Logout</a>
<?php if($this->ion_auth_acl->has_permission('access_admin')) : ?><a href="/admin">Admin</a><?php endif; ?>

<h3>User Groups</h3>
<ul>
    <?php foreach($users_groups as $group) : ?>
    <li><?php echo $group->description; ?></li>
    <?php endforeach; ?>
</ul>

<h3>User Permissions</h3>
<ul>
    <?php foreach($users_permissions as $permission) : ?>
    <li><strong><?php echo $permission['name']; ?></strong> (<?php if($this->ion_auth_acl->has_permission($permission['key'])) : ?>Allow<?php else: ?>Deny<?php endif; ?>)</li>
    <?php endforeach; ?>
</ul>