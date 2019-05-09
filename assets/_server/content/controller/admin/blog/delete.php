<?php
		if(isset($_POST['delete_blog'])) {
			$id = $_POST['id'];
			$database->where('ID', $id)->delete('blogposts');
			$globalScript->setModal("Success", "Your blog post has been deleted");
			Header("Location: /admin/blog");
		}