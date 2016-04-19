//================================================all
$(document).scroll(function(){
	if($(document).scrollTop() == 0){
		$('#lead').removeClass('navbar-shadow');
	}else
		$('#lead').addClass('navbar-shadow');
});

$(document).ready(function(){
	setJumps();
});


function setJumps(){
	
	//href
	var loc = location.href;
	if(loc.indexOf('#') != -1){
		var jumpId = loc.substr(loc.lastIndexOf('#') + 1, loc.length);
		if(jumpId.indexOf('jump_') == 0){
			var targetId = jumpId.substr(5, jumpId.length);
			jumpTo('#'+targetId);
		}
	}
	
	//footer
	$('#footer a').on('click', function(){
		var href = $(this).attr('href');
		if(href.indexOf('#') != -1){
			var thisPage = loc.substring(loc.lastIndexOf('/') + 1, loc.lastIndexOf('#'));
			var targetPage = href.substring(href.lastIndexOf('/'), href.lastIndexOf('#'));
			if(thisPage == targetPage){
				var jumpId = href.substr(href.lastIndexOf('#') + 1, href.length);
				if(jumpId.indexOf('jump_') == 0){
					var targetId = jumpId.substr(5, jumpId.length);
					jumpTo('#'+targetId);
					return false;
				}
			}
		}
	});
	
	//links
	$('.bs-docs-sidebar a').on('click', function(){
		var href = $(this).attr('href');
		if(href.indexOf('#') == -1) return;
		
		var targetId = href.substr(href.lastIndexOf('#'), href.length);
		jumpTo(targetId);
		return false;
	});

}

//jump to
function jumpTo(targetId){
	var target = $(targetId);
    if(target.length==1){
         var top = target.offset().top-99;
         if(top < 0) top = 0;
         $('html,body').animate({scrollTop:top}, 200);
     } 
}

