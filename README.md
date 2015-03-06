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
$total = 100; 
$limit = 10; //Per page
$mode = 1;  // template style, now only support github pagination style of '1'
$demo = new Pagination($page, $total, $limit, $mode);
$paginationTpl = $demo->render();
echo $paginationTpl;
```
 ![alt tag](https://github.com/l1905/pagination/blob/master/demo1.png)
 
 
 ![alt tag](https://github.com/l1905/pagination/blob/master/demo2.png)


 ### 中文介绍
 1.依赖bootsrap
 2.目前完成github风格的分页,即与github分页翻页风格一致
 3.后续会完成多种分页模板的渲染
 4.暂时仅支持普通的路由规则


