<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="list-categories.html">List Categories</a></li>
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
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="<?php echo BASE_URL . '?p=admin&c=category&a=add'; ?>" class="btn btn-add">Add Category</a>
                    <form action="#" method="POST">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all" name="select_all"/></th>
                                <th width="15%" class="sorting"><a href="#">No</a></th>
                                <th width="35%" class="sorting"><a href="#">Category Name</a></th>
                                <th width="20%" class="sorting"><a href="#">Activate</a></th>
                                <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                                <th width="10%" class="sorting"><a href="#">Action</a></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                    $c = 0;
                                    foreach ($categories as $key => $value) {
                                        $c += 1;
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="cb[<?php echo $value['id'] ?>]" /></td>
                                        <td><?php echo $c ?></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td>
                                            <?php
                                                if ( $value['active'] == 1 ) {
                                                    echo '<span class="text-error">Deactive</span>';
                                                } else {
                                                    echo '<span class="text-success">Active</span>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value['created_at'] ?></td>
                                        <td><?php echo $value['updated_at'] ?></td>
                                        
                                        <td><a href="<?php echo BASE_URL . '?p=admin&c=category&a=edit&id=' . $value['id']; ?>" class="btn btn-info">Edit</a></td>
                                    </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                        <div class="bulk-action">
                            <input class="btn btn-success" type="submit" name="active" value="Active">
                            <input class="btn btn-danger" type="submit" name="deactive" value="Deactive">
                        </div><!-- /bulk-action-->
                        <div class="dataTables_paginate">
                            <a class="first paginate_button <?php echo parent::checkPagiFirst($_GET['page']); ?>" href="#">First</a>
                            <a class="previous paginate_button <?php echo parent::checkPagiFirst($_GET['page']); ?>" href="#">Previous</a>
                            <?php
                                parent::pagiHandling('categories', $totalPages);
                            ?>
                            <a class="next paginate_button <?php echo parent::checkPagiLast($_GET['page'], $totalPages); ?>" href="#">Next</a>
                            <a class="last paginate_button <?php echo parent::checkPagiLast($_GET['page'], $totalPages); ?>" href="#">Last</a>
                        </div>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>