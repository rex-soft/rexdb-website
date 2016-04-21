--
--  `feedback_bug`
--

CREATE TABLE `feedback_bug` (
  `id` int(10) NOT NULL,
  `sys` varchar(10) NOT NULL,
  `jdk` varchar(10) NOT NULL,
  `db` varchar(10) NOT NULL,
  `container` varchar(15) DEFAULT NULL,
  `detail` text NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- `feedback_suggest`
--

CREATE TABLE `feedback_suggest` (
  `id` int(10) NOT NULL,
  `detail` text NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback_bug`
--
ALTER TABLE `feedback_bug`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_suggest`
--
ALTER TABLE `feedback_suggest`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT
--

--
-- AUTO_INCREMENT `feedback_bug`
--
ALTER TABLE `feedback_bug`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT `feedback_suggest`
--
ALTER TABLE `feedback_suggest`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
