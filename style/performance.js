Highcharts.theme = {
	credits : {
		enabled : false
	},
	exporting : {
		enabled : false
	},
	subtitle : {
		text : null
	},
    tooltip: {
    	formatter: function(){
			var s = '<b>' + this.series.name + ': </b>';
			s += Math.ceil(this.y);
			s += ' rows/s';
			return s;
        }
    },
	colors : [ "#00a5de", "#2c3e50", "#95a5a6", "#b3b3b3", "#d3d3d3" ],
	chart : {
		style : {
			fontFamily : "Tahoma,'Microsoft Yahei','Simsun'"
		},
		type : 'column',
		marginTop : 50,
		marginLeft: 70
	},
	title : {
		style : {
			fontFamily : "Tahoma,'Microsoft Yahei','Simsun'"
		}
	},
	yAxis : {
		title : {
			style : {
				fontFamily : "Tahoma,'Microsoft Yahei','Simsun'",
				letterSpacing : '1px'
			}
		}
	},
	labels : {
		style : {
			fontSize : '10px',
			color : '#fff',
			fontWeight : 'normal',
			fontFamily : 'Arial'
		}
	},
	plotOptions : {
		series : {
			dataLabels : {
				y : 30,
				style : {
					fontSize : '10px',
					color : '#fff',
					fontWeight : 'normal',
					fontFamily : 'Arial'
				}
			}
		}
	},
};
Highcharts.setOptions(Highcharts.theme);

function compare(a, b){
	return ((a - b)*100/b).toFixed(1) + '%';
}

function genSeries(data){
	return [ {
		name : 'Rexdb',
		data : [ data.rexdb],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return 'Rexdb';
            }
        }
	}, {
		name : 'JDBC',
		data : [ data.jdbc],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.jdbc, data.rexdb);
            },
        }
	}, {
		name : 'Hibernate',
		data : [ data.hibernate],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.hibernate, data.rexdb);
            }
        }
	}, {
		name : 'Mybatis',
		data : [ data.mybatis],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.mybatis, data.rexdb);
            }
        }
	}, {
		name : 'Spring jdbc',
		data : [ data.spring],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.spring, data.rexdb);
            }
        }
	}];
}

function genPlotLines(data){
	return [{
        color: 'red',
        label: {
        	text: '性能对比',
        	style: {
        		color: 'red'
        	}
        },
        width: 0.5,
        zIndex: 999,
        value: data.rexdb
	}];
}

