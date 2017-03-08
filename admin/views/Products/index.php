<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="list-products.html">List Products</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form>
                    <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                    <button class="btn span1" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="<?php echo BASE_URL . '?p=admin&c=product&a=add' ?>" class="btn btn-add">Add Product</a>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"/></th>
                            <th width="10%" class="sorting"><a href="#">ID</a></th>
                            <th width="30%" class="sorting"><a href="#">Product Name</a></th>
                            <th width="15%" class="sorting"><a href="#">Price</a></th>
                            <th width="15%" class="sorting"><a href="#">Image</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                            <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                            <th width="10%">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $c = 0;
                            foreach ($products as $key => $value) {
                                $c += 1;
                        ?>
                            <tr>
                                <td><input type="checkbox" name="checkbox"/></td>
                                <td><?php echo $c ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['price'] ?></td>
                                <td><img alt="<?php echo $value['name']; ?>" src="<?php echo BASE_URL . $value['image']; ?>" style="width: 100%; height: 100px"></td>
                                <td><?php echo $value['created_at'] ?></td>
                                <td><?php echo $value['updated_at'] ?></td>
                                <td><a href="<?php echo BASE_URL . '?p=admin&c=product&a=edit&id=' . $value['id']; ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php
                            }
                        ?>

                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <a href="#" class="btn btn-success">Activate</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </div><!-- /bulk-action-->
                    <div class="dataTables_paginate">
                        <a class="first paginate_button paginate_button_disabled" href="#">First</a>
                        <a class="previous paginate_button paginate_button_disabled" href="#">Previous</a>
                        <span>
                            <a class="paginate_active" href="#">1</a>
                            <a class="paginate_button" href="#">2</a>
                        </span>
                        <a class="next paginate_button" href="#">Next</a>
                        <a class="last paginate_button" href="#">Last</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>