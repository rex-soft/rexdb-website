Highcharts.theme = {
//	colors: ["#2e363f", "#707b88", "#7cb5ec", "#40aba4", "#27a9e3"]	
//		colors: ["#2c3e50", "#578ebe", "#36d7b7", "#1bbc9b", "#1ba39c"]	
		colors: ["#2c3e50", "#00a5de", "#d3d3d3", "#b3b3b3", "#95a5a6"]	
};

// Apply the theme
Highcharts.setOptions(Highcharts.theme);


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
				text: '每秒查询记录数',
				style: {
					fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
					letterSpacing: '1px'
				}
			}
		},
		title : {
			text : '查询性能',
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
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
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
				text: '每秒写入记录数',
				style: {
					fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
					letterSpacing: '1px'
				}
			}
		},
		title : {
			text : '更新性能',
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
			labels: {
				enabled: false
			}
		},
		yAxis: {
			 plotLines: [{
	                color: 'red',
	                label: {
	                	text: '性能对比',
	                	style: {
	                		color: 'red',
	                		fontFamily: "Tahoma,'Microsoft Yahei','Simsun'"
	                	}
	                },
	                width: 0.5,
	                zIndex: 999,
	                value: testResult["getList"].rexdb
	        }],
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Java对象性能',
			style: {
				fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
				fontSize: "16px"
			}
		},
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
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
			name : 'Rexdb',
			data : [ testResult["getList"].rexdb],
			dataLabels: {
                enabled: true,
                formatter: function(){
                	return 'Rexdb';
                },
                y: 30,
                style: {
                    fontSize: '10px',
                    color: '#fff',
                    fontWeight: 'normal',
                    fontFamily: 'Arial'
                }
            }
		}, {
			name : 'JDBC',
			data : [ testResult["getList"].jdbc],
			dataLabels: {
                enabled: true,
                formatter: function(){
                	return ((testResult["getList"].rexdb - testResult["getList"].jdbc)*100/testResult["getList"].rexdb).toFixed(1) + '%';
                },
                y: 30,
                style: {
                    fontSize: '10px',
                    color: '#fff',
                    fontWeight: 'normal',
                    fontFamily: 'Arial'
                }
            }
		}, {
			name : 'Hibernate',
			data : [ testResult["getList"].hibernate],
			dataLabels: {
                enabled: true,
                formatter: function(){
                	return ((testResult["getList"].hibernate - testResult["getList"].jdbc)*100/testResult["getList"].rexdb).toFixed(1) + '%';
                },
                y: 30,
                style: {
                    fontSize: '10px',
                    color: '#fff',
                    fontWeight: 'normal',
                    fontFamily: 'Arial'
                }
            }
		}, {
			name : 'Mybatis',
			data : [ testResult["getList"].mybatis],
			dataLabels: {
                enabled: true,
                formatter: function(){
                	return ((testResult["getList"].mybatis - testResult["getList"].jdbc)*100/testResult["getList"].rexdb).toFixed(1) + '%';
                },
                y: 30,
                style: {
                    fontSize: '10px',
                    color: '#fff',
                    fontWeight: 'normal',
                    fontFamily: 'Arial'
                }
            }
		}, {
			name : 'Spring jdbc',
			data : [ testResult["getList"].spring],
			dataLabels: {
                enabled: true,
                formatter: function(){
                	return ((testResult["getList"].spring - testResult["getList"].jdbc)*100/testResult["getList"].rexdb).toFixed(1) + '%';
                },
                y: 30,
                style: {
                    fontSize: '10px',
                    color: '#fff',
                    fontWeight: 'normal',
                    fontFamily: 'Arial'
                }
            }
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
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		title : {
			text : '查询Java对象性能（禁用动态字节码选项）',
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
			name : 'Rexdb',
			data : [ testResult["getList-disableDynamicClass"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["getList-disableDynamicClass"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["getList-disableDynamicClass"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["getList-disableDynamicClass"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["getList-disableDynamicClass"].spring]
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
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '查询Map性能',
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
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["getMapList"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["getMapList"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["getMapList"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["getMapList"].spring]
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
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Java对象性能',
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
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["insert"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["insert"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["insert"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["insert"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["insert"].spring]
		}]
	});
	
	//性能-插入PS
	var insert = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'insertps',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '写入Ps对象性能',
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
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["insertPs"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["insertPs"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["insertPs"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["insertPs"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["insertPs"].spring]
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
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Java对象性能',
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
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["batchInsert"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["batchInsert"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["batchInsert"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["batchInsert"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["batchInsert"].spring]
		}]
	});
	
	//性能-批量PS
	var batch = new Highcharts.Chart({
		credits : {
			enabled : false
		},
		exporting : {
			enabled : false
		},
		chart : {
			renderTo : 'batchps',
			type : 'column',
			marginTop : 50,
			marginLeft: 70
		},
		xAxis: {
			labels: {
				enabled: false
			}
		},
		yAxis: {
			title: {
				text: 'Affected Rows Per Second'
			}
		},
		title : {
			text : '批量写入Ps对象性能',
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
        tooltip: {
        	formatter: function(){
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
        },
		series : [ {
			name : 'Rexdb',
			data : [ testResult["batchInsertPs"].rexdb]
		}, {
			name : 'JDBC',
			data : [ testResult["batchInsertPs"].jdbc]
		}, {
			name : 'Hibernate',
			data : [ testResult["batchInsertPs"].hibernate]
		}, {
			name : 'Mybatis',
			data : [ testResult["batchInsertPs"].mybatis]
		}, {
			name : 'Spring jdbc',
			data : [ testResult["batchInsertPs"].spring]
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
			categories: ['Query List', 'Query Map List']
		},
		yAxis: {
//			max: 1500,
//			type: 'logarithmic',
			title: {
				text: '每秒查询记录数',
				style: {
					fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
					letterSpacing: '1px'
				}
			}
		},
		title : {
			text : '查询性能（树莓派）',
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
    			var s = '<b>' + this.series.name + ': </b>';
    			s += Math.ceil(this.y);
    			s += ' rows/s';
    			return s;
            }
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
			categories: ['Insert', 'Batch Insert (hundred rows)']
		},
		yAxis: {
			title: {
				text: '每秒写入记录数',
				style: {
					fontFamily: "Tahoma,'Microsoft Yahei','Simsun'",
					letterSpacing: '1px'
				}
			}
		},
		title : {
			text : '更新性能（树莓派）',
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
    			s += Math.ceil(this.x.indexOf('Batch') == -1 ? this.y : this.y * 100);
    			s += ' rows/s';
    			return s;
            }
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