<!DOCTYPE html>
<html>
<head>
	<!-- Include Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url_for('static', filename='style.css') }}">
	<script
      src="https://kit.fontawesome.com/8a3d976fe3.js"
      crossorigin="anonymous"
    ></script>
	<style>
		/* Custom styles for the sidebar */
		.sidebar {
			background-color: #f8f9fa;
			padding: 20px;
		}

		.profile-image {
			width: 120px;
			height: 120px;
			border-radius: 50%;
			object-fit: cover;
		}

		.profile-details {
			margin-top: 20px;
		}

		.profile-details h4 {
			margin-bottom: 10px;
		}

		.profile-details p {
			margin-bottom: 5px;
			color: #6c757d;
		}

		.follow-stats {
			margin-top: 20px;
		}

		.follow-stats p {
			margin-bottom: 5px;
			color: #6c757d;
		}

		.advertisement {
			margin-top: 20px;
			border: 1px solid #ccc;
			padding: 10px;
		}

		.advertisement h5 {
			margin-bottom: 10px;
		}

		.advertisement p {
			color: #6c757d;
		}
		
		.right-sidebar {
			width: 30%;
			float: right;
		}
		
		.uploaded-image {
			max-width: 100%;
			max-height: 100%;
			object-fit: contain;
		}
		
		.image-container {
			margin-bottom: 20px;
		}
		
		.image-actions {
			margin-top: 10px;
		}
		
		.like-btn,
		.comment-btn {
			margin-right: 10px;
		}
		.navbar-brand:hover {
			color: #fff;
		}

		.navbar-nav .nav-link {
			color: #fff;
		}

		.navbar-nav .nav-link:hover {
			color: #fff;
		}

		/* Custom styles for the main content */
		.container-fluid {
			padding: 20px;
		}
		.post-form {
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
		}
		.post {
      border-radius: 5px;
      box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
      padding: 20px;
      background-color: #f8f9fa;
    }

    .post .media {
      margin-bottom: 10px;
    }

    .post .media-body {
      padding-left: 10px;
    }

    .post .media-body h5 {
      margin-bottom: 5px;
      font-size: 1.2rem;
      font-weight: bold;
    }

    .post .media-body p {
      margin-bottom: 0;
    }

    .post .img-preview {
      max-height: 300px;
      object-fit: contain;
    }

    .post .timestamp {
      font-size: 0.8rem;
      color: #888;
    }
	.img-preview {
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
}
.likes-comments-section {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 10px;
}

.like-btn {
  font-size: 20px;
  color: #ff0000; /* You can adjust the color as desired */
  cursor: pointer;
}

.comment-btn {
  font-size: 14px;
  color: #888;
  cursor: pointer;
}

.comment-section {
  display: none; /* Initially hide the comment section */
  margin-top: 10px;
}

.comment-input {
  width: 100%;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  margin-right: 10px;
}