//================================================index
//=====================typed animation
! function($) {
    "use strict";
    var Typed = function(el, options) {
        this.el = $(el);
        this.options = $.extend({}, $.fn.typed.defaults, options);
        this.isInput = this.el.is('input');
        this.attr = this.options.attr;
        this.showCursor = this.isInput ? false : this.options.showCursor;
        this.elContent = this.attr ? this.el.attr(this.attr) : this.el.text()
        this.contentType = this.options.contentType;
        this.typeSpeed = this.options.typeSpeed;
        this.startDelay = this.options.startDelay;
        this.backSpeed = this.options.backSpeed;
        this.backDelay = this.options.backDelay;
        this.stringsElement = this.options.stringsElement;
        this.strings = this.options.strings;
        this.strPos = 0;
        this.arrayPos = 0;
        this.stopNum = 0;
        this.loop = this.options.loop;
        this.loopCount = this.options.loopCount;
        this.curLoop = 0;
        this.stop = false;
        this.cursorChar = this.options.cursorChar;
        this.shuffle = this.options.shuffle;
        this.sequence = [];
        this.build();
    };

    Typed.prototype = {
        constructor: Typed
        ,
        init: function() {
            var self = this;
            self.timeout = setTimeout(function() {
                for (var i=0;i<self.strings.length;++i) self.sequence[i]=i;
                if(self.shuffle) self.sequence = self.shuffleArray(self.sequence);
                self.typewrite(self.strings[self.sequence[self.arrayPos]], self.strPos);
            }, self.startDelay);
        }

        ,
        build: function() {
            var self = this;
            if (this.showCursor === true) {
                this.cursor = $("<span class=\"typed-cursor\">" + this.cursorChar + "</span>");
                this.el.after(this.cursor);
            }
            if (this.stringsElement) {
                self.strings = [];
                this.stringsElement.hide();
                var strings = this.stringsElement.find('p');
                $.each(strings, function(key, value){
                    self.strings.push($(value).html());
                });
            }
            this.init();
        }
        ,
        typewrite: function(curString, curStrPos) {
            if (this.stop === true) {
                return;
            }

            var humanize = Math.round(Math.random() * (100 - 30)) + this.typeSpeed;
            var self = this;

            self.timeout = setTimeout(function() {
                var charPause = 0;
                var substr = curString.substr(curStrPos);
                if (substr.charAt(0) === '^') {
                    var skip = 1; // skip atleast 1
                    if (/^\^\d+/.test(substr)) {
                        substr = /\d+/.exec(substr)[0];
                        skip += substr.length;
                        charPause = parseInt(substr);
                    }
                    curString = curString.substring(0, curStrPos) + curString.substring(curStrPos + skip);
                }

                if (self.contentType === 'html') {
                    var curChar = curString.substr(curStrPos).charAt(0)
                    if (curChar === '<' || curChar === '&') {
                        var tag = '';
                        var endTag = '';
                        if (curChar === '<') {
                            endTag = '>'
                        } else {
                            endTag = ';'
                        }
                        while (curString.substr(curStrPos).charAt(0) !== endTag) {
                            tag += curString.substr(curStrPos).charAt(0);
                            curStrPos++;
                        }
                        curStrPos++;
                        tag += endTag;
                    }
                }

                self.timeout = setTimeout(function() {
                    if (curStrPos === curString.length) {
                        self.options.onStringTyped(self.arrayPos);

                        if (self.arrayPos === self.strings.length - 1) {
                            self.options.callback();

                            self.curLoop++;
                            if (self.loop === false || self.curLoop === self.loopCount)
                                return;
                        }

                        self.timeout = setTimeout(function() {
                            self.backspace(curString, curStrPos);
                        }, self.backDelay);
                    } else {

                        if (curStrPos === 0)
                            self.options.preStringTyped(self.arrayPos);

                        var nextString = curString.substr(0, curStrPos + 1);
                        if (self.attr) {
                            self.el.attr(self.attr, nextString);
                        } else {
                            if (self.isInput) {
                                self.el.val(nextString);
                            } else if (self.contentType === 'html') {
                                self.el.html(nextString);
                            } else {
                                self.el.text(nextString);
                            }
                        }

                        curStrPos++;
                        self.typewrite(curString, curStrPos);
                    }
                }, charPause);

            }, humanize);

        }

        ,
        backspace: function(curString, curStrPos) {
            if (this.stop === true) {
                return;
            }

            var humanize = Math.round(Math.random() * (100 - 30)) + this.backSpeed;
            var self = this;

            self.timeout = setTimeout(function() {

                if (self.contentType === 'html') {
                    if (curString.substr(curStrPos).charAt(0) === '>') {
                        var tag = '';
                        while (curString.substr(curStrPos).charAt(0) !== '<') {
                            tag -= curString.substr(curStrPos).charAt(0);
                            curStrPos--;
                        }
                        curStrPos--;
                        tag += '<';
                    }
                }

                var nextString = curString.substr(0, curStrPos);
                if (self.attr) {
                    self.el.attr(self.attr, nextString);
                } else {
                    if (self.isInput) {
                        self.el.val(nextString);
                    } else if (self.contentType === 'html') {
                        self.el.html(nextString);
                    } else {
                        self.el.text(nextString);
                    }
                }
                if (curStrPos > self.stopNum) {
                    curStrPos--;
                    self.backspace(curString, curStrPos);
                }
                else if (curStrPos <= self.stopNum) {
                    self.arrayPos++;

                    if (self.arrayPos === self.strings.length) {
                        self.arrayPos = 0;
                        if(self.shuffle) self.sequence = self.shuffleArray(self.sequence);

                        self.init();
                    } else
                        self.typewrite(self.strings[self.sequence[self.arrayPos]], curStrPos);
                }

            }, humanize);

        }
        ,shuffleArray: function(array) {
            var tmp, current, top = array.length;
            if(top) while(--top) {
                current = Math.floor(Math.random() * (top + 1));
                tmp = array[current];
                array[current] = array[top];
                array[top] = tmp;
            }
            return array;
        }

        ,
        reset: function() {
            var self = this;
            clearInterval(self.timeout);
            var id = this.el.attr('id');
            this.el.after('<span id="' + id + '"/>')
            this.el.remove();
            if (typeof this.cursor !== 'undefined') {
                this.cursor.remove();
            }
            self.options.resetCallback();
        }

    };

    $.fn.typed = function(option) {
        return this.each(function() {
            var $this = $(this),
                data = $this.data('typed'),
                options = typeof option == 'object' && option;
            if (!data) $this.data('typed', (data = new Typed(this, options)));
            if (typeof option == 'string') data[option]();
        });
    };

    $.fn.typed.defaults = {
        strings: ["These are the default values...", "You know what you should do?", "Use your own!", "Have a great day!"],
        stringsElement: null,
        typeSpeed: 0,
        startDelay: 0,
        backSpeed: 0,
        shuffle: false,
        backDelay: 500,
        loop: false,
        loopCount: false,
        showCursor: true,
        cursorChar: "|",
        attr: null,
        contentType: 'html',
        callback: function() {},
        preStringTyped: function() {},
        onStringTyped: function() {},
        resetCallback: function() {}
    };


}(window.jQuery);

