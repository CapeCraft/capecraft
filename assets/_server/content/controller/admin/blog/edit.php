<?php
		//Edit Blog
		if(isset($_POST['edit-blog'])) {		
			
			$id = $_POST['id'];
			
			$title = isset($_POST['title']) ? $_POST['title'] : null;
			if(!isset($title) || empty($title)) {
				$globalScript->setModal("Error", "Please supply a title");
				return;
			}
			
			$content = isset($_POST['blogcontent']) ? $_POST['blogcontent'] : null;
			if(!isset($content) || empty($content)) {
				$globalScript->setModal("Error", "Please supply content");
				return;
			}
			
			$buildArray = array(
				"title" => $title,
				"content" => $content
			);
			
			$database->where('ID', $id)->update('blogposts', $buildArray);
			$globalScript->setModal("Success", "Your blog post has been updated");
			Header("Location: /admin/blog");
		}