<!-- 메뉴  -->
<div class="col-md-3 col-sm-3 col-xs-3">
    <div class="sidebar portfolio-sidebar">
        <div class="sidebar-item categories">
            <h3>블로그 메뉴</h3>
            <ul class="nav navbar-stacked">
                <?php 
                
                $menu = fetchAll('select * from menu where member = ?' , array($member_r->idx ));

                foreach ($menu as $key => $value) {
                    $len = rowCount("select * from board where reidx = ? " , array($value->reidx));
                 ?>
                <li <?php echo $value->idx == $active_chk ? 'class="active"' : ''; ?> ><a href="/<?php echo $varray[0] . '/'. $value->idx ?>"><?php print_r($value->name) ?><span class="pull-right">(<?= $len ?>)</span></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>