<?php 
    $view_r = fetch("select * from board where idx = ? " , array($varray[3]));
    $mv_r = fetch("select * from member where idx = ? " , array($view_r->member));
 ?>
<div class="col-md-9 col-sm-9 col-xs-9">
    <div class="row">
        <div class="col-md-12">
            <h1>글수정</h1>
            <form class="boardwrite" method="post" action="/action/bUpdate">
                <input type="hidden" name="idx" value="<?php echo $view_r->idx ?>">
                <input type="hidden" name="url" value="<?php echo $varray[0] . '/' . $varray[1] ?>">
                <input type="hidden" name="UserChk" value="<?php echo $varray[0] ?>">
                <label>제목
                    <span class="color-red">*</span>
                </label>
                <input class="form-control margin-bottom-20" type="text" name="title" value="<?php echo $view_r->title ?>">
                <label>작성자
                    <span class="color-red">*</span>
                </label>
                <input class="form-control margin-bottom-20" type="text" readonly="" value="<?php echo $mv_r->id ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <label>내용
                            <span class="color-red">*</span>
                        </label>
                        <textarea class="form-control margin-bottom-20" name="content" ><?php echo $view_r->content ?></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary btn-sm" type="submit">글수정</button>
                        <button class="btn btn-default btn-sm" type="reset">다시작성하기</button>
                        <button class="btn btn-default btn-sm" type="button" onclick="history.back();">취소</button>
                    </div>
                </div>
            </form> 
        </div>

    </div>
</div>