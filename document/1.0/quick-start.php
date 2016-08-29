<h1><div id="user-content-top">快速入门</div></h1>

<p>本文档用于快速了解Rexdb的使用方法，适合大部分的Java编程人员阅读。</p>

<h2><div id="user-content-environment">开发/运行运行环境</div></h2>

<p>Rexdb需要如下运行环境：  </p>

<ul>
<li><strong>JDK 5.0及以上版本</strong></li>
</ul>

<p>在开始前，请检查环境变量中的如下jar包：</p>

<ul>
<li><strong>JDBC驱动</strong></li>
<li><strong>rexdb-1.0.0.jar（或其它版本）</strong></li>
<li>javassist-3.20.0-GA.jar（可选）</li>
<li>logger4j/logger4j2/slf4j（可选其一，也可以都不使用）</li>
<li>dbcp/C3P0/BoneCP等（可选其一，也可以都不使用）</li>
</ul>

<h2><div id="user-content-config">全局配置 <em>rexdb.xml</em>
</div></h2>

<p>Rexdb依赖全局配置文件<strong>rexdb.xml</strong>，用于配置数据源、日志、异常信息语言等。该文件默认存放于classpath环境变量中（例如，在Java EE应用中，应将其放置于<strong>WEB-INF/classes</strong>目录中）。</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    <span class="pl-c">&lt;!-- 默认数据源，Oracle数据库，使用框架内置的连接池 --&gt;</span>
    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>oracle.jdbc.driver.OracleDriver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:oracle:thin:@127.0.0.1:1521:rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
    <span class="pl-c">&lt;!-- student数据源，Mysql数据库，使用了Apache DBCP连接池 --&gt;</span>
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">id</span>=<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>org.apache.commons.dbcp.BasicDataSource<span class="pl-pds">"</span></span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbcUrl<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://127.0.0.1:3306/rexdb?characterEncoding=utf8<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>更多选项请参考Rexdb用户手册。</p>

<h2><div id="user-content-get">查询单条记录 <em>DB.get()</em>
</div></h2>

<p><code>org.rex.DB.get()</code>方法用于查询单条记录，并返回指定的java对象实例（无记录时返回null），格式如下：</p>

<blockquote>
<p><strong>T DB.get([String dataSourceId,] String sql, [Object[] | org.rex.db.Ps | Map | Object parameter,] Class clazz)</strong></p>
</blockquote>

<ul>
<li>dataSourceId：可选，配置文件中的数据源id，不设置时使用默认数据源；</li>
<li>sql：必填，待执行的SQL语句；</li>
<li>parameter：可选，执行SQL时的预编译参数。根据该参数的类型不同，SQL中使用<code>?</code>或者<code>#{}</code>标记预编译参数；</li>
<li>class：必填，需要转换的结果集类型。</li>
</ul>

<p>例1：执行SQL，并获取结果</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班' and num=1<span class="pl-pds">"</span></span>, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数，例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=? and num=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>}, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);
<span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=? and num=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>), <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数，例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//map为java.util.Map类型的实例，包含名为“clazz”和“num”的键；obj为普通的java对象，包含名为“clazz”和“num”的成员变量</span>
<span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz} and num=#{num}<span class="pl-pds">"</span></span>, map, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);
<span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz} and num=#{num}<span class="pl-pds">"</span></span>, obj, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例4：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//配置文件rexdb.xml中有id为student的数据源</span>
<span class="pl-smi">Student</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班' and num=1<span class="pl-pds">"</span></span>, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<h2><div id="user-content-getMap">查询单条Map记录 <em>DB.getMap()</em>
</div></h2>

<p><code>org.rex.DB.get()</code>方法用于查询单条记录，并返回一个org.rex.RMap实例（无记录时返回null），org.rex.RMap是java.util.HashMap的子类，提供了数据类型转换等功能。格式如下：</p>

<blockquote>
<p><strong>RMap DB.getMap([String dataSourceId,] String sql, [Object[] | Ps | Map | Object parameter])</strong></p>
</blockquote>

<ul>
<li>dataSourceId：可选，配置文件中的数据源id，不设置时使用默认数据源；</li>
<li>sql：必填，待执行的SQL语句；</li>
<li>parameter：可选，执行SQL时的预编译参数。根据该参数的类型不同，SQL中使用<code>?</code>或者<code>#{}</code>标记预编译参数。</li>
</ul>

