<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=category'; ?>">List Categories</a> <span class="divider">></span></li>
            <li class="active"><?php
                if ( $_GET['a'] == 'create' ) {
                    echo 'Add';
                } else if ( $_GET['a'] == 'update' ) {
                    echo 'Edit';
                }
            ?></li>
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
                            <div class="span9"><input type="text" name="categoryName" value="<?php
                                if ( !empty($_POST['categoryName']) ) { 
                                    echo $_POST['categoryName'];
                                } else if ( isset($this->category) ) {
                                    echo $this->category['name'];
                                }
                            ?>" required /></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="categoryActive">
                                    <?php
                                        if ( $this->category['active'] == 1 ) {
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