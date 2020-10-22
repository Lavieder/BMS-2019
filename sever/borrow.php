<?php
    $navTitle = "<span class='breadcrumb-item active'>借阅管理</span>";
    include "admin/header.php";
?>
<script>
    $(function(){
        var len = $('table tr').length;
        for(var i = 1;i<len;i++){
            $('table tr:eq('+i+') td:first').text(i);
        } 
    });
</script>
<link rel="stylesheet" href="../css/borrow.css">
<style>
    .main .pagination{
        margin-top: 16px;
    }
    .main .page-item:nth-child(1){
        margin: 0 0 0 25px;
    }
</style>
<!-- 修改模态框 -->
<form action="modifyBow.php" method="post">
    <div class="modal fade" id="updModal">
        <!-- 定义他为模态框model,弹出效果为淡入淡出fade -->
        <div class="modal-dialog">
            <!-- 定义他弹出以对话框的形式出现 -->
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">修改图书</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                <input type="text" class='form-control mb-2 w-250' name='aid' placeholder='图书编号' required>
                    <input type="text" class='form-control mb-2 w-250' name='aname' placeholder='书名' required>
                    <input type="text" class='form-control mb-2 w-250' name='awriter' placeholder='作者' required>
                    <input type="text" class='form-control mb-2 w-250' name='apublish' placeholder='出版社' required>
                    <input type="date" class='form-control mb-2 w-250' name='apubDate' placeholder='出版日期' required>
                    <input type="number" step="0.01" class='form-control mb-2 w-250' name='aprice' placeholder='单价' required>
                    <input type="text" class='form-control mb-2 w-250' name='ainDate' placeholder='入库日期' >
                    <input type="text" class='form-control mb-2 w-250' name='acount' placeholder='数量' required>
                    <input type="text" class='form-control mb-2 w-250' name='astack' placeholder='书库' required>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">提交</button>
                </div>
            </div>
        </div>
    </div>
</form>  

    <div class="box">
        <div class="content">
            <h2>借阅操作</h2>
            <form action="borrow_book.php" method="post" autocomplete="off">
                <input type="text" name="rdid" placeholder="读者编号">
                <input type="text" name="bkid" placeholder="图书编号">
                <div class="row">
                    <input type="radio" name="rad" id="ad" value="1"  required>
                       <label class="col-form-label ad" for="ad">借阅</label>
                    <input type="radio" name="rad" id="rd" value="0" required>
                        <label class="col-form-label rd" for="rd">归还</label>
                </div>
                <button type="submit" class="sub">确认</button>
            </form>
        </div>
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
                $count = 0;
                $pageSize = 7;
                $page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
                $offset = 4;

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

                $sql1 = "select reader.rd_id,reader.rd_name,book.bk_id,book.bk_name,borrow.bow_date,giveback.re_date,borrow.bow_count, admin.ad_name from borrow left join giveback on borrow.bk_id=giveback.bk_id join book on book.bk_id=borrow.bk_id join admin on admin.ad_id=borrow.ad_id join reader on reader.rd_id=borrow.rd_id limit $idx,$pageSize";
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
    include "admin/footer.php";
?>