
<h1>用户手册</h1>

<h2><div id="user-content-summary">概述</div></h2>

<h3><div id="user-content-summary-intro">简介</div></h3>

<p>Rexdb是一款使用Java语言编写的，开放源代码的持久层框架。提供了查询、调用、（JTA）事务、数据源管理等功能。使用Rexdb时，不需要像JDBC一样编写繁琐的代码，也不需要编写映射文件，只要将SQL和Java对象等参数传递至框架接口，即可获取需要的结果。</p>

<p>Rexdb的官方网站地址为：<a href="http://db.rex-soft.org">http://db.rex-soft.org</a></p>

<h3><div id="user-content-summary-feature">功能</div></h3>

<p>Rexdb具有如下功能：</p>

<ul>
<li>数据库操作：查询、更新、批处理、调用、（JTA）事物等；</li>
<li>ORM映射：支持数组、Map和任意Java对象；</li>
<li>数据源：内置连接池，支持第三方数据源和JNDI；</li>
<li>方言：自动分页，支持Oracle、DB2、SQL Server、Mysql、达梦等数据库；</li>
<li>高级功能：监听、国际化、异常管理等；</li>
</ul>

<h2><div id="user-content-environment">开发环境</div></h2>

<p>Rexdb的官方网站提供了下载衔接，下载并解压后，可以得到编译好的jar包和全局配置文件的示例：</p>

<ul>
<li>
<strong>rexdb-1.0.0.jar</strong>（或其它版本）</li>
<li><strong>rexdb.xml</strong></li>
</ul>

<p><strong>rexdb-1.0.0.jar</strong>（或其它版本）是运行Rexdb必须的包，请确保它在开发/运行环境的<code>classpath</code>中。由于Rexdb直接调用JDBC的接口，所以您还需要在<code>classpath</code>中设置好待连接数据库的驱动。如果要使用Rexdb的扩展功能，还需在运行环境中增加其它jar包。具体请参考<a href="#user-content-express">扩展</a>。</p>

<p><strong>rexdb.xml</strong>是Rexdb的全局配置文件，默认需要放置在开发/运行环境的<code>classpath</code>中。如果需要放置在其它位置，需要编写程序加载指定位置的文件。具体请参考<a href="#user-content-config-load">全局配置文件-加载配置文件</a>。</p>

<p>例如，在JavaEE应用中，<strong>rexdb-1.0.0.jar</strong>（或其它版本）应当放置在应用根目录下的“<code>/WEB-INF/lib</code>”文件夹中，<strong>rexdb.xml</strong>默认应当放置在“<code>/WEB-INF/classes</code>”中。</p>

<h2><div id="user-content-config">全局配置文件</div></h2>

<p>Rexdb需要一个XML格式的全局配置文件<strong>rexdb.xml</strong>，用于配置运行选项、数据源、监听程序等。各节点的含义如下：</p>

<ul>
<li>
<code>/configuration</code>：根节点；</li>
<li>
<code>/configuration/properties</code>：外部资源文件，可以在该文件中定义<code>key-value</code>对，并在其余配置中以“<code>#{key}</code>”的格式引用<code>value</code>；</li>
<li>
<code>/configuration/settings</code>：全局设置选项，用于配置Rexdb的全局选项，例如异常信息语言、日志、反射缓存等；</li>
<li>
<code>/configuration/dataSource</code>：数据源配置；</li>
<li>
<code>/configuration/listener</code>：监听程序配置，可以使用监听程序跟踪SQL执行、事物等事件。</li>
</ul>

<p>例如，某应用中的<strong>rexdb.xml</strong>文件内容如下：</p>

<div class="highlight highlight-text-xml"><pre>&lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
&lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
&lt;<span class="pl-ent">configuration</span>&gt;
    &lt;<span class="pl-ent">properties</span> <span class="pl-e">path</span>=<span class="pl-s"><span class="pl-pds">"</span>rexdb-settings.properties<span class="pl-pds">"</span></span> /&gt;
    &lt;<span class="pl-ent">settings</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>lang<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>#{setting.lang}<span class="pl-pds">"</span></span>/&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>nolog<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>true<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>reflectCache<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>true<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>dynamicClass<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>true<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">settings</span>&gt;
    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://localhost:3306/rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">id</span>=<span class="pl-s"><span class="pl-pds">"</span>oracleDs<span class="pl-pds">"</span></span> <span class="pl-e">jndi</span>=<span class="pl-s"><span class="pl-pds">"</span>java:/comp/env/oracleDb<span class="pl-pds">"</span></span>/&gt;
    &lt;<span class="pl-ent">listener</span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>org.rex.db.listener.impl.SqlDebugListener<span class="pl-pds">"</span></span>/&gt; 
&lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>配置文件中引用了一个外部资源文件<strong>rexdb-settings.properties</strong>，并设置了异常信息语言、禁用了日志输出等全局选项；配置了一个默认数据源和一个<code>oracleDs</code>数据源；启用了Rexdb内置的<code>SqlDebugListener</code>监听。各节点的详细含义和配置方法请参见下面的章节。</p>

<h3><div id="user-content-config-load">加载配置文件</div></h3>

<p><strong>rexdb.xml</strong>的默认存放路径是运行环境的<code>classpath</code>根目录。Rexdb会在类加载时自动读取该文件，并完成框架的初始化工作。如果您启用了日志，将在日志输出中看到类似如下内容（输出格式取决于您的日志配置）：</p>

<div class="highlight highlight-source-shell"><pre>[INFO][2016-02-23 21:26:55] configuration.Configuration[main] - loading default configuration rexdb.xml.
... <span class="pl-c"># detailed log messages.</span>
[INFO][2016-02-23 21:26:59] configuration.Configuration[main] - default configuration rexdb.xml loaded.</pre></div>

<p>当在默认路径中无法找到<strong>rexdb.xml</strong>文件时，会输出如下日志：</p>

<div class="highlight highlight-source-shell"><pre>[INFO][2016-02-23 22:18:36] configuration.Configuration[main] - loading default configuration rexdb.xml.
[WARN][2016-02-23 22:18:36] configuration.Configuration[main] - could not load default configuration rexdb.xml from classpath, rexdb is not initialized, cause (DB-URS01) resource rexdb.xml not found.</pre></div>

<p>在配置未被加载时调用Rexdb的接口，Rexdb会再次尝试从默认路径中加载配置，如果仍然无法加载，将会抛出异常信息。如果Rexdb的全局配置文件放置在其它位置，或者使用了其它的命名，可以使用类<a href="#user-content-class-Configuration">org.rex.db.configuration.Configuration</a>类加载指定目录下的配置文件。该类有如下加载配置文件的接口：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>loadDefaultConfiguration()</td>
            <td>从<code>classpath</code>中加载名称为<b>rexdb.xml</b>的配置文件</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>loadConfigurationFromClasspath(String path)</td>
            <td>从<code>classpath</code>中加载配置文件</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>loadConfigurationFromFileSystem(String path)</td>
            <td>从文件系统中加载配置文件</td>
        </tr>
    </tbody>
</table>

<p>例如，下面的代码加载了位于classpath中的rexdb-config.xml文件：</p>

<div class="highlight highlight-source-java"><pre>    <span class="pl-smi">Configuration</span><span class="pl-k">.</span>loadConfigurationFromClasspath(<span class="pl-s"><span class="pl-pds">"</span>rexdb-config.xml<span class="pl-pds">"</span></span>);</pre></div>

<p>需要注意到是，Rexdb在加载配置文件时具备容错机制，当某节点不符合配置要求，或无法根据配置完成初始化时，该节点将会被忽略，并继续加载下一个节点。所以，您通常需要留意日志的输出，检查是否有未被成功加载的配置。</p>

<h3><div id="user-content-config-properties">外部资源文件</div></h3>

<p>全局配置文件的<code>/configuration/properties</code>节点用于引用一个外部资源文件，在该文件中定义的<code>key-value</code>配置可以被其它节点以<code>#{key}</code>的格式引用。该节点有如下可选属性：</p>

<table>
    <thead>
        <tr>
            <th width="80">属性</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>path</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>本地<code>classpath</code>中资源文件的相对路径，不能与<code>url</code>属性同时存在。</td>
        </tr>
        <tr>
            <td><code>url</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>网络中资源文件的<code>URL</code>路径，不能与<code>path</code>属性同时存在。</td>
        </tr>
    </tbody>
</table>

<p>例如，放置在<code>classpath</code>根目录的资源文件<strong>rexdb-database-sample.properties</strong>内容如下：</p>

<div class="highlight highlight-source-shell"><pre>    driver=com.mysql.jdbc.Driver
    url=jdbc:mysql://localhost:3306/rexdb
    username=root
    password=12345678</pre></div>

<p><strong>rexdb.xml</strong>中的配置如下：</p>

<div class="highlight highlight-text-xml"><pre>    &lt;?<span class="pl-ent">xml</span><span class="pl-e"> version</span>=<span class="pl-s"><span class="pl-pds">"</span>1.0<span class="pl-pds">"</span></span><span class="pl-e"> encoding</span>=<span class="pl-s"><span class="pl-pds">"</span>UTF-8<span class="pl-pds">"</span></span>?&gt; 
    &lt;!<span class="pl-k">DOCTYPE</span> <span class="pl-v">configuration</span> PUBLIC "-//rex-soft.org//REXDB DTD 1.0//EN" "http://www.rex-soft.org/dtd/rexdb-1-config.dtd"&gt;
    &lt;<span class="pl-ent">configuration</span>&gt;
        &lt;<span class="pl-ent">properties</span> <span class="pl-e">path</span>=<span class="pl-s"><span class="pl-pds">"</span>rexdb-database-sample.propertie<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">dataSource</span>&gt;
            &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>#{driver}<span class="pl-pds">"</span></span> /&gt;
            &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>#{url}<span class="pl-pds">"</span></span> /&gt;
            &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>#{username}<span class="pl-pds">"</span></span> /&gt;
            &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>#{password}<span class="pl-pds">"</span></span> /&gt;
        &lt;/<span class="pl-ent">dataSource</span>&gt;
    &lt;/<span class="pl-ent">configuration</span>&gt;</pre></div>

<p>Rexdb在初始化时会首先读取<strong>rexdb-database-sample.properties</strong>文件的内容。在解析<strong>rexdb.xml</strong>时，如果发现其内容符合<code>#{...}</code>的格式，则会替换为资源文件中配置的值。在上面的示例中，<code>dataSource</code>节点的属性<code>driverClassName</code>的值是<code>#{driver}</code>，则会被替换为资源文件中<code>driver</code>对应的值<code>com.mysql.jdbc.Driver</code>。</p>

<h3><div id="user-content-config-settings">全局设置</div></h3>

<p>全局配置文件的<code>/configuration/settings</code>节点用于设置Rexdb的运行参数，可用的配置选项有：</p>

<table>
    <thead>
        <tr>
            <th width="80">配置项</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="110">可选值</th>
            <th width="60">默认值</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>lang</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>
