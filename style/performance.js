var overviewPerformace, overviewCode, getListDynamic, getListReflect, getMapList, insert, insertPs, batch, batchPs;
var piGetList, piInsert;
var result;

$(document).ready(function(){
	$('#showall').click(showAll);
	$('input[name=framework]').change(function(){
		refreshChart(this);
	})
	$('input[name=database]').change(function(){
		reloadDatabase(this);
	})
	
	result = testResults['mysql'];
	renderAllCharts();
});

function showAll(){
	var chks = ['hibernate', 'mybatis', 'spring'];
	for(var i = 0; i < chks.length; i++){
		if($('#'+chks[i]).attr('checked') == null){
			var chk = $('#'+chks[i]).attr('checked', true);
			refreshChart(chk.get(0))
		}
	}	
}

function refreshChart(chk){
	var value = chk.value;
	var show = chk.checked;
	var idx = {
		rexdb: 0,
		jdbc: 1,
		hibernate: 2,
		mybatis: 3,
		spring: 4
	};
	var charts = [overviewPerformace, overviewCode, getListDynamic, getListReflect, getMapList, insert, insertPs, batch, batchPs,
	              piGetList, piInsert];
	
	for(var i = 0; i < charts.length; i++){
		if(show)
			charts[i].series[idx[value]].show();
		else
			charts[i].series[idx[value]].hide();
	}
}

function reloadDatabase(rdo){
	if(!rdo.checked) return;
	result = testResults[rdo.value];
	renderAllCharts();
}

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
	var com = ((a - b)*100/b).toFixed(1);
	if(com < 0)
		return '- ' + (com.substr(1)) + '%';
	else if(com > 0)
		return '+ ' + com + '%';
	else
		return '0%';
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
		visible: false,
		data : [ data.hibernate],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.hibernate, data.rexdb);
            }
        }
	}, {
		name : 'Mybatis',
		visible: false,
		data : [ data.mybatis],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.mybatis, data.rexdb);
            }
        }
	}, {
		name : 'Spring',
		visible: false,
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

function renderAllCharts(){
	// 总览-性能
	overviewPerformace = new Highcharts.Chart({
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
			data : [ result["getList"].rexdb, result["getMapList"].rexdb]
		}, {
			name : 'JDBC',
			data : [ result["getList"].jdbc, result["getMapList"].jdbc]
		}, {
			name : 'Hibernate',
			visible: false,
			data : [ result["getList"].hibernate, result["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			visible: false,
			data : [ result["getList"].mybatis, result["getMapList"].mybatis]
		}, {
			name : 'Spring',
			visible: false,
			data : [ result["getList"].spring, result["getMapList"].spring]
		}]
	});
	
	//总览-代码量
	overviewCode = new Highcharts.Chart({
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
			data : [ result["insert"].rexdb, result["batchInsert"].rexdb/100]
		}, {
			name : 'JDBC',
			data : [ result["insert"].jdbc, result["batchInsert"].jdbc/100]
		}, {
			name : 'Hibernate',
			visible: false,
			data : [ result["insert"].hibernate, result["batchInsert"].hibernate/100]
		}, {
			name : 'Mybatis',
			visible: false,
			data : [ result["insert"].mybatis, result["batchInsert"].mybatis/100]
		}, {
			name : 'Spring',
			visible: false,
			data : [ result["insert"].spring, result["batchInsert"].spring/100]
		}]
	});
	
	//性能-对象-启用动态字节码
	getListDynamic = new Highcharts.Chart({
		chart : {
			renderTo : 'getlist-dynamic'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["getList"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Java对象性能'
		},
		series : genSeries(result["getList"])
	});
	
	//性能-对象-禁用动态字节码
	getListReflect = new Highcharts.Chart({
		chart : {
			renderTo : 'getlist-reflect'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["getList-disableDynamicClass"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Java对象性能（禁用动态字节码选项）'
		},
		series : genSeries(result["getList-disableDynamicClass"])
	});
	
	//性能-Map
	getMapList = new Highcharts.Chart({
		chart : {
			renderTo : 'getmaplist'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["getMapList"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Map性能'
		},
		series : genSeries(result["getMapList"])
	});
	
	//性能-插入
	insert = new Highcharts.Chart({
		chart : {
			renderTo : 'insert'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["insert"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Java对象性能'
		},
		series : genSeries(result["insert"])
	});
	
	//性能-插入PS
	insertPs = new Highcharts.Chart({
		chart : {
			renderTo : 'insertps'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["insertPs"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Ps对象性能'
		},
		series : genSeries(result["insertPs"])
	});
	
	//性能-批量
	batch = new Highcharts.Chart({
		chart : {
			renderTo : 'batch'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["batchInsert"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Java对象性能'
		},
		series : genSeries(result["batchInsert"])
	});
	
	//性能-批量PS
	batchPs = new Highcharts.Chart({
		chart : {
			renderTo : 'batchps'
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			plotLines: genPlotLines(result["batchInsertPs"]),
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Ps对象性能'
		},
		series : genSeries(result["batchInsertPs"])
	});
	
	
	//-----------------------------------pi
	//性能-树莓派-对象-启用动态字节码
	piGetList = new Highcharts.Chart({
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
			visible: false,
			data : [ testResultPi["getList"].hibernate, testResultPi["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			visible: false,
			data : [ testResultPi["getList"].mybatis, testResultPi["getMapList"].mybatis]
		}, {
			name : 'Spring',
			visible: false,
			data : [ testResultPi["getList"].spring, testResultPi["getMapList"].spring]
		}]
	});
	
	//性能-树莓派-插入
	piInsert = new Highcharts.Chart({
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
			visible: false,
			data : [ testResultPi["insert"].hibernate, testResultPi["batchInsert"].hibernate/100]
		}, {
			name : 'Mybatis',
			visible: false,
			data : [ testResultPi["insert"].mybatis, testResultPi["batchInsert"].mybatis/100]
		}, {
			name : 'Spring',
			visible: false,
			data : [ testResultPi["insert"].spring, testResultPi["batchInsert"].spring/100]
		}]
	});
}