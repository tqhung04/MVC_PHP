<?php
class Base_Controller {
	public function __construct () {
	}

    public function showHiddenInput () {
        foreach ($_GET as $key => $value) {
            if ( $key != 'search' ) {
                echo("<input type='hidden' name='$key' value='$value'/>");
            }
        }
    }

	public function checkPagiFirst ($i) {
		if ( $i == 1 ) {
			return 'paginate_button_disabled';
		}
	}

	public function checkPagiLast ($i, $totalPages) {
		if ( $i == $totalPages ) {
			return 'paginate_button_disabled';
		}
	}

	public function pagiHandling ($name, $totalPages) {
		if ( $totalPages <= 5 ) {
            for ( $i = 1; $i <= $totalPages; $i ++ ) {
                echo '<span>';
                if ( $i == $_GET['page'] ) {
            ?>
                <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
            <?php
                } else {
            ?>
                <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
            <?php
            }
            ?>
            <?php
                echo '</span>';
            }
        }
        
        else if ( $totalPages > 5 ) {
            $currentPage = $_GET['page'];
            if ( $currentPage - 3 > 0 && ($currentPage+2) < $totalPages ) {
            ?>
                <a class="paginate_button" href="">...</a>
            <?php
                for ( $i = $currentPage - 2; $i <= $currentPage + 2; $i ++ ) {
                    echo '<span>';
                    if ( $i == $_GET['page'] ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    echo '</span>';
                }
                ?>
                    <a class="paginate_button" href="">...</a>
                <?php
            } else if ( $currentPage - 3 <= 0) {
                for ( $i = 1; $i <= $currentPage + 2; $i ++ ) {
                    echo '<span>';
                    if ( $i == $_GET['page'] ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    echo '</span>';
                }
                ?>
                    <a class="paginate_button" href="">...</a>
                <?php
            } else if ( $currentPage >= $totalPages - 3 ) {
                ?>
                    <a class="paginate_button" href="">...</a>
                <?php
                for ( $i = $currentPage - 2; $i <= $totalPages; $i ++ ) {
                    echo '<span>';
                    if ( $i == $_GET['page'] ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $name . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    echo '</span>';
                }
            }
            
        }
	}

    public function active ($name) {
        if ( isset($_POST['cb']) ) {
            $cb = $_POST['cb'];
            $checked = array_keys($cb);
            foreach ($checked as $p) {
                $active = ucfirst(strtolower($name))::active($p, $name);
                if ( $active == 1 ) {
                    $_SESSION['errMsg'] = '';
                    header( 'Location: ' . BASE_URL . '?p=admin&c=' . $name . '&page=' . $_GET['page']);
                } else {
                    $_SESSION['errMsg'] = 'Can not active' . $name;
                }
            }
        }
    }

    public function deactive ($name) {
        if ( isset($_POST['cb']) ) {
            $cb = $_POST['cb'];
            $checked = array_keys($cb);
            foreach ($checked as $p) {
                $active = ucfirst(strtolower($name))::deactive($p, $name);
                if ( $active == 1 ) {
                    $_SESSION['errMsg'] = '';
                    header( 'Location: ' . BASE_URL . '?p=admin&c=' . $name . '&page=' . $_GET['page']);
                } else {
                    $_SESSION['errMsg'] = 'Can not active' . $name;
                }
            }
        }
    }

    public function search_base () {
        if ( isset($_GET['search']) ) {
            $model = $_GET['c'];
            $content = $_GET['search'];
            $data = ucfirst(strtolower($model))::search($model, $content);
            return $data;
        } else {
            // 
        }
        
    }
}