function startTyped(){
    $("#typed").typed({
      strings: ["DB.get(sql, Student.class);"],
      startDelay: 500,
      typeSpeed: 0,
      callback: function() {
    	  $("#typed").fadeOut('fast', function(){
    		  $('#typed').css('color', '#000').html('DB.get(<font color="#957d47">sql</font>, Student.<font color="#7f0055">class</font>);');
    	      $(this).fadeIn('normal');
    	  });
    	  $('#student-colored').fadeIn(1200);
      }
    });
}

//=====================gears  animation
var gearDatabaseGray = false;
var lastDatabase = null;
function runGears(){
	var db = ['postgresql', 'script', 'h2', 'db2', 'oracle', 'mysql', 'sqlserver-copy'];
	
	$('#gears').addClass('gears-run');
	window.setInterval(function(){
		var randomDb = db[parseInt(db.length * Math.random())];
		while(randomDb == lastDatabase){
			randomDb = db[parseInt(db.length * Math.random())];
		}
		lastDatabase = randomDb;
		gearFly(randomDb);
	}, 600);
	
	window.setTimeout(function(){
		$('#native-sql').fadeIn(1200);
		gearDatabaseGray = true;
	}, 2000)
}

function gearFly(icon){
	var h = $('#gears').innerHeight() - 20 - 50;
	var w = ($('#gears').innerWidth() - 250) / 2;
	
	var l = $('#gear12').offset().left - $('#gears').offset().left;
	var m = ($('#gears').innerHeight() - 50)/2;
	var icon = $('<span class="float-database iconfont icon-'+ icon +'"></span>').addClass(gearDatabaseGray ? 'float-database-gray' : '').css({
		top: h * Math.random(),
		left: w * Math.random()
	}).appendTo('#gears');
	
	icon.animate({
		left: l,
		top: m,
		opacity: 0
	}, 1600, "swing", function(){
		$(this).remove();
	})
}

//================================================performance.php
var testResults = [];

