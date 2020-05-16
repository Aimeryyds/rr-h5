	function bindClick(){
		$('.main .row .pick').click(function(){
			console.log($(this).attr('data'));
			if($(this).attr('data')=='pink'){
				$(this).attr('data','white');
				$(this).css('color','#cccccc');
			}else{
				$(this).attr('data','pink');
				$(this).css('color','#ff09af');
			}
			updateSelect();
		});
		
		$('#headerBtn').click(function(){
			if($(this).attr('data')=='edit'){
				$(this).attr('data','cancel');
				$(this).html('取消');
				$('.main .btn').css('display','block');
				$('.main .panel').css('display','flex');
				$('.main').css('margin-bottom','50px');
			}else{
				$(this).attr('data','edit');
				$(this).html('编辑');
				$('.main .btn').css('display','none');
				$('.main .panel').css('display','none');
				$('.main').css('margin-bottom','0px');
				
				$('.main .panel .all').attr('data','1');
				$('.main .panel .all').html('全选');
				$('.main .btn em').attr('data','white');
				$('.main .btn em').css('color','#cccccc');
				updateSelect();
			}
		});
		
		$('.main .panel .all').click(function(){
			if($(this).attr('data')=='1'){
				$(this).attr('data','0');
				$(this).html('取消全选');
				$('.main .btn em').attr('data','pink');
				$('.main .btn em').css('color','#ff09af');
			}else{
				$(this).attr('data','1');
				$(this).html('全选');
				$('.main .btn em').attr('data','white');
				$('.main .btn em').css('color','#cccccc');
			}
			updateSelect();
		});
	}
	
	function updateSelect(){
		var selectNum=$('.main .btn em[data="pink"]').length;
		if(selectNum>0){
			$('.main .panel .delete').attr('data','1');
			$('.main .panel .delete').css('color','#ff09af');
			$('.main .panel .delete').html('删除('+selectNum+')');
		}else{
			$('.main .panel .delete').attr('data','0');
			$('.main .panel .delete').css('color','#CCCCCC');
			$('.main .panel .delete').html('删除');
		}
	}