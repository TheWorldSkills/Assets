<?php 
	// 기능
	$mode = isset($midx) ? $midx : null;
	extract($_POST);
	switch ($mode) {
		case 'login':
			re([
				$userid,
				$pw,
			]);

			$user = fetch("select * from member where userid = ? and pw = ? " , array($userid , $pw));

			if($user)
			{	
				$_SESSION['member'] = $user;
				alert("로그인이 되었습니다.", '/');
			}else{
				alert("아이디와 비밀번호를 다시 확인해주세요.");
			}
		break;
		case 'join' :
			re([
				$userid,
				$pw,
				$name,
				$id,
			]);

			if(!filter_var($userid , FILTER_VALIDATE_EMAIL)){
				alert("아이디를 이메일 형식으로 해주세요.");
			}
			

			$len = mb_strlen($pw);
			if (!mb_ereg('([a-zA-Z]{1,})', $pw) || !mb_ereg('([0-9]{1,})', $pw) || $len < 5) {
				alert("비밀번호를 영문숫자조합 5글자 이상");
			}

			if(!mb_ereg('^([가-힣a-zA-Z]{1,})$', $name)){
				alert("이름을 한글/영문 으로 입력해주세요.");
			}

			$len = mb_strlen($id);
			if(!mb_ereg('^([a-zA-Z가-힣0-9]{1,})$', $id) || $len > 6){
				alert("닉네임을 한글/영문/숫자 6글자 이하 , 숫자만은 허용 안됨");
			}

			if(mb_ereg('^([0-9]{1,})$', $id)){
				alert("닉네임을 한글/영문/숫자 6글자 이하 , 숫자만은 허용 안됨");
			}

			$user = execute("INSERT into member set userid = ? , pw = ? , name = ? , id = ? " , array($userid , $pw , $name , $id));
			alert("회원가입이 되었습니다.", '/');
		break;
		case "logout" :	
			session_destroy();
			alert("로그아웃" , '/');
		break;
		// 삭제
		case "delete" :
			switch($_GET['mode']){
				case "member" :
					execute("delete from reid where member = ? " , array($_GET['idx']));
					execute("delete from menu where member = ? " , array($_GET['idx']));
					execute("delete from board where member = ? " , array($_GET['idx']));
					execute("delete from ma where member = ? " , array($_GET['idx']));

					execute("delete from member where idx = ? " , array($_GET['idx']));
					alert("삭제가 되었습니다" );
				break;
				case "reid" :
					execute("update menu set reidx = ?  where reidx = ? " , array(0,$_GET['idx']));

					execute("delete from reid where idx = ? " , array($_GET['idx']));
					alert("삭제가 되었습니다" , '/page/preferences');
				break;
				case "menu" :

					execute("delete from menu where idx = ? " , array($_GET['idx']));

					alert("삭제가 되었습니다" , '/page/preferences');
					
				break;
				case "board" :
					$chk = fetch("select * from board where idx = ? " , array($_GET['idx']));
					execute("delete from ma where bidx = ? " , array($chk->idx ));

					$chkAll = fetchAll("select * from board where ord = ? " , array($chk->ord));

					if($chkAll){
						foreach ($chkAll as $key => $value) {
							if($chk->dep < $value->dep){
								execute("delete from board where idx = ? " , array($value->idx));			
							}
						}
					}
					
					execute("delete from board where idx = ? " , array($chk->idx));


					alert("삭제가 되었습니다" , '/' . $_GET['url']);
				break;
				case "ma" :
					execute("delete from ma where idx = ? " , array($_GET['idx']));
					alert("삭제가 되었습니다" );
				break;
			}
		break;
		// 메뉴 생성
		case "menuAdd" :
			re([
				$name,
			]);

			
			$chk = fetch("select * from menu where name = ? and member = ? " , array( $name , $member->idx ));
			if($chk){
				alert("등록된 메뉴 이름과 동일 합니다.");
			}
			execute("insert into menu set member = ? , name = ? " , array($member->idx , $name));

			alert("등록이 되었습니다." , '/page/preferences' );
		break;
		//게시판 아이디 생성
		case "reAdd" :
			re([
				$name,
			]);
			$chk = fetch("select * from reid where member = ? and name = ? " , array($member->idx , $name));
			if(!mb_ereg('^([a-zA-Z0-9])+$', $name)){
				alert("게시판 아이디는 영문과 숫자만 입력 가능 하다");
			}else if($chk){
				alert("등록된 게시판 아이디과 동일 합니다.");
			}else{
				execute("insert into reid set member = ? , name = ? " , array($member->idx , $name));

				alert("등록이 되었습니다." , '/page/preferences' );
			}
		break;
		// 메뉴 체크
		case "menu_chk" :

			execute("update menu set ok = ? , reidx = ? where idx = ? " , array(1 ,$val , $idx));
			echo "게시판 등록이 되었습니다.";
		break;
		// 글쓰기 
		case "writeBoard" :
			re([
				$title,
				$content,
			]);

			if($member->idx == $UserChk){
				alert("자신의 블로그만 게시물 을 작성 , 수정 , 삭제 할 수 있습니다.", '/' . $url);
			}

			$chk = rowCount("select * from board where reidx = ? " , array($reidx));

			execute("insert into board set title = ? , content = ? , member = ? , reidx = ? , ord = ? , date = ? " , array($title , $content , $member->idx , $reidx , $chk + 1 , Date("Y-m-d")));


			alert("글작성이 되었습니다." , '/' . $url);
		break;
		// 수정
		case "bUpdate" :
			if($member->idx == $UserChk){
				alert("자신의 블로그만 게시물 을 작성 , 수정 , 삭제 할 수 있습니다.", '/' . $url);
			}

			execute('update board set title = ? , content = ? where idx = ? ' , array($title , $content , $idx));

			alert("수정이 되었습니다." , '/' . $url);
		break;
		// 답글쓰기
		case "dep" :
			re([
				$title,
				$content,
			]);

			$chk = fetch("select * from board where idx = ? " , array($idx));

			execute("insert into board set title = ? , content = ? , member = ? , reidx = ? , ord = ? , dep = ? , date = ? " , array($title , $content , $member->idx , $chk->reidx , $chk->ord , $chk->dep + 1 , Date("Y-m-d")));

			alert("글작성이 되었습니다." , '/' . $url);
		break;
		case "ma" :
			re([
				$content
			]);

			execute("insert into ma set content = ? , member = ? , bidx = ? , date = ? " , array($content , $member->idx , $bidx , Date('Y-m-d') ) );
			alert("글작성이 되었습니다." , '/' . $url);
		break;
		case "maUpdate" :
			print_r($_POST);

			execute("UPDATE ma set content = ? where idx = ? " , array($text , $idx));
		break;
	}

 ?>
