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
			marginTop : 75,
			marginLeft: 50,
			options3d : {
				enabled : true,
				alpha : 6,
				beta : -10,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['Query 10000 rows', 'Insert 10000 rows']
		},
		yAxis: {
			title: {
				text: "Raspberry Pi 3B + "
			}
		},
		title : {
			text : '执行耗时（毫秒）',
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
			name : 'JDBC',
			data : [ 107, 31]
		}, {
			name : 'Rexdb',
			data : [ 133, 156 ]
		}, {
			name : 'Hibernate',
			data : [ 1052, 954]
		}, {
			name : 'Mybatis',
			data : [ 1052, 954]
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
			marginTop : 75,
			marginLeft: 30,
			options3d : {
				enabled : true,
				alpha : 6,
				beta : -10,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['Query', 'Insert']
		},
		yAxis: {
			title: {
				text: ""
			}
		},
		title : {
			text : '程序代码量（行数）',
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
			name : 'JDBC',
			data : [ 25, 21]
		}, {
			name : 'Rexdb',
			data : [ 1, 1]
		}, {
			name : 'Hibernate',
			data : [ 37, 25]
		}, {
			name : 'Mybatis',
			data : [ 15, 25]
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
			marginTop : 75,
			marginLeft: 30
		},
		xAxis: {
			categories: ['100 rows', '1000 rows', '5000 rows', '10000 rows']
		},
		yAxis: {
			title: {
				text: ""
			}
		},
		title : {
			text : '查询对象性能（启动优化选项）',
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
			name : 'JDBC',
			data : [ 25, 21, 25, 21]
		}, {
			name : 'Rexdb',
			data : [ 1, 1]
		}, {
			name : 'Hibernate',
			data : [ 37, 25]
		}, {
			name : 'Mybatis',
			data : [ 15, 25]
		} ]
	});
});