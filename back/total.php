<div>

    <h1 class="t cent botli">進站總人數管理</h1>
    <form action="api/total.php"method="post">
        <table style="margin:auto">
            <tr class="yel">
                <td>進站總人數</td>
                <td><input type="text" name="total" value="<?=$Total->find(1)['total'];?>"></td>
            </tr>
        </table>
        <div class="cent"><input type="submit" value="修改確定">
        <input type="reset" value="重置"></div>
    </form>
</div>