testResults.oracle={"insert":{"rexdb":1815.42,"jdbc":1957.75,"hibernate":1412.31,"mybatis":1896.65,"spring":1836.83},"insertPs":{"rexdb":1838.38,"jdbc":1943.69,"hibernate":1410.93,"mybatis":1889.89,"spring":1823.61},"batchInsert":{"rexdb":41436.87,"jdbc":46638.96,"hibernate":37496.37,"mybatis":19329.82,"spring":43011.58},"batchInsertPs":{"rexdb":39453.99,"jdbc":46354.15,"hibernate":37319.02,"mybatis":19016.82,"spring":42242.14},"getList":{"rexdb":28679.23,"jdbc":29448.93,"hibernate":19121.2,"mybatis":19451.7,"spring":27708.73},"getList-disableDynamicClass":{"rexdb":26487.4,"jdbc":28182.42,"hibernate":17912.65,"mybatis":18224.09,"spring":26584.41},"getMapList":{"rexdb":25975.55,"jdbc":18450.8,"hibernate":18126.83,"mybatis":17811.41,"spring":24082.22}}
testResults.sqlserver={"insert":{"rexdb":2160.76,"jdbc":2139.02,"hibernate":1057.59,"mybatis":2089.1,"spring":1949.51},"insertPs":{"rexdb":1999.99,"jdbc":2004.65,"hibernate":1035.59,"mybatis":1891.52,"spring":1995.96},"batchInsert":{"rexdb":22963.98,"jdbc":22518.09,"hibernate":20251.96,"mybatis":5708.35,"spring":21565.87},"batchInsertPs":{"rexdb":21578,"jdbc":22277.29,"hibernate":20663.29,"mybatis":5523.23,"spring":21300.6},"getList":{"rexdb":106338.03,"jdbc":88943.64,"hibernate":47628.74,"mybatis":61846.93,"spring":71774.28},"getList-disableDynamicClass":{"rexdb":88931.33,"jdbc":92192.83,"hibernate":47858.75,"mybatis":63444.31,"spring":71346.7},"getMapList":{"rexdb":78335.07,"jdbc":77699.36,"hibernate":74053.5,"mybatis":62768.86,"spring":58441.78}}
testResults.db2={"insert":{"rexdb":2070.94,"jdbc":2067.3,"hibernate":1271.77,"mybatis":1977.83,"spring":1718.46},"insertPs":{"rexdb":2075.38,"jdbc":2103.55,"hibernate":1265.2,"mybatis":1992.38,"spring":1736.89},"batchInsert":{"rexdb":62466.39,"jdbc":46420.67,"hibernate":37505.6,"mybatis":40434.84,"spring":49245.52},"batchInsertPs":{"rexdb":57784.04,"jdbc":41942.47,"hibernate":36146.31,"mybatis":39210.96,"spring":43393.51},"getList":{"rexdb":59224.75,"jdbc":69722.08,"hibernate":35410.28,"mybatis":41305.37,"spring":67356.54},"getList-disableDynamicClass":{"rexdb":73191.28,"jdbc":121954.27,"hibernate":50672.14,"mybatis":55978.24,"spring":121961.5},"getMapList":{"rexdb":82411.31,"jdbc":97270.9,"hibernate":95576.83,"mybatis":61952.3,"spring":53882.98}}

testResults.mysql = {"insert":{"rexdb":2558.6,"jdbc":2668.34,"hibernate":1018.44,"mybatis":2504.37,"spring":2385.54},"insertPs":{"rexdb":2514.66,"jdbc":2609.91,"hibernate":1005.62,"mybatis":2465.78,"spring":2356.76},"batchInsert":{"rexdb":38029.47,"jdbc":36331.23,"hibernate":26398.35,"mybatis":33300.41,"spring":33131.24},"batchInsertPs":{"rexdb":33668.83,"jdbc":40263.09,"hibernate":24336.78,"mybatis":34728.59,"spring":35790.58},"getList":{"rexdb":134800.19,"jdbc":138268.99,"hibernate":58071.6,"mybatis":76499.53,"spring":122763.9},"getList-disableDynamicClass":{"rexdb":96267.23,"jdbc":142484.02,"hibernate":57976.6,"mybatis":70304.96,"spring":140093.29},"getMapList":{"rexdb":118971,"jdbc":102657.83,"hibernate":101095.28,"mybatis":75529.9,"spring":74601.72}}
testResults.postgresql={"insert":{"rexdb":2492.06,"jdbc":2676.59,"hibernate":1488.92,"mybatis":2489,"spring":2487.26},"insertPs":{"rexdb":2540.9,"jdbc":2638.51,"hibernate":1473.07,"mybatis":2367.12,"spring":2467.33},"batchInsert":{"rexdb":17275.65,"jdbc":17735.4,"hibernate":14012.21,"mybatis":16194.25,"spring":16767.28},"batchInsertPs":{"rexdb":16470.26,"jdbc":17328.44,"hibernate":15560.36,"mybatis":15836.08,"spring":16556.95},"getList":{"rexdb":75485.45,"jdbc":88332.9,"hibernate":44387.26,"mybatis":55693.18,"spring":64142.83},"getList-disableDynamicClass":{"rexdb":66587.26,"jdbc":90931.46,"hibernate":46687.18,"mybatis":54740.47,"spring":66016.13},"getMapList":{"rexdb":66551.75,"jdbc":81763.12,"hibernate":70318.11,"mybatis":59679.63,"spring":51214.24}}

