<?php include_once "../base.php"?>
<h1 class="t botli">新增主選單</h1>
<form action="api/add.php?do=<?=$_GET['table']?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>主選單名稱</td>
            <td>主選單連結網址</td>
        </tr>
        <tr>
            <td><input type="text" name="name" id=""></td>
            <td><input type="text" name="href" id=""></td>
        </tr>
        
    </table>
    
            <div>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </div>
</form>