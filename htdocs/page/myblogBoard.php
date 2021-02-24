<!-- 내 블러그  게시판 -->
<div class="col-md-9 col-sm-9 col-xs-9">
      <div class="row">
          <?php 

          if($active->reidx == 0){
                  echo "게시판이 등록되지 않은 메뉴 입니다.";
                  exit;
              }else{
           ?>
          <div class="col-md-12">
              <?php $re_r = fetch("select * from reid where idx = ? " , array($active->reidx)); ?>
              <h1><?= $re_r->name ?></h1>
              <div class="boardlist">
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="col-md-1">번호</th>
                              <th class="col-md-6">제목</th>
                              <th>작성자</th>
                              <th>작성일</th>
                              <th>조회</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php 

                          
                          
                          $len = rowCount("select * from board where reidx = ? " , array($active->reidx));
                          $od_list = 5;

                          $total_page = ceil($len/$od_list);

                          $start = ($page - 1) * $od_list;
                          $cc = $len - $start;
                          $prev_page = $page-1;
                          if($prev_page == 0){$prev_page=1;}

                          $next_page = $page+1;
                          if($next_page > $total_page){$next_page = $total_page;}

                          $list = fetchAll("select * from board where reidx = ? order by ord desc , dep asc limit {$start},{$od_list} " , array($active->reidx));

                          foreach ($list as $key => $value) {
                            $ml_r = fetch("select * from member where idx = ? " , array($value->member));
                           ?>
                          <tr>
                              <td><?= $cc - $key ?></td>
                              <td>
                                <?php 
                                  for ($i=0; $i < $value->dep; $i++) echo "&nbsp;&nbsp;&nbsp;";
                                    if($value->dep > 0) echo '┗'
                                 ?>
                                  <a href="/<?= $varray[0] . '/' . $active_chk  ?>/myblog_view/<?php echo $value->idx ?>"><?php echo $value->title ?></a>
                              </td>
                              <td><?php echo $ml_r->name ?></td>
                              <td><?php echo $value->date ?></td>
                              <td><?php echo $value->no ?></td>
                          </tr>
                          <?php } ?>
                      </tbody>
                  </table>
                  <div class="pull-right">
                      <button class="btn btn-default btn-sm" type="button" onclick="window.location='/<?= $varray[0] . '/' . $active_chk  ?>/myblog_write'">글쓰기</button>
                  </div>
              </div>

              <div class="portfolio-pagination">
                  <ul class="pagination">
                    <li><a href="/<?php echo $varray[0] . '/' . $active_chk . '/' . $blogRoot . '/'. $prev_page ?>">left</a></li>
                    <?php for ($i=0; $i < $total_page; $i++) { ?>
                      
                    <li <?php echo $page == $i+ 1 ? 'class="active"' : ''; ?> ><a href="/<?php echo $varray[0] . '/' . $active_chk . '/' . $blogRoot . '/'. ($i+1) ?>"><?php echo $i+1 ?></a></li>
                    <?php }  ?>
                    <li><a href="/<?php echo $varray[0] . '/' . $active_chk . '/' . $blogRoot . '/'. $next_page ?>">right</a></li>
                  </ul>
              </div>
          </div>
          <?php } ?>

      </div>
  </div>