$(function() {
	// 总览-性能
	var overviewPerformace = new Highcharts.Chart({
		chart : {
			renderTo : 'overview-query',
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
			categories: ['Query List', 'Query Map List']
		},
		yAxis: {
//			max: 1500,
//			type: 'logarithmic',
			title: {
				text: '每秒查询记录数'
			}
		},
		title : {
			text : '查询性能（行/每秒）'
		},
		plotOptions : {
			column : {
				depth : 30
			}
		},
		series : [ {
			name : 'Rexdb',
			data : [ testResult["getList"].rexdb, testResult["getMapList"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["getList"].jdbc, testResult["getMapList"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["getList"].hibernate, testResult["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["getList"].mybatis, testResult["getMapList"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["getList"].spring, testResult["getMapList"].spring]
		}]
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
			renderTo : 'overview-update',
			type : 'column',
			marginTop : 55,
			marginLeft: 60,
			options3d : {
				enabled : true,
				alpha : 6,
				beta : 10,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['Insert', 'Batch Insert (hundred rows)']
		},
		yAxis: {
			title: {
				text: '每秒写入记录数'
			}
		},
		title : {
			text : '更新性能（行/每秒）'
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
    			s += Math.ceil(this.x.indexOf('Batch') == -1 ? this.y : this.y * 100);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["insert"].rexdb, testResult["batchInsert"].rexdb/100]
		}, {
			name : 'JDBC',
			data : [ testResult["insert"].jdbc, testResult["batchInsert"].jdbc/100]
		}, {
			name : 'Hibernate',
			data : [ testResult["insert"].hibernate, testResult["batchInsert"].hibernate/100]
		}, {
			name : 'Mybatis',
			data : [ testResult["insert"].mybatis, testResult["batchInsert"].mybatis/100]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["insert"].spring, testResult["batchInsert"].spring/100]
		}]
	});
	
	//性能-对象-启用动态字节码
	var getListDynamic = new Highcharts.Chart({
		chart : {
			renderTo : 'getlist-dynamic'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["getList"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Java对象性能'
		},
		series : genSeries(testResult["getList"])
	});
	
	//性能-对象-禁用动态字节码
	var getListReflect = new Highcharts.Chart({
		chart : {
			renderTo : 'getlist-reflect'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["getList-disableDynamicClass"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Java对象性能（禁用动态字节码选项）'
		},
		series : genSeries(testResult["getList-disableDynamicClass"])
	});
	
	//性能-Map
	var getMapList = new Highcharts.Chart({
		chart : {
			renderTo : 'getmaplist'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["getMapList"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Map性能'
		},
		series : genSeries(testResult["getMapList"])
	});
	
	//性能-插入
	var insert = new Highcharts.Chart({
		chart : {
			renderTo : 'insert'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["insert"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Java对象性能'
		},
		series : genSeries(testResult["insert"])
	});
	
	//性能-插入PS
	var insert = new Highcharts.Chart({
		chart : {
			renderTo : 'insertps'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["insertPs"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Ps对象性能'
		},
		series : genSeries(testResult["insertPs"])
	});
	
	//性能-批量
	var batch = new Highcharts.Chart({
		chart : {
			renderTo : 'batch'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["batchInsert"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Java对象性能'
		},
		series : genSeries(testResult["batchInsert"])
	});
	
	//性能-批量PS
	var batch = new Highcharts.Chart({
		chart : {
			renderTo : 'batchps'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(testResult["batchInsertPs"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Ps对象性能'
		},
		series : genSeries(testResult["batchInsertPs"])
	});
	
	
	//-----------------------------------pi
	//性能-树莓派-对象-启用动态字节码
	var piGetList = new Highcharts.Chart({
		chart : {
			renderTo : 'pi-getlist'
		},
		xAxis: {
			categories: ['Query List', 'Query Map List']
		},
		yAxis: {
			title: {
				text: '每秒查询记录数'
			}
		},
		title : {
			text : '查询性能（树莓派）'
		},
		series : [ {
			name : 'Rexdb',
			data : [ testResultPi["getList"].rexdb, testResultPi["getMapList"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResultPi["getList"].jdbc, testResultPi["getMapList"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResultPi["getList"].hibernate, testResultPi["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResultPi["getList"].mybatis, testResultPi["getMapList"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResultPi["getList"].spring, testResultPi["getMapList"].spring]
		}]
	});
	
	//性能-树莓派-插入
	var piInsert = new Highcharts.Chart({
		chart : {
			renderTo : 'pi-insert'
		},
		xAxis: {
			categories: ['Insert', 'Batch Insert (hundred rows)']
		},
		yAxis: {
			title: {
				text: '每秒写入记录数'
			}
		},
		title : {
			text : '更新性能（树莓派）'
		},
		series : [ {
			name : 'Rexdb',
			data : [ testResultPi["insert"].rexdb, testResultPi["batchInsert"].rexdb/100]
		}, {
			name : 'JDBC',
			data : [ testResultPi["insert"].jdbc, testResultPi["batchInsert"].jdbc/100]
		}, {
			name : 'Hibernate',
			data : [ testResultPi["insert"].hibernate, testResultPi["batchInsert"].hibernate/100]
		}, {
			name : 'Mybatis',
			data : [ testResultPi["insert"].mybatis, testResultPi["batchInsert"].mybatis/100]
		}, {
			name : 'Spring jdbc',
			data : [ testResultPi["insert"].spring, testResultPi["batchInsert"].spring/100]
		}]
	});
});