<h1 class="t botli">新增動態文字廣告</h1>
<form action="api/add.php?do=<?=$_GET['table']?>" method="post">
    <table>
        <tr>
            <td>動態文字廣告：</td>
            <td><input type="text" name="text" ></td>
        </tr>
        
    </table>
    
            <div>
                <input type="submit" value="新增">
                <input type="reset" value="重置">
            </div>
</form>