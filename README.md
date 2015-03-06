### Overview
It provides this feature:

 1. github pagination style

### Usage
 1. must import bootstrap file
 
### demo

```
require_once 'Pagination.class.php';
 if(isset($_GET['page'])) {
    $page = max(intval($_GET['page']), 1);
 } else {
    $page = 1;
 }
 $demo = new Pagination($page, 100, 10, 1);
 $paginationTpl = $demo->render();
 echo $paginationTpl;
```
 

