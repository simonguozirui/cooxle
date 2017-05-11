<html>
	<?php include_once("required/head.php") ?>
	<body>
	<?php include_once("required/nav.php") ?>
		<div class="container">
			<div class="columns">
				<div class="column is-2">
					<aside class="menu">
					  <p class="menu-label">
					    General
					  </p>
					  <ul class="menu-list">
					    <li><a href="#about">About Cooxle</a></li>
					    <li><a href="#features">Features</a></li>
						<li><a href="#team">Team</a></li>
					  </ul>
						<p class="menu-label">
							Legal &amp; Privacy
					 </p>
					 <ul class="menu-list">
						 <li><a href="#privacy">Privacy</a></li>
						 <li><a href="#info">User Information</a></li>
					 </ul>
					 <p class="menu-label">
						 Help
					</p>
					<ul class="menu-list">
						<li><a href="#post">Post issues</a></li>
					</ul>
					  <p class="menu-label">
					    Developer Options
					  </p>
					  <ul class="menu-list">
					    <li><a href="#open-source">Open-Source</a></li>
						<li><a href="#contribute">Contribute</a></li>
					  </ul>
					</aside>
				</div>
				<div class="column">
					<div class="content">
						<h1>General</h1>
						<section>
							<h2 id="about">About</h2>
	  					<p>
	  						Cooxle is a computer science project created by <a href="http://obrien.tech" target="_blank">Nicholas O'Brien</a> and <a href="http://simonguo.tech" target="_blank">Simon Guo</a> for their ICS4U computer science class. It is designed to work like twitter with easy-to-use styling and account systems. It is hosted on <a href="https://github.com/simonguozirui/cooxle">github</a> and under the MIT License.
	  					</p>
						</section>
						<br>
						<section>
							<h2 id="features">Features</h2>
	  					<p>
	  						As said previously, Cooxle is supposed to work like twitter. It has account and posting systems in place to be used as a social media. To post, simply go to the home page and fill in the textboxes. To add a tag, enter your desired tag in the first textbox. Tags are not necessary, but they allow for users to find your post more easily. There is also a search feature. Users can search for posts by other users or for tags.
	  					</p>
						</section>
						<br>
						<section>
							<h2 id="team">Team</h2>
	  					<p>
	  						The Cooxle team is composed of Nicholas O'Brien and Simon Guo. <br><br>
	  						Nick: <br>
	  						I am a UCC student, sailor, rower, and hobby developer. I spend a lot of time on the water and I love making boats go fast. I've been programming for 2 years (as of 2017) and I've had a lot of fun learning different programming languages. <br><br>

	  						Simon:<br>
	  						Sample text
	  					</p>
						</section>

						<h1>Legal & Privacy</h1>
						<section>
							<h2 id="privacy">Privacy</h2>
	  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan, metus ultrices eleifend gravida, nulla nunc varius lectus, nec rutrum justo nibh eu lectus. Ut vulputate semper dui. Fusce erat odio, sollicitudin vel erat vel, interdum mattis neque.</p>
						</section>
						<br>
						<section>
							<h2 id="info">User Information</h2>
	  					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla accumsan, metus ultrices eleifend gravida, nulla nunc varius lectus, nec rutrum justo nibh eu lectus. Ut vulputate semper dui. Fusce erat odio, sollicitudin vel erat vel, interdum mattis neque.</p>
						</section>

						<h1>Developer Option</h1>
						<section>
							<h2 id="open-source">Open-Source</h2>
	  					<p>Licensed under the MIT license. Copyright 2017 Cooxle
								<br />Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
								<br>
								<br />The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
								<br />THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
								<br>
								<br />If you have any questions or concerns, please feel free to contact <a href="mailto:simonguozirui@gmail.com">Simon Zirui Guo</a> or <a href="mailto:nicholas.obrien@ucc.on.ca">Nicholas O’Brien</a>.							
						</p>
						</section>
						<br>
						<section>
							<h2 id="contribute">Contribute</h2>
							<p>You can run Cooxle locally on your development environment. Use <a href="setup.sql" target="_blank">setup.sql</a> to create the database structure cooxle has or copy and execute the code below.</p>
							<pre>
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE `symbols` (
`id` int(11) NOT NULL,
`country` varchar(255) NOT NULL DEFAULT '',
`animal` varchar(255) NOT NULL DEFAULT '',
`username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `users` (
`id` int(11) NOT NULL,
`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
`password` char(64) COLLATE utf8_unicode_ci NOT NULL,
`salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `symbols`
ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
ADD PRIMARY KEY (`id`),
ADD UNIQUE KEY `username` (`username`),
ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `symbols`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;

ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
							</pre>
	  					<p>If you would like to run Cooxle locally, please download our project at our <a href="https://github.com/simonguozirui/cooxle" target="_blank">GitHub repository</a>.
							<br />If you have any suggestions or suggestions about the project, please open an issue or submit a pull request on our <a href="https://github.com/simonguozirui/cooxle" target="_blank">GitHub repository</a>.
							<br />Visit our <a href="https://github.com/simonguozirui/cooxle/wiki" target="_blank" >Github Wiki</a> for more documentation on the project.</p>
						</section>

					</div>
				</div>
			</div>
		</div>
	</body>
</html>
