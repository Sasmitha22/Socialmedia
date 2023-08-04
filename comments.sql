CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
CREATE TABLE comments (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  image_id INT(11) NOT NULL,
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (image_id) REFERENCES images(id)
);