testResults.hsqldb={"insert":{"rexdb":407.59,"jdbc":455.23,"hibernate":342.22,"mybatis":402.3,"spring":392.03},"insertPs":{"rexdb":402.73,"jdbc":450.07,"hibernate":397.43,"mybatis":415.68,"spring":418.28},"batchInsert":{"rexdb":677.14,"jdbc":710.29,"hibernate":657.85,"mybatis":719.77,"spring":636.26},"batchInsertPs":{"rexdb":955.8,"jdbc":990.95,"hibernate":956.5,"mybatis":1038.44,"spring":955.07},"getList":{"rexdb":9631.27,"jdbc":9650.07,"hibernate":9687.69,"mybatis":9844.87,"spring":9389.79},"getList-disableDynamicClass":{"rexdb":9514.75,"jdbc":9651.08,"hibernate":9540.91,"mybatis":9820.1,"spring":9368.03},"getMapList":{"rexdb":9616.33,"jdbc":9605.09,"hibernate":9672.89,"mybatis":9752.79,"spring":9203.33}}
testResults.h2 ={"insert":{"rexdb":4630.75,"jdbc":4581.83,"hibernate":1506.69,"mybatis":4279.02,"spring":4394.8},"insertPs":{"rexdb":4606.3,"jdbc":4614.55,"hibernate":1527.61,"mybatis":4186.82,"spring":4336.03},"batchInsert":{"rexdb":9411.25,"jdbc":8845.62,"hibernate":8105.69,"mybatis":8489.57,"spring":9171.75},"batchInsertPs":{"rexdb":9912.34,"jdbc":9224.14,"hibernate":8728.06,"mybatis":8883.68,"spring":9775.11},"getList":{"rexdb":282733.85,"jdbc":286465.5,"hibernate":322456.08,"mybatis":354788.64,"spring":272054.92},"getList-disableDynamicClass":{"rexdb":263951.98,"jdbc":285315.29,"hibernate":335775.49,"mybatis":357127.86,"spring":278735.37},"getMapList":{"rexdb":218244.44,"jdbc":286446.9,"hibernate":418097.07,"mybatis":374712.54,"spring":248407.87}}
testResults.derby={"insert":{"rexdb":1400.8,"jdbc":1426.15,"hibernate":1085.96,"mybatis":1348.1,"spring":1399.06},"insertPs":{"rexdb":1270.9,"jdbc":1421.89,"hibernate":1091.23,"mybatis":1331.61,"spring":1342.77},"batchInsert":{"rexdb":11580.2,"jdbc":11646.95,"hibernate":11838.87,"mybatis":11463.4,"spring":11667.4},"batchInsertPs":{"rexdb":11260.95,"jdbc":11807.49,"hibernate":11381.07,"mybatis":11510.17,"spring":11410.67},"getList":{"rexdb":12500.35,"jdbc":12506.09,"hibernate":9540.53,"mybatis":9516.08,"spring":12819.5},"getList-disableDynamicClass":{"rexdb":12437.93,"jdbc":12609.59,"hibernate":9562.16,"mybatis":9574.88,"spring":12864.76},"getMapList":{"rexdb":12515.32,"jdbc":12497.51,"hibernate":9789.65,"mybatis":9593.13,"spring":12611.92}}

