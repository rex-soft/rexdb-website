
<h1>用户手册 - Rexdb性能测试程序</h1>

<h2><div id="user-content-intro">简介</div></h2>

<p>本程序用于Rexdb在开发/生产环境中的运行效率，同时，也测试了JDBC直接接口调用和其它主流ORM框架的性能，以便为开发者提供一个全方位的性能参考。参与测试的框架包括：</p>

<ul>
<li>Rexdb</li>
<li>JDBC接口直接调用</li>
<li>Hibernate</li>
<li>Mybatis</li>
<li>Spring JDBC</li>
</ul>

<p>各框架均使用了较新的正式版本，所有参与测试的框架均使用dbcp作为连接池。除此之外，本程序还集成了主流数据库的驱动，包括：</p>

<ul>
<li>oracle</li>
<li>mysql</li>
<li>SQL Server</li>
<li>DB2</li>
<li>postgresql</li>
<li>derby</li>
<li>h2</li>
<li>hsqldb</li>
<li>kingbase</li>
<li>oscar</li>
<li>dm</li>
</ul>

<h2><div id="user-content-how">如何使用</div></h2>

<p>本程序已经集成了大部分数据库驱动和运行所需的Jar包，修改配置后直接使用即可。</p>

<ol>
<li>将本程序拷贝至待测试的系统，并确保系统已经安装了JDK 6.0及以上版本，并且可以连接数据库</li>
<li>修改/conf/conn.properties，启用并修改相应数据库的配置</li>
<li>运行/bin/run.bat（Windows系统），或者/bin/run.sh（Linux系统），耐心等待执行完成</li>
</ol>

<div class="highlight highlight-source-shell"><pre>run.bat <span class="pl-c">#Windows</span>
./run.sh <span class="pl-c">#Linux</span></pre></div>

<h2><div id="user-content-conf">优化设置</div></h2>

<p>在测试性能时，程序会反复执行重复同一操作，直到最终计算平均耗时。理论上，重复执行次数越多，测试数据越准确，但耗时也越长。在run.bat/run.sh文件中，执行了以下命令：</p>

<pre><code>java -classpath ../conf -Djava.ext.dirs=../lib org.rex.db.test.RunAllTests speed=10 loop=30
</code></pre>

<p>您可以自行编辑该文件，修改以下的两项参数，以获取速度和误差之间的平衡：</p>

<ul>
<li>speed：执行速度，默认是10。值越大，每次测试中使用的数据量越小，误差越大</li>
<li>loop：循环次数，默认是30。值越大，每个测试项目的循环次数越多，误差越小</li>
</ul>

<h2><div id="user-content-project">测试项目</div></h2>

<p>本程序测试了以下操作的性能：</p>

<ul>
<li>更新</li>
<li>批处理</li>
<li>查询Java对象</li>
<li>查询Map对象</li>
</ul>

<p>在测试时，测试程序可能会分别将不同的设置应用到同一测试项目。例如，测试更新时，程序分别测试了Java对象和org.rex.db.Ps对象做为参数时的性能；测试查询Java对象时，又分别测试了启用和禁用动态字节码参数时的性能。</p>

<h2><div id="user-content-flow">测试流程</div></h2>

<p>本程序的测试流程如下：</p>

<ol>
<li>连接数据库，创建测试需要的表（部分数据库还会创建存储过程）</li>
<li>测试Rexdb的各接口是否可用（部分数据库会测试调用接口）</li>
<li>测试各框架是否可用</li>
<li>执行性能测试</li>
<li>输出结果</li>
</ol>
