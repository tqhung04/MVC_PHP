<?php
include_once PATH_ADMIN . '/models/User.php';
class Base_Controller {
    protected $i;
    protected $c;
    protected $total;
    protected $data;
    protected $totalPages;
    protected $previous;
    protected $next;
	function __construct () {
        if ( !isset($_GET['page']) ) {
            $_GET['page'] = 1;
        }
        $this->i = $_GET['page'];
        $this->c = $_GET['c'];
	}
    public function showHiddenInput () {
        foreach ($_GET as $key => $value) {
            if ( $key != 'search' && $key != 'search_type') {
                echo("<input type='hidden' name='$key' value='$value'/>");
            }
        }
    }
	public function checkPagiFirst () {
		if ( $_GET['page'] == 1 ) {
			return 'paginate_button_disabled';
		}
	}
	public function checkPagiLast () {
		if ( $_GET['page'] == $this->totalPages ) {
			return 'paginate_button_disabled';
		}
	}
	public function pagiHandling () {
        $page = $_GET['page'];
        $first = BASE_URL . '?p=admin&c=' . $this-> c . '&page=1';
        $previous = BASE_URL . '?p=admin&c=' . $this-> c . '&page=' . ($_GET['page'] - 1);
        $next = BASE_URL . '?p=admin&c=' . $this-> c . '&page=' . ($_GET['page'] + 1);
        $last = BASE_URL . '?p=admin&c=' . $this-> c . '&page=' . $this->totalPages;
        echo '
            <div class="dataTables_paginate">
                <a class="first paginate_button ' . $this->checkPagiFirst() . '" href="' . $first . '">First</a>
                <a class="previous paginate_button ' . $this->checkPagiFirst() . '" href="' . $previous . '">Previous</a>';
		if ( $this->totalPages <= 5 ) {
            for ( $i = 1; $i <= $this->totalPages; $i ++ ) {
                echo '<span>';
                if ( $i == $page ) {
            ?>
                <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
            <?php
                } else {
            ?>
                <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
            <?php
            }
            ?>
            <?php
                echo '</span>';
            }
        } else if ( $this->totalPages > 5 ) {
            $currentPage = $page;
            if ( $currentPage - 3 > 0 && ($currentPage+2) < $this->totalPages ) {
            ?>
                <a class="paginate_button" href="">...</a>
            <?php
                for ( $i = $currentPage - 2; $i <= $currentPage + 2; $i ++ ) {
                    echo '<span>';
                    if ( $i == $page ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
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
                    if ( $i == $page ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    echo '</span>';
                }
                ?>
                    <a class="paginate_button" href="">...</a>
                <?php
            } else if ( $currentPage >= $this->totalPages - 3 ) {
                ?>
                    <a class="paginate_button" href="">...</a>
                <?php
                for ( $i = $currentPage - 2; $i <= $this->totalPages; $i ++ ) {
                    echo '<span>';
                    if ( $i == $page ) {
                    ?>
                        <a class="paginate_active" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                        } else {
                    ?>
                        <a class="paginate_button" href="<?php echo BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $i; ?>"><?php echo $i; ?></a>
                    <?php
                    }
                    ?>
                    <?php
                    echo '</span>';
                }
            }
        }
        echo '
                <a class="next paginate_button ' . $this->checkPagiLast() . '" href="' . $next . '">Next</a>
                <a class="last paginate_button ' . $this->checkPagiLast() . '" href="' . $last . '">Last</a>
            </div>';
	}
    public function active () {
        if ( isset($_POST['cb']) ) {
            $cb = $_POST['cb'];
            $checked = array_keys($cb);
            foreach ($checked as $p) {
                $active = ucfirst(strtolower($this->c))::active($p, $this->c);
                if ( $active == 1 ) {
                    $_SESSION['errMsg'] = '';
                    header( 'Location: ' . BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $this->i);
                } else {
                    $_SESSION['errMsg'] = 'Can not active' . $this->c;
                }
            }
        }
    }
    public function deactive () {
        if ( isset($_POST['cb']) ) {
            $cb = $_POST['cb'];
            $checked = array_keys($cb);
            foreach ($checked as $p) {
                $active = ucfirst(strtolower($this->c))::deactive($p, $this->c);
                if ( $active == 1 ) {
                    $_SESSION['errMsg'] = '';
                    header( 'Location: ' . BASE_URL . '?p=admin&c=' . $this->c . '&page=' . $this->i);
                } else {
                    $_SESSION['errMsg'] = 'Can not deactive' . $this->c;
                }
            }
        }
    }
    public function search_base () {
        if ( isset($_GET['search']) ) {
            $model = ucfirst(strtolower($this->c));
            $content = $_GET['search'];
            if ( isset($_GET['search_type']) ) {
                $type = $_GET['search_type'];
                if ( $type == 'search_price') {
                    $data = $model::searchProductByPrice($this->c, $content);
                } else if ( $type == 'search_category' ) {
                    $data = $model::searchProductByCategory($this->c, $content);
                } else if ( $type == 'search_name' ) {
                    $data = $model::search($this->c, $content);
                }
            } else {
                $data = $model::search($this->c, $content);
            }
            return $data;
        } else {
            // 
        }   
    }
    public function index_base () {
        $model = ucfirst(strtolower($_GET['c']));
        $datas = $model::getAllData();
        $this->data = $datas['data'];
        $this->totalPages = $datas['totalPages'];
        // Pagination
        if ( $this->i > $this->totalPages ) {
            $_GET['page'] = $this->totalPages;
        } else if ( $this->i < 1 ) {
            $_GET['page'] = 1;
        }
        // Active - Deactive
        if ( isset($_POST['active']) ) {
            $this->active();
        } else if ( isset($_POST['deactive']) ) {
            $this->deactive();
        }
        // Search
        if ( isset($_GET['search']) ) {
            $result = $this->search_base();
            $this->total = $result['total'];
            echo $this->total;
            if ( isset($result['data']) ) {
                $this->data = $result['data'];
            }
            else
                $this->data = '';
        }
        // View
        include PATH_ADMIN . '/views/' . $model . '/index.php';
    }
}