testResults.dm={"insert":{"rexdb":3239,"jdbc":3403.58,"hibernate":1931.16,"mybatis":2984.45,"spring":3216.44},"insertPs":{"rexdb":3274.79,"jdbc":3409.39,"hibernate":1918.16,"mybatis":3012.15,"spring":3193.03},"batchInsert":{"rexdb":45035.36,"jdbc":49682.26,"hibernate":32432.28,"mybatis":38393.05,"spring":42591.08},"batchInsertPs":{"rexdb":42662.77,"jdbc":46739.14,"hibernate":34427.21,"mybatis":36025.34,"spring":42752.61},"getList":{"rexdb":106029.38,"jdbc":108056.05,"hibernate":61527.59,"mybatis":67130.34,"spring":80781.9},"getList-disableDynamicClass":{"rexdb":88735.85,"jdbc":108722.72,"hibernate":61541,"mybatis":66941.41,"spring":78347.69},"getMapList":{"rexdb":77752.61,"jdbc":102094.33,"hibernate":66942.83,"mybatis":66276.26,"spring":50808.02}}
testResults.kingbase={"insert":{"rexdb":491.39,"jdbc":496.80,"hibernate":430.50,"mybatis":461.61,"spring":469.61},"insertPs":{"rexdb":498.14,"jdbc":505.55,"hibernate":441.94,"mybatis":479.08,"spring":473.06},"batchInsert":{"rexdb":1068.27,"jdbc":1071.84,"hibernate":954.93,"mybatis":969.06,"spring":1003.06},"batchInsertPs":{"rexdb":1076.4,"jdbc":1088.67,"hibernate":999.76,"mybatis":971.21,"spring":1034.89},"getList":{"rexdb":10674.11,"jdbc":11095.31,"hibernate":16541.74,"mybatis":10844.78,"spring":11875.59},"getList-disableDynamicClass":{"rexdb":10898.72,"jdbc":11399.25,"hibernate":16639.02,"mybatis":10934.59,"spring":12038.49},"getMapList":{"rexdb":10921.59,"jdbc":11298.71,"hibernate":17138.43,"mybatis":10894.75,"spring":11840.07}}
testResults.oscar={"insert":{"rexdb":830.96,"jdbc":848.27,"hibernate":842.47,"mybatis":1076.53,"spring":870.67},"insertPs":{"rexdb":852.28,"jdbc":861.99,"hibernate":858.82,"mybatis":1079.95,"spring":861.89},"batchInsert":{"rexdb":74906.46,"jdbc":103307.35,"hibernate":68141.62,"mybatis":74533.71,"spring":101555.84},"batchInsertPs":{"rexdb":84255.81,"jdbc":87474.76,"hibernate":57157.28,"mybatis":59640.81,"spring":81990.92},"getList":{"rexdb":32782.35,"jdbc":32707.47,"hibernate":28796.64,"mybatis":32177.05,"spring":33625.36},"getList-disableDynamicClass":{"rexdb":32214.42,"jdbc":33133.41,"hibernate":28545.87,"mybatis":31932.29,"spring":33476.23},"getMapList":{"rexdb":32422.54,"jdbc":32321.29,"hibernate":31334.83,"mybatis":31737.07,"spring":31726.87}};

testResults.pi2={"insert":{"rexdb":165.16,"jdbc":170.03,"hibernate":87.66,"mybatis":150.61,"spring":159.18},"insertPs":{"rexdb":182.97,"jdbc":187.05,"hibernate":107.69,"mybatis":165.2,"spring":176.25},"batchInsert":{"rexdb":2859.15,"jdbc":2991.79,"hibernate":1499.52,"mybatis":2232.62,"spring":2755.76},"batchInsertPs":{"rexdb":2913.28,"jdbc":2994.05,"hibernate":1582.05,"mybatis":2239.99,"spring":2702.41},"getList":{"rexdb":76656.75,"jdbc":66126.11,"hibernate":39421.95,"mybatis":39851.63,"spring":72625.1},"getList-disableDynamicClass":{"rexdb":59875.66,"jdbc":71908.24,"hibernate":38725.8,"mybatis":41685.47,"spring":71690.88},"getMapList":{"rexdb":69435.58,"jdbc":64430.72,"hibernate":52766.69,"mybatis":41661.61,"spring":51926.15}}

var tips = [];
tips.h2 = "rexdb-1.0.0 尚未对<b>H2</b>数据库中的CLOB字段进行优化处理，在查询时具有超出预期的性能损耗（其它类型的字段不受影响），将在后续版本中改进。";


//==============================theme
function getDefaultTheme(){
	return {
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
		colors : [ "#0b62a4", "#2c3e50", "#95a5a6", "#b3b3b3", "#d3d3d3" ],
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
						color :'#fff',
						fontWeight : 'normal',
						fontFamily : 'Arial'
					}
				}
			}
		}
	};
}

function getIndexTheme(){
	return $.extend({}, getDefaultTheme(), {
			colors : [ "#0b62a4", "#95a5a6", "#b3b3b3", "#d3d3d3" ],
			plotOptions : {
				series: {
	                dataLabels: {
	                	y : 30,
	                	rotation: -270,
	                    style: {
							color : '#fff',
							fontWeight : 'normal',
							fontFamily : 'Arial',
							fontSize : '10px'
	                    }
	                }
	            }
			},
		}
	);
}

