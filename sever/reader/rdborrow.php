<?php
    session_start();
    $navTitle = "<span class='breadcrumb-item active'>借阅管理</span>";
    include "../admin/header.php";
    $w = "";
    $iid="";
    $iname="";
    $iwriter="";
    if(isset($_POST['sub'])){
        $iid = $_POST['iid'];
        $iname = $_POST['iname'];
        $iwriter = $_POST['iwriter'];
        if(!empty($iid)) {$w .= " and reader.rd_id like '%$iid%'"; }
        if(!empty($iname)){$w .= " and book.bk_name like '%$iname%'";}
        if(!empty($iwriter)){$w .= " and book.bk_writer  like '%$iwriter%'";}
    }
?>
<script>
    $(function(){
        var len = $('table tr').length;
        for(var i = 1;i<len;i++){
            $('table tr:eq('+i+') td:first').text(i);
        } 
    });
</script>
<link rel="stylesheet" href="../../css/borrow.css">
<style>
    .top .span{
        margin-top: -16px;
    }
    .top .bkname{
        margin: 0;
    }
    .main .pagination{
        margin-top: 16px;
    }
    .main .page-item:nth-child(1){
        margin: 0 0 0 25px;
    }
</style>
<div class="top">
    <form method="post">
    <span class="span">
        借阅人编号：<input type="text" placeholder="Reader number" name="iid" value="<?=$_SESSION['reader']?>" readonly>
        <span class="span bkname">图书书名：<input type="text" name="iname" placeholder="Book Name" value="<?=$iname?>"></span>
        <span class="span bkname">图书作者：<input type="text" name="iwriter" placeholder="Book author" value="<?=$iwriter?>"></span>
        <button type="submit" class="btn select" name="sub">查询</button>
    </span>
    </form>
</div>
    <div class="main">
        <table class="table table-hover" name="table">
            <thead class="thead-dark">
                <tr>
                    <th>序号</th>
                    <th>借阅人编号</th>
                    <th>借阅人姓名</th>
                    <th>图书编号</th>
                    <th>图书名称</th>
                    <th>借阅时间</th>
                    <th>还书时间</th>
                    <th>借阅数量</th>
                    <th>经手人</th>
                </tr>
            </thead>
        <tbody id="item">

            <?php
                //分页定义
                //分页1.总量
                $count = 0;
                //分页2.每页的数据条数
                $pageSize = 12;
                //分页3.当前页(用户需要自己看见的页)
                $page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
                //分页4.左右偏移数
                $offset = 6;

                // 打开数据库
                $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
                //分页5.插入一段获取数据总量的代码
                $sql = 'select count(*) cnt from borrow';
                $rs = $db->query($sql);
                $row = $rs->fetch();
                $count = $row['cnt'];
                //分页6.求出能分成几页
                $pageCount = ceil($count / $pageSize);
                //分页7.定义起始页码
                $startPage = $page - $offset;
                //分页8.定义结束页码
                $endPage = $page + $offset;
                //分页9.定义上一页，下一页
                $lastPage = $page - 1;
                $nextPage = $page + 1;
                //页码校正
                if($page < 1) $page = 1;
                if($lastPage < 1) $lastPage = 1;
                if($endPage > $pageCount) $endPage = $pageCount;
                if($startPage < 1) $startPage = 1;
                if($endPage < $pageCount) $endPage = $pageCount;
                //分页10.准备查询语句
                $idx = ($page-1)*$pageSize;

                $sql1 = "select reader.rd_id,reader.rd_name,book.bk_id,book.bk_name,borrow.bow_date,giveback.re_date,borrow.bow_count, admin.ad_name from borrow left join giveback on borrow.bk_id=giveback.bk_id join book on book.bk_id=borrow.bk_id join admin on admin.ad_id=borrow.ad_id join reader on reader.rd_id=borrow.rd_id and reader.rd_id='".$_SESSION['reader']."' $w limit $idx,$pageSize";
                // echo($sql1);
                $pre = $db->query($sql1);
                if($pre){
                    while($row1 = $pre->fetch()){
                ?>
                <tr>
                    <td></td>
                    <td><?=$row1['rd_id']?></td>
                    <td><?=$row1['rd_name']?></td>
                    <td><?=$row1['bk_id']?></td>
                    <td><?=$row1['bk_name']?></td>
                    <td><?=$row1['bow_date']?></td>
                    <td><?php 
                            if(empty($row1['re_date'])){
                                echo '待还';
                            }else{
                                echo $row1['re_date'];
                            }
                        ?></td>
                    <td><?=$row1['bow_count']?></td>
                    <td><?=$row1['ad_name']?></td>
                </tr>
                <?php
                    }
                }
                ?>
        </tbody>
    </table>
    <!-- 生成分页操作 -->
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link" href='?page= <?php echo $page-1; ?>'>上一页</a>
        </li>
        <?php
            //    计算开始页码：当前页 减去 偏离数
            $pageS = $page-$offset;
            //矫正
            if($pageS<1) $pageS = 1;
            //结束页码：当前页 加上 偏离数
            $pageE = $page+$offset;
            if($pageE>$pageCount) $pageE = $pageCount;
            //生成想要的数字分页样式
            for($i=$pageS;$i<=$pageE;++$i){
                //高亮显示
                $class = ($page == $i)? 'active' : '';
                echo "<li  class='page-item $class' >";
                echo "<a class='page-link' href='?page=$i'>$i</a>";
                echo "</li>";
            }
            $pageNext =$page + 1;
            if($pageNext>$pageCount) $pageNext = $pageCount;
        ?>
        <li class="page-item" >
            <a class="page-link" href="?page= <?php echo $pageNext; ?>">下一页</a>
        </li>
        </ul>
    </div>

<?php
    include "../admin/footer.php";
?>