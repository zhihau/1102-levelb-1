<div>
<h1 class="t cent botli">頁尾版權資料管理</h1>
<form action="api/bottom.php" method="post">
    <table style="margin:auto">
        <tr class="yel">
            <td>頁尾版權資料：</td>
            <td><input type="text" name="bottom" value="<?=$Bottom->find(1)['bottom']?>"></td>
        </tr>
    </table>
    <div class="cent"><input type="submit" value="修改確定">
    <input type="reset" value="重置"></div>
</form>
</div>