Highcharts.theme = location.href.indexOf('performance') == -1 ? getIndexTheme() : getDefaultTheme();

var overviewPerformace, overviewCode, getListDynamic, getListReflect, getMapList, insert, insertPs, batch, batchPs;
var piGetList, piInsert;
var result;

//init graphics
function initPerformaceGraphics(){
	$('#showall').click(showAll);
	$('input[name=framework]').change(function(){
		refreshChart(this);
	})
	$('input[name=database]').change(function(){
		var chk = this;
		$(this).parent().after('<span id="loading" class="label label-info glyphicon glyphicon-refresh" style="margin-left: 3px; display: inline;"></span>');
		setTimeout(function(){reloadDatabase(chk)}, 10);
	})
	
	result = testResults['mysql'];
	renderAllCharts();
	showTip();
}

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
	if(show)
		$(chk).parent().addClass('b');
	else
		$(chk).parent().removeClass('b');
	
	var idx = {
		rexdb: 0,
		jdbc: 1,
		hibernate: 2,
		mybatis: 3,
		spring: 4
	};
	var charts = [overviewPerformace, overviewCode, getListDynamic, getListReflect, getMapList, insert, insertPs, batch, batchPs];
	
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
	
	$('input[name=database]').parent().removeClass('b');
	$('#'+rdo.value).parent().addClass('b');
	
	renderAllCharts();
	showTip();
	
	$('#loading').remove();
}

Highcharts.setOptions(Highcharts.theme);

function compare(a, b, c){
	if(c == null) c = 1;
	
	if(a == 0)
		return '';
	var com = ((a - b)*100/b).toFixed(c);
	if(com < 0)
		return '- ' + (com.substr(1)) + '%';
	else if(com > 0)
		return '+ ' + com + '%';
	else
		return '0%';
}

function genSeries(data){
	//show graphics
	var showHibernate=$('#hibernate:checked').length > 0;
	var showMybatis=$('#mybatis:checked').length > 0;
	var showSpring=$('#spring:checked').length > 0;
	
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
		visible: showHibernate,
		data : [ data.hibernate],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.hibernate, data.rexdb);
            }
        }
	}, {
		name : 'Mybatis',
		visible: showMybatis,
		data : [ data.mybatis],
		dataLabels: {
            enabled: true,
            formatter: function(){
            	return compare(data.mybatis, data.rexdb);
            }
        }
	}, {
		name : 'Spring',
		visible: showSpring,
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
        zIndex: 4,
        value: data.rexdb
	}];
}

function showTip(){
	//show tips
	var db = $('input[name=database]:checked').val();
	if(db != null && tips[db] != null){
		$('#tip-tip').html(tips[db]);
		$('#tip').show();
	}else{
		$('#tip-tip').empty();
		$('#tip').hide();
	}
}

function renderAllCharts(){
	
	//show graphics
	var showHibernate=$('#hibernate:checked').length > 0;
	var showMybatis=$('#mybatis:checked').length > 0;
	var showSpring=$('#spring:checked').length > 0;
	
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
			title: {
				text: '每秒查询记录数'
			}
		},
		title : {
			text : '查询性能总览'
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
			visible: showHibernate,
			data : [ result["getList"].hibernate, result["getMapList"].hibernate]
		}, {
			name : 'Mybatis',
			visible: showMybatis,
			data : [ result["getList"].mybatis, result["getMapList"].mybatis]
		}, {
			name : 'Spring',
			visible: showSpring,
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
			text : '更新性能总览'
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
			visible: showHibernate,
			data : [ result["insert"].hibernate, result["batchInsert"].hibernate/100]
		}, {
			name : 'Mybatis',
			visible: showMybatis,
			data : [ result["insert"].mybatis, result["batchInsert"].mybatis/100]
		}, {
			name : 'Spring',
			visible: showSpring,
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
}


