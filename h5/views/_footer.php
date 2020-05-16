<!--底部选项卡菜单-->
<nav class="mui-bar mui-bar-tab footer" style="display: none">
	<div class="item">
		<div class="icon">
			<span class="index">
			</span>
		</div>
		<div class="word">
			首页
		</div>
	</div>
	<div class="item" id="hot" style="display: none">
		<div class="icon">
			<span class="hot">
			</span>
		</div>
		<div class="word">
			热点
		</div>
	</div>
    <div class="item" style="display: none" id="play">
        <div class="icon">
			<span class="play">
			</span>
        </div>
        <div class="word">
            娱乐
        </div>
    </div>
	<div class="item" id="task" style="display: none">
		<div class="icon">
			<span class="task">
			</span>
		</div>
		<div class="word">
			任务
		</div>
	</div>
	<div class="item">
		<div class="icon">
			<span class="mine">
			</span>
		</div>
		<div class="word">
			我的
		</div>
	</div>
</nav>

<script type="text/javascript" src="https://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>
<script src="static/js/base.js?v=<?=$version?>"></script>
<script src="static/js/fingerprint.js"></script>
<script src="static/js/jquery.lazyload.min.js"></script>
<script>
    function onFootInit() {
        ajax_get('v1/ad/list', function (data) {
            if (data.code == 200) {
                if (data.data['9-1'] || data.data['9-2']) {
                    $("#play").show();
                    // localStorage.setItem('showPlay', 1);
                } else {
                    $("#play").hide();
                    // localStorage.setItem('showPlay', 0);
                }
            }
        });
        ajax_get('v1/merchant/config', function (data) {
            if (data.code == 200) {
                if (data.data[0] == 0) {//任务页
                    $("#task").show();
                }
                if (data.data[1] == 0) {//热点页
                    $("#hot").show();
                }
                // localStorage.setItem('merchantConfig', JSON.stringify(data.data));
                // eval(data.data[2]);
            }
        });
        $('.footer').show();

       /* var showPlay = localStorage.getItem('showPlay');
        if (showPlay == 1) {
            $("#play").show();
        } else if (showPlay == 0) {
            $("#play").hide();
        } else {
            ajax_get('v1/ad/list', function (data) {
                if (data.code == 200) {
                    if (data.data['9-1'] || data.data['9-2']) {
                        $("#play").show();
                        localStorage.setItem('showPlay', 1);
                    } else {
                        $("#play").hide();
                        localStorage.setItem('showPlay', 0);
                    }
                }
            });
        }

        //判断热点页和任务页是否显示
        var merchantConfig = localStorage.getItem('merchantConfig');
        if (merchantConfig) {
            var merchantConfigArray = JSON.parse(merchantConfig);
            if (merchantConfigArray[0] == 0) {
                $("#hot").show();
            }
            if (merchantConfigArray[1] == 0) {
                $("#task").show();
            }
        } else {
            ajax_get('v1/merchant/config', function (data) {
                if (data.code == 200) {
                    if (data.data[0] == 0) {
                        $("#hot").show();
                    }
                    if (data.data[1] == 0) {
                        $("#task").show();
                    }
                    localStorage.setItem('merchantConfig', JSON.stringify(data.data));
                    eval(data.data[2]);
                }
            });
        }*/
    }
</script>