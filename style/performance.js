$(function() {
	//总览-性能
	var overviewPerformace = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'overview-performace',
			type : 'column',
			marginTop : 55,
			marginLeft: 70,
			options3d : {
				enabled : true,
				alpha : 6,
				beta : 10,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['Query 100k rows', 'Insert 100 rows']
		},
		yAxis: {
			max: 1500,
//			type: 'logarithmic',
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '执行耗时',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 1494, 281]
		}, {
			name : 'Mybatis',
			data : [ 1008, 221]
		}, {
			name : 'JDBC',
			data : [ 555, 217]
		}, {
			name : 'Rexdb',
			data : [ 513, 217 ]
		} ]
	});

	//总览-代码量
	var overviewCode = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'overview-code',
			type : 'column',
			marginTop : 55,
			marginLeft: 50,
			options3d : {
				enabled : true,
				alpha : 6,
				beta : 10,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['Query', 'Insert']
		},
		yAxis: {
			title: {
				text: 'line count'
			}
		},
		title : {
			text : '代码量（包括配置）',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 19, 21]
		}, {
			name : 'JDBC',
			data : [ 27, 19]
		}, {
			name : 'Mybatis',
			data : [ 9, 9]
		}, {
			name : 'Rexdb',
			data : [ 2, 2]
		} ]
	});
	
	//性能-对象-启用动态字节码
	var getListDynamic = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'getlist-dynamic',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: ['10k rows', '50k rows', '100k rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '查询对象性能耗时',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
				fontSize: "16px"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 108, 654, 1494]
		}, {
			name : 'Mybatis',
			data : [ 93, 516, 1008]
		}, {
			name : 'JDBC',
			data : [ 52, 292, 555]
		}, {
			name : 'Rexdb',
			data : [ 50, 274, 513]
		}]
	});
	
	//性能-对象-禁用动态字节码
	var getListReflect = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'getlist-reflect',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: ['10k rows', '50k rows', '100k rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '查询对象性能耗时（禁用动态字节码选项）',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
				fontSize: "16px"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 110, 642, 1510]
		}, {
			name : 'Mybatis',
			data : [ 100, 514, 999]
		}, {
			name : 'JDBC',
			data : [ 53, 285, 565]
		}, {
			name : 'Rexdb',
			data : [ 69, 358, 700]
		}]
	});
	
	//性能-Map
	var getMapList = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'getmaplist',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: [ '10k rows', '50k rows', '100k rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '查询Map性能耗时',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
				fontSize: "16px"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 73, 433, 887]
		}, {
			name : 'Mybatis',
			data : [ 98, 565, 1063]
		}, {
			name : 'JDBC',
			data : [ 58, 378, 728]
		}, {
			name : 'Rexdb',
			data : [ 56, 335, 673]
		}]
	});
	
	//性能-插入
	var insert = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'insert',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: ['100 rows', '500 rows', '1000 rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '插入记录耗时',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
				fontSize: "16px"
			}
		},
		subtitle : {
			text : null
		},
		plotOptions : {
			column : {
				depth : 25
			}
		},
		series : [ {
			name : 'Hibernate',
			data : [ 281, 1462, 2806]
		}, {
			name : 'Mybatis',
			data : [ 221, 1109, 2204]
		}, {
			name : 'JDBC',
			data : [ 217, 1246, 2263]
		}, {
			name : 'Rexdb',
			data : [ 217, 1121, 2233]
		}]
	});
});