<?php 
    $oewwe_r = fetch("select * from board where idx = ? " , array($varray[3]));
    execute("update board set no = ? where idx = ? " , array($oewwe_r->no + 1 ,  $varray[3]));

    $view_r = fetch("select * from board where idx = ? " , array($varray[3]));
    $mv_r = fetch("select * from member where idx = ? " , array($view_r->member));

 ?>
<div class="col-md-9 col-sm-9 col-xs-9">
    <div class="row">
        <div class="col-md-12">
            <h1>글보기</h1>
            <div class="subject">
                <small>[제목]</small> <?php echo $view_r->title ?>
            </div>
            <div class="post-bottom overflow">
                
                <ul class="nav navbar-nav post-nav">
                    <li><i class="fa fa-tag"></i> 작성자 : <?php echo $mv_r->name ?> [<?php echo $mv_r->id ?>]</li>
                    <li><i class="fa fa-clock-o "></i> 작성일 : <?php echo str_replace('-', '. ', $view_r->date)  ?></li>
                    <li><i class="fa fa-comments"></i> 조회 : <?php echo $view_r->no ?></li>
                </ul>
            </div>
            <div class="viwebox">
                <?php echo $view_r->content ?>
            </div>
            <hr>
            <div class="pull-right">
                <button class="btn btn-default btn-sm" type="button" onclick="window.location='/<?= $varray[0] . '/' . $active_chk  ?>'">목록보기</button>
                <?php if(!$member){ ?>

                <button class="btn btn-default btn-sm" type="button" onclick="alert('로그인 후 사용가능 합니다.');location.href='/page/login'" >답글</button>
                <button class="btn btn-default btn-sm" type="button" onclick="alert('로그인 후 사용가능 합니다.');location.href='/page/login'" >수정</button>
                <button class="btn btn-default btn-sm" type="button" onclick="alert('로그인 후 사용가능 합니다.');location.href='/page/login'" >삭제</button>

                <?php }else if($member->userid == $mv_r->userid || $member->userid == 'admin'){ ?>

                <button class="btn btn-default btn-sm" type="button" onclick="window.location='/<?= $varray[0] . '/' . $active_chk  ?>/myblog_reply/<?php echo $view_r->idx ?>'
                ">답글</button>
                <button class="btn btn-default btn-sm" type="button" onclick="window.location='/<?= $varray[0] . '/' . $active_chk  ?>/myblog_modify/<?php echo $view_r->idx ?>'">수정</button>
                <button class="btn btn-default btn-sm" type="button" onclick="location.href='/action/delete?mode=board&idx=<?php echo $view_r->idx ?>&url=<?php echo $varray[0] ?>'">삭제</button>

                <?php } else { ?>
                <button class="btn btn-default btn-sm" type="button" onclick="alert('자신의 블로그만 게시물 을 작성, 수정, 삭제 할 수 있습니다.');" >답글</button>
                <button class="btn btn-default btn-sm" type="button" onclick="alert('자신의 블로그만 게시물 을 작성, 수정, 삭제 할 수 있습니다.');" >수정</button>
                <button class="btn btn-default btn-sm" type="button" onclick="alert('자신의 블로그만 게시물 을 작성, 수정, 삭제 할 수 있습니다.');" >삭제</button>
                <?php } ?>
            </div>
        </div>
        <div class="commentwrite col-md-12 row">
        <h2 class="bold">Comments</h2>
            <form method="post" action="/action/ma">
                <input type="hidden" name="bidx" value="<?php echo $view_r->idx ?>">
                <input type="hidden" name="url" value="<?php echo $varray[0] . '/' . $varray[1].'/'.$varray[2].'/'.$view_r->idx?>">
                <textarea class="margin-bottom-20" type="text" name="content"></textarea>
                <button type="submit">등록</button>
            </form>
        </div>
        <div class="response-area col-md-12 row">
            <ul class="media-list">
                <?php 
                $list = fetchAll("SELECT * from ma where bidx = ?  " , array($view_r->idx));
                foreach ($list as $key => $value) {
                    $vm_r = fetch("SELECT * from member where idx = ?  " , array($view_r->member));
                 ?>
                <li class="media">
                    <div class="post-comment">
                        <div class="media-body">
                            <span><i class="fa fa-user"></i><?php echo $vm_r->name ?>[<?php echo $vm_r->id ?>]</span>
                            <p><?php echo $value->content ?></p>
                            <ul class="nav navbar-nav post-nav">
                                <li><i class="fa fa-clock-o"></i> <?php echo str_replace('-', '.', $value->date) ?></li>
                            </ul>
                        </div>

                        <div class="pull-right">
                            <button class="btn btn-default btn-xs dowoi" type="button" data-idx="<?php echo $value->idx ?>">수정</button>
                            <button class="btn btn-default btn-xs" type="button" onclick="location.href='/action/delete?mode=ma&idx=<?php echo $value->idx ?>'">삭제</button>
                        </div>
                    </div>                                                   
                </li>
                <?php } ?>
            </ul>                   
        </div>

    </div>
</div>