<?php
    $navTitle = "<span class='breadcrumb-item active'>图书管理</span>";
    include "admin/header.php";
    $cx = "";
    $iid="";
    $iname="";
    $iwriter="";
    $ipub="";
    if(isset($_POST['sub'])){
        $iid = $_POST['iid'];
        $iname = $_POST['iname'];
        $iwriter = $_POST['iwriter'];
        $ipub = $_POST['ipub'];
        if(!empty($iid)) {$cx .= " and bk_id like '%$iid%'"; }
        if(!empty($iname)){$cx .= " and bk_name like '%$iname%'";}
        if(!empty($iwriter)){$cx .= " and bk_writer  like '%$iwriter%'";}
        if(!empty($ipub)) {$cx .= " and bk_publish like '%$iid%'"; }
    }
?>
<link rel="stylesheet" href="../css/book.css">
<style>
    .top span{ 
        border-bottom: 1px solid #ccc;
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
    function modify(bid){
       $.get('get_book.php',{"bid":bid},function(data){
            $('[name=aid]').val(data.bk_id);
            $('[name=aname]').val(data.bk_name);
            $('[name=awriter]').val(data.bk_writer);
            $('[name=apublish]').val(data.bk_publish);
            $('[name=apubDate]').val(data.bk_pubDate);
            $('[name=aprice]').val(data.bk_price);
            $('[name=ainDate]').val(data.bk_inDate);
            $('[name=acount]').val(data.bk_count);
            $('[name=stack]').val(data.srm_no);
        },'json');
      $('#bookal').modal('show');
    }
    function delbook(sid){
        if(confirm("你确认要删除吗？")){
            $.post('delbook.php',{sid:sid},function(msg){
                if(msg=='1') {
                    alert('删除成功！');
                    window.location.reload();
                }else{
                    alert('删除失败！');
                }
            });
        }
    }
    //加载数据(分类)
    function loadStack(){
        $.get('stackes.php','',function(data){
            // $('#list').html('');// 清理原来已加载的数据，避免重复加载
            $('[name=stack]').html('');
            for(d of data){
                // 往添加坐标的下拉类别追加数据
                $('[name=stack]').append("<option class='list-group-item' value='"+d.srm_no+"'>"+d.srm_name+"</option>");
            }
        },'json')
    }
    // 调用显示数据分类
    loadStack();
</script>
<!-- 新增模态框 -->
<form action="addbook.php" method="post">
    <div class="modal fade" id="addModal">
        <!-- 定义他为模态框model,弹出效果为淡入淡出fade -->
        <div class="modal-dialog">
            <!-- 定义他弹出以对话框的形式出现 -->
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">新增图书</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <input type="text" class='form-control mb-2 w-150' name='id' placeholder='图书编号' required>
                    <input type="text" class='form-control mb-2 w-150' name='name' placeholder='书名' required>
                    <input type="text" class='form-control mb-2 w-150' name='writer' placeholder='作者' required>
                    <input type="text" class='form-control mb-2 w-150' name='publish' placeholder='出版社'>
                    <input type="date" class='form-control mb-2 w-150' name='pubDate' placeholder='出版日期'>
                    <input type="number" step="0.01" class='form-control mb-2 w-150' name='price' placeholder='单价' required>
                    <input type="text" class='form-control mb-2 w-150' name='count' placeholder='数量' required>
                    <select name="stack" class='form-control mb-2 w-150' required></select>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success ok">新增</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 修改模态框 -->
<form action="modifybook.php" method="post">
    <div class="modal fade" id="bookal">
        <!-- 定义他为模态框model,弹出效果为淡入淡出fade -->
        <div class="modal-dialog">
            <!-- 定义他弹出以对话框的形式出现 -->
            <div class="modal-content mct">
                <!-- 模态框头部 -->
                <div class="modal-header mhd">
                    <h4 class="modal-title mtl">修改图书信息</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body mbd">
                    <input type="text" class='form-control mb-2 w-250' name='aid' placeholder='图书编号' readonly>
                    <input type="text" class='form-control mb-2 w-250' name='aname' placeholder='书名' required>
                    <input type="text" class='form-control mb-2 w-250' name='awriter' placeholder='作者' required>
                    <input type="text" class='form-control mb-2 w-250' name='apublish' placeholder='出版社' required>
                    <input type="date" class='form-control mb-2 w-250' name='apubDate' placeholder='出版日期' required>
                    <input type="number" step="0.01" class='form-control mb-2 w-250' name='aprice' placeholder='单价' required>
                    <input type="text" class='form-control mb-2 w-250' name='ainDate' placeholder='入库日期' readonly>
                    <input type="text" class='form-control mb-2 w-250' name='acount' placeholder='数量' required>
                    <select name="stack" class='form-control mb-2 w-150' required></select>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer mft">
                    <button type="submit" class="btn btn-success ok">修改</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="main">
    <div class="top">
        <form method="post">
        <span class="span">
            图书编号：<input type="text" placeholder="Book number" name="iid" value="<?=$iid?>">
            <span class="span">图书书名：<input type="text" name="iname" placeholder="Book Name" value="<?=$iname?>"></span>
            <span class="span">图书作者：<input type="text" name="iwriter" placeholder="Book author" value="<?=$iwriter?>"></span>
            <span class="span">图书出版社：<input type="text" name="ipub" placeholder="Book Publish" value="<?=$ipub?>"></span>
            <button type="submit" class="btn select" name="sub">查询</button>
        </span>
        </form>
        <p class="p">
            <span class="a" data-toggle="modal" data-target="#addModal">添加图书</span>
        </p>
    </div>
    <table class="table table-hover" name="table">
        <thead class="thead-dark">
            <tr>
                <th>序号</th>
               <th>编号</th>
               <th>名称</th>
               <th>作者</th>
               <th>出版社</th>
               <th>单价</th>
               <th>入库时间</th>
               <th>数量</th>
               <th>书库</th>
               <th>状态</th>
               <th>操作</th>
            </tr>
        </thead>
        <tbody id="item">
            <?php
                $count = 0;
                $pageSize = 9;
                $page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
                $offset = 4;

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
                $idx = ($page-1)*$pageSize;

                $sql = "select bk_id,bk_name,bk_writer,bk_publish,bk_price,bk_inDate,bk_count,srm_name from book,stackRoom where stackRoom.srm_no=book.srm_no $cx limit $idx,$pageSize";
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
                    <td><?=$row['bk_count']?></td>
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
                    <td>
                        <button type="button" class='btn btn-success' onclick="modify('<?=$row['bk_id']?>')">修改</button>
                        <button type="button" class='btn btn-warning' id="del" onclick="delbook('<?=$row['bk_id']?>')">删除</button>
                    </td>
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
            // 计算开始页码：当前页 减去 偏离数
            $pageS = $page-$offset;
            if($pageS<1) $pageS = 1;
            $pageE = $page+$offset;
            if($pageE>$pageCount) $pageE = $pageCount;
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
    include 'admin/footer.php';
?>