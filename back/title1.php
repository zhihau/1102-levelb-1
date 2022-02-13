<div>
<h1 class="t cent botli"><?=$DB->title;?></h1>
<form method="post"  action="api/edit.php?do=<?=$DB->table;?>">
<table width="100%">
        <tr class="yel">
            <td><?=$DB->header;?></td>
            <td><?=$DB->append;?></td>
            <td>顯示</td>
            <td>刪除</td>
            <td></td>

        </tr>
        <?php
$rows=$DB->all();
foreach($rows as $row){
    $checked=($row['sh']=1)?'checked':'';

        ?>
        <tr>
            <td>
                <img src="./img/<?=$row['img'];?>" style="width:300px;height:30px"alt="">
            </td>
            <td>
                <input type="text" name="text[]" value="<?=$row['text'];?>">
            </td>
            <td>
                <input type="radio" name="sh" value="<?=$row['id'];?>" <?=$checked;?>>
            </td>
            <td>
                <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
            </td>
            <td>
                <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                <input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/upload.php?do=<?=$DB->table;?>&id=<?=$row['id'];?>&#39;)" 
                              value="更新圖片">
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
    <table style="margin-top:40px; width:70%;">
            <tbody>
                <tr>
                    <td width="200px">
                    <input type="button"
                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)" 
                              value="<?=$DB->button;?>">
                    </td>
                    <td class="cent">
                        
                    <input type="submit" value="修改確定">
        <input type="reset" value="重置">
                    </td>
                </tr>
            </tbody>
        </table>
    
</form>

</div>