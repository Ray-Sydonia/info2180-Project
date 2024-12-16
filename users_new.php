<?php
session_start();
?>

<div class="info">
    <?php if ($_SESSION['role'] === 'Admin'): ?>
        <h2>New User</h2>
        <div id="new_user">
            <form method="post" action="users_insert.php">
                <div class="first_name">
                    <label for="first_name">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" placeholder="e.g. John"
                           required/>
                </div>

                <div class="last_name">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" placeholder="e.g. Doe"
                           required/>
                </div>

                <div class="email">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" class="form-control" placeholder="something@example.com"
                           required/>
                </div>

                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required
                           pattern="^(?=.*[a-zA-Z])(?=.*\d)(?=.*[A-Z]).{8,}$"/>
                </div>

                <div>
                    <label for="role">Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </div>
                <div class="save">
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    <?php else: ?>
        <div class="info">
            <h2>Access Denied</h2>
            <p>You do not have permission to access this page.</p>
        </div>
    <?php endif; ?>
</div>

