<!DOCTYPE html>
<html>
<head>
<title>性能 - Rexdb</title>
<?
include_once('include/import.php'); 
?>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/highcharts-3d.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/highcharts-4.2.3/modules/exporting.js"></script>
<script type="text/javascript" src="<?=$basePath?>style/performance.js"></script>
<style>
p {
	font-size: 16px;
}

blockquote {
	font-size: 15.5px;
}

li {
	list-style-type: disc;
}
</style>
</head>
<body>
<? 
$activeMenu = 'performance';
include_once('include/navbar.php'); 
?>

<div class="container top-div">

		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-12">
				<h3>性能测试</h3>
				<p>我们执行了一系列性能检测，并且与同类框架进行了多方面的比较。</p>
			</div>
		</div>
		
		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-6">
				<div id="overview-performace" style="height: 350px"></div>
			</div>
			<div class="col-md-6">
				<div id="overview-code" style="height: 350px"></div>
			</div>
			<div class="col-md-12 text-right">
			* 根据软硬件环境的不同，您的测试结果可能与图示有所不同
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<h3>查询性能</h3>
				<p>查询性能取决于多方面因素，包括需要读取的字段数量、映射对象类型、是否启用了优化选项等，我们按照映射对象类型分别进行了测试。</p>
			</div>
			<div class="col-md-6">
				<h4>查询为对象</h4>
				<p>
					查询为指定对象时，配置中的“动态字节码”选项对性能影响最为明显，启用后可以大幅提升查询性能。
				</p>
				
				<div id="getlist-dynamic" style="height: 300px"></div>
			</div>
			<div class="col-md-6">
				<h4>查询为Map</h4>
				<p>
					当您认为Rexdb需要改进时，包括功能、性能、接口设计等方面，可以向我们提出改进建议。
					例如，您可以提出类似以下建议：
				</p>
				<ul>
					<li><p>建议为批量更新接口增加分批提交功能，并在全局选项中增加一个“每n条数据提交一次”的选项；</p></li>
					<li><p>建议增加监听框架初始化和销毁的监听接口；</p></li>
				</ul>
				<p>在制定下一版本的升级计划时，我们通常会对收到的建议进行评估。</p>
			</div>
		</div>

		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-12">
				<h3>反馈表单</h3>
				<p>请填写下面的反馈表，并点击“提交表单”按钮发送给我们。如果您留下了称谓和邮箱，我们可能还会向您发送邮件。</p>
			</div>
			<div class="col-md-10 col-md-push-1">
				<form accept-charset="UTF-8" action="/partners/contact" method="post">
					<div class="row">
						<div class="col-md-7">
							<div class="form-group">
								<textarea class="form-control" cols="40" name="message"
									placeholder="请尽量详细描述您发现的BUG，或者您希望Rexdb作出的改进"
									rows="8"></textarea>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<input class="form-control" id="msg_name" name="name" placeholder="您的称谓" size="30" type="text" />
							</div>
							<div class="form-group">
								<input class="form-control" id="msg_email" name="email" placeholder="您的邮箱" size="30" type="text" />
							</div>
							<div class="form-group">
								<input class="form-control pull-left" id="msg_val" name="validate" placeholder="验证码" size="4" type="text" style="width: auto;"/>
								<button class="btn btn-cta btn-default pull-right" name="button" type="submit">提交表单</button>
							</div>
						</div>
					</div>
				</form>

			</div>

		</div>

		<div class="row" style="margin-top: 20px;">
			<div class="col-md-12">
				<h3>处理流程</h3>
				<p>我们会认真阅读每一份反馈表单，但碍于资源有限，我们可能不会向您发送处理进度和结果信息。</p>
			</div>
			<div class="col-md-12 text-center" style="margin-top: 30px">
				<img alt="反馈流程" src="style/images/feedback-workflow.png">
			</div>
		</div>
	</div>

<? include_once('include/footer.php'); ?>
</body>
</html>
