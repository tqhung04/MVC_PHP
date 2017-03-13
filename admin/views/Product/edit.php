<div class="content">
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=product'; ?>">List Products</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
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
                            <div class="span3">Product Name:</div>
                            <div class="span9"><input type="text" value="<?php echo $data['name']; ?>" name="productName"/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Price:</div>
                            <div class="span9"><input type="text" value="<?php echo $data['price']; ?>" name="productPrice"/></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9"><textarea name="productDescription"/><?php echo $data['description']; ?></textarea></div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Image:</div>
                            <div class="span9">
                            <img alt="<?php echo $data['name'] ?>" width="100px" height="100px" src="<?php echo BASE_URL . $data['image']; ?>"/>
                            <br/>
                            <input type="file" size="19" name="productImg">
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Category:</div>
                            <div class="span9">
                                <select name="productCategory">
                                    <option value="<?php echo $category; ?>">
                                        <?php 
                                            echo $category;
                                        ?>
                                    </option>
                                    <?php
                                        foreach ($categories as $key => $value) {
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