<code>en</code>, <code>zh-cn</code>
</td>
            <td><code>en</code></td>
            <td>设置Rexdb异常信息的语言。要注意的是，在Linux系统中，中文异常信息在输出至控制台可能会出现乱码。</td>
        </tr>
        <tr>
            <td><code>nolog</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>是否禁用所有日志输出，当设置为<code>true</code>时，Rexdb将不再输出任何日志。</td>
        </tr>
        <tr>
            <td><code>validateSql</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>是否对SQL语句进行简单的校验。通常Rexdb只校验SQL中带有<code>?</code>标记的个数是否与的预编译参数个数相同。</td>
        </tr>
        <tr>
            <td><code>checkWarnings</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>在执行SQL后，是否检查状态中的警告。当设置为<code>true</code>时，将执行检查，当发现警告信息时抛出异常。要注意的是，开启该选项可能会大幅降低Rexdb的性能。</td>
        </tr>
        <tr>
            <td><code>queryTimeout</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>任意整数</td>
            <td><code>-1</code></td>
            <td>执行SQL的超时秒数，当小于或等于0时，不设置超时时间。当同时设置了事物超时时间时，Rexdb会自动选择一个较短的时间作为执行SQL的超时秒数。</td>
        </tr>
        <tr>
            <td><code>transactionTimeout</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>任意整数</td>
            <td><code>-1</code></td>
            <td>执行事务的超时秒数，当小于或等于0时，不设置超时时间。要注意的是，Rexdb通过设置事物中每个SQL的执行时间来控制整体事物的时间，如果事物中有与SQL执行无关的操作，且在执行该操作时超时，事物超时时间将不起作用。</td>
        </tr>
        <tr>
            <td><code>transactionIsolation</code></td>
            <td>否</td>
            <td>String</td>
            <td>
                <code>DEFAULT</code><br>
                <code>READ_UNCOMMITTED</code><br>
                <code>READ_COMMITTED</code><br>
                <code>REPEATABLE_READ</code><br>
                <code>SERIALIZABLE</code><br>
            </td>
            <td><code>DEFAULT</code></td>
            <td>
                定义事物的隔离级别，仅在非JTA事物中时有效。各参数含义如下：<br>
                - <code>DEFAULT</code>：使用数据库默认的事务隔离级别；<br>
                - <code>READ_UNCOMMITTED</code>：一个事务可以看到其它事务未提交的数据<br>
                - <code>READ_COMMITTED</code>：一个事务修改的数据提交后才能被另外一个事务读取；<br>
                - <code>REPEATABLE_READ</code>：同一事务的多个实例在并发读取数据时，会看到同样的数据行；<br>
                - <code>SERIALIZABLE</code>：通过强制事务排序，使事物之间不可能相互冲突。
            </td>
        </tr>
        <tr>
            <td><code>autoRollback</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>
                事务提交失败时是否自动回滚。
            </td>
        </tr>
        <tr>
            <td><code>reflectCache</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>true</code></td>
            <td>是否启用反射缓存。当启用时，Rexdb将会缓存类的参数、函数等信息。开启该选项可以大幅提升Rexdb的性能。</td>
        </tr>
        <tr>
            <td><code>dynamicClass</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>true</code></td>
            <td>是否启用动态字节码功能。当开启该选项时，Rexdb将使用javassist的生成中间类。启用该选项可以大幅提高Rexdb在查询<code>Java对象</code>时的性能。要注意的是，该选项需要配合jboss javassist包使用，Rexdb会在加载全局配置时检测javassist环境，当环境不可用时，该配置项会被自动切换为false。</td>
        </tr>
        <tr>
            <td><code>dateAdjust</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>true</code></td>
            <td>写入数据时，是否自动将日期类型的参数转换为<code>java.sql.Timestamp</code>类型。开启此选项可以有效避免日期、时间数据的丢失，以及因类型、格式不匹配而产生的异常。</td>
        </tr>
        <tr>
            <td><code>batchTransaction</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>true</code></td>
            <td>调用批量更新接口时，如果当前没有事物，是否自动开启。在某些数据库中，需要在在事物中执行批量更新，才能获得高效的性能。</td>
        </tr>
    </tbody>
</table>

<p>例如，如果要设置Rexdb抛出异常时的语言为中文，并且禁用日志，可以使用如下配置：</p>

<div class="highlight highlight-text-xml"><pre>    &lt;<span class="pl-ent">settings</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>lang<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>en<span class="pl-pds">"</span></span>/&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>nolog<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>false<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">settings</span>&gt;</pre></div>

<p>要注意的是，如果设置项不被Rexdb支持，或者值的格式、值域不正确，则该设置会被忽略并使用默认值。</p>

<h3><div id="user-content-config-datasource">数据源</div></h3>

<p><code>/configuration/dataSource</code>节点用于配置数据源。该节点支持如下属性：</p>

<table>
    <thead>
        <tr>
            <th width="80">属性</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>id</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>数据源编号。不设置时为Rexdb的默认数据源，配置文件中只允许出现一个默认数据源。</td>
        </tr>
        <tr>
            <td><code>class</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>数据源实现类，不设置时使用Rexdb的内置数据源，不能与<code>jndi</code>属性一同出现。</td>
        </tr>
        <tr>
            <td><code>jndi</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>上下文中的数据源JNDI，不能与<code>class</code>属性一同出现。</td>
        </tr>
        <tr>
            <td><code>dialect</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>为该数据源指定的数据库方言，不设置时将由Rexdb根据元数据信息自动选择内置的方言，请参见[方言接口](#class-dialect)。</td>
        </tr>
    </tbody>
</table>

<p>也可以通过<code>property</code>节点为数据源初始化参数。当不设置<code>class</code>和<code>jndi</code>属性时，Rexdb将使用内置的数据源<code>org.rex.db.datasource.SimpleDataSource</code>。该数据源支持如下初始化参数：</p>

<table>
    <thead>
        <tr>
            <th width="80">选项</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="110">可选值</th>
            <th width="60">默认值</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>driverClassName</code></td>
            <td>是</td>
            <td><code>String</code></td>
            <td>-</td>
            <td>-</td>
            <td>JDBC驱动类。</td>
        </tr>
        <tr>
            <td><code>url</code></td>
            <td>是</td>
            <td><code>String</code></td>
            <td>-</td>
            <td>-</td>
            <td>数据库连接URL。</td>
        </tr>
        <tr>
            <td><code>username</code></td>
            <td>是</td>
            <td><code>String</code></td>
            <td>-</td>
            <td>-</td>
            <td>数据库用户。</td>
        </tr>
        <tr>
            <td><code>password</code></td>
            <td>是</td>
            <td><code>String</code></td>
            <td>-</td>
            <td>-</td>
            <td>数据库密码。</td>
        </tr>
        <tr>
            <td><code>initSize</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>1</code></td>
            <td>初始化连接池时创建的连接数。</td>
        </tr>
        <tr>
            <td><code>minSize</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>3</code></td>
            <td>连接池保持的最小连接数。连接池将定期检查持有的连接数，达不到该数量时将开启新的空闲连接。</td>
        </tr>
        <tr>
            <td><code>maxSize</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>10</code></td>
            <td>连接池的最大连接数。当程序所需连接超出此数量时，将置于等待状态，直到有新的空闲连接。</td>
        </tr>
        <tr>
            <td><code>increment</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>1</code></td>
            <td>每次增长的连接数。当连接池的连接数量不足，需要开启新的连接时，将一次性增长该参数指定的连接数。</td>
        </tr>
        <tr>
            <td><code>retries</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>2</code></td>
            <td>获取新的数据库连接失败后的重试次数。Rexdb不会判定失败原因，只要无法创建新的连接，即重试指定的次数。</td>
        </tr>
        <tr>
            <td><code>retryInterval</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>750</code></td>
            <td>创建新的数据库连接失败后的重试间隔，单位为毫秒。即当获取一个新的数据库连接失败，直到下一次重试的等待时间.</td>
        </tr>
        <tr>
            <td><code>getConnectionTimeout</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>5000</code></td>
            <td>获取连接的超时时间，单位为毫秒。当程序从Rexdb数据源中申请一个新的连接，且当前无空闲连接时，程序的等待时间。当超过改时间后，Rexdb会抛出一个超时的异常信息。</td>
        </tr>
        <tr>
            <td><code>inactiveTimeout</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>600000</code></td>
            <td>数据库连接的最长空闲时间，单位为毫秒。当数据库连接的空闲时间超过该参数的值时，连接会被关闭。</td>
        </tr>
        <tr>
            <td><code>maxLifetime</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>1800000</code></td>
            <td>数据库连接的最长时间，单位为毫秒。当数据库连接开启时间超过该参数的值时，连接会被关闭。</td>
        </tr>
        <tr>
            <td><code>testConnection</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>true</code></td>
            <td>开启新的数据库连接后，是否测试连接可用。当运行环境为JDK1.6及以上版本时，Rexdb将使用JDBC的测试接口执行测试；当JDK低于1.5时，如果未指定测试SQL，将调用方言接口获取测试SQL，如果能成功执行，则测试通过。</td>
        </tr>
        <tr>
            <td><code>testSql</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>SQL语句</td>
            <td>-</td>
            <td>指定测试连接是否活跃的SQL语句。</td>
        </tr>
        <tr>
            <td><code>testTimeout</code></td>
            <td>否</td>
            <td><code>int</code></td>
            <td>大于0的整数</td>
            <td><code>500</code></td>
            <td>测试连接的超时时间。</td>
        </tr>
    </tbody>
</table>

<p>类似于Rexdb内置的数据源，其它开源数据源（例如Apache DBCP、C3P0等），通常也支持设置多个初始化参数，具体请参考各自的用户手册。</p>

<p>例如，以下代码配置了3个数据源：</p>

<div class="highlight highlight-text-xml"><pre>    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>oracle.jdbc.driver.OracleDriver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:oracle:thin:@127.0.0.1:1521:orcl<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>123456<span class="pl-pds">"</span></span> /&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">id</span>=<span class="pl-s"><span class="pl-pds">"</span>mysqlDs<span class="pl-pds">"</span></span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>org.apache.commons.dbcp.BasicDataSource<span class="pl-pds">"</span></span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>com.mysql.jdbc.Driver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:mysql://localhost:3306/rexdb<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>root<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>12345678<span class="pl-pds">"</span></span> /
    &lt;/dataSource&gt;
    &lt;<span class="pl-ent">dataSource</span> <span class="pl-e">id</span>=<span class="pl-s"><span class="pl-pds">"</span>oracleDs<span class="pl-pds">"</span></span> <span class="pl-e">jndi</span>=<span class="pl-s"><span class="pl-pds">"</span>java:/comp/env/oracleDb<span class="pl-pds">"</span></span>/&gt;</pre></div>

<p>按照顺序分别是：</p>

<ul>
<li>连接Oracle数据库的默认数据源，使用Rexdb自带的数据源和连接池；</li>
<li>连接Mysql数据库的数据源，编号为“mysqlDs”，使用了Apache DBCP数据源；</li>
<li>连接Oracle的数据源，编号为“oracleDs”，使用JNDI方式查找容器自带的数据源；</li>
</ul>

<p>上面的示例中，默认数据源使用了Rexdb自带的数据源，如果希望将其配置为初始化连接数为3、每次增长3个连接、重试次数设置为3、不再测试连接活跃性时，可以调整为如下配置：</p>

<div class="highlight highlight-text-xml"><pre>    &lt;<span class="pl-ent">dataSource</span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>driverClassName<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>oracle.jdbc.driver.OracleDriver<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>url<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>jdbc:oracle:thin:@127.0.0.1:1521:orcl<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>username<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span> /&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>password<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>123456<span class="pl-pds">"</span></span> /&gt;

        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>initSize<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>3<span class="pl-pds">"</span></span>/&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>increment<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>3<span class="pl-pds">"</span></span>/&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>retries<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>3<span class="pl-pds">"</span></span>/&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>testConnection<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>false<span class="pl-pds">"</span></span>/&gt;
    &lt;/<span class="pl-ent">dataSource</span>&gt;</pre></div>

<p>在配置好数据源后，在调用类<code>org.rex.DB</code>的方法执行SQL、处理事务时，可以指定数据源。例如，在执行查询时：</p>

<div class="highlight highlight-source-java"><pre>    <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(<span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>);            <span class="pl-c">//使用默认数据源执行查询</span>
    <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(<span class="pl-s"><span class="pl-pds">"</span>mysqlDs<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>); <span class="pl-c">//使用mysqlDs数据源执行查询</span>
    <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(<span class="pl-s"><span class="pl-pds">"</span>oracleDs<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>);<span class="pl-c">//使用oracleDs数据源执行查询</span></pre></div>

<h3><div id="user-content-config-listener">监听</div></h3>

<p><code>/configuration/listener</code>节点用于设置监听程序。监听程序可以跟踪SQL执行、事物等事件，该节点支持如下属性：</p>

<table>
    <thead>
        <tr>
            <th width="80">属性</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>class</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>监听程序实现类。</td>
        </tr>
    </tbody>
</table>

<p>如果监听类定义了可以设置的属性，还可以通过设置<code>property</code>节点设置值。Rexdb内置了用于输出SQL和事物信息的监听类，分别是：</p>

<ul>
<li>
<code>org.rex.db.listener.impl.SqlDebugListener</code>：使用日志接口输出SQL和事物信息。该监听类支持如下配置选项：</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">选项</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="110">可选值</th>
            <th width="60">默认值</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>level</code></td>
            <td>否</td>
            <td><code>String</code></td>
            <td>
<code>debug</code>, <code>info</code>
</td>
            <td><code>debug</code></td>
            <td>设置日志的输出级别。</td>
        </tr>
        <tr>
            <td><code>simple</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>是否启用简易的日志输出。当设置为<code>true</code>时，仅在SQL或事物完成后输出简要的日志；设置为<code>false</code>时，在SQL和事物执行前后均会输出日志。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>
<code>org.rex.db.listener.impl.SqlConsolePrinterListener</code>：将SQL和事物信息输出到<code>System.out</code>终端。该监听类支持如下配置选项：</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">选项</th>
            <th width="60">必填</th>
            <th width="60">类型</th>
            <th width="110">可选值</th>
            <th width="60">默认值</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>simple</code></td>
            <td>否</td>
            <td><code>boolean</code></td>
            <td>
<code>true</code>, <code>false</code>
</td>
            <td><code>false</code></td>
            <td>是否启用简易的日志输出，当设置为<code>true</code>时，仅在SQL或事物完成后输出日志；设置为<code>false</code>时，在SQL和事物执行前后均会输出日志。</td>
        </tr>
    </tbody>
</table>

<p>例如，以下代码配置了一个监听：</p>

<div class="highlight highlight-text-xml"><pre>    &lt;<span class="pl-ent">listener</span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>org.rex.db.listener.impl.SqlDebugListener<span class="pl-pds">"</span></span>&gt;
        &lt;<span class="pl-ent">property</span> <span class="pl-e">name</span>=<span class="pl-s"><span class="pl-pds">"</span>simple<span class="pl-pds">"</span></span> <span class="pl-e">value</span>=<span class="pl-s"><span class="pl-pds">"</span>true<span class="pl-pds">"</span></span>/&gt;
    &lt;/<span class="pl-ent">listener</span>&gt;</pre></div>

<p>上面的配置使用了Rexdb内置的<code>SqlDebugListener</code>监听类，并以DEBUG级别输出简要的日志信息。如果您需要自行定义监听程序，例如记录每个SQL的执行时间，可以编写程序实现监听接口，详情请查看<a href="#user-content-express-listener">扩展-监听</a>。</p>

<p>需要注意的是，监听程序并非线程安全，且不运行于独立线程，在编程时需要注意线程安全和性能问题。</p>

<h2><div id="user-content-functions">执行数据库操作</div></h2>

<p>定义好全局配置文件后，就可以执行数据库操作了。Rexdb将数据库操作接口集中在类<code>org.rex.DB</code>中，且都是静态的，可以直接调用。根据SQL类型的不同，可以将接口分类如下：</p>

<ul>
<li>插入/更新/删除操作：<code>DB.update(...)</code>系列接口；</li>
<li>批量更新：<code>DB.batchUpdate(...)</code>系列接口；</li>
<li>查询多行记录：<code>DB.getList(...)</code>和<code>DB.getMapList(...)</code>系列接口；</li>
<li>查询单行记录：<code>DB.get(...)</code>和<code>DB.getMap(...)</code>系列接口；</li>
<li>调用：<code>DB.call(...)</code>系列接口；</li>
<li>事物：<code>DB.beginTransaction(...)</code>, <code>DB.commit(...)</code>, <code>DB.rollback(...)</code>等接口</li>
<li>其它：<code>getDataSource(...)</code>, <code>getConnection(...)</code>等接口</li>
</ul>

<p>如果您在开发时使用了Eclipse等IDE工具，可以方便的由工具提示出可用的接口列表，直接选择需要的接口使用即可。</p>

<h3><div id="user-content-functions-update">插入/更新/删除</div></h3>

<p>类<code>org.rex.DB</code>的下列接口负责执行数据库的插入/更新/删除操作，以及执行创建表、删除表等DDL SQL：</p>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>update(String sql)</td>
            <td>执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String sql, Object[] parameterArray)</td>
            <td>执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String sql, Ps ps)</td>
            <td>执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String sql, Map
            </td>
<td>执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String sql, Object parameterBean)</td>
            <td>执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>update(String dataSourceId, String sql)</td>
            <td>在指定的数据源中执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String dataSourceId, String sql, Object[] parameterArray)</td>
            <td>在指定的数据源中执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String dataSourceId, String sql, Ps ps)</td>
            <td>在指定的数据源中执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String dataSourceId, String sql, Map
            </td>
