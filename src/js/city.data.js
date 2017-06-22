/*var data = 
	[{"raname":"海富花园","blocks":["1号楼","2号楼","3号楼","4号楼","5号楼","6号楼","A1栋","A2栋","A3栋","A4栋","A5栋","A6栋","B10栋","B11栋","B12栋","B1栋","B2栋","B3栋","B4栋","B5栋","B6栋","B7栋","B8栋","B9栋","汇仁阁","汇兴阁","汇嘉阁","汇祥阁","海怡阁","海恒阁","海憬阁","海涛阁","海清阁","海潮阁","海澜阁","海逸阁","海韵阁","海鸣阁"]}];
*/
var data;
var cityData=[];
$(function() {
	var code;
	$.ajax({
		'url': 'app.php',
		'type': 'post',
		'data': {
			'op': 'parks',
			'uid': '1'
		},
		'success': function(res) {
			res = JSON.parse(res);
			//console.log(res);
			if(!res.code) {
				data= res.data;
			} else {
				alert(res.msg);
			}
		}
	});

});
for(var i = 0; i < data.length; i++){
   cityData.push({text:data[i].raname,children:[]});
   for(var j = 0; j < data[i].blocks.length; j++)
    cityData[i].children.push({text:data[i].blocks[j]});
}

/*
var cityData = [{
	text: '芳草园小区',
	children: [{
		text: "1栋"
	}, {
		text: "2栋"
	}, {
		text: "3栋"
	}, {
		text: "4栋"
	}]
}, {
	text: '珠江俊园',
	children: [{
		text: "1栋"
	}, {
		text: "2栋"
	}, {
		text: "3栋"
	}, {
		text: "4栋"
	}]
}, {
	text: '海富花园',
	children: [{
		text: "1栋"
	}, {
		text: "2栋"
	}, {
		text: "3栋"
	}, {
		text: "4栋"
	}]
}, {
	text: '加拿大花园',
	children: [{
		text: "1栋"
	}, {
		text: "2栋"
	}, {
		text: "3栋"
	}, {
		text: "4栋"
	}]
}]*/