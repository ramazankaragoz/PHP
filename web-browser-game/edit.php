<html>
<?php

echo	'<div id="EditContent" > 
		<h1 class="PageTitle">Edit</h1>
		
		<div class="EditChar"> 
        <img src="userpictures/'.$_SESSION[userpicurl].'" />
		
		<div class="EditPic">
		
		<form method="post" enctype="multipart/form-data">
		<table>
		<tr>
		<td><input type="file" name="picfile" /></td></tr>
		<tr><td><input type="submit" name="changepic" value="Upload" /></td>
		</tr>
		</table>
		</form>
		</div>
		
		</div>
		</div>';

		if (isset($_POST['changepic']))
		{
			$sourcepic=$_FILES['picfile']['tmp_name'];
			$picname=$_FILES['picfile']['name'];
			$picsize=$_FILES['picfile']['size'];
			$pictype=$_FILES['picfile']['type'];
			list($picwidth,$picheight,$pictypeee)=getimagesize($sourcepic);
			$picext=substr($picname,(strpos($picname,'.')));
			$nwpicname=substr(uniqid(md5(rand())),0,35);
			$newpicname=$nwpicname.$picext;
			$targetpic="userpictures";
			
			if(isset($sourcepic))
			{
				if($pictype != "image/pjpeg" && $pictype != "image/gif" && $pictype !="image/png" && $pictype!="image/xpng" && $pictype!="image/jpeg")
				{
					echo "<script>alert('Please select an image!')</script>";
				}
				else if($picsize>(1000*100))
				{
					echo "<script>alert('Picture size is maximum 100kb !')</script>";
				}
				else if($picwidth > 350 && $picheight > 350 )
				{
					echo "<script>alert('Picture resolution should not be larger than 350x350!!!')</script>";
				}
				else
				{
					if(move_uploaded_file($sourcepic,$targetpic.'/'.$newpicname))
					{
						$picquery = mysql_query( "SELECT * from users WHERE id='".mysql_real_escape_string($_SESSION[id])."'");
						$picresult=mysql_fetch_object($picquery);
						if(mysql_num_rows($picquery) > 0)
						{
							if($_SESSION[userpicurl] == "user.png")
							{
								$addpic=mysql_query("UPDATE users SET userpicurl='$newpicname' WHERE id='{$picresult->id}'");
								
								if($addpic)
								{
									echo "<script>alert('Your picture successfully updated..!')</script>";
									$_SESSION[userpicurl]=$newpicname;
									header("refresh:0;url=index.php?page=profile");
								}
								else
								{
									echo "<script>alert('Your Picture could not be updated!!!')</script>";
									header("refresh:0;url=index.php?page=profile");
								}
							}
							
							else
							{
								$addpic = mysql_query("UPDATE users SET userpicurl='$newpicname' WHERE id='{$picresult->id}'");
								if($addpic)
								{	
									unlink("userpictures/$picresult->userpicurl");
									echo "<script>alert('Your picture successfully updated..!')</script>";
									header("refresh:0;url=index.php?page=profile");
								}
								else
								{
									echo "<script>alert('Your Picture could not be updated!!!')</script>";
									header("refresh:0;url=index.php?page=profile");
								}
							}
						}
						else
						{
							echo "<script>alert('An error has occurred!')</script>";
						}
					}
					else
					{
						echo "<script>alert('Picture is not upload!')</script>";	
					}
				}
			}
			
			else
			{
				echo "<script>alert('Please select the file!')</script>";
			}
		}
		
?>
</html>