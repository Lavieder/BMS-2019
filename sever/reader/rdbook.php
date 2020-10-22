<?php
    $navTitle = "<span class='breadcrumb-item active'>图书管理</span>";
    include "../admin/header.php";
    $w = "";
    $iid="";
    $iname="";
    $iwriter="";
    if(isset($_POST['sub'])){
        $iid = $_POST['iid'];
        $iname = $_POST['iname'];
        $iwriter = $_POST['iwriter'];
        if(!empty($iid)) {$w .= " and bk_id like '%$iid%'"; }
        if(!empty($iname)){$w .= " and bk_name like '%$iname%'";}
        if(!empty($iwriter)){$w .= " and bk_writer  like '%$iwriter%'";}
    }
?>
<link rel="stylesheet" href="../../css/book.css">
<style>
    .top .span{
        border-top: none;
    }
    .main .pagination{
        margin-top: 16px;
    }
    .main .page-item:nth-child(1){
        margin: 0 0 0 25px;
    }
</style>
<script>
    $(function(){
        var len = $('table tr').length;
        for(var i = 1;i<len;i++){
            $('table tr:eq('+i+') td:first').text(i);
        } 
    });
</script>
<div class="main">
    <div class="top">
        <form method="post">
        <span class="span">
            图书编号：<input type="text" placeholder="Book number" name="iid" value="<?=$iid?>">
            <span class="span">图书书名：<input type="text" name="iname" placeholder="Book Name" value="<?=$iname?>"></span>
            <span class="span">图书作者：<input type="text" name="iwriter" placeholder="Book author" value="<?=$iwriter?>"></span>
            <button type="submit" class="btn select" name="sub">查询</button>
        </span>
        </form>
    </div>
    <table class="table table-hover" name="table">
        <thead class="thead-dark">
            <tr>
                <th>序号</th>
               <th>图书编号</th>
               <th>名称</th>
               <th>作者</th>
               <th>出版社</th>
               <th>单价</th>
               <th>入库时间</th>
               <th>数量</th>
               <th>书库</th>
               <th>状态</th>
            </tr>
        </thead>
        <tbody id="item">
            <?php
                $count = 0;
                $pageSize = 12;
                $page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
                $offset = 6;

                $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
                $sql = 'select count(*) cnt from book';
                $rs = $db->query($sql);
                $row = $rs->fetch();
                $count = $row['cnt'];
                $pageCount = ceil($count / $pageSize);
                $startPage = $page - $offset;
                $endPage = $page + $offset;
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

                $sql = "select bk_id,bk_name,bk_writer,bk_publish,bk_price,bk_inDate,bk_count,srm_name from book,stackRoom where stackRoom.srm_no=book.srm_no $w limit $idx,$pageSize";
                // die($sql);
                $pre = $db->query($sql);
                if($pre){
                    while($row = $pre->fetch()){
                ?>
                <tr>
                    <td></td>
                    <td><?=$row['bk_id']?></td>
                    <td><?=$row['bk_name']?></td>
                    <td><?=$row['bk_writer']?></td>
                    <td><?=$row['bk_publish']?></td>
                    <td><?=$row['bk_price']?></td>
                    <td><?=$row['bk_inDate']?></td>
                    <td><?php
                        if(isset($row['bk_count'])){
                            echo '有';
                        }else{
                            echo '无';
                        }
                    ?></td>
                    <td><?=$row['srm_name']?></td>
                    <td><?php
                        $sql1 = 'select count(bk_id) as cnt from book';
                        $rs1 = $db->query($sql1);
                        $rs1->execute();
                        $row1 = $rs1->fetch();
                        if($row1['cnt'] == 0){
                            echo '正在补充';
                        }else{
                            echo '在馆';
                        }
                    ?></td>
                </tr>
                <?php
                    }
                }else{
                    echo '没有数据';
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
            $pageS = $page-$offset;
            if($pageS<1) $pageS = 1;
            $pageE = $page+$offset;
            if($pageE>$pageCount) $pageE = $pageCount;
            for($i=$pageS;$i<=$pageE;++$i){
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
    include '../admin/footer.php';
?>