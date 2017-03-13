<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=user';?>">List Users</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
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
                            <div class="span9"><input type="text" name="userName" value="<?php echo $data['username']; ?>" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Email:</div>
                            <div class="span9"><input type="text" name="userEmail" value="<?php echo $data['email']; ?>" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Password:</div>
                            <div class="span9"><input type="text" name="userPwd" value="<?php echo $data['password']; ?>" /></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <div class="span9">
                            <img alt="<?php echo $data['username'] ?>" width="100px" height="100px" src="<?php echo BASE_URL . $data['avatar']; ?>"/>
                            <input type="file" name="userImg" size="19">
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="userActive">
                                    <?php
                                        if ( $data['active'] == 1 ) {
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
                                <button class="btn btn-success" type="submit" name="update">Update</button>
                            </div>
                            <div class="span9">
                                <p class="error">
                                    <?php
                                        if ( isset($_SESSION['errMsg']) ) {
                                            echo $_SESSION['errMsg'];
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