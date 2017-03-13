<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="<?php echo BASE_URL . '?p=admin&c=user'; ?>">List Users</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET">
                    <?php 
                        $this->showHiddenInput();
                    ?>
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
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <div class="row-fluid">
                        <div class="span3">
                            <a href="<?php echo BASE_URL . '?p=admin&c=user&a=add'; ?>" class="btn btn-add">Add User</a>
                        </div>
                        <div class="span9">
                            <?php
                                if ( isset($_GET['search']) )
                                echo '<p class="result">'.$this->total.' result for "' . $_GET['search'] . '"</p>';
                            ?>
                        </div>
                    </div>
                    <form method="POST" action="#">
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all"/></th>
                                <th width="15%" class="sorting"><a href="#">No</a></th>
                                <th width="35%" class="sorting"><a href="#">Username</a></th>
                                <th width="20%" class="sorting"><a href="#">Activate</a></th>
                                <th width="10%" class="sorting"><a href="#">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="#">Time Updated</a></th>
                                <th width="10%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $no = 0;
                                if ( !empty($this->data) )
                                foreach ($this->data as $key => $value) {
                                    $no += 1;
                                ?>
                                    <tr>
                                        <td><input type="checkbox" name="cb[<?php echo $value['id'] ?>]"/></td>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td>
                                            <?php
                                                if ( $value['active'] == 1 ) {
                                                    echo '<span class="text-error">Deactive</span>';
                                                } else {
                                                    echo '<span class="text-success">Active</span>';
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value['created_at']; ?></td>
                                        <td><?php echo $value['updated_at']; ?></td>
                                        <td><a href="<?php echo BASE_URL . '?p=admin&c=user&a=edit&id=' . $value['id']; ?>" class="btn btn-info">Edit</a></td>
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
                        <?php
                            if ( !isset($_GET['search']) ) {
                                $this->pagiHandling();
                            }
                        ?>
                        <div class="clear"></div>
                    </form>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>