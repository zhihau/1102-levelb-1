<?php include "../base.php"?>

<h1 class="t botli">更新<?=$DB->upload;?></h1>
<form action="api/upload.php?do=<?=$_GET['do']?>" method="post" enctype="multipart/form-data">
    <table>
        <tr>
            <td><?=$DB->upload;?></td>
            <td>
                <input type="file" name="img">
            </td>
        </tr>
    </table>
    <input type="hidden" name="id" value="<?=$_GET['id']?>">
    <div>
        <input type="submit" value="更新">
        <input type="reset" value="重置">
    </div>
</form>