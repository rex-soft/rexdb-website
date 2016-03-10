<!DOCTYPE html>
<html>
<head>
<title>反馈 - Rexdb</title>
<?
include_once('include/import.php'); 
?>
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
$activeMenu = 'feedback';
include_once('include/navbar.php'); 
?>

<div class="container top-div">

		<div class="row" style="margin-top: 20px; margin-bottom: 20px">
			<div class="col-md-12">
				<h3>感谢您的支持</h3>
				<p>Rexdb是一个免费、开源的项目，只能提供有限的技术支持；但同时也是一个长期维护的项目，我们希望搜集更多的意见，并使其更加完善。</p>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-6">
				<h3>发现BUG</h3>
				<p>
					如果您在开发和生产环境中发现了BUG。包括轻微的和严重的、确认和怀疑的、频繁和偶尔发生的问题，都可以向我们反馈。
					我们通常会在修复一定数量的错误后，集中发布一个升级版本。
					但如果问题严重，例如发现了安全漏洞、影响整体系统稳定性的错误等，也会立刻进行一次版本升级。
				</p>
				<p>
					在反馈BUG时，请尽量搜集足够的信息，以便于我们确认问题，这些信息包括：
				</p>
				<ul>
					<li>
						<p>运行环境：个别情况下，我们需要获知操作系统、数据库版本、JDK版本、Java EE中间件、其它开源软件等信息。</p>
					</li>
					<li>
						<p>程序代码：调用Rexdb的代码片段。</p>
					</li>
					<li>
						<p>异常堆栈：通常情况下，您需要提供完整的异常堆栈信息。
							在提交表单前请对异常栈进行检查，确保与Rexdb相关。
							例如，在使用Struts2并且出错时，网页中显示的异常可能只有Struts2的栈，如果您只将这些信息发送给我们，将无助于定位异常。</p>
					</li>
				</ul>
				
				<p>
					我们注意到，在接收到的反馈中，有相当一部分是因运行环境中的其它框架、或程序逻辑而导致的异常，我们不会对这类问题进行处理和反馈。
				</p>
			</div>
			<div class="col-md-6">
				<h3>改进建议</h3>
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
