$(function(){
	$(document).on( 'click' , '.on_click' , function(){
		var idx = $(this).data('idx');
		var val = $(this).parents('tr').find('select').val();

		if(val == '선택'){
			alert("게시판 아이디를 선택해주세요.");
		}else {
			$.post('/action/menu_chk' , {idx : idx , val : val} , function(k){
				if(k)
				{
					alert(k);
					location.reload();
				}	
			})
		}
	})

	$(document).on( 'click' , '.dowoi' , function(e){
		var text = $(this).parents('.media').find('p').text();
		var html = `<textarea name="content" cols="30" rows="10" style="width:100%">${text}</textarea>`
		$(this).parents('.media').find('p').html(html);
		$(this).parents('.media').find('button').eq(0).text('완료');
		$(this).parents('.media').find('button').eq(0).removeClass('dowoi');
		$(this).parents('.media').find('button').eq(0).addClass('dowoiOK');
	})

	$(document).on('click' , '.dowoiOK' , function(e){

		var text = $(this).parents('.media').find('textarea').val();
		var idx = $(this).data('idx');

		$.post('/action/maUpdate' , {text : text , idx : idx } , function(data){
			alert(data);
			alert('수정완료');
			location.reload();
		})


	})


	$(document).on('click' , '.delete_dr' , function(){
		if(confirm("정말 삭제하시겠습니까?")){
			var url = $(this).data('idx');

			location.href = url
		}
	})
})


