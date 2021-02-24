<div class="col-md-9 col-sm-9 col-xs-9">
    <div class="row">
        <div class="col-md-12">
            <h1>글쓰기</h1>
            <form class="boardwrite" method="post" action="/action/writeBoard">
                <input type="hidden" name="reidx" value="<?php echo $active->reidx ?>">
                <input type="hidden" name="url" value="<?php echo $varray[0] . '/' . $varray[1] ?>">
                <input type="hidden" name="UserChk" value="<?php echo $varray[0] ?>">
                <label>제목
                    <span class="color-red">*</span>
                </label>
                <input class="form-control margin-bottom-20" type="text" name="title">
                <label>작성자
                    <span class="color-red">*</span>
                </label>
                <input readonly class="form-control margin-bottom-20" type="text" value="<?php echo $member->id ?>" >
                <div class="row">
                    <div class="col-sm-12">
                        <label>내용
                            <span class="color-red">*</span>
                        </label>
                        <textarea class="form-control margin-bottom-20" name="content"></textarea>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-lg-12 text-right">
                        <button class="btn btn-primary btn-sm" type="submit">글작성</button>
                        <button class="btn btn-default btn-sm" type="reset">다시작성하기</button>
                        <button class="btn btn-default btn-sm" type="button" onclick="history.back();">취소</button>
                    </div>
                </div>
            </form> 
        </div>

    </div>
</div>