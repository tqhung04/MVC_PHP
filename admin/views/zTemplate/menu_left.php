<div class="menu">
    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, <?php echo $_SESSION['username']; ?>
        </div>
    </div>
    <div class="admin">
        <div class="image">
            <img width="50px" height="50px" alt="<?php echo $_SESSION['username']; ?>" src="<?php echo BASE_URL . $_COOKIE['avatar']; ?>" class="img-polaroid"/>
        </div>
        <ul class="control">
            <li><span class="icon-cog"></span> <a href="<?php echo BASE_URL . '?p=admin&c=user&a=edit&id=' . $_COOKIE['id']; ?>">Update Profile</a></li>
            <li><span class="icon-share-alt"></span> <a href="<?php echo BASE_URL . '?p=admin&c=login&a=logout' ?>">Logout</a></li>
        </ul>
    </div>
    <ul class="navigation">
        <li>
            <a href="<?php echo BASE_URL . '?p=admin&c=category' ?>">
                <span class="isw-grid"></span><span class="text">Categories</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . '?p=admin&c=product' ?>">
                <span class="isw-list"></span><span class="text">Products</span>
            </a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . '?p=admin&c=user' ?>">
                <span class="isw-user"></span><span class="text">Users</span>
            </a>
        </li>
    </ul>
</div>