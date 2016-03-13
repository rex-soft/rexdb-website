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
			categories: ['Query 100k rows', 'Batch Insert 10k rows', 'Insert 100 rows']
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
				depth : 30
			}
		},
        tooltip: {
        	formatter: function(){
        		if(this.series.name == 'Hibernate' && this.y == 1550)
        			return '<b>' + this.series.name + ': </b>more than 3000 (ms)'
        		else{
        			var s = '<b>' + this.series.name + ': </b>';
        			s += this.y;
        			s += ' (ms)';
        			return s;
        		}
            }
        },
		series : [ {
			name : 'Hibernate',
			data : [ 1494, 1550, 281]//3954
		}, {
			name : 'Mybatis',
			data : [ 1008, 745, 221]
		}, {
			name : 'JDBC',
			data : [ 555, 193, 217]
		}, {
			name : 'Rexdb',
			data : [ 513, 212, 217]
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
		tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += this.y;
    			s += ' (ms)';
    			return s;
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
			text : '写入耗时',
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
	
	
	//性能-批量
	var batch = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'batch',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: ['1000 rows', '5000 rows', '10k rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '批量写入耗时',
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
			data : [ 403, 1961, 3954]
		}, {
			name : 'Mybatis',
			data : [ 67, 366, 745]
		}, {
			name : 'JDBC',
			data : [ 20, 94, 193]
		}, {
			name : 'Rexdb',
			data : [ 22, 106, 212]
		}]
	});
	
	//性能-树莓派-插入
	var piInsert = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'pi-insert',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			categories: ['50 rows', '200 rows', '500 rows']
		},
		yAxis: {
			title: {
				text: 'millisecond (ms)'
			}
		},
		title : {
			text : '写入耗时（树莓派2代B型）',
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
			data : [ 518, 1942, 4374]
		}, {
			name : 'Mybatis',
			data : [ 290, 1236, 2762]
		}, {
			name : 'JDBC',
			data : [ 285, 1160, 2635]
		}, {
			name : 'Rexdb',
			data : [ 289, 1200, 2734]
		}]
	});
	
	
	//性能-树莓派-对象-启用动态字节码
	var piGetList = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'pi-getlist',
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
			text : '查询耗时（树莓派2代B型）',
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
});