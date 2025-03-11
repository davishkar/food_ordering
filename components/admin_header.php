<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="dashboard.php" class="logo">Admin<span>Panel</span></a>
      <img src="images/LYgjKqzpQb.ico" width="100" height="100"></a>

      <nav class="navbar">
         <a href="dashboard.php">home</a>
         <a href="products.php">products</a>
         <a href="placed_orders.php">orders</a>
         <a href="admin_accounts.php">admins</a>
         <a href="users_accounts.php">users</a>
         <a href="messages.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php if (isset($fetch_profile) && $fetch_profile): ?>
            <p>Welcome, <span><?= htmlspecialchars($fetch_profile['name'] ?? 'Admin'); ?></span></p>
            <a href="update_profile.php" class="btn">Update Profile</a>
         <?php else: ?>
            <p>Welcome, <span>Admin</span></p>
         <?php endif; ?>
         <div class="flex-btn">
            <a href="admin_login.php" class="option-btn">Login</a>
            <a href="register_admin.php" class="option-btn">Register</a>
         </div>
         <a href="admin_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">Logout</a>
      </div>

   </section>

</header>