.post-comment-btn {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.comments-list {
  margin-top: 10px;
}

.comments-list p {
  margin-bottom: 5px;
}
.comment-section {
    margin-top: 10px;
  }

  .comment-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 8px;
  }

  .post-comment-btn {
    padding: 8px 16px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .post-comment-btn:hover {
    background-color: #0056b3;
  }

  .comments-list {
    margin-top: 10px;
  }

  .comment-item {
    margin-bottom: 8px;
  }
  .like-btn {
  font-size: 20px;
  color: black;
  cursor: pointer;
}

.like-btn.liked {
  color: red;
}
.comment-count {
  margin-left: 10px;
  font-size: 14px;
  color: #999;
}
.right-sidebar .list-group-item:hover {
  background-color: #f7f7f7;
}
.right-sidebar .list-group-item {
  border: none;
  padding: 10px;
  font-size: 14px;
  transition: background-color 0.3s ease;
}

.right-sidebar .list-group-item a {
  color: #333;
  text-decoration: none;
}
.right-sidebar .list-group-item:hover {
  background-color: #f7f7f7;
}
.navbar {
  position: relative;
}

.form-inline {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.search-container {
  position: relative;
}

.form-control {
  border: none;
  border-radius: 20px;
  box-shadow: none;
  padding: 8px 15px 8px 40px;
  font-size: 14px;
  background-color: #f5f5f5;
  color: #333;
  width: 200px;
  transition: background-color 0.3s ease;
}

.form-control:focus {
  background-color: #ebebeb;
  color: #555;
  outline: none;
}

.search-container:before {
  content: '\f002';
  font-family: 'Font Awesome 5 Free';
  font-weight: 900;
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  font-size: 16px;
}


	</style>
</head>
<body>
	<!-- Toolbar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color: #f29393; padding: 10px;" >
		<a class="navbar-brand" href="#" style="color:black; font-size: 1.5rem; font-weight: bold;">Socially Connected</a>
		<form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" id="search-input" placeholder="Search for a user" aria-label="Search">
      
    </form>
		<!-- User profile dropdown -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<img src="static\images\avatar.png" alt="User Avatar" style="width: 40px; height: 40px; border-radius: 50%;">
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ url_for('index') }}">Logout</a>
				</div>
			</li>
		</ul>
		
	</nav>
	<!-- End Toolbar -->

	<div class="container-fluid">
		<div class="row">
			<!-- Sidebar -->
			<div class="col-md-3 sidebar" style="background-color: #f7f7f7; padding: 20px; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
				<img src="static\images\avatar.png" alt="User Avatar" class="profile-image" style=" width: 100px; height: 100px; border-radius: 50%; margin-bottom: 10px;">
				<div class="profile-details">
					<h4 style="font-size: 20px; margin-bottom: 5px;">John Doe</h4>
					<p style="margin-bottom: 5px; font-size: 14px;">Web Developer</p>
					<p style="margin-bottom: 5px; font-size: 14px;">Location: Chennai, India</p>
					<hr style="margin-top: 20px; margin-bottom: 20px; border: none; border-top: 1px solid #e0e0e0;">
				</div>
				<div class="follow-stats">
						<p style="margin-bottom: 10px;"><a href="{{ url_for('friend_request') }}"><strong>Friend Requests</strong></a></p>
						<hr style="margin-top: 20px; margin-bottom: 20px; border: none; border-top: 1px solid #e0e0e0;">
						<p style="margin-bottom: 10px;"><a href="{{ url_for('get_accepted_requests') }}"><strong>New Connections</strong></a></p>
				</div>
			<div id="advertisementCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">
				<div class="carousel-inner">
					<div class="carousel-item active">
							<div class="advertisement" style="margin-bottom: 20px;">
							<img src="static\images\2.png" alt="Advertisement 1" class="img-fluid" style="width: 100%; height: auto; border-radius: 5px;">
							<div class="advertisement-content">
								<h5 style="font-size: 16px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">Work-Life Balance is Within Reach: Register Today for the Business Conference 2023!</h5>
								<p style="font-size: 14px; margin-bottom: 10px;">Are you tired of the constant struggle to find harmony between your work and personal life? It's time to discover the key to achieving true work-life balance.</p>
							</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="advertisement">
						<img src="static\images\1.png" alt="Advertisement 2" class="img-fluid" style="width: 100%; height: auto; border-radius: 5px;">
						<div class="advertisement-content">
							<h5 style="font-size: 16px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">Master Any Skill, Anytime, Anywhere: Introducing Our Revolutionary Learning App!</h5>
							<p style="font-size: 14px; margin-bottom: 10px;">Are you ready to embark on a journey of knowledge and self-improvement? With our cutting-edge learning app, the power to learn is now at your fingertips. </p>
						</div>
						</div>
					</div>
					<div class="carousel-item">
						<div class="advertisement">
						<img src="static\images\3.png" alt="Advertisement 3" class="img-fluid" style="width: 100%; height: auto; border-radius: 5px;">
						<div class="advertisement-content">
							<h5 style="font-size: 16px; font-weight: bold; margin-top: 10px; margin-bottom: 5px;">Experience Divine Connection: Join Us at the Worship Conference 2023!</h5>
							<p style="font-size: 14px; margin-bottom: 10px;">Calling all worshippers! It's time to gather together and elevate our spirits in the presence of the divine.</p>
						</div>
					</div>
					</div>
					</div>
				</div>
			</div>
			<!-- End Sidebar -->
			
	  <div class="col-md-6">
		<!-- Post Form -->
		<div id="post-form-container" class="relative mt-3">
		  <div class="card">
			<div class="card-body">
			  <h5 class="card-title">What's on your mind?</h5>
			  <form id="post-form" style="padding: 20px; background-color: #f8f9fa; border-radius: 5px; box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);">
				<div class="form-group">
				  <textarea class="form-control" rows="1" name="post-content" placeholder="Write something..." style="resize: none; border: none; box-shadow: none; padding: 10px; font-size: 1rem; margin-bottom: 10px; background-color: #f8f9fa;"></textarea>
				</div>
				<div class="form-group">
				  <label for="post-image" class="font-weight-bold">Upload an image (optional)</label>
				  <div class="custom-file">
            			<input type="file" class="custom-file-input" id="post-image" name="post-image" style="max-width: 100%; max-height: 300px; object-fit: contain;">
            			<label class="custom-file-label" for="post-image">Choose file</label>
          			</div>
					<img id="preview-image" src="#" alt="Selected Image" style="max-width: 100%; max-height: 300px; object-fit: contain; display: none;">
				</div>
				<button type="submit" class="btn btn-primary btn-lg btn-block rounded-pill">Post</button>
			  </form>
			</div>
		  </div>
		</div>

		
  
		<!-- Posted Images -->
		<div id="posted-images-container" class="mt-3" style="margin-top: 20px;"></div>
	
	  </div>
	  <!-- Post Display -->
		<div id="post-display-container" class="mt-3" style="display: none;">
		<div class="card">
			<div class="card-body">
			<div class="post-content"></div>
			<img id="post-image-display" src="#" alt="Posted Image" style="max-width: 100%; max-height: 300px; object-fit: contain; margin-top: 10px; display: none;">
			<div class="likes-comments-section" style="display: none;">
				<span class="like-btn">&#10084;</span>
				<span class="comment-btn">Comment</span>
				<span class="comment-count"></span>
			</div>
			<div class="comment-section" style="display: none;">
				<input type="text" class="comment-input" placeholder="Write a comment...">
				<button class="post-comment-btn">Post</button>
				<div class="comments-list"></div>
			</div>
			</div>
		</div>
		</div>
	  <!-- End Main Content -->
			<!-- Right Sidebar -->
			<div class="col-md-3 right-sidebar">
				<div class="card" style="border: none; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
					<div class="card-body" style="padding: 20px;">
						<h5 class="card-title" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">Trending Posts</h5>
						<ul class="list-group">
							<li class="list-group-item" style="border: none; padding: 10px; font-size: 14px; transition: background-color 0.3s ease;">
								<a href="https://ssnvivid.com/" target ="_blank" style="color: #333; text-decoration: none;">> VIVID 7.0 is ongoing</a>
							</li>
							<li class="list-group-item" style="border: none; padding: 10px; font-size: 14px; transition: background-color 0.3s ease;">>
								<a href="https://forms.gle/1iT1Fggx6ZzsLmnm7" target="_blank">Form for volunteers</a>
							</li>
							<li class="list-group-item" style="border: none; padding: 10px; font-size: 14px; transition: background-color 0.3s ease;">>
								<a href="https://www.ssn.edu.in/college-of-engineering/it-faculty/" target="_blank">IT Department Faculty</a>
							</li>
							<li class="list-group-item" style="border: none; padding: 10px; font-size: 14px; transition: background-color 0.3s ease;">>
								<a href="https://timesofindia.indiatimes.com/topic/ssn-college-of-engineering/news" target="_blank">Check out the latest Times of India news about SSN</a>
							</li>
							<li class="list-group-item" style="border: none; padding: 10px; font-size: 14px; transition: background-color 0.3s ease;">>
								<a href="https://drive.google.com/file/d/1eSxzUd0BjIBnMWIDv1CrrlmDiYyOS3OU/view?usp=sharing" target="_blank">IdenITy Magazine is out now!</a>
							</li>
						</ul>
					</div>
				</div>
				<br>
				<div class="card" style="border: none; box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);">
					<div class="card-body" style="padding: 20px;">
						<h5 class="card-title" style="font-size: 20px; font-weight: bold; margin-bottom: 10px;">Mutual Friends</h5>
						<!-- Mutual Friends Suggestions -->
						<div class="mutual-friends">
							{% set displayed_friends = [] %}
							{% for user in accepted_users %}
							<div class="mutual-friend-card">
								
								<ul class="list-unstyled">
									{% for friend in mutual_friends[user] if friend not in accepted_users and friend not in displayed_friends %}
									{% set mutual_friends_of_friend = [] %}
									
									{% for mf_user, mf_friends in mutual_friends.items() if mf_user != user and friend in mf_friends and mf_user not in accepted_users %}
                            		{% set _ = mutual_friends_of_friend.extend(mf_friends) %}
                            			
                        			{% endfor %}
									<li class="friend-item" style="margin-bottom:10px;"><i class="fa-solid fa-user-friends" style="color: #007bff;"></i> 
									<span class="friend-name" style="font-weight: bold">{{ friend }}</span> 
									<span class="friend-status" style="font-size:10px">(Friend of {{ user }} {% if mutual_friends_of_friend %} | Friends: {{ mutual_friends_of_friend|join(', ') }}{% endif %})</span>
									</li>
									{% set _ = displayed_friends.append(friend) %}
									
									{% endfor %}
								</ul>
							</div>
							{% endfor %}
							<!-- Add more mutual friends here -->
						</div>
					</div>
				</div>
			</div>
			
			<!-- End Right Sidebar -->
		</div>
	</div>

	<!-- Include Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- Custom Script -->
	<script>
		$(document).ready(function() {
  $("#post-form").submit(function(e) {
    e.preventDefault();

    // Get the form content
    var postContent = $("textarea[name='post-content']").val();
    var postImage = $("#post-image")[0].files[0];
	// Check if both caption and image are empty
    if (!postContent && !postImage) {
      return; // Exit the function without posting
    }
    // Create a new post element
    var postElement = $("<div>").addClass("card mt-3 post"); // Add the 'post' class
    var postBody = $("<div>").addClass("card-body");

    var mediaElement = $("<div>").addClass("media");

    var mediaBody = $("<div>").addClass("media-body");
    var username = $("<h5>").addClass("mt-0").text("John Doe").css("font-weight", "bold");
    
    if (postImage) {
      var uploadedImage = $("<img>")
        .addClass("img-fluid img-preview")
        .attr("alt", "Posted Image")
        .css("max-height", "400px");

      // Read the uploaded image as URL
      var reader = new FileReader();
      reader.onload = function(e) {
        uploadedImage.attr("src", e.target.result);
      };
      reader.readAsDataURL(postImage);
	  var caption = $("<p>").text(postContent);
        var timestamp = $("<p>")
          .addClass("timestamp")
          .text("Posted at " + getCurrentTime()); // Add timestamp with current time
        mediaBody.append(username, caption, timestamp, uploadedImage);
        // Append the uploaded image to media body 
	  mediaBody.append(username, uploadedImage, caption, timestamp);
      // Append the uploaded image to media body
      //mediaElement.append(uploadedImage);
	  
    }else {
      // Append only the username to media body
     var caption = $("<p>").text(postContent); 
	 var timestamp = $("<p>")
          .addClass("timestamp")
          .text("Posted at " + getCurrentTime()); // Add timestamp with current time
	  mediaBody.append(username, caption, timestamp);
    }

	
    mediaElement.append(mediaBody);
    postBody.append(mediaElement);
    postElement.append(postBody);

	 // Create likes and comments section
    var likesCommentsSection = $("<div>").addClass("likes-comments-section");

    var likeBtn = $("<span>").addClass("like-btn").html("&#10084;").click(function() {
         if (likeBtn.hasClass("liked")) {
    // Unlike the post
    likeBtn.removeClass("liked");
  } else {
    // Like the post
    likeBtn.addClass("liked");
  }});
    var commentBtn = $("<span>").addClass("comment-btn").text("Comment").click(function() {
        $(this).siblings(".comment-section").toggle();
      });

  // Create the comment section
  var commentSection = $("<div>").addClass("comment-section").hide();
  var commentInput = $("<input>").addClass("comment-input").attr("type", "text").attr("placeholder", "Write a comment...");
  var commentsList = $("<div>").addClass("comments-list");
  var commentCount = $("<span>").addClass("comment-count").text("0 Comments");
  var postCommentBtn = $("<button>").addClass("post-comment-btn").text("Post").click(function() {
          var commentContent = commentInput.val();
          if (commentContent) {
            var commentItem = $("<div>").addClass("comment-item").text(commentContent);
            commentsList.append(commentItem);
            commentInput.val("");
			// Update the comment count
      var currentCount = parseInt(commentCount.text().split(" ")[0]);
      commentCount.text((currentCount + 1) + " Comments");
          }
        });
	
  
likesCommentsSection.append(likeBtn, commentBtn, commentCount, commentSection);


    commentSection.append(commentInput, postCommentBtn, commentsList);
  likesCommentsSection.append(likeBtn, commentBtn, commentSection);

    postBody.append(mediaElement, likesCommentsSection);
    postElement.append(postBody);

    // Prepend the new post to the main content
    $("#posted-images-container").prepend(postElement); // Append to the posted images container

    // Clear the form inputs
    $("textarea[name='post-content']").val("");
    $("#post-image").val("");
	$("#preview-image").attr("src", "").hide();
  });
   // Show the selected image preview
      $("#post-image").change(function() {
        var input = this;
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
            $("#preview-image").attr("src", e.target.result).show();
          };
          reader.readAsDataURL(input.files[0]);
        }
      });
	  // Helper function to get the current time
      function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours();
        var minutes = now.getMinutes();
        var amPm = hours >= 12 ? "PM" : "AM";
        hours = hours % 12 || 12;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        return hours + ":" + minutes + " " + amPm;
      }

});

function searchUser() {
        var input = document.getElementById("search-input").value.toLowerCase();
        var users = document.getElementsByClassName("user-card");

        for (var i = 0; i < users.length; i++) {
            var user = users[i];
            var userTitle = user.getElementsByClassName("user-title")[0];
            var userText = userTitle.textContent.toLowerCase();
            var friendList = user.getElementsByClassName("friend-name");

            if (userText.includes(input)) {
                user.style.display = "";
                for (var j = 0; j < friendList.length; j++) {
                    friendList[j].style.display = "";
                }
            } else {
                user.style.display = "none";
                for (var j = 0; j < friendList.length; j++) {
                    friendList[j].style.display = "none";
                }
            }
        }
    }
	</script>
<!-- Include Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
