<?php
    /* //包含文件(引用文件)，可以使用require，include
    require 'adminCheck.php'; */
    $navTitle = "<span class='breadcrumb-item active'>书库管理</span>";
    include "admin/header.php";
    include "admin/conn.php";
    $cx = "";
    $iid="";
    $iname="";
    if(isset($_POST['sub'])){
        $iid = $_POST['iid'];
        $iname = $_POST['iname'];
        if(!empty($iid)) {$cx .= " and srm_no like '%$iid%'"; }
        if(!empty($iname)){$cx .= " and srm_name like '%$iname%'";}
    }
?>
<script>
    $(function(){
        var len = $('table tr').length;
        for(var i = 1;i<len;i++){
            $('table tr:eq('+i+') td:first').text(i);
        } 
    });
    
    function delstack(sid){
        if(confirm("你确认要删除吗？")){
            $.post('delstack.php',{sid:sid},function(msg){
                if(msg=='1') {
                    window.location.reload();
                }else{
                    alert('删除失败！');
                }
            });
        }
    }
    function modify(bid){
       $.post('get_stack.php',{"bid":bid},function(data){
            $('[name=updid]').val(data.srm_no);
            $('[name=updname]').val(data.srm_name);
        },'json');
      $('#updModal').modal('show');
    }
    // 添加书库类别到数据库
    $('#addstack').click(function(){
        var adid = $('[name=adid]').val();
        var adname = $('[name=adname]').val();
        $.post('addstack.php',{adid:adid,adname:adname},function(msg){
            //添加加载数据 --> 分类
            if(msg == '1'){
                $('#addstack').modal('hide');
                window.location.reload();
            }else{
                alert('添加分类失败！');
            }
        });
    });
</script>
<link rel="stylesheet" href="../css/stack.css">
<style>
    .top .content .pagination{
        margin-top: 16px;
    }
    .top .content .page-item:nth-child(1){
        margin: 0 0 0 25px;
    }
</style>
<!-- 新增模态框 -->
<form action="addstack.php" method="post">
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
                    <input type="text" class='form-control mb-3 w-150' name='adid' placeholder='书库编号' required>
                    <input type="text" class='form-control mb-3 w-150' name='adname' placeholder='书库名称' required>
                </div>
                <!-- 模态框底部 -->
                <div class="modal-footer">
                    <button type="submit"  id="addstack" class="btn btn-success">新增</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- 修改模态框 -->
<form action="modifyStack.php" method="post">
    <div class="modal fade" id="updModal">
        <!-- 定义他为模态框model,弹出效果为淡入淡出fade -->
        <div class="modal-dialog">
            <!-- 定义他弹出以对话框的形式出现 -->
            <div class="modal-content">
                <!-- 模态框头部 -->
                <div class="modal-header">
                    <h4 class="modal-title">修改书库</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- 模态框主体 -->
                <div class="modal-body">
                    <input type="text" class='form-control mb-3 w-150' name='updid' placeholder='书库编号' readonly>
                    <input type="text" class='form-control mb-3 w-150' name='updname' placeholder='书库名称' required>
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
            书库编号：<input type="text" placeholder="Book number" name="iid" value="<?=$iid?>">
            <span class="span">书库名称：<input type="text" name="iname" placeholder="Book Name" value="<?=$iname?>"></span>
            <button type="submit" class="btn select" name="sub">查询</button>
        </span>
        </form>
        <p class="p">
            <span class="a" data-toggle="modal" data-target="#addModal">添加书库</span>
        </p>
    </span>
    <div class="content">
        <table class="table table-hover" name="table">
            <thead class="thead-dark">
                <tr>
                    <th>序号</th>
                    <th>书库编号</th>
                    <th>书库名称</th>
                    <th>书库状态</th>
                    <th>书库操作</th>
                </tr>
            </thead>
            <tbody id="item">
                <?php
                    //分页定义
                    //分页1.总量
                    $count = 0;
                    //分页2.每页的数据条数
                    $pageSize = 9;
                    //分页3.当前页(用户需要自己看见的页)
                    $page = empty($_REQUEST['page']) ? 1 : $_REQUEST['page'];
                    //分页4.左右偏移数
                    $offset = 5;

                    // 打开数据库
                    $db = new pdo('mysql:host=127.0.0.1;dbname=db_BMS;','root','tang1999');
                    //分页5.插入一段获取数据总量的代码
                    $sql2 = 'select count(*) cnt from stackRoom';
                    $rs = $db->query($sql2);
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
                    
                    $sql = "select * from stackRoom where 1=1 $cx limit $idx,$pageSize";
                    $pre = $db->query($sql);
                    // print_r($pre->fetch());
                    while($row = $pre->fetch()){
                ?>
                <tr>
                    <td></td>
                    <td><?=$row['srm_no']?></td>
                    <td><?=$row['srm_name']?></td>
                    <td><?php
                        $sql2 = "select count(*) cnt from book ";
                        $rs2 = $db->query($sql2);
                        $rs2->execute();
                        $row2 = $rs2->fetch();
                        if($row2['cnt'] == 0){
                            die("<script>alert('没有此类书库！');location.href='stack.php';</script>");
                        }else{
                            echo '使用中';
                        }
                    ?></td>
                    <td>
                        <button type="button" class='btn btn-success' onclick="modify('<?=$row['srm_no']?>')">修改</button>
                        <button type="button" class="btn btn-warning" id="del" onclick="delstack('<?=$row['srm_no']?>')">删除</button>
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
        <!-- 用数字型显示分页效果 -->
        <!-- 要求两个值 第一个是起始页和结束页 -->
        <!-- 起始页：当前页 减去 偏离数 如果小于1 则矫正为1 -->
        <!-- 结束页：当前页 加上 偏离数 如果大于总页码 则矫正为总页码 -->
        <?php
            // 计算开始页码：当前页 减去 偏离数
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
</div>

<?php
    include 'admin/footer.php';
?>