<td>在指定的数据源中执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>update(String dataSourceId, String sql, Object parameterBean)</td>
            <td>在指定的数据源中执行一个SQL语句，例如INSERT、UPDATE、DELETE或DDL语句。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在Object对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<p>在执行带有预编译参数的SQL时，<code>数组</code>、<code>org.rex.db.Ps</code>、<code>Map</code>和<code>Java对象</code>都可以作为预编译参数。</p>

<p>当使用<code>数组</code>做参数时，SQL语句以<code>?</code>作为预编译参数标记，数组元素按照顺序与其对应。Rexdb还内置了类<code>org.rex.db.Ps</code>，提供了比数组更加丰富的操作接口，可以按照下标赋值，还可以声明输出参数等，详情请参见<a href="#user-content-class-ps">类org.rex.db.Ps</a>。<code>Ps</code>对象中内置的元素同样按照顺序与SQL语句中的<code>?</code>标记对应。</p>

<p>Rexdb支持<code>java.util.Map</code>作为执行SQL的参数。此时，SQL语句中的预编译参数需要声明为<code>#{key}</code>的格式，<code>Map</code>中键为<code>key</code>的值将作为对应的预编译参数，当<code>Map</code>中没有键<code>key</code>时，预编译参数将被设置为<code>null</code>。</p>

<p>Rexdb还支持<code>Java类</code>作为预编译参数，与<code>Map</code>类似，SQL语句中的预编译参数需要声明为<code>#{key}</code>的格式，Rexdb将通过调用getter方法获取<code>key</code>的值，并将其作为预编译参数。当无法取值时，预编译参数将设置为<code>null</code>。需要注意的是，实体类还需要满足如下条件，才能被Rexdb正常调用：</p>

<ul>
<li>类是可以访问的；</li>
<li>参数需要有标准的getter方法；</li>
<li>类具备无参的构造函数（启用动态字节码选项时需要调用）</li>
</ul>

<p>以下是使用各种类型的参数执行SQL的示例：</p>

<p>以下代码直接执行了一个没有预编译参数的SQL：</p>

<pre><code>DB.update("INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (1, 'Jim', now())"); //Mysql
</code></pre>

<p>当使用<code>数组</code>作为执行SQL的参数时，可以使用如下代码：</p>

<div class="highlight highlight-source-java"><pre>    <span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
    <span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()});</pre></div>

<p>与数组类似，当使用<code>Ps</code>对象作为参数时：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()));</pre></div>

<p>当使用<code>Map</code>对象做参数时，SQL语句中需要以<code>#{key}</code>的格式标记预编译参数，例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (#{id}, #{name}, #{createTime})<span class="pl-pds">"</span></span>;
<span class="pl-smi">Map</span> prameters <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">HashMap</span>();
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>id<span class="pl-pds">"</span></span>, <span class="pl-c1">1</span>);
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>name<span class="pl-pds">"</span></span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>);
prameters<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>createTime<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());

<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, prameters);</pre></div>

<p>使用自定义的<code>Java对象</code>做参数时，首先需要编写一个成员变量能够与表的字段对应的类：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">import</span> <span class="pl-smi">java.util.Date</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">RexTest</span> {

    <span class="pl-k">private</span> <span class="pl-k">int</span> id;
    <span class="pl-k">private</span> <span class="pl-smi">String</span> name;
    <span class="pl-k">private</span> <span class="pl-smi">Date</span> createTime;

    <span class="pl-k">public</span> <span class="pl-en">RexTest</span>() {
    }    

    <span class="pl-k">public</span> <span class="pl-en">RexTest</span>(<span class="pl-k">int</span> <span class="pl-v">id</span>, <span class="pl-smi">String</span> <span class="pl-v">name</span>, <span class="pl-smi">Date</span> <span class="pl-v">createTime</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>id <span class="pl-k">=</span> id;
        <span class="pl-v">this</span><span class="pl-k">.</span>name <span class="pl-k">=</span> name;
        <span class="pl-v">this</span><span class="pl-k">.</span>createTime <span class="pl-k">=</span> createTime;
    }

    <span class="pl-k">public</span> <span class="pl-k">int</span> <span class="pl-en">getId</span>() {
        <span class="pl-k">return</span> id;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setId</span>(<span class="pl-k">int</span> <span class="pl-v">id</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>id <span class="pl-k">=</span> id;
    }

    <span class="pl-k">public</span> <span class="pl-smi">String</span> <span class="pl-en">getName</span>() {
        <span class="pl-k">return</span> name;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setName</span>(<span class="pl-smi">String</span> <span class="pl-v">name</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>name <span class="pl-k">=</span> name;
    }

    <span class="pl-k">public</span> <span class="pl-smi">Date</span> <span class="pl-en">getCreateTime</span>() {
        <span class="pl-k">return</span> createTime;
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">setCreateTime</span>(<span class="pl-smi">Date</span> <span class="pl-v">createTime</span>) {
        <span class="pl-v">this</span><span class="pl-k">.</span>createTime <span class="pl-k">=</span> createTime;
    }
}</pre></div>

<p>该类的实例可以作为执行SQL的参数：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (#{id}, #{name}, #{createTime})<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">RexTest</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());

<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>update(sql, rexTest);</pre></div>

<p>下图展示了<code>DB.update(...)</code>接口中SQL语句和各种类型参数的组合方式：</p>

<p><a href="resource/quick-start-update.png" target="_blank"><img data-src="resource/quick-start-update.png" alt="" style="max-width:100%;"></a></p>

<h3><div id="user-content-functions-batch">批量更新</div></h3>

<p>当插入多条记录时，使用批量更新接口可以获得更好的执行效率。类<code>org.rex.DB</code>中的批量更新接口如下：</p>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String[] sql)</td>
            <td>将一批SQL提交至数据库执行，如果全部成功，则返回更新计数组成的数组。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String sql, Object[][] parameterArrays)</td>
            <td>将一组<code>java.lang.Object数组</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String sql, Ps[] parameters)</td>
            <td>将一组<code>org.rex.db.Ps对象</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String sql, Map[] parameterMaps)</td>
            <td>将一组<code>java.util.Map</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String sql, Object[] parameterBeans)</td>
            <td>将一组<code>Object</code>对象作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Object</code>对象中的属性名称与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String sql, List parameterList)</td>
            <td>将一个<code>java.util.List</code>对象作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。<code>List</code>中的元素类型必须相同，Rexdb将根据类型确定SQL中预编译参数标记方式和取值方式。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String[] sql)</td>
            <td>在指定数据源中执行一批SQL语句，如果全部成功，则返回更新计数组成的数组。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String sql, Object[][] parameterArrays)</td>
            <td>在指定数据源中将一组<code>java.lang.Object数组</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String sql, Ps[] parameters)</td>
            <td>将一组<code>org.rex.db.Ps对象</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String sql, Map[] parameterMaps)</td>
            <td>在指定数据源中将一组<code>java.util.Map</code>作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String sql, Object[] parameterBeans)</td>
            <td>在指定数据源中将一组<code>Object</code>对象作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Object</code>对象中的属性名称与其对应。</td>
        </tr>
        <tr>
            <td><code>int[]</code></td>
            <td>batchUpdate(String dataSourceId, String sql, List parameterList)</td>
            <td>在指定数据源中将一个<code>java.util.List</code>对象作为参数提交至数据库执行，如果全部成功，则返回更新计数组成的数组。<code>List</code>中的元素类型必须相同，Rexdb将根据类型确定SQL中预编译参数标记方式和取值方式。</td>
        </tr>
    </tbody>
</table>

<p>在使用批量更新接口时，需要预先准备好多个SQL或参数。当需要写入大量记录时，可以将考虑拆分成多份后多次调用批量更新接口，以减少内存占用。</p>