//=================================================index.php
function initIndexGraphics(){
	new Highcharts.Chart({
		chart : {
			renderTo : 'performance',
			type : 'column',
			marginTop : 45,
			marginLeft: 30,
			marginBottom: 35,
			options3d : {
				enabled : true,
				alpha : 0,
				beta : 20,
				depth : 60,
				viewDistance : 50
			}
		},
		xAxis: {
			categories: ['查询Java对象', '查询Map']
		},
		yAxis: {
			labels: {
				x: -3,
				style:{
					fontSize: '8px'
				}
			},
			title: {
				offset: 30,
				text: null,
				style:{
					fontSize: '10px'
				}
			}
		},
		title : {
			text : null
		},
		subtitle: {
			text: '<b>每秒查询记录数</b> - Mysql 5.7',
			align: 'left',
			style: {
//				fontWeight: 'bolder'
			}
		},
		plotOptions : {
			column : {
				depth : 30
			}
		},
		legend : {
			verticalAlign: 'top',
			align: 'right',
			itemMarginBottom: -5,
			itemDistance: 8,
			itemStyle: { 
				fontWeight: 'normal',
				fontSize: '10px',
				color: '#777',
				fontFamily : 'Arial'
			}
		},
		series : [ {
			name : 'Rexdb 1.0.0',
			data : [ testResults.mysql["getList"].rexdb, testResults.mysql["getMapList"].rexdb],
			dataLabels: {
	            enabled: true,
	            formatter: function(){
            		return 'Rexdb';
	            },
	        }
		}, {
			name : 'Hibernate 5.1.0',
			data : [ testResults.mysql["getList"].hibernate, testResults.mysql["getMapList"].hibernate],
			dataLabels: {
	            enabled: true,
	            formatter: function(){
	            	if(this.x.indexOf('Java') != -1)
	            		return compare(testResults.mysql["getList"].hibernate, testResults.mysql["getList"].rexdb, 0);
	            	else
	            		return compare(testResults.mysql["getMapList"].hibernate, testResults.mysql["getMapList"].rexdb, 0);
	            },
	        }
		}, {
			name : 'Mybatis 3.3.1',
			data : [ testResults.mysql["getList"].mybatis, testResults.mysql["getMapList"].mybatis],
			dataLabels: {
	            enabled: true,
	            formatter: function(){
	            	if(this.x.indexOf('Java') != -1)
	            		return compare(testResults.mysql["getList"].mybatis, testResults.mysql["getList"].rexdb, 0);
	            	else
	            		return compare(testResults.mysql["getMapList"].mybatis, testResults.mysql["getMapList"].rexdb, 0);
	            },
	        }
		}, {
			name : 'Spring 4.2.5',
			data : [ testResults.mysql["getList"].spring, testResults.mysql["getMapList"].spring],
			dataLabels: {
	            enabled: true,
	            formatter: function(){
	            	if(this.x.indexOf('Java') != -1)
	            		return compare(testResults.mysql["getList"].spring, testResults.mysql["getList"].rexdb, 0);
	            	else
	            		return compare(testResults.mysql["getMapList"].spring, testResults.mysql["getMapList"].rexdb, 0);
	            },
	        }
		}]
	});
}


//=================================================feedback.php
$(document).ready(function(){
	$('#submit-bug').click(function(){
		if(validateBug()){
//			$('#submit-bug').popover({
//				html: true,
//				title: '请输入图片验证码',
//				container: 'body',
//				placement: 'left',
//				trigger: 'manual',
//				content: $('#code').html()
//			}).popover('show');
//			
//			$(this).attr('disabled', true);
		}
		 
		return false;
	});
});

function validateBug() {
    return $('#bugForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            system: {
                validators: {
                    notEmpty: {
                        message: '请选择操作系统'
                    }
                }
            },
            database: {
                validators: {
                    notEmpty: {
                        message: '请选择数据库'
                    }
                }
            },
            jdk: {
                validators: {
                    notEmpty: {
                        message: '请选择JDK版本'
                    }
                }
            },
            detail: {
                validators: {
                    notEmpty: {
                        message: '请填写问题描述'
                    },
                    stringLength: {
                        min: 6,
                        max: 6000,
                        message: '需要录入6到6000个字符'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'The username can only consist of alphabetical, number, dot and underscore'
                    }
                }
            }
        }
    });
}