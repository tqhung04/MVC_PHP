<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=category'; ?>">List Categories</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
        </ul>
    </div>
    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="#" method="POST">
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9"><input type="text" name="categoryName" value="<?php echo $data['name']; ?>" /></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="categoryActive">
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