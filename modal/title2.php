<h1 class="t botli">新增標題圖片</h1>
<form action="api/add.php?do=<?=$_GET['table'];?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td>標題區圖片：</td>
            <td><input type="file" name="img" id=""></td>
        </tr>
        <tr>
            <td>標題區替代文字：</td>
            <td><input type="text" name="text" id=""></td>
        </tr>
    </table>
    <div><input type="submit" value="新增">
    <input type="reset" value="重置"></div>
</form>