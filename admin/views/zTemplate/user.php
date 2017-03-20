<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=user';?>">List Users</a> <span class="divider">></span></li>
            <li class="active">
            <?php
                if ( $_GET['a'] == 'create' ) {
                    echo 'Add';
                } else if ( $_GET['a'] == 'update' ) {
                    echo 'Edit';
                }
            ?>
            </li>
        </ul>
    </div>
    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="#" method="POST" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Username:</div>
                            <div class="span9"><input type="text" name="userName" value="<?php
                                if ( !empty($_POST['userName']) ) { 
                                    echo $_POST['userName'];
                                } else if ( isset($this->user) ) {
                                    echo $this->user['username'];
                                }
                            ?>" required /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Email:</div>
                            <div class="span9"><input type="text" name="userEmail" value="<?php
                                if ( !empty($_POST['userEmail']) ) { 
                                    echo $_POST['userEmail'];
                                } else if ( isset($this->user) ) {
                                    echo $this->user['email'];
                                }
                            ?>" required /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <div class="span9"><input type="text" name="userPassword" value="<?php
                                if ( !empty($_POST['userPassword']) ) { 
                                    echo $_POST['userPassword'];
                                } else if ( isset($this->user) ) {
                                    echo $this->user['password'];
                                }
                            ?>" required /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <div class="span9">
                            <img alt="<?php
                                if ( !empty($_POST['userImg']) ) {
                                    echo $_POST['userImg'];
                                } else if ( isset($this->user) ) {
                                    echo $this->user['avatar'];
                                }
                            ?>" width="100px" height="100px" src="<?php
                                    if ( !empty($_POST['userImg']) ) {
                                        echo BASE_URL . $_POST['userImg'];
                                    } else if ( isset($this->user) ) {
                                        echo BASE_URL . $this->user['avatar'];
                                    }
                                ?>"/>
                            <input type="file" name="userImg" size="19">
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="userActive">
                                    <?php
                                        if ( $this->user['active'] == 1 ) {
                                            echo '<option value="1">Deactive</option>';
                                            echo '<option value="0">Active</option>';
                                        } else {
                                            echo '<option value="0">Active</option>';
                                            echo '<option value="1">Deactive</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">
                                <?php 
                                    if ( $_GET['a'] == 'create' ) {
                                        echo '<button class="btn btn-success" type="submit" name="create">Create</button>';
                                    } else if ( $_GET['a'] == 'update' ) {
                                        echo '<button class="btn btn-success" type="submit" name="update">Update</button>';
                                    }
                                ?>
                            </div>
                            <div class="span9">
                                <p class="error">
                                    <?php
                                        if ( isset($this->messages) ) {
                                            foreach ($this->messages as $key => $value) {
                                                echo $value . '<br>';
                                            }
                                        }
                                    ?>
                                </p>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>
    </div>
</div>