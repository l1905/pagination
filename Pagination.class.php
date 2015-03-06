<?php 
    class Pagination {

        private $_limit;
        private $_currentPage;
        private $_pageNum;
        private $_total;
        private $_mode;
        
        public function __construct($currentPage, $total, $limit, $mode) {
            $this->setLimit($limit);
            $this->setCurrentPage($currentPage);
            $this->setTotal($total);

            $this->setMode($mode);
            $this->setPageNum();
        }

        public function getLimit() {
            return $this->_limit;
        }

        public function setLimit($limit) {
            if(intval($limit) > 0) {
                $this->_limit = $limit;
            } else {
                $this->_limit = 5; //default limit is five
            }
        }

        public function getCurrentPage() {
            return $this->_currentPage;
        }

        public function setCurrentPage($currentPage) {
            $this->_currentPage = $currentPage;
        }

        public function getTotal() {
            return $this->_total;
        }

        public function setTotal($total) {
            $this->_total = $total;
        }

        public function getMode() {
            return $this->_mode;
        }

        public function setMode($mode) {
            $this->_mode = $mode;
        }

        public function isFirstPage() {
            return $this->getCurrentPage() == 1;
        }

        public function isLastPage() {
            return $this->getCurrentPage() == $this->getPageNum();
        }

        public function getPageNum() {
            return $this->_pageNum;
            
        }

        public function setPageNum() {
            if($this->getTotal() > 0) {
                if($this->getTotal() >= $this->getLimit()) {
                    $this->_pageNum =  ceil($this->getTotal()/$this->getLimit());
                } else {
                    $this->_pageNum = 1;
                }
            } else {
                $this->_pageNum = 0;
            }
        }

        public function urlParse() {
            $uri = $_SERVER['REQUEST_URI'];
            $pos = strstr($uri, '?');
            if($pos === false) {
                $result = $uri.'?page=pgnmbr';
            } else {
                $result = $uri.'&page=pgnmbr';
            }
            
            return $result;
        }


        public function render() {
            switch ($this->getMode()) {
                case '1':
                    return $this->tplGithub();
                default:
                    # code...
                    break;
            }
        }

        public function tplGithub() {
            $result = '<div class="pagination">';
            $result .= '<ul>';
            $previousDisabled = $this->isFirstPage()?'disabled':'';
            $result .= '<li class="'.$previousDisabled.'"><a href="#">Previous</a></li>';
            $currentPage = $this->getCurrentPage();
            $pageNum = $this->getPageNum();
            // $url = $this->urlParse();

            $offset = 2;
            $from = $currentPage - $offset;
            $to = $currentPage + $offset;
            $from2to = $offset * 2 + 1;
            if($from2to > $pageNum) {
                $from = 1;
                $to = $pageNum;
            } else {
                if($from <= 0) {
                    $from = 1;
                    $to = $from2to;
                } else if($to >= $pageNum) {
                    $from  = $pageNum - $from2to + 1;
                    $to = $pageNum;
                }
            }
            if($from >1) {
                if($from>4) {
                    $result .= '<li><a href="#">1</a></li>';
                    $result .= '<li><a href="#">2</a></li>';
                    $result .= '<li><span>…</span></li>';
                    // echo "1,2...";
                } else if($from == '4'){
                    $result .= '<li><a href="#">1</a></li>';
                    $result .= '<li><a href="#">2</a></li>';
                    $result .= '<li><a href="#">3</a></li>';
                    // echo "1,2,3,";
                } else if($from == '3'){
                    $result .= '<li><a href="#">1</a></li>';
                    $result .= '<li><a href="#">2</a></li>';
                } else {
                    $result .= '<li><a href="#">1</a></li>';
                }
            }
            for($i=$from; $i<=$to; $i++) {
                if($i == $currentPage) {
                    $result .= '<li class="active"><span>'.$i.'</span></li>'; 
                } else {
                    $result .= '<li><a href="">'.$i.'</a></li>';
                }
            }

            $diff = $pageNum - $to;

            if($diff>0) {
                if($diff>=4) {
                    $result .= '<li><span>…</span></li>';
                    $result .= '<li><a href="">'.($pageNum-1).'</a></li>';
                    $result .= '<li><a href="">'.($pageNum).'</a></li>';
                } else if($diff == 3){
                    $result .= '<li><a href="">'.($pageNum-2).'</a></li>';
                    $result .= '<li><a href="">'.($pageNum-1).'</a></li>';
                    $result .= '<li><a href="">'.($pageNum).'</a></li>';
                } else if($diff == 2){
                    $result .= '<li><a href="">'.($pageNum-1).'</a></li>';
                    $result .= '<li><a href="">'.($pageNum).'</a></li>';
                } else if($diff ==1) {
                    $result .= '<li><a href="">'.($pageNum).'</a></li>';
                }
            }
            $lastDisabled = $this->isLastPage()?'disabled':'';
            $result .= '<li class="'.$lastDisabled.'"><a href="#">Next</a></li>';
            $result .= '</ul>';
            $result .= '</div>';
            return $result;
        }
    }
?>
