<?php
    $navTitle = "<span class='breadcrumb-item active'>读者管理</span>";
    include "admin/header.php";
    include "admin/conn.php";
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
        if(!empty($iid)) {$cx .= " and rd_id like '%$iid%'"; }
        if(!empty($iname)){$cx .= " and rd_name like '%$iname%'";}
        if(!empty($iwriter)){$cx .= " and rd_sex  like '%$iwriter%'";}
        if(!empty($ipub)) {$cx .= " and rd_class like '%$iid%'"; }
    }
?>
<link rel="stylesheet" href="../css/stack.css">
<style>
    .top .content .pagination{
        margin-top: 16px;
    }
    .top .content .page-item:nth-child(1){
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
    function delreader(sid){
        if(confirm("你确认要删除吗？")){
            $.post('delreader.php',{sid:sid},function(msg){
                if(msg=='1') {
                    alert('删除成功！');
                    window.location.reload();
                }else{
                    alert('删除失败！');
                }
            });
        }
    }
    function modify(bid){
       $.post('get_reader.php',{"bid":bid},function(data){
            $('[name=updid]').val(data.rd_id);
            $('[name=updname]').val(data.rd_name);
                if(data.rd_sex == 1){
                    $('[name=updsex]').val('男');
                }else if(data.rd_sex == 0){
                    $('[name=updsex]').val('女');
                }
            $('[name=updage]').val(data.rd_age);
            $('[name=updclass]').val(data.rd_class);
            $('[name=updtel]').val(data.rd_tel);
        },'json');
      $('#updModal').modal('show');
    }
</script>
<!--新增模态框 -->
<form action="addreader.php" method="post">
    <div class="modal fade" id="addModal">
        <!-- 定义他为模态框model,弹出效果为淡入淡出fade -->
        <div class="modal-dialog">
            <!-- 定义他弹出以对话框的形式出现 -->
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">新增读者</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <input type="number" class='form-control mb-3 w-150' name='rdid' placeholder='读者编号' required>
                    <input type="text" class='form-control mb-3 w-150' name='rdpwd' placeholder='读者密码' required>
                    <input type="text" class='form-control mb-3 w-150' name='rdname' placeholder='读者姓名' required>
                    <input type="text" class='form-control mb-3 w-150' name='rdsex' placeholder='读者性别' required>
                    <input type="number" class='form-control mb-3 w-150' name='rdage' placeholder='读者年龄' required>
                    <input type="text" class='form-control mb-3 w-150' name='rdclass' placeholder='读者班级' required>
                    <input type="text" class='form-control mb-3 w-150' name='rdtel' placeholder='读者电话' required>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">新增</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 修改模态框 -->
<form action="modifyReader.php" method="post">
    <div class="modal fade" id="updModal">
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
                <input type="number" class='form-control mb-3 w-150' name='updid' placeholder='读者编号' readonly>
                    <input type="text" class='form-control mb-3 w-150' name='updname' placeholder='读者姓名' required>
                    <input type="text" class='form-control mb-3 w-150' name='updsex' placeholder='读者性别' required>
                    <input type="number" class='form-control mb-3 w-150' name='updage' placeholder='读者年龄' required>
                    <input type="text" class='form-control mb-3 w-150' name='updclass' placeholder='读者班级' required>
                    <input type="text" class='form-control mb-3 w-150' name='updtel' placeholder='读者电话' required>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">提交</button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="top">
    <form method="post">
        <span class="span">
            读者编号：<input type="text" placeholder="Book number" name="iid" value="<?=$iid?>">
            <span class="span">读者姓名：<input type="text" name="iname" placeholder="Book Name" value="<?=$iname?>"></span>
            <span class="span">读者性别：<input type="text" name="iwriter" placeholder="Book author" value="<?=$iwriter?>"></span>
            <span class="span">读者班级：<input type="text" name="ipub" placeholder="Book Publish" value="<?=$ipub?>"></span>
            <button type="submit" class="btn select" name="sub">查询</button>
        </span>
    </form>
        <p class="p">
            <span class="a" data-toggle="modal" data-target="#addModal">添加读者</span>
        </p>
    </span>
    <div class="content">
        <table class="table table-hover" name="table">
            <thead class="thead-dark">
                <tr>
                    <th>序号</th>
                    <th>读者编号</th>
                    <th>读者姓名</th>
                    <th>读者性别</th>
                    <th>读者年龄</th>
                    <th>读者班级</th>
                    <th>读者电话</th>
                    <th>读者状态</th>
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
                    $sql = 'select count(*) cnt from reader';
                    $rs = $conn->query($sql);
                    $row = $rs->fetch();
                    $count = $row['cnt'];
                    $pageCount = ceil($count / $pageSize);
                    $startPage = $page - $offset;
                    $endPage = $page + $offset;
                    $lastPage = $page - 1;
                    $nextPage = $page + 1;
                    
                    if($page < 1) $page = 1;
                    if($lastPage < 1) $lastPage = 1;
                    if($endPage > $pageCount) $endPage = $pageCount;
                    if($startPage < 1) $startPage = 1;
                    if($endPage < $pageCount) $endPage = $pageCount;
                    //分页10.准备查询语句
                    $idx = ($page-1)*$pageSize;

                    $sql1 = "select * from reader where 1=1 $cx limit $idx,$pageSize";
                    $pre1 = $db->query($sql1);
                    $rs1 = $pre1->execute();
                    // print_r($pre->fetch());
                    while($row = $pre1->fetch()){
                ?>
                <tr>
                    <td></td>
                    <td><?=$row['rd_id']?></td>
                    <td><?=$row['rd_name']?></td>
                    <td><?php
                        if($row['rd_sex'] == "1"){
                            echo '男';
                        }else if($row['rd_sex'] == "0"){
                            echo '女';
                        }
                    ?></td>
                    <td><?=$row['rd_age']?></td>
                    <td><?=$row['rd_class']?></td>
                    <td><?=$row['rd_tel']?></td>
                    
                    <td>正常</td>
                    <td>
                        <button type="submit" class='btn btn-success' onclick="modify('<?=$row['rd_id']?>')">修改</button>
                        <button type="submit" class='btn btn-warning' id="del" onclick="delreader('<?=$row['rd_id']?>')">删除</button>
                    </td>
                </tr>
                <?php
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
</div>
<?php
    include 'admin/footer.php';
?>