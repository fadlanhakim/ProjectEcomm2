<div class="container-fluid">
    <h3><i class="fas fa-edit"></i>EDIT DATA USER</h3>

    <?php foreach ($users as $user) : ?>

        <form method="post" action="<?php echo base_url() . 'admin/users/update' ?>">

            <div class="for-group">
                <label>Nama User</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $user->nama ?>">
            </div>

            <div class="for-group">
                <label>Username</label>
                <input type="hidden" name="id" class="form-control" value="<?php echo $user->id ?>">
                <input type="text" name="username" class="form-control" value="<?php echo $user->username ?>">
            </div>

            <div class="for-group">
                <label>Password</label>
                <input type="text" name="password" class="form-control" value="<?php echo $user->password ?>">
            </div>

            <div class="for-group">
                <label>Role ID</label>
                <input type="text" name="role_id" class="form-control" value="<?php echo $user->role_id ?>">
            </div>

            <button type="submit" class="btn btn-primary btn-sm mt-3"> Simpan </buttom>
        </form>
    <?php endforeach; ?>

</div>