<p>例1：执行SQL，并获取结果</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班' and num=1<span class="pl-pds">"</span></span>);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=? and num=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>});
<span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=? and num=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>));</pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//map为java.util.Map类型的实例，包含名为“class”和“num”的键；obj为普通的java对象，包含名为“clazz”和“num”的成员变量</span>
<span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz} and num=#{num}<span class="pl-pds">"</span></span>, map);
<span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz} and num=#{num}<span class="pl-pds">"</span></span>, obj);</pre></div>

<p>例4：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//配置文件rexdb.xml中有id为student的数据源</span>
<span class="pl-smi">RMap</span> stu <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班' and num=1<span class="pl-pds">"</span></span>);</pre></div>

<h2><div id="user-content-getList">查询多条记录 <em>DB.getList()</em>
</div></h2>

<p><code>org.rex.DB.getList()</code>方法用于查询多条记录，并返回一个java.util.List实例（无记录时返回空的List实例）。格式如下：</p>

<blockquote>
<p><strong>List DB.getList([String dataSourceId,] String sql, [Object[] | Ps | Map | Object parameter,] Class clazz [, int offset, int rows])</strong></p>
</blockquote>

<ul>
<li>dataSourceId：可选，配置文件中的数据源id，不设置时使用默认数据源；</li>
<li>sql：必填，待执行的SQL语句；</li>
<li>parameter：可选，执行SQL时的预编译参数。根据该参数的类型不同，SQL中使用<code>?</code>或者<code>#{}</code>标记预编译参数。</li>
<li>class：必填，需要转换的结果集类型；</li>
<li>offset：可选，分页查询的起始行号；</li>
<li>rows：可选，分页查询待获取的结果集条目。</li>
</ul>

<p>例1：执行SQL，并获取结果</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>}, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);
<span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>), <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//map为java.util.Map类型的实例，包含名为“class”的键；obj为普通的java对象，包含名为“clazz”的成员变量</span>
<span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz}<span class="pl-pds">"</span></span>, map, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);
<span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz}<span class="pl-pds">"</span></span>, obj, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<p>例4：执行分页查询，查询第100～110条记录</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>, <span class="pl-smi">Student</span><span class="pl-k">.</span>class, <span class="pl-c1">100</span>, <span class="pl-c1">10</span>);</pre></div>

<p>例5：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//配置文件rexdb.xml中有id为student的数据源</span>
<span class="pl-k">List&lt;<span class="pl-smi">Student</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>, <span class="pl-smi">Student</span><span class="pl-k">.</span>class);</pre></div>

<h2><div id="user-content-getMapList">查询多条Map记录 <em>DB.getMapList()</em>
</div></h2>

<p><code>org.rex.DB.getMapList()</code>方法用于查询多条记录，并返回一个java.util.List实例（无记录时返回空的List实例）。格式如下：</p>

<blockquote>
<p><strong>List DB.getList([String dataSourceId,] String sql, [Object[] | Ps | Map | Object parameter] [, int offset, int rows])</strong></p>
</blockquote>

<ul>
<li>dataSourceId：可选，配置文件中的数据源id，不设置时使用默认数据源；</li>
<li>sql：必填，待执行的SQL语句；</li>
<li>parameter：可选，执行SQL时的预编译参数。根据该参数的类型不同，SQL中使用<code>?</code>或者<code>#{}</code>标记预编译参数。</li>
<li>offset：可选，分页查询的起始行号；</li>
<li>rows：可选，分页查询待获取的结果集条目。</li>
</ul>

<p>例1：执行SQL，并获取结果</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>});
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=?<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>));</pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//map为java.util.Map类型的实例，包含名为“class”的键；obj为普通的java对象，包含名为“clazz”的成员变量</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz}<span class="pl-pds">"</span></span>, map);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class=#{clazz}<span class="pl-pds">"</span></span>, obj);</pre></div>

<p>例4：执行分页查询，查询第100～110条记录</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>, <span class="pl-c1">100</span>, <span class="pl-c1">10</span>);</pre></div>

<p>例5：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//配置文件rexdb.xml中有id为student的数据源</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>select * from t_student where class='3年1班'<span class="pl-pds">"</span></span>);</pre></div>

<h2><div id="user-content-update">插入/更新/删除 <em>DB.update()</em>
</div></h2>

