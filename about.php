<html>
	<!-- Include the constant head file. -->
	<?php include_once("required/head.php") ?>
	<body>
	<!-- Include the constant nav file. -->
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
				<div class="column is-10">
					<div class="content">
						<h1>General</h1>
						<section>
							<h2 id="about">About</h2>
	  					<p>
	  						Cooxle is a twitter-like social media platform with easy-to-use posting and account systems.
								<br />Developed by <a href="http://obrien.tech" target="_blank">Nicholas O'Brien</a> and <a href="http://simonguo.tech" target="_blank">Simon Guo</a> for their ICS4U computer science class.
								<br />It is hosted on <a href="https://github.com/simonguozirui/cooxle">Github</a> and under <a href="#open-source">the MIT License</a>.
	  					</p>
						</section>
						<br>
						<section>
							<h2 id="features">Features</h2>
							<h4>Account System</h4>
							<p>Cooxle let every user to create their user profile which others could view and follow. It includes users' picture, name, number of posts, number of followers, and posts posted by the user.</p>
							<h4>Posting</h4>
							<p>Cooxle allow users to post messages less than 140 characters. To post, simply go to the home page and fill in the textboxes. To add a tag, enter your desired tag in the tag box. Tags are not necessary, but they allow for users to find your post more easily.
							<br />You can view other people's posts in the feed page, and you can like or comment on others' posts.</p>
							<h4>Follower System</h4>
							<p>You can follow other users and read post feeds from them.</p>
							<h4>Search System</h4>
	  					<p>You can search for posts by other users or by tags in the search page.</p>
	  					</p>
						</section>
						<br>
						<section>
							<h2 id="team">Team</h2>
							<div class="container">
							<!--Nick-->
							<div class="columns">
							<div class="column is-one-third">
								<div class="card">
									<div class="card-image">
									  <figure class="image is-1by1">
									    <img src="img/nick.jpg" alt="Image">
									  </figure>
									</div>
									<div class="card-content">
									  <div class="media">
									    <div class="media-content">
									      <p class="title is-4">Nicholas O'Brien</p>
									    </div>
									  </div>

									  <div class="content">
											I am a UCC student, sailor, rower, and hobby developer. I spend a lot of time on the water and I love making boats go fast. I've been programming for 2 years (as of 2017) and I've had a lot of fun learning different programming languages.
											<br><br>
											<a href="http://obrien.tech" target="_blank" class="button is-info is-outlined">Website</a>
											<a href="https://github.com/obrien66" target="_blank" class="button is-dark is-outlined">Github</a>
										</div>
									</div>
								</div>
							</div>
							<!--Simon-->
							<div class="column is-one-third">
								<div class="card">
									<div class="card-image">
									  <figure class="image is-1by1">
									    <img src="img/simon.jpg" alt="Image">
									  </figure>
									</div>
									<div class="card-content">
									  <div class="media">
									    <div class="media-content">
									      <p class="title is-4">Simon Zirui Guo</p>
									    </div>
									  </div>

									  <div class="content">
											I am a 16-years-old high school student from Shanghai, China, currently studying in Toronto, Canada. I am passionate about Internet of Things, robotics, and innovation. Proficient at hardware engineering, embedded system design, and web front-end development.
											<br><br>
											<a href="http://simonguo.tech" target="_blank" class="button is-info is-outlined">Website</a>
											<a href="https://github.com/simonguozirui" target="_blank" class="button is-dark is-outlined">Github</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
						</section>

						<h1>Legal & Privacy</h1>
						<section>
							<h2 id="privacy">Privacy</h2>
	  					<p>We respect users' privacy and we protect our database and platform from cross site scripting. The database is controlled by Simon Zirui Guo and Nicholas O’Brien.</p>
						</section>
						<br>
						<section>
							<h2 id="info">User Information</h2>
	  					<p>Cooxle and it's developers will not record, transfer, or sell user information in the Cooxle database.</p>
						</section>

						<h1>Developer Option</h1>
						<section>
							<h2 id="open-source">Open-Source</h2>
							<pre>
<!-- Include the License. -->
<?php include_once("LICENSE") ?>
							</pre>
	  					<p>If you have any questions or concerns, please feel free to contact <a href="mailto:simonguozirui@gmail.com">Simon Zirui Guo</a> or <a href="mailto:nicholas.obrien@ucc.on.ca">Nicholas O’Brien</a>.</p>
						</section>
						<br>
						<section>
							<h2 id="contribute">Contribute</h2>
							<p>You can run Cooxle locally on your development environment. Use <a href="setup.sql" target="_blank">setup.sql</a> to create the database structure cooxle has or copy and execute the code below.</p>
							<pre>
<!-- Include the sql setup script. -->
<?php include_once("setup.sql") ?>
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