<p>以<code>org.rex.db.Ps</code>数组做参数为例，可以使用如下代码执行批量更新：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>;
<span class="pl-k">Ps</span>[] pss <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>[<span class="pl-c1">10</span>];
<span class="pl-k">for</span> (<span class="pl-k">int</span> i <span class="pl-k">=</span> <span class="pl-c1">0</span>; i <span class="pl-k">&lt;</span> <span class="pl-c1">10</span>; i<span class="pl-k">++</span>)
    pss[i] <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(i, <span class="pl-s"><span class="pl-pds">"</span>name<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>());
<span class="pl-c1">DB</span><span class="pl-k">.</span>batchUpdate(sql, pss);</pre></div>

<p>执行成功后，数据库将写入10条记录。</p>

<p>下图展示了<code>DB.batchUpdate(...)</code>系列接口的SQL语句和参数组合方式：</p>

<p><a href="resource/quick-start-batchupdate.png" target="_blank"><img data-src="resource/quick-start-batchupdate.png" alt="" style="max-width:100%;"></a></p>

<h3><div id="user-content-functions-getlist">查询多行记录</div></h3>

<p>类<code>org.rex.DB</code>中的<code>getList(...)</code>系列接口用于查询多条记录。返回值是一个<code>java.util.ArrayList</code>列表，列表中的元素为调用接口时指定类型的<code>Java对象</code>，每个元素对应一条数据库记录。如果没有找到符合条件的记录，将返回一个空的<code>ArrayList</code>。</p>

<p>如果没有编写结果集对应的<code>Java对象</code>，也可以使用<code>getMapList(...)</code>系列方法查询一个包含<code>java.util.Map</code>的列表。列表中的元素类型为<code>org.rex.RMap</code>，是<code>java.util.HashMap</code>的子类，该类的具体接口请查阅类<a href="#user-content-class-rmap">org.rex.RMap</a>。</p>

<p>Rexdb在进行O/R映射时，会读取结果集中元数据，并将标签（Label）名称转换为Java风格的命名（具体的转换规则为“分析小写的标签名称，将字符<code>_</code>后的首字母转换为大写后，再移除字符<code>_</code>”），再根据转换后的名称为<code>Java对象</code>或<code>Map</code>赋值。例如：</p>

<pre><code>列名          -&gt;  Map的key/Java对象的属性名称
ABC         -&gt;  abc
ABC_DE      -&gt;  abcDe
ABC_DE_F    -&gt;  abcDeF
</code></pre>

<p>Rexdb内置了数据库方言，在查询指定偏移量和条目的记录时（以下称为分页查询），会根据方言自动封装相应的SQL语句，详情请见<a href="#express-dialect">扩展-方言</a>和<a href="#user-content-class-dialect">接口org.rex.db.dialect.Dialect</a>。</p>

<ul>
<li>如果希望查询指定类型的<code>Java对象</code>，可以使用如下接口：</li>
</ul>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String sql, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取元素类型为resultClass的Java对象列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String sql, Object[] parameterArray, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String sql, Ps parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String sql, Object parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String sql, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>执行分页查询，获取元素类型为resultClass的Java对象列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String sql, Object[] parameterArray, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String sql, Ps parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String sql, Object parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String dataSourceId, String sql, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取元素类型为resultClass的Java对象列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String dataSourceId, String sql, Object[] parameterArray, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String dataSourceId, String sql, Ps parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String dataSourceId, String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>get(String dataSourceId, String sql, Object parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String dataSourceId, String sql, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素类型为resultClass的Java对象列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String dataSourceId, String sql, Object[] parameterArray, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String dataSourceId, String sql, Ps parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String dataSourceId, String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;T&gt;</code></td>
            <td>getList(String dataSourceId, String sql, Object parameters, Class&lt;T&gt; resultClass, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素类型为resultClass的Java对象列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>如果希望查询出元素为<code>java.util.Map</code>的列表，可以使用下列接口：</li>
</ul>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql)</td>
            <td>执行查询，获取元素为<code>Map</code>的列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Object[] parameterArray)</td>
            <td>执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Ps parameters)</td>
            <td>执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Map&lt;?, ?&gt; parameters)</td>
            <td>执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Object parameters)</td>
            <td>执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, int offset, int rows)</td>
            <td>执行分页查询，获取元素为<code>Map</code>的列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Object[] parameterArray, int offset, int rows)</td>
            <td>执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Ps parameters, int offset, int rows)</td>
            <td>执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Map&lt;?, ?&gt; parameters, int offset, int rows)</td>
            <td>执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String sql, Object parameters, int offset, int rows)</td>
            <td>执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql)</td>
            <td>在指定数据源中执行查询，获取元素为<code>Map</code>的列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Object[] parameterArray)</td>
            <td>在指定数据源中执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Ps parameters)</td>
            <td>在指定数据源中执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Map&lt;?, ?&gt; parameters)</td>
            <td>在指定数据源中执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Object parameters)</td>
            <td>在指定数据源中执行查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素为<code>Map</code>的列表。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Object[] parameterArray, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Ps parameters, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Map&lt;?, ?&gt; parameters, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>List&lt;RMap&gt;</code></td>
            <td>getMapList(String dataSourceId, String sql, Object parameters, int offset, int rows)</td>
            <td>在指定数据源中执行分页查询，获取元素为<code>Map</code>的列表。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<p>例如，如下代码以多种方式查询了默认数据源中的表<code>REX_TEST</code>（在实际使用时，选择一种方式即可）。为便于演示，根据参数类型的不同进行了代码分组：</p>

<ul>
<li>无预编译参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST<span class="pl-pds">"</span></span>;
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sql);                       <span class="pl-c">//查询包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sql, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);                <span class="pl-c">//查询前10条记录，获取包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);        <span class="pl-c">//查询包含RexTest的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>); <span class="pl-c">//查询前10条记录，包含RexTest的列表</span></pre></div>

<ul>
<li>以数组作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlo <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID &gt; ?<span class="pl-pds">"</span></span>;
<span class="pl-k">Object</span>[] obj <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-c1">10</span>};
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlo, obj);                     <span class="pl-c">//查询编号大于10，包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlo, obj, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);              <span class="pl-c">//查询编号大于10的前10条记录，获取包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlo, obj, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);      <span class="pl-c">//查询编号大于10的记录，包含RexTest的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlo, obj, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);<span class="pl-c">//查询编号大于10的前10条记录，包含RexTest的列表</span></pre></div>

<ul>
<li>以Ps对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlp <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID &gt; ?<span class="pl-pds">"</span></span>;
<span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">10</span>);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlp, ps);                      <span class="pl-c">//查询编号大于10，包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlp, ps, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);               <span class="pl-c">//查询编号大于10的前10条记录，获取包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlp, ps, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);       <span class="pl-c">//查询编号大于10的记录，包含RexTest的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlp, ps, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);<span class="pl-c">//查询编号大于10的前10条记录，包含RexTest的列表</span></pre></div>

<ul>
<li>以Map对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlm <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID &gt; #{id}<span class="pl-pds">"</span></span>;
<span class="pl-smi">Map</span> map <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">HashMap</span>();
ps<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>id<span class="pl-pds">"</span></span>, <span class="pl-c1">10</span>);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlm, map);                     <span class="pl-c">//查询编号大于10，包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlm, map, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);              <span class="pl-c">//查询编号大于10的前10条记录，获取包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlm, map, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);      <span class="pl-c">//查询编号大于10的记录，包含RexTest的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlm, map, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);<span class="pl-c">//查询编号大于10的前10条记录，包含RexTest的列表</span></pre></div>

<ul>
<li>以RexTest对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlj <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID &gt; #{id}<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">RexTest</span>();
rexTest<span class="pl-k">.</span>setId(<span class="pl-c1">10</span>);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlj, rexTest);                     <span class="pl-c">//查询编号大于10，包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMapList(sqlj, rexTest, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);              <span class="pl-c">//查询编号大于10的前10条记录，获取包含Map对象的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlj, rexTest, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);      <span class="pl-c">//查询编号大于10的记录，包含RexTest的列表</span>
<span class="pl-k">List&lt;<span class="pl-smi">RexTest</span>&gt;</span> list <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getList(sqlj, rexTest, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class, <span class="pl-c1">0</span>, <span class="pl-c1">10</span>);<span class="pl-c">//查询编号大于10的前10条记录，包含RexTest的列表</span></pre></div>

<p><code>DB.getMapList(...)</code>接口的SQL语句和参数组合如下：</p>

<p><a href="resource/quick-start-getmaplist.png" target="_blank"><img data-src="resource/quick-start-getmaplist.png" alt="" style="max-width:100%;"></a></p>

<p><code>DB.getList(...)</code>接口的SQL语句和参数组合如下：</p>

<p><a href="resource/quick-start-getlist.png" target="_blank"><img data-src="resource/quick-start-getlist.png" alt="" style="max-width:100%;"></a></p>

<h3><div id="user-content-functions-get">查询单行记录</div></h3>

<p>与查询多行记录类似，类<code>org.rex.DB</code>的<code>get(...)</code>和<code>getMap(...)</code>方法分别用于查询指定类型的<code>Java对象</code>和<code>Map</code>对象。要注意的是，如果未查询到记录，查询接口将返回<code>null</code>；如果查询出了多条记录，由于无法确定需要哪一条，因此会抛出异常。</p>

<ul>
<li>如果希望查询出指定类型的<code>Java对象</code>，可以使用下面的接口：</li>
</ul>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>T</code></td>
            <td>get(String sql, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取指定类型的<code>Java对象</code>。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String sql, Object[] parameterArray, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String sql, Ps parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String sql, Object parameters, Class&lt;T&gt; resultClass)</td>
            <td>执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>T</code></td>
            <td>get(String dataSourceId, String sql, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取指定类型的<code>Java对象</code>。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String dataSourceId, String sql, Object[] parameterArray, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String dataSourceId, String sql, Ps parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String dataSourceId, String sql, Map&lt;?, ?&gt; parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>T</code></td>
            <td>get(String dataSourceId, String sql, Object parameters, Class&lt;T&gt; resultClass)</td>
            <td>在指定数据源中执行查询，获取指定类型的<code>Java对象</code>。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>如果希望查询出<code>Map</code>类型的结果时象，可以使用下面的接口：</li>
</ul>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String sql)</td>
            <td>执行查询，获取<code>Map</code>类型的结果。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String sql, Object[] parameterArray)</td>
            <td>执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String sql, Ps parameters)</td>
            <td>执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String sql, Map parameters)</td>
            <td>执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String sql, Object parameters)</td>
            <td>执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String dataSourceId, String sql)</td>
            <td>在指定数据源中执行查询，获取<code>Map</code>类型的结果。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String dataSourceId, String sql, Object[] parameterArray)</td>
            <td>在指定数据源中执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String dataSourceId, String sql, Ps parameters)</td>
            <td>在指定数据源中执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>?</code>标记预编译参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String dataSourceId, String sql, Map parameters)</td>
            <td>在指定数据源中执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>getMap(String dataSourceId, String sql, Object parameters)</td>
            <td>在指定数据源中执行查询，获取<code>Map</code>类型的结果。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<p>例如，以下代码使用了多种方式查询了表<code>REX_TEST</code>中的一条记录：</p>

<ul>
<li>无预编译参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sql <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID = 10<span class="pl-pds">"</span></span>;
<span class="pl-smi">RMap</span> rMap <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sql);                     <span class="pl-c">//查询Map对象</span>
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sql, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);   <span class="pl-c">//查询RexTest对象</span></pre></div>

<ul>
<li>以数组作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlo <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID = ?<span class="pl-pds">"</span></span>;
<span class="pl-k">Object</span>[] obj <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Object</span>[]{<span class="pl-c1">10</span>};
<span class="pl-smi">RMap</span> rMap <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sqlo, obj);                   <span class="pl-c">//查询编号为10的Map对象</span>
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sqlo, obj, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class); <span class="pl-c">//查询编号为10的RexTest对象</span></pre></div>

<ul>
<li>以Ps对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlp <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID = ?<span class="pl-pds">"</span></span>;
<span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">10</span>);
<span class="pl-smi">RMap</span> rMap <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sqlp, ps);                    <span class="pl-c">//查询编号为10的Map对象</span>
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sqlp, ps, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class);  <span class="pl-c">//查询编号为10的RexTest对象</span></pre></div>

<ul>
<li>以Map对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlm <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID = #{id}<span class="pl-pds">"</span></span>;
<span class="pl-smi">Map</span> map <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">HashMap</span>();
ps<span class="pl-k">.</span>put(<span class="pl-s"><span class="pl-pds">"</span>id<span class="pl-pds">"</span></span>, <span class="pl-c1">10</span>);
<span class="pl-smi">RMap</span> rMap <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sqlm, map);                   <span class="pl-c">//查询编号为10的Map对象</span>
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sqlm, map, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class); <span class="pl-c">//查询编号为10的RexTest对象</span></pre></div>

<ul>
<li>以RexTest对象作参数时</li>
</ul>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">String</span> sqlj <span class="pl-k">=</span> <span class="pl-s"><span class="pl-pds">"</span>SELECT * FROM REX_TEST WHERE ID = #{id}<span class="pl-pds">"</span></span>;
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">RexTest</span>();
rexTest<span class="pl-k">.</span>setId(<span class="pl-c1">10</span>);
<span class="pl-smi">RMap</span> rMap <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>getMap(sqlj, rexTest);                   <span class="pl-c">//查询编号为10的Map对象</span>
<span class="pl-smi">RexTest</span> rexTest <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>get(sqlj, rexTest, <span class="pl-smi">RexTest</span><span class="pl-k">.</span>class); <span class="pl-c">//查询编号为10的RexTest对象</span></pre></div>

<p><code>DB.getMap(...)</code>接口的SQL语句和参数组合如下：</p>

<p><a href="resource/quick-start-getmap.png" target="_blank"><img data-src="resource/quick-start-getmap.png" alt="" style="max-width:100%;"></a></p>

<p><code>DB.get(...)</code>接口的SQL语句和参数组合如下：</p>

<p><a href="resource/quick-start-get.png" target="_blank"><img data-src="resource/quick-start-get.png" alt="" style="max-width:100%;"></a></p>

<h3><div id="user-content-functions-call">调用</div></h3>

<p>类<code>org.rex.DB</code>的<code>call(...)</code>系列方法用于执行存储过程和函数调用，接口列表如下：</p>