<p><code>org.rex.DB.update()</code>方法用于执行插入/更新/删除操作，该接口将返回受影响的记录条数。格式如下：</p>

<blockquote>
<p><strong>int DB.update([String dataSourceId,] String sql [, Object[] | Ps | Map | Object parameter])</strong></p>
</blockquote>

<p>例1：执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>update(<span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num = 1<span class="pl-pds">"</span></span>);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre>string sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>insert into t_student(num, student_name, student_class,create_time) values (?, ?, ?, ?)<span class="pl-pds">"</span></span>;
<span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>钟小强<span class="pl-pds">"</span></span>,<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()});
<span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">2</span>, <span class="pl-s"><span class="pl-pds">"</span>王小五<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>,<span class="pl-k">new</span> <span class="pl-smi">Date</span>()));</pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>update t_student set student_name = #{studentName} where num = #{num}<span class="pl-pds">"</span></span>;
<span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql,map);<span class="pl-c">//map为java.util.Map类型的实例，包含名为“studentName”和“num”的键</span>
<span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql,<span class="pl-k">new</span> <span class="pl-smi">Students</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>钟小强<span class="pl-pds">"</span></span>, <span class="pl-c1">null</span>, <span class="pl-c1">null</span>));<span class="pl-c">//obj为普通的java对象，包含名为“studentName”和“num”的成员变量</span></pre></div>

<p>例4：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c">//配置文件rexdb.xml中有id为student的数据源</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num = 1<span class="pl-pds">"</span></span>);</pre></div>

<h2><div id="user-content-batchUpdate">批量处理 <em>DB.batchUpdate()</em>
</div></h2>

<p><code>DB.batchUpdate()</code>方法用于执行批处理操作，该接口可以有效提升执行大量数据变更时的执行性能，格式如下：</p>

<blockquote>
<p><strong>int[] DB.batchUpdate([String datasource,] String[] sqls)</strong></p>
</blockquote>

<p>例1：执行多个SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">String</span>[] sqls <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">String</span>[]{<span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num=1<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num=2<span class="pl-pds">"</span></span>};
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sqls);</pre></div>

<p>例2：执行带有预编译参数的SQL，当parameter参数元素类型为<code>Object数组</code>、<code>org.rex.db.Ps</code>时，SQL中使用<code>?</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre>string sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>insert into t_student(num, student_name, student_class,create_time) values (?, ?, ?, ?)<span class="pl-pds">"</span></span>;
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[][]{{<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>钟小强<span class="pl-pds">"</span></span>,<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()}, {<span class="pl-c1">2</span>, <span class="pl-s"><span class="pl-pds">"</span>王小五<span class="pl-pds">"</span></span>,<span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()}});
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>[]{<span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">3</span>, <span class="pl-s"><span class="pl-pds">"</span>李小华<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()), <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">4</span>, <span class="pl-s"><span class="pl-pds">"</span>赵小明<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>3年1班<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>())});  </pre></div>

<p>例3：执行带有预编译参数的SQL，当parameter参数元素类型为<code>java.util.Map</code>、<code>Java对象</code>时，SQL中使用<code>#{}</code>标记预编译参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>update t_student set student_name = #{studentName} where num = #{num}<span class="pl-pds">"</span></span>;
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, maps);<span class="pl-c">//maps为java.util.Map数组实例，数组中每个元素都包含名为“studentName”和“num”的键</span>
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, objs);<span class="pl-c">//objs为Student类型的java对象实例数组，Student对象包含名为“studentName”和“num”的成员变量</span></pre></div>

<p>例4：在指定数据源中执行SQL</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">String</span>[] sqls <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">String</span>[]{<span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num=1<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num=2<span class="pl-pds">"</span></span>};
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(<span class="pl-s"><span class="pl-pds">"</span>student<span class="pl-pds">"</span></span>, sqls);    </pre></div>

<h2><div id="user-content-transaction">事务</div></h2>

<p>Rexdb使用编程的方式处理事务，以下接口用于事务处理：</p>

<blockquote>
<p><strong>void DB.beginTransaction([String dataSourceId] [,DefaultDefinition definition])</strong> //开启事物<br>
<strong>void DB.commit([String dataSourceId])</strong> //提交事务<br>
<strong>void DB.rollback([String dataSourceId])</strong> //回滚事务</p>
</blockquote>

<p>JTA事物接口如下：</p>

<blockquote>
<p><strong>void DB.beginJta([DefaultDefinition definition])</strong> //开启JTA事物<br>
<strong>void DB.commitJta()</strong> //提交JTA事务<br>
<strong>void DB.rollbackJta()</strong> //回滚JTA事务</p>
</blockquote>

<p>例：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>beginTransaction();
<span class="pl-k">try</span>{
    <span class="pl-c1">DB</span><span class="pl-k">.</span>update(<span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num = 1<span class="pl-pds">"</span></span>);
    <span class="pl-c1">DB</span><span class="pl-k">.</span>update(<span class="pl-s"><span class="pl-pds">"</span>delete from t_student where num = 2<span class="pl-pds">"</span></span>);
    <span class="pl-c1">DB</span><span class="pl-k">.</span>commit();
}<span class="pl-k">catch</span>(<span class="pl-smi">Exception</span> e){
    <span class="pl-c1">DB</span><span class="pl-k">.</span>rollback();
}</pre></div>

<h2><div id="user-content-call">调用</div></h2>

<p><code>DB.call()</code>方法用于执行调用操作，可用于调用存储过程和函数，支持返输入、输出参数和返回值。格式如下：</p>

<blockquote>
<p><strong>RMap DB.call([String dataSourceId,] String sql [, Object[] | Ps | Map | Object parameter])</strong></p>
</blockquote>

<p>例1：调用存储过程/函数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>test_proc()<span class="pl-pds">"</span></span>);</pre></div>

<p>例2：调用有输入参数的存储过程/函数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call test_proc_in(?)<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">200</span>));</pre></div>

<p>例3：调用有输出参数的存储过程/函数时，必须使用org.rex.db.Ps对象声明输出参数</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>();
ps<span class="pl-k">.</span>addOutInt(<span class="pl-s"><span class="pl-pds">"</span>age<span class="pl-pds">"</span></span>);
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call test_proc_out(?)}<span class="pl-pds">"</span></span>, ps);
<span class="pl-k">int</span> age <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>age<span class="pl-pds">"</span></span>)</pre></div>

<p>例4：调用同时有输入输出参数的存储过程/函数，必须使用org.rex.db.Ps对象，并按照SQL中标记的顺序声明</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>();
ps<span class="pl-k">.</span>add(<span class="pl-c1">200</span>);
ps<span class="pl-k">.</span>addOutInt(<span class="pl-s"><span class="pl-pds">"</span>major<span class="pl-pds">"</span></span>);
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call test_proc_in_out(?, ?)}<span class="pl-pds">"</span></span>, ps);
<span class="pl-k">int</span> major <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>major<span class="pl-pds">"</span></span>);</pre></div>

<p>例5：调用即是输入参数也是输出参数的存储过程/函数，必须使用org.rex.db.Ps对象</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>();
ps<span class="pl-k">.</span>addInOut(<span class="pl-s"><span class="pl-pds">"</span>count<span class="pl-pds">"</span></span>, <span class="pl-c1">10</span>);
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call test_proc_inout(?)}<span class="pl-pds">"</span></span>, ps);
<span class="pl-k">int</span> count <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>count<span class="pl-pds">"</span></span>);</pre></div>

<p>例6：调用带有返回值的存储过程/函数，返回值将按照return_1、return_2的顺序命名</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call exdb_test_proc_return()}<span class="pl-pds">"</span></span>);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> return1 <span class="pl-k">=</span> result<span class="pl-k">.</span>getList(<span class="pl-s"><span class="pl-pds">"</span>return_1<span class="pl-pds">"</span></span>);</pre></div>

<p>关于调用的其它用法请参见用户手册。</p>

<h2><div id="user-content-more">更多</div></h2>

<p>Rexdb还有更多功能，例如：</p>

<ul>
<li>设置异常信息为中文/英文；</li>
<li>开启/关闭日志；</li>
<li>执行SQL前的语法检查；</li>
<li>自动检查连接/状态中的警告；</li>
<li>设置查询超时时间；</li>
<li>设置事物超时时间/隔离级别/自动回滚/自动的批处理事务；</li>
<li>启动动态字节码编译/反射缓存；</li>
<li>自动转换日期类型的参数；</li>
</ul>

<p>详情请参见用户手册。</p>
