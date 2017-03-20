<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=product'; ?>">List Products</a> <span class="divider">></span></li>
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
                    <h1>Products Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form action="#" method="POST" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Product Name: (*)</div>
                            <div class="span9"><input type="text" name="productName" value="<?php
                                if ( !empty($_POST['productName']) ) { 
                                    echo $_POST['productName'];
                                } else if ( isset($this->product) ) {
                                    echo $this->product['name'];
                                }
                            ?>" required/></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Price: (*)</div>
                            <div class="span9"><input type="number" value="<?php
                                if ( !empty($_POST['productPrice']) ) { 
                                    echo $_POST['productPrice'];
                                } else if ( isset($this->product) ) {
                                    echo $this->product['price'];
                                }
                            ?>" name="productPrice" required/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9"><textarea value="" name="productDescription"/><?php
                                    if ( !empty($_POST['productDescription']) ) { 
                                        echo $_POST['productDescription'];
                                    } else if ( isset($this->product) ) {
                                        echo $this->product['description'];
                                    }
                                ?></textarea></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Upload Image:</div>
                            <div class="span9"><input type="file" value="" name="productImg" size="19" /></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Category: (*)</div>
                            <div class="span9">
                                <select name="productCategory" required>
                                    <?php
                                        if ( isset($_POST['productCategory']) ) {
                                            echo '<option value="' . $_POST['productCategory'] . '">' . $_POST['productCategory'] . '</option>';
                                        }
                                        if ( isset($current_category) ) {
                                    ?>
                                    <option value="<?php echo $current_category; ?>"><?php echo $current_category; ?></option>
                                    <?php
                                        }
                                        foreach ($this->categories as $key => $value) {
                                    ?>
                                        <option value="<?php echo $value['name']; ?>">
                                            <?php
                                                echo $value['name'];
                                            ?>
                                        </option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>      
                        <div class="row-form">
                            <div class="span3">Active</div>
                            <div class="span9">
                                <select name="productActive">
                                    <?php
                                        if ( $this->product['active'] == 1 ) {
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