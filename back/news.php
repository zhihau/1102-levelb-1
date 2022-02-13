<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
                    <p class="t cent botli"><?=$DB->title?></p>
                    <form method="post" action="../api/edit.php?do=<?=$DB->table?>">
                        <table width="100%">
                            <tbody>
                                <tr class="yel">
                                    <td width="45%"><?=$DB->header?></td>
                                    <td width="23%"><?=$DB->append?></td>
                                    <td width="7%">刪除</td>
                                </tr>
                                <?php
                                $all=$News->math('count','*');
                                $div=3;
                                $pages=ceil($all/$div);
                                $now=$_GET['p']??1;
                                $start=($now-1)*$div;
                                $rows=$News->all(" limit $start,$div");
                                foreach($rows as $row){
                                    $checked=($row['sh']==1)?"checked":"";
                                ?>
                                <tr>
                                    <td>
                                        <textarea name="text[]"  cols="30" rows="10"><?=$row['text']?></textarea>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="sh[]" <?=$checked?> value="<?=$row['id'];?>">
                                    </td>
                                    <td>
                                        <input type="hidden" name="id[]" value="<?=$row['id'];?>">
                                        <input type="checkbox" name="del[]" value="<?=$row['id'];?>">
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="cent">
                            <?php
if(($now-1)>0){
    $pre=$now-1;
    echo "<a href='?do=$DB->table&p=$pre'> &lt; </a>";
}
for($i=1;$i<=$pages;$i++){
    $size=($i==$now)?"24px":"16px";
    echo "<a href='?do=$DB->table&p=$i' style='font-size:$size'> $i </a>";
}
if(($now+1)<=$pages){
    $next=$now+1;
    echo "<a href='?do=$DB->table&p=$next'> &gt; </a>";
}
                            ?>
                            </div>
                        <table style="margin-top:40px; width:70%;">
                            <tbody>
                                <tr>
                                    <td width="200px"><input type="button"
                                            onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;modal/<?=$DB->table;?>.php?table=<?=$DB->table;?>&#39;)"
                                            value="<?=$DB->button?>"></td>
                                    <td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>

               
            