<blockquote>
<p>使用默认数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String sql)</td>
            <td>执行调用，并获取返回结果（如果有）。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String sql, Object[] parameterArray)</td>
            <td>执行调用，并获取返回结果（如果有）。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String sql, Map parameterMap)</td>
            <td>执行调用，并获取返回结果（如果有）。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String sql, Object parameterBean)</td>
            <td>执行调用，并获取返回结果（如果有）。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String sql, Ps ps)</td>
            <td>执行调用，并获取输出参数和返回结果（如果有）。SQL语句需要以<code>?</code>标记预编译参数、声明输出参数和输入输出参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String dataSourceId, String sql)</td>
            <td>在指定数据源中执行调用，并获取返回结果（如果有）。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String dataSourceId, String sql, Object[] parameterArray)</td>
            <td>在指定数据源中执行调用，并获取返回结果（如果有）。SQL语句需要以<code>?</code>标记预编译参数，<code>Object数组</code>中的元素按照顺序与其对应。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String dataSourceId, String sql, Map parameterMap)</td>
            <td>在指定数据源中执行调用，并获取返回结果（如果有）。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，<code>Map</code>对象中键为<code>key</code>的值与其对应。当<code>Map</code>对象中没有键<code>key</code>时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String dataSourceId, String sql, Object parameterBean)</td>
            <td>在指定数据源中执行调用，并获取返回结果（如果有）。SQL语句需要以<code>#{key}</code>的格式标记预编译参数，Rexdb将在<code>Object</code>对象中查找<code>key</code>对应的getter方法，通过该方法取值后作为相应的预编译参数。当<code>Object</code>对象中没有相应的getter方法时，将赋值为<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>RMap</code></td>
            <td>call(String dataSourceId, String sql, Ps ps)</td>
            <td>在指定数据源中执行调用，并获取输出参数和返回结果（如果有）。SQL语句需要以<code>?</code>标记预编译参数、声明输出参数和输入输出参数，<code>Ps</code>对象内置的元素按照顺序与其对应。</td>
        </tr>
    </tbody>
</table>

<p>当调用有返回值时，Rexdb会自动遍历，并按照顺序存放在接口返回的<code>RMap</code>对象中，键分别为"<code>return_0</code>"、"<code>return_1</code>"等。当使用<code>org.rex.db.Ps</code>对象作为参数时，可以使用其<code>addReturnType(Class beanClass)</code>和<code>setReturnType(index, Class beanClass)</code>方法为每个返回值声明Java类型。如果声明了返回值类型<code>T</code>，<code>RMap</code>对象中的相应的结果将是<code>List&lt;T&gt;</code>；当不声明返回值类型时，每个返回结果都将是<code>List&lt;RMap&gt;</code>。</p>

<p>当调用有输出参数时，需要使用<code>org.rex.db.Ps</code>对象作为调用的参数，并使用其<code>addOut(...)</code>和<code>setOut(...)</code>系列方法声明输出参数，或者使用<code>addInOut(...)</code>和<code>setInOut(...)</code>系列方法声明输入输出参数。调用成功后，可以在返回的<code>RMap</code>对象中获取输出参数的值，键分别为"<code>out_0</code>"、"<code>out_1</code>"等。此外，<code>Ps</code>对象还支持对输出参数设置别名，在设置了别名后，返回的<code>RMap</code>对象中还可以按照别名取值。<code>org.rex.db.Ps</code>的接口详情请参见<a href="#user-content-class-ps">类org.rex.db.Ps</a>。</p>

<p>例如，以下代码调用了存储过程<code>test_proc</code>，并获取了第1个返回值：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call test_proc()}<span class="pl-pds">"</span></span>);
<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span> return1 <span class="pl-k">=</span> (<span class="pl-k">List&lt;<span class="pl-smi">RMap</span>&gt;</span>)result<span class="pl-k">.</span>get(<span class="pl-s"><span class="pl-pds">"</span>return_0<span class="pl-pds">"</span></span>);</pre></div>

<p>例如，以下代码声明了1个<code>int</code>类型的输出参数，调用成功后可以在返回的<code>RMap</code>对象中以<code>out_0</code>的键取值：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>();
ps<span class="pl-k">.</span>addOutInt();                                     <span class="pl-c">//将第1个参数声明为int类型的输出参数</span>
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call proc_out(?)}<span class="pl-pds">"</span></span>, ps);    <span class="pl-c">//调用存储过程</span>
<span class="pl-k">int</span> out <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>out_0<span class="pl-pds">"</span></span>);                   <span class="pl-c">//获取输出参数的值</span></pre></div>

<p>为取值方便，也可以在上面的代码中为输出参数设置一个别名，例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>()<span class="pl-k">.</span>addOutInt(<span class="pl-s"><span class="pl-pds">"</span>age<span class="pl-pds">"</span></span>);                  <span class="pl-c">//将第1个参数声明为int类型的输出参数，并设置别名"age"</span>
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call proc_out(?)}<span class="pl-pds">"</span></span>, ps);    <span class="pl-c">//调用存储过程</span>
<span class="pl-k">int</span> out <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>age<span class="pl-pds">"</span></span>);                     <span class="pl-c">//使用别名获取输出参数的值</span></pre></div>

<p>与输出参数类似，<code>Ps</code>对象还可以声明输入输出参数。例如：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">Ps</span> ps <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">Ps</span>()<span class="pl-k">.</span>addInOut(<span class="pl-c1">1</span>);                       <span class="pl-c">//将第1个参数声明为输入输出参数</span>
<span class="pl-smi">RMap</span> result <span class="pl-k">=</span> <span class="pl-c1">DB</span><span class="pl-k">.</span>call(<span class="pl-s"><span class="pl-pds">"</span>{call proc_inout(?)}<span class="pl-pds">"</span></span>, ps);  <span class="pl-c">//调用存储过程</span>
<span class="pl-k">int</span> out <span class="pl-k">=</span> result<span class="pl-k">.</span>getInt(<span class="pl-s"><span class="pl-pds">"</span>out_0<span class="pl-pds">"</span></span>);                   <span class="pl-c">//获取输出参数的值</span></pre></div>

<p>DB.call(...)接口的SQL语句和参数组合如下：</p>

<p><a href="resource/quick-start-call.png" target="_blank"><img data-src="resource/quick-start-call.png" alt="" style="max-width:100%;"></a></p>

<h3><div id="user-content-functions-transaction">事物</div></h3>

<p>Rexdb支持事物和标准的JTA事物，类<code>org.rex.DB</code>的事物接口有：</p>

<blockquote>
<p>使用默认数据源的事物</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>beginTransaction()</td>
            <td>开启事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>beginTransaction(DefaultDefinition definition)</td>
            <td>开启事物并设置事物参数。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>commit()</td>
            <td>提交事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>rollback()</td>
            <td>回滚事物</td>
        </tr>
        <tr>
            <td><code>java.sql.Connection</code></td>
            <td>getTransactionConnection()</td>
            <td>获取事物所在的数据库连接。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>使用指定的数据源的事物</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>beginTransaction(String dataSourceId)</td>
            <td>在指定数据源中开启事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>beginTransaction(String dataSourceId, DefaultDefinition definition)</td>
            <td>在指定数据源中开启事物，并设置配置参数。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>commit(String dataSourceId)</td>
            <td>提交指定数据源的事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>rollback(String dataSourceId)</td>
            <td>回滚指定数据源事物</td>
        </tr>
        <tr>
            <td><code>java.sql.Connection</code></td>
            <td>getTransactionConnection(String dataSourceId)</td>
            <td>获取指定数据源事物所在的连接。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>分布式事物</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>beginJtaTransaction()</td>
            <td>开启JTA事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>commitJta()</td>
            <td>提交JTA事物。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>rollbackJta()</td>
            <td>回滚JTA事物。</td>
        </tr>
    </tbody>
</table>

<p>在启用事物前，可以为事物设置超时时间、隔离级别等。首先实例化一个<code>org.rex.db.transaction.DefaultDefinition</code>对象，并在调用开启事物方法时将其作为参数，详情请见类<a href="#user-content-class-defaultDefinition">DefaultDefinition</a>。</p>

<p>需要注意的是，在使用Rexdb事物接口时，需要遵循<code>try...catch...</code>的写法，以防事物开启后未被提交或回滚。</p>

<p>例如，以下代码启用了事物：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-c1">DB</span><span class="pl-k">.</span>beginTransaction();
<span class="pl-k">try</span>{
    <span class="pl-c1">DB</span><span class="pl-k">.</span>update(<span class="pl-s"><span class="pl-pds">"</span>DELETE FROM REX_TEST<span class="pl-pds">"</span></span>);
    <span class="pl-c1">DB</span><span class="pl-k">.</span>update(<span class="pl-s"><span class="pl-pds">"</span>INSERT INTO REX_TEST(ID, NAME, CREATE_TIME) VALUES (?, ?, ?)<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Ps</span>(<span class="pl-c1">1</span>, <span class="pl-s"><span class="pl-pds">"</span>test<span class="pl-pds">"</span></span>, <span class="pl-k">new</span> <span class="pl-smi">Date</span>()));
    <span class="pl-c1">DB</span><span class="pl-k">.</span>commit();
}<span class="pl-k">catch</span>(<span class="pl-smi">Exception</span> e){<span class="pl-c">//一般来说，应捕获Exception异常，以防程序抛出预期外的异常，导致事物未被回滚</span>
    <span class="pl-c1">DB</span><span class="pl-k">.</span>rollback();
}</pre></div>

<p>如果要设置事物的超时时间和隔离级别，可以使用如下代码：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-smi">DefaultDefinition</span> definition <span class="pl-k">=</span> <span class="pl-k">new</span> <span class="pl-smi">DefaultDefinition</span>();
definition<span class="pl-k">.</span>setTimeout(<span class="pl-c1">10</span>);                                                  <span class="pl-c">//设置事物超时时间为10秒</span>
definition<span class="pl-k">.</span>setIsolationLevel(<span class="pl-smi">DefaultDefinition</span><span class="pl-c1"><span class="pl-k">.</span>ISOLATION_READ_COMMITTED</span>);   <span class="pl-c">//设置事物的隔离级别为"READ_COMMITTED"</span>
<span class="pl-c1">DB</span><span class="pl-k">.</span>beginTransaction(definition);</pre></div>

<h2><div id="user-content-express">扩展</div></h2>

<h3><div id="user-content-express-listener">监听</div></h3>

<p>可以通过配置监听程序，实现SQL、事物执行事件的捕获。Rexdb已经内置了以下监听类（详情请查看<a href="#user-content-config-listener">全局配置文件-监听</a>）：</p>

<table>
    <thead>
        <tr>
            <th width="300">监听类</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>org.rex.db.listener.impl.SqlDebugListener</code></td>
            <td>使用日志包输出SQL和事物执行信息。</td>
        </tr>
        <tr>
            <td><code>org.rex.db.listener.impl.SqlConsolePrinterListener</code></td>
            <td>将SQL和事物执行信息输出到终端。</td>
        </tr>
    </tbody>
</table>

<p>当需要实现一个新的监听时，首先编写监听程序，实现<a href="#user-content-class-listener">接口org.rex.db.listener.DBListener</a>。例如，如果希望打印出执行时间超过10秒的所有SQL语句，则可以编写如下监听类：</p>

<div class="highlight highlight-source-java"><pre><span class="pl-k">package</span> <span class="pl-smi">test</span>;

<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.listener.DBListener</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.listener.SqlContext</span>;
<span class="pl-k">import</span> <span class="pl-smi">org.rex.db.listener.TransactionContext</span>;

<span class="pl-k">public</span> <span class="pl-k">class</span> <span class="pl-en">CustomListener</span> <span class="pl-k">implements</span> <span class="pl-e">DBListener</span>{
    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">onExecute</span>(<span class="pl-smi">SqlContext</span> <span class="pl-v">context</span>) {
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">afterExecute</span>(<span class="pl-smi">SqlContext</span> <span class="pl-v">context</span>, <span class="pl-smi">Object</span> <span class="pl-v">results</span>) {
        <span class="pl-k">long</span> costs <span class="pl-k">=</span> <span class="pl-smi">System</span><span class="pl-k">.</span>currentTimeMillis() <span class="pl-k">-</span> context<span class="pl-k">.</span>getCreateTime()<span class="pl-k">.</span>getTime();
        <span class="pl-k">if</span>(costs <span class="pl-k">&gt;</span> <span class="pl-c1">10000</span>){                                  <span class="pl-c">//当执行时间超过10秒时</span>
            <span class="pl-k">String</span>[] sql <span class="pl-k">=</span> context<span class="pl-k">.</span>getSql();                <span class="pl-c">//获取已经执行的SQL</span>
            <span class="pl-smi">Object</span> parameters <span class="pl-k">=</span> context<span class="pl-k">.</span>getParameters();    <span class="pl-c">//获取预编译参数</span>
            <span class="pl-smi">System</span><span class="pl-k">.</span>out<span class="pl-k">.</span>println(<span class="pl-s"><span class="pl-pds">"</span>more than 10s: <span class="pl-pds">"</span></span> <span class="pl-k">+</span> sql[<span class="pl-c1">0</span>] <span class="pl-k">+</span> <span class="pl-s"><span class="pl-pds">"</span> : <span class="pl-pds">"</span></span> <span class="pl-k">+</span> parameters);
        }
    }

    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">onTransaction</span>(<span class="pl-smi">TransactionContext</span> <span class="pl-v">context</span>) {
    }
    <span class="pl-k">public</span> <span class="pl-k">void</span> <span class="pl-en">afterTransaction</span>(<span class="pl-smi">TransactionContext</span> <span class="pl-v">context</span>) {
    }
}</pre></div>

<p>然后将将该监听类加入到全局配置文件即可：</p>

<div class="highlight highlight-text-xml"><pre>&lt;<span class="pl-ent">listener</span> <span class="pl-e">class</span>=<span class="pl-s"><span class="pl-pds">"</span>test.CustomListener<span class="pl-pds">"</span></span> /&gt;</pre></div>

<h3><div id="user-content-express-dialect">方言</div></h3>

<p>Rexdb支持数据库方言功能，用于支持自动的分页查询等功能。已经内置的方言有：</p>

<table>
    <thead>
        <tr>
            <th width="120">数据库</th>
            <th width="">方言实现类</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>DB2</td>
            <td><code>org.rex.db.dialect.impl.DB2Dialect</code></td>
        </tr>
        <tr>
            <td>Derby</td>
            <td><code>org.rex.db.dialect.impl.DerbyDialect</code></td>
        </tr>
        <tr>
            <td>DM</td>
            <td><code>org.rex.db.dialect.impl.DMDialect</code></td>
        </tr>
        <tr>
            <td>H2</td>
            <td><code>org.rex.db.dialect.impl.H2Dialect</code></td>
        </tr>
        <tr>
            <td>HSQL</td>
            <td><code>org.rex.db.dialect.impl.HSQLDialect</code></td>
        </tr>
        <tr>
            <td>MySQL</td>
            <td><code>org.rex.db.dialect.impl.MySQLDialect</code></td>
        </tr>
        <tr>
            <td>Oracle</td>
            <td>
                <code>org.rex.db.dialect.impl.Oracle8iDialect</code><br>
                <code>org.rex.db.dialect.impl.Oracle9iDialect</code>
            </td>
        </tr>
        <tr>
            <td>PostgreSQL</td>
            <td><code>org.rex.db.dialect.impl.PostgreSQLDialect</code></td>
        </tr>
        <tr>
            <td>SQLServer</td>
            <td>
                <code>org.rex.db.dialect.impl.SQLServerDialect</code><br>
                <code>org.rex.db.dialect.impl.SQLServer2005Dialect</code>
            </td>
        </tr>
    </tbody>
</table>

<p>Rexdb会根据数据库的类型和版本选择合适的方言。如果您使用的数据库不在列表中，可以编写一个实现<a href="#user-content-class-dialect">接口org.rex.db.dialect.Dialect</a>的方言类，并将其增加到<a href="#user-content-config-datasource">全局配置文件-数据源</a>中。</p>

<h3><div id="user-content-express-logger">日志</div></h3>

<p>Rexdb支持如下日志包：</p>

<table>
    <thead>
        <tr>
            <th width="80">顺序号</th>
            <th width="120">日志</th>
            <th width="">官方网址</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>log4j-1.x</td>
            <td>
                <a href="http://logging.apache.org/log4j">http://logging.apache.org/log4j</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>slf4j</td>
            <td>
                <a href="http://www.slf4j.org/">http://www.slf4j.org/</a>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>log4j-2.x</td>
            <td>
                <a href="http://logging.apache.org/log4j">http://logging.apache.org/log4j</a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>JDK Logger</td>
            <td>
                -
            </td>
        </tr>
    </tbody>
</table>

<p>当Rexdb在加载类时，会按照上面的顺序检测日志支持环境，并使用首个可用的日志接口。如果希望禁用日志，可以在<a href="#user-content-config-settings">全局配置文件-全局设置</a>中将<code>nolog</code>属性设置为<code>true</code>。</p>

<h3><div id="user-content-express-dynamic">动态字节码</div></h3>

<p>Rexdb支持jboss javassist（官方网址：<a href="http://jboss-javassist.github.io/javassist/">http://jboss-javassist.github.io/javassist/</a>）的动态字节码功能。当<a href="#user-content-config-settings">全局配置文件-全局设置</a>中的<code>dynamicClass</code>属性为<code>true</code>，且检测到javassist环境可用时，Rexdb框架将会启动动态字节码功能。</p>

<p>启用动态字节码后，在查询指定类型的<code>Java对象</code>系列接口时将有大幅的性能提升，因此建议开启此扩展功能。</p>

<p>另外，我们注意到，在javassist的官方网站下载的编译包均是基于新版的JDK编译。因此，如果您的JDK运行环境较低，建议下载javassist的源代码，并使用低版本JDK重新编译。同时，我们在Rexdb的下载包中也内置了一个基于JDK1.5编译的新版javassist，您可以根据实际情况选用。</p>

<h2><div id="user-content-class">接口列表</div></h2>

<h3><div id="user-content-class-Configuration">类org.rex.db.configuration.Configuration</div></h3>

<p>该类用于加载Rexdb的全局配置文件，有如下接口：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>loadDefaultConfiguration()</td>
            <td>从<code>classpath</code>中加载名为<b>rexdb.xml</b>的配置文件</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>loadConfigurationFromClasspath(String path)</td>
            <td>从<code>classpath</code>中加载配置文件</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>loadConfigurationFromFileSystem(String path)</td>
            <td>从文件系统中加载配置文件</td>
        </tr>
    </tbody>
</table>

<p>Rexdb只允许加载一次配置文件。配置加载后，不能重新加载，也不能加载其它位置的配置。</p>

<p>需要注意的是，在类加载器加载<code>org.rex.db.configuration.Configuration</code>时，会自动调用<code>loadDefaultConfiguration()</code>方法加载默认配置文件<strong>rexdb.xml</strong>，当该文件不存在时，才能调用接口加载其它位置的配置。</p>

<h3><div id="user-content-class-dialect">接口org.rex.db.dialect.Dialect</div></h3>

<p>该接口用于定义数据库的方言，而数据库方言类用于定义数据库个性化的语句，例如分页查询SQL、测试SQL等。Rexdb在执行分页查询、测试活跃连接等操作时调用数据库方言接口。接口定义如下：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>LimitHandler</code></td>
            <td>getLimitHandler(int rows)</td>
            <td>获取一个分页查询SQL封装类，用于包装带有行数限制的查询。</td>
        </tr>
        <tr>
            <td><code>LimitHandler</code></td>
            <td>getLimitHandler(int offset, int rows)</td>
            <td>获取一个分页查询SQL封装类，用于包装带有偏移数和行数限制的查询。</td>
        </tr>
        <tr>
            <td><code>String</code></td>
            <td>getTestSql()</td>
            <td>获取测试SQL语句，通常用于测试数据库连接的有效性。</td>
        </tr>
        <tr>
            <td><code>String</code></td>
            <td>getName()</td>
            <td>获取数据库名称。例如，oracle数据库方言将返回<code>ORACLE</code>。</td>
        </tr>
    </tbody>
</table>

<p>其中，抽象类<code>org.rex.db.dialect.LimitHandler</code>用于封装分页查询语句。抽象接口接口定义如下：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>String</code></td>
            <td>wrapSql(String sql)</td>
            <td>包装分页查询SQL，分页相关的预编译参数必须设置在其它预编译参数后。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>afterSetParameters(PreparedStatement statement, int parameterCount)</td>
            <td>设置分页相关的预编译参数，这个方法将在设置完其它预编译参数后调用。</td>
        </tr>
    </tbody>
</table>

<h3><div id="user-content-class-listener">接口org.rex.db.listener.DBListener</div></h3>

<p>该接口用于定义一个数据库监听类，可以用于监听SQL执行、事物的启用、提交等事件。接口如下：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>void</code></td>
            <td>onExecute(SqlContext context)</td>
            <td>SQL执行前调用该方法。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>afterExecute(SqlContext context, Object results)</td>
            <td>SQL执行后调用该方法。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>onTransaction(TransactionContext context)</td>
            <td>开始事物前调用该方法。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>afterTransaction(TransactionContext context)</td>
            <td>提交、回滚事物后调用该方法。</td>
        </tr>
    </tbody>
</table>

<p>其中，类<code>org.rex.db.listener.SqlContext</code>中存放了与SQL执行相关的参数，常量和接口如下：</p>

<blockquote>
<p>类<code>org.rex.db.listener.SqlContext</code>的常量</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">类型</th>
            <th width="200">常量名称</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>SQL_QUERY</td>
            <td>表示当前执行的是查询。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>SQL_UPDATE</td>
            <td>表示当前执行的是更新。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>SQL_BATCH_UPDATE</td>
            <td>表示当前执行的是批处理。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>SQL_CALL</td>
            <td>表示当前执行的是调用。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>类<code>org.rex.db.listener.SqlContext</code>的方法</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>String</code></td>
            <td>getContextId()</td>
            <td>获取唯一的SQL上下文编号。这个参数可以用于区分属于一次执行的多个事件。</td>
        </tr>
        <tr>
            <td><code>Date</code></td>
            <td>getCreateTime()</td>
            <td>获取当前上下文实例的创建时间。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>getSqlType()</td>
            <td>获取执行类型。返回值是常量<code>SQL_QUERY</code>、<code>SQL_UPDATE</code>、<code>SQL_BATCH_UPDATE</code>、<code>SQL_CALL</code>中的一种。</td>
        </tr>
        <tr>
            <td><code>boolean</code></td>
            <td>isBetweenTransaction()</td>
            <td>当前数据库操作是否在事物中。</td>
        </tr>
        <tr>
            <td><code>DataSource</code></td>
            <td>getDataSource()</td>
            <td>获取当前操作所在的数据源。</td>
        </tr>
        <tr>
            <td><code>String[]</code></td>
            <td>getSql()</td>
            <td>获取SQL。当执行一条SQL语句时，返回的数组元素个数为1。</td>
        </tr>
        <tr>
            <td><code>Object</code></td>
            <td>getParameters()</td>
            <td>获取执行SQL的参数（不包括分页查询的偏移、行数参数）。</td>
        </tr>
        <tr>
            <td><code>LimitHandler</code></td>
            <td>getLimitHandler()</td>
            <td>获取当前查询的分页对象。如果当前执行的不是分页查询，返回<code>null</code>。</td>
        </tr>
    </tbody>
</table>

<p>类<code>org.rex.db.listener.TransactionContext</code>中包含了与事物相关的参数，常量和方法如下：</p>

<blockquote>
<p>类<code>org.rex.db.listener.TransactionContext</code>的常量</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">类型</th>
            <th width="200">常量名称</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>TRANSACTION_BEGIN</td>
            <td>当前事件为开始事务。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>TRANSACTION_COMMIT</td>
            <td>当前事件为提交事物。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>TRANSACTION_ROLLBACK</td>
            <td>当前事件为回滚事物。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>类<code>org.rex.db.listener.TransactionContext</code>的方法</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>String</code></td>
            <td>getContextId()</td>
            <td>获取唯一的上下文编号。这个参数可以用于区分属于一次事物执行的多个事件。</td>
        </tr>
        <tr>
            <td><code>Date</code></td>
            <td>getCreateTime()</td>
            <td>获取当前上下文实例的创建时间。</td>
        </tr>
        <tr>
            <td><code>Definition</code></td>
            <td>getDefinition()</td>
            <td>获取事务设置。仅在启用事务时有值，提交、回滚事务时该方法将返回<code>null</code>。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>getEvent()</td>
            <td>获取事务事件类型。值为常量<code>TRANSACTION_BEGIN</code>、<code>TRANSACTION_COMMIT</code>、<code>TRANSACTION_ROLLBACK</code>中的一种。</td>
        </tr>
    </tbody>
</table>

<h3><div id="user-content-class-ps">类org.rex.db.Ps</div></h3>

<p>类<code>org.rex.db.Ps</code>用于封装预编译参数，它可以设置执行SQL时的输入、输出和输入输出参数。与<code>数组</code>相比，提供了更多实用的接口，大致可分为如下几类：</p>

<ul>
<li>类中定义的常量</li>
<li>构造函数</li>
<li>设置预编译输入参数</li>
<li>声明输出参数</li>
<li>声明输入输出参数</li>
<li>声明返回值映射类</li>
<li><p>其它方法</p></li>
<li><p>该类中定义的常量有：</p></li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">类型</th>
            <th width="200">常量名称</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>String</code></td>
            <td>CALL_OUT_DEFAULT_PREFIX</td>
            <td>
<code>DB.call(...)</code>系列接口的返回值中，输出参数的前缀。</td>
        </tr>
        <tr>
            <td><code>String</code></td>
            <td>CALL_RETURN_DEFAULT_PREFIX</td>
            <td>
<code>DB.call(...)</code>系列接口的返回值中，返回值的前缀。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>构造函数有：</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="200">构造函数</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>public Ps()</code></td>
            <td>初始化一个空的Ps对象。</td>
        </tr>
        <tr>
            <td><code>public Ps(Object... parameters)</code></td>
            <td>初始化一个Ps对象，并按照参数顺序设置预编译参数。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>设置预编译输入参数</li>
</ul>

<blockquote>
<p>按顺序设置预编译参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>add(Object value)</td>
            <td>增加一个预编译参数,SQL类型将根据<code>value</code>的Java类型自动匹配。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(int index, Object value, int sqlType)</td>
            <td>增加一个预编译参数，并指定SQL类型。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addNull()</td>
            <td>增加一个值为<code>null</code>的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(String value)</td>
            <td>增加一个String类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(boolean value)</td>
            <td>增加一个<code>boolean</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(BigDecimal value)</td>
            <td>增加一个<code>BigDecimal</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(int value)</td>
            <td>增加一个<code>int</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(long value)</td>
            <td>增加一个<code>long</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(double value)</td>
            <td>增加一个<code>double</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(float value)</td>
            <td>增加一个<code>float</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(Blob value)</td>
            <td>增加一个<code>Blob</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(Clob value)</td>
            <td>增加一个<code>Clob</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>dd(java.util.Date date)</td>
            <td>增加一个<code>java.util.Date</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(java.sql.Date date)</td>
            <td>增加一个<code>java.sql.Date</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(Time time)</td>
            <td>增加一个<code>Time</code>类型的预编译参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>add(Timestamp time)</td>
            <td>增加一个<code>Timestamp</code>类型的预编译参数。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>设置指定索引的预编译参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Object value)</td>
            <td>在指定索引设置预编译参数。<code>index</code>起始于1，预编译参数的SQL类型将根据<code>value</code>的Java类型自动匹配。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Object value, int sqlType)</td>
            <td>在指定索引设置预编译参数，并指定SQL类型。<code>index</code>起始于1。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setNull(int index)</td>
            <td>在指定索引设置一个值为<code>null</code>的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, String value)</td>
            <td>在指定索引设置一个<code>String</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, boolean value)</td>
            <td>在指定索引设置一个<code>boolean</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, BigDecimal value)</td>
            <td>在指定索引设置一个<code>BigDecimal</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, int value)</td>
            <td>在指定索引设置一个<code>int</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, long value)</td>
            <td>在指定索引设置一个<code>long</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, double value)</td>
            <td>在指定索引设置一个<code>double</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, float value)</td>
            <td>在指定索引设置一个<code>float</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Blob value)</td>
            <td>在指定索引设置一个<code>Blob</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Clob value)</td>
            <td>在指定索引设置一个<code>Clob</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, java.util.Date date)</td>
            <td>在指定索引设置一个<code>java.util.Date</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, java.sql.Date date)</td>
            <td>在指定索引设置一个<code>java.sql.Date</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Time time)</td>
            <td>在指定索引设置一个<code>Time</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>set(int index, Timestamp time)</td>
            <td>在指定索引设置一个<code>Timestamp</code>类型的预编译参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>声明输出参数</li>
</ul>

<blockquote>
<p>按顺序声明输出参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutResultSet(int sqlType)</td>
            <td>声明一个结果集类型的输出参数，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为<code>Map</code>对象。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutResultSet(int sqlType, Class resultClass)</td>
            <td>声明一个结果集类型的输出参数，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为指定类型的Java对象。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutString()</td>
            <td>声明一个<code>String</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBoolean()</td>
            <td>声明一个<code>boolean</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBigDecimal()</td>
            <td>声明一个<code>BigDecimal</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutInt()</td>
            <td>声明一个<code>int</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutLong()</td>
            <td>声明一个<code>long</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutFloat()</td>
            <td>声明一个<code>float</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutDouble()</td>
            <td>声明一个<code>double</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBlob()</td>
            <td>声明一个<code>Blob</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutClob()</td>
            <td>声明一个<code>Clob</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutDate()</td>
            <td>声明一个<code>Date</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutTime()</td>
            <td>声明一个<code>Time</code>类型的输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutTimestamp()</td>
            <td>声明一个<code>Timestamp</code>类型的输出参数。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>按顺序声明输出参数，并为参数设置别名</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutResultSet(String paramName, int sqlType)</td>
            <td>声明一个结果集类型的输出参数，并为参数设置别名。参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为<code>Map</code>对象</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutResultSet(String paramName, int sqlType, Class resultClass)</td>
            <td>声明一个结果集类型的输出参数，并为参数设置别名。参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为指定类型的Java对象。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutString(String paramName)</td>
            <td>声明一个<code>String</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBoolean(String paramName)</td>
            <td>声明一个<code>boolean</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBigDecimal(String paramName)</td>
            <td>声明一个<code>BigDecimal</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutInt(String paramName)</td>
            <td>声明一个<code>int</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutLong(String paramName)</td>
            <td>声明一个<code>long</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutFloat(String paramName)</td>
            <td>声明一个<code>float</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutDouble(String paramName)</td>
            <td>声明一个<code>double</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutBlob(String paramName)</td>
            <td>声明一个<code>Blob</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutClob(String paramName)</td>
            <td>声明一个<code>Clob</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutDate(String paramName)</td>
            <td>声明一个<code>Date</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutTime(String paramName)</td>
            <td>声明一个<code>Time</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addOutTimestamp(String paramName)</td>
            <td>声明一个<code>Timestamp</code>类型的输出参数，并为参数设置别名。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>声明指定索引的输出参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutResultSet(int index, int sqlType)</td>
            <td>在指定索引声明一个结果集类型的输出参数，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为<code>Map</code>对象。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutResultSet(int index, int sqlType, Class resultClass)</td>
            <td>在指定索引声明一个结果集类型的输出参数，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为指定类型的Java对象。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutString(int index)</td>
            <td>在指定索引声明一个<code>String</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBoolean(int index)</td>
            <td>在指定索引声明一个<code>boolean</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBigDecimal(int index)</td>
            <td>在指定索引声明一个<code>BigDecimal</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutInt(int index)</td>
            <td>在指定索引声明一个<code>int</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutLong(int index)</td>
            <td>在指定索引声明一个<code>long</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutFloat(int index)</td>
            <td>在指定索引声明一个<code>float</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutDouble(int index)</td>
            <td>在指定索引声明一个<code>double</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBlob(int index)</td>
            <td>在指定索引声明一个<code>Blob</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutClob(int index)</td>
            <td>在指定索引声明一个<code>Clob</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutDate(int index)</td>
            <td>在指定索引声明一个<code>Date</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutTime(int index)</td>
            <td>在指定索引声明一个<code>Time</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutTimestamp(int index)</td>
            <td>在指定索引声明一个<code>Timestamp</code>类型的输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>声明指定索引的输出参数，并为参数设置别名</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutResultSet(int index, String paramName, int sqlType)</td>
            <td>在指定索引声明一个结果集类型的输出参数，并为参数设置别名，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为<code>Map</code>对象。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutResultSet(int index, String paramName, int sqlType, Class resultClass)</td>
            <td>在指定索引声明一个结果集类型的输出参数，并为参数设置别名，参数<code>sqlType</code>需要设置为JDBC驱动中定义的结果集类型。执行调用后，结果集将被映射为指定类型的Java对象。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutString(int index, String paramName)</td>
            <td>在指定索引声明一个<code>String</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBoolean(int index, String paramName)</td>
            <td>在指定索引声明一个<code>boolean</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBigDecimal(int index, String paramName)</td>
            <td>在指定索引声明一个<code>BigDecimal</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutInt(int index, String paramName)</td>
            <td>在指定索引声明一个<code>int</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutLong(int index, String paramName)</td>
            <td>在指定索引声明一个<code>long</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutFloat(int index, String paramName)</td>
            <td>在指定索引声明一个<code>float</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutDouble(int index, String paramName)</td>
            <td>在指定索引声明一个<code>double</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutBlob(int index, String paramName)</td>
            <td>在指定索引声明一个<code>Blob</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutClob(int index, String paramName)</td>
            <td>在指定索引声明一个<code>Clob</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutDate(int index, String paramName)</td>
            <td>在指定索引声明一个<code>Date</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutTime(int index, String paramName)</td>
            <td>在指定索引声明一个<code>Time</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setOutTimestamp(int index, String paramName)</td>
            <td>在指定索引声明一个<code>Timestamp</code>类型的输出参数，并为参数设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>声明输入输出参数</li>
</ul>

<blockquote>
<p>按顺序声明输入输出参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Object value)</td>
            <td>声明一个输入输出参数。预编译参数的SQL类型将根据<code>value</code>的Java类型自动匹配。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Object value, int type)</td>
            <td>声明一个输入输出参数，并指定SQL类型。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOutNull()</td>
            <td>声明一个<code>null</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String value)</td>
            <td>声明一个<code>String</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(boolean value)</td>
            <td>声明一个<code>boolean</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(BigDecimal value)</td>
            <td>声明一个<code>BigDecimal</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(int value)</td>
            <td>声明一个<code>int</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(long value)</td>
            <td>声明一个<code>long</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(float value)</td>
            <td>声明一个<code>float</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(double value)</td>
            <td>声明一个<code>double</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Blob value)</td>
            <td>声明一个<code>Blob</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Clob value)</td>
            <td>声明一个<code>Clob</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(java.util.Date date)</td>
            <td>声明一个<code>java.util.Date</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(java.sql.Date date)</td>
            <td>声明一个<code>java.sql.Date</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Time time)</td>
            <td>声明一个<code>Time</code>类型的输入输出参数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(Timestamp time)</td>
            <td>声明一个<code>Timestamp</code>类型的输入输出参数。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>按顺序声明输入输出参数，并设置别名</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Object value)</td>
            <td>声明一个输入输出参数，并设置别名。预编译参数的SQL类型将根据<code>value</code>的Java类型自动匹配。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Object value, int type)</td>
            <td>声明一个输入输出参数，并设置别名和SQL类型。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOutNull(String paramName)</td>
            <td>声明一个<code>null</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, String value)</td>
            <td>声明一个<code>String</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, boolean value)</td>
            <td>声明一个<code>boolean</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, BigDecimal value)</td>
            <td>声明一个<code>BigDecimal</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, int value)</td>
            <td>声明一个<code>int</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, long value)</td>
            <td>声明一个<code>long</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, float value)</td>
            <td>声明一个<code>float</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, double value)</td>
            <td>声明一个<code>double</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Blob value)</td>
            <td>声明一个<code>Blob</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Clob value)</td>
            <td>声明一个<code>Clob</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, java.util.Date date)</td>
            <td>声明一个<code>java.util.Date</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, java.sql.Date date)</td>
            <td>声明一个<code>java.sql.Date</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Time time)</td>
            <td>声明一个<code>Time</code>类型的输入输出参数，并设置别名。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>addInOut(String paramName, Timestamp time)</td>
            <td>声明一个<code>Timestamp</code>类型的输入输出参数，并设置别名。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>声明指定索引的输入输出参数</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Object value)</td>
            <td>在指定索引声明一个输入输出参数，预编译参数的SQL类型将根据<code>value</code>的Java类型自动匹配。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Object value, int type)</td>
            <td>在指定索引声明一个输入输出参数，并指定SQL类型。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOutNull(int index)</td>
            <td>在指定索引声明一个<code>null</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String value)</td>
            <td>在指定索引声明一个<code>String</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, boolean value)</td>
            <td>在指定索引声明一个<code>boolean</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, BigDecimal value)</td>
            <td>在指定索引声明一个<code>BigDecimal</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, int value)</td>
            <td>在指定索引声明一个<code>int</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, long value)</td>
            <td>在指定索引声明一个<code>long</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, float value)</td>
            <td>在指定索引声明一个<code>float</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, double value)</td>
            <td>在指定索引声明一个<code>double</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Blob value)</td>
            <td>在指定索引声明一个<code>Blob</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Clob value)</td>
            <td>在指定索引声明一个<code>Clob</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, java.util.Date date)</td>
            <td>在指定索引声明一个<code>java.util.Date</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, java.sql.Date date)</td>
            <td>在指定索引声明一个<code>java.sql.Date</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Time time)</td>
            <td>在指定索引声明一个<code>Time</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, Timestamp time)</td>
            <td>在指定索引声明一个<code>Timestamp</code>类型的输入输出参数。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
    </tbody>
</table>

<blockquote>
<p>声明指定索引的输入输出参数，并设置别名</p>
</blockquote>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Object value)</td>
            <td>在指定索引声明一个输入输出参数并设置别名，预编译参数的SQL类型将根据<code>value</code>的Java类型自动匹配。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Object value, int type)</td>
            <td>在指定索引声明一个输入输出参数，，并设置别名和SQL类型。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOutNull(int index, String paramName)</td>
            <td>在指定索引声明一个<code>null</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, String value)</td>
            <td>在指定索引声明一个<code>String</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, boolean value)</td>
            <td>在指定索引声明一个<code>boolean</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, BigDecimal value)</td>
            <td>在指定索引声明一个<code>BigDecimal</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, int value)</td>
            <td>在指定索引声明一个<code>int</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, long value)</td>
            <td>在指定索引声明一个<code>long</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, float value)</td>
            <td>在指定索引声明一个<code>float</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, double value)</td>
            <td>在指定索引声明一个<code>double</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Blob value)</td>
            <td>在指定索引声明一个<code>Blob</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Clob value)</td>
            <td>在指定索引声明一个<code>Clob</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, java.util.Date date)</td>
            <td>在指定索引声明一个<code>java.util.Date</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, java.sql.Date date)</td>
            <td>在指定索引声明一个<code>java.sql.Date</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Time time)</td>
            <td>在指定索引声明一个<code>Time</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setInOut(int index, String paramName, Timestamp time)</td>
            <td>在指定索引声明一个<code>Timestamp</code>类型的输入输出参数，并设置别名。<code>index</code>索引不能大于当前已经设置的预编译参数个数。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>声明返回值映射类</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>Ps</code></td>
            <td>addReturnType(Class&lt;?&gt; beanClass)</td>
            <td>设置调用操作返回值的映射类。当调用的函数或存储过程有1个或多个返回值时，可以使用该方法按顺序设置一个返回值的映射类。</td>
        </tr>
        <tr>
            <td><code>Ps</code></td>
            <td>setReturnType(int index, Class&lt;?&gt; resultBeanClass)</td>
            <td>按索引设置调用操作返回值的映射类。当调用的函数或存储过程有1个或多个返回值时，可以使用该方法设置一个返回值的映射类。索引<code>index</code>开始于1.</td>
        </tr>
    </tbody>
</table>

<ul>
<li>其它方法</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>getParameterSize()</td>
            <td>获取已经设置的预编译参数个数。</td>
        </tr>
        <tr>
            <td><code>List&lt;SqlParameter&gt;</code></td>
            <td>getParameters()</td>
            <td>获取已经设置或声明的预编译参数，包括输入、输出和输入输出参数。</td>
        </tr>
        <tr>
            <td><code>List&lt;Class&lt;?&gt;&gt;</code></td>
            <td>getReturnResultTypes()</td>
            <td>获取已经设置的调用操作的返回值映射类。</td>
        </tr>
    </tbody>
</table>

<h3><div id="user-content-class-rmap">类org.rex.RMap</div></h3>

<p>类<code>org.rex.RMap</code>是<code>java.util.HashMap</code>的子类，额外提供了获取指定Java类型值的接口，更便于开发人员使用。类<code>org.rex.DB</code>的<code>getMap(...)</code>、<code>getMapList(...)</code>等方法均返回该类型的对象。接口如下：</p>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>String</code></td>
            <td>getString(String key, boolean emptyAsNull)</td>
            <td>获取<code>String</code>类型的值。当<code>emptyAsNull</code>参数设置为<code>true</code>，且Map条目中的实际值为""时，会返回一个<code>null</code>值。</td>
        </tr>
        <tr>
            <td><code>String</code></td>
            <td>getString(String key)</td>
            <td>获取<code>String</code>类型的值。当<code>Map</code>条目中原有数据类型不是<code>String</code>时，将进行格式转换；原条目为<code>数组</code>时，将返回类似于<code>[值1, 值2, 值3]</code>这样的格式。</td>
        </tr>
        <tr>
            <td><code>boolean</code></td>
            <td>getBoolean(String key)</td>
            <td>获取<code>boolean</code>类型的值。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>getInt(String key)</td>
            <td>获取<code>int</code>类型的值。当<code>Map</code>条目中的值无法转换为<code>int</code>时，将抛出<code>NumberFormatException</code>异常。</td>
        </tr>
        <tr>
            <td><code>long</code></td>
            <td>getLong(String key)</td>
            <td>获取<code>long</code>类型的值。当<code>Map</code>条目中的值无法转换为<code>long</code>时，将抛出<code>NumberFormatException</code>异常。</td>
        </tr>
        <tr>
            <td><code>float</code></td>
            <td>getFloat(String key)</td>
            <td>获取<code>float</code>类型的值。当<code>Map</code>条目中的值无法转换为<code>float</code>时，将抛出<code>NumberFormatException</code>异常。</td>
        </tr>
        <tr>
            <td><code>double</code></td>
            <td>getDouble(String key)</td>
            <td>获取<code>double</code>类型的值。当<code>Map</code>条目中的值无法转换为<code>double</code>时，将抛出<code>NumberFormatException</code>异常。</td>
        </tr>
        <tr>
            <td><code>BigDecimal</code></td>
            <td>getBigDecimal(String key)</td>
            <td>获取<code>BigDecimal</code>类型的值。当<code>Map</code>条目中的值无法转换为<code>BigDecimal</code>时，将抛出<code>NumberFormatException</code>异常。</td>
        </tr>
        <tr>
            <td><code>java.util.Date</code></td>
            <td>getDate(String key)</td>
            <td>获取<code>java.util.Date</code>类型的值。如果<code>Map</code>条目中的值不是<code>Date</code>类型或其子类时，将按照常见的日期格式进行格式化。如果无法匹配格式，将抛出异常。</td>
        </tr>
        <tr>
            <td><code>java.sql.Date</code></td>
            <td>getDateForSql(String key)</td>
            <td>获取<code>java.sql.Date</code>类型的值。如果<code>Map</code>条目中的值不是<code>Date</code>类型或其子类时，将按照常见的日期格式进行格式化。如果无法匹配格式，将抛出异常。</td>
        </tr>
        <tr>
            <td><code>Time</code></td>
            <td>getTime(String key)</td>
            <td>获取<code>java.sql.Time</code>类型的值。如果<code>Map</code>条目中的值不是<code>Date</code>类型或其子类时，将按照常见的日期格式进行格式化。如果无法匹配格式，将抛出异常。</td>
        </tr>
        <tr>
            <td><code>Timestamp</code></td>
            <td>getTimestamp(String key)</td>
            <td>获取<code>java.sql.Timestamp</code>类型的值。如果<code>Map</code>条目中的值不是<code>Date</code>类型或其子类时，将按照常见的日期格式进行格式化。如果无法匹配格式，将抛出异常。</td>
        </tr>
        <tr>
            <td><code>String[]</code></td>
            <td>getStringArray(String key)</td>
            <td>获取<code>String[]</code>类型的值。当<code>Map</code>条目中的值不是<code>String[]</code>类型时，将进行类型转换。</td>
        </tr>
        <tr>
            <td><code>Object</code></td>
            <td>set(K key, V value)</td>
            <td>设置一个值，等同于<code>Map.put(K key, V value)</code>
</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setAll(Map m)</td>
            <td>合并<code>Map</code>对象，等同于<code>Map.putAll(Map m)</code>
</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>addDateFormat(String pattern, String format)</td>
            <td>新增一个日期格式识别表达式。</td>
        </tr>
    </tbody>
</table>

<p>在获取日期类型的值时，Rexdb可以自动识别日期格式的字符串，如果识别成功，将自动进行类型转换。支持的日期格式如下：</p>

<table>
    <thead>
        <tr>
            <th width="150">日期格式</th>
            <th width="">示例</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>yyyy-MM-dd HH-mm-ss</code></td>
            <td><code>2016-02-02 02:02:02, 2016/2/2 2:2:2, 2016年2月2日 2时2分2秒</code></td>
        </tr>
        <tr>
            <td><code>yyyy-MM-dd HH-mm</code></td>
            <td><code>2016-02-02 02:02</code></td>
        </tr>
        <tr>
            <td><code>yyyy-MM-dd HH</code></td>
            <td><code>2016-02-02 02</code></td>
        </tr>
        <tr>
            <td><code>yyyy-MM-dd</code></td>
            <td><code>2016-02-02, 2016年02月02日</code></td>
        </tr>
        <tr>
            <td><code>yyyy-MM</code></td>
            <td><code>2016-02</code></td>
        </tr>
        <tr>
            <td><code>yyyy</code></td>
            <td><code>2016</code></td>
        </tr>
        <tr>
            <td><code>yyyyMMddHHmmss</code></td>
            <td><code>20160202020202</code></td>
        </tr>
        <tr>
            <td><code>yyyyMMddHHmm</code></td>
            <td><code>201602020202</code></td>
        </tr>
        <tr>
            <td><code>yyyyMMddHH</code></td>
            <td><code>2016020202</code></td>
        </tr>
        <tr>
            <td><code>yyyyMMdd</code></td>
            <td><code>20160202</code></td>
        </tr>
        <tr>
            <td><code>yyyyMM</code></td>
            <td><code>201602</code></td>
        </tr>
        <tr>
            <td><code>HH:mm:ss</code></td>
            <td><code>02:02:02</code></td>
        </tr>
        <tr>
            <td><code>HH:mm</code></td>
            <td><code>02:02</code></td>
        </tr>
        <tr>
            <td><code>yy-MM-dd</code></td>
            <td><code>02.02.02</code></td>
        </tr>
        <tr>
            <td><code>dd-MM</code></td>
            <td><code>02.02</code></td>
        </tr>
        <tr>
            <td><code>dd-MM-yyyy</code></td>
            <td><code>02.02.2016</code></td>
        </tr>
        <tr>
            <td>
<code>java.text.DateFormat</code><br>支持的格式</td>
            <td><code>07/10/96 4:5 PM, PDT</code></td>
        </tr>
    </tbody>
</table>

<h3><div id="user-content-class-defaultDefinition">类org.rex.db.transaction.DefaultDefinition</div></h3>

<p>类<code>org.rex.db.transaction.DefaultDefinition</code>用于设置事物选项。</p>

<ul>
<li>该类声明了如下常量：</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">类型</th>
            <th width="200">常量</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td><code>ISOLATION_DEFAULT</code></td>
            <td>默认事物的隔离级别。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td><code>ISOLATION_READ_UNCOMMITTED</code></td>
            <td>指示防止发生脏读的常量；不可重复读和虚读有可能发生。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td><code>ISOLATION_READ_COMMITTED</code></td>
            <td>指示可以发生脏读 (dirty read)、不可重复读和虚读 (phantom read) 的常量。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td><code>ISOLATION_REPEATABLE_READ</code></td>
            <td>指示防止发生脏读和不可重复读的常量；虚读有可能发生。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td><code>ISOLATION_SERIALIZABLE</code></td>
            <td> 指示防止发生脏读、不可重复读和虚读的常量。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td><code>TIMEOUT_DEFAULT</code></td>
            <td>默认的超时时间。</td>
        </tr>
    </tbody>
</table>

<ul>
<li>该类有如下接口：</li>
</ul>

<table>
    <thead>
        <tr>
            <th width="80">返回值</th>
            <th width="300">接口</th>
            <th width="">说明</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><code>int</code></td>
            <td>getIsolationLevel()</td>
            <td>获取事物的隔离级别。返回的值是类中以<code>ISOLATION_</code>开头的常量之一。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>getTimeout()</td>
            <td>获取事物超时时间。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>isReadOnly()</td>
            <td>是否是只读事务。</td>
        </tr>
        <tr>
            <td><code>int</code></td>
            <td>isAutoRollback()</td>
            <td>提交失败时是否自动回滚。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setIsolationLevel(String isolationLevelName)</td>
            <td>设置事物的隔离级别名称。参数<code>isolationLevelName</code>是类中以<code>ISOLATION_</code>开头的常量名称之一。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setIsolationLevel(int isolationLevel)</td>
            <td>设置事物的隔离级别。参数<code>isolationLevelName</code>是类中以<code>ISOLATION_</code>开头的常量之一。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setTimeout(int timeout)</td>
            <td>设置事物超时时间。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setReadOnly(boolean readOnly)</td>
            <td>是否将事物设置为只读。</td>
        </tr>
        <tr>
            <td><code>void</code></td>
            <td>setAutoRollback(boolean autoRollback)</td>
            <td>是否将事物设置为提交失败后自动回滚。</td>
        </tr>
    </tbody>
</table>
