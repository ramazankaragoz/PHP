<?php

echo'<div><h1 class="PageTitle">Change Password<h1>
		<form method="post" onsubmit="return passcheck(this);">
		<table>
		<tr>
				<td>
					<label class="loginLabel" >Old Password: </label></td>
					<td><input type="password" name="oldpassword" value="*****" onkeyup="passcheck(this.value)" 
					onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" " /></td>
				</td></tr>
			<tr>
				<td><label class="loginLabel" >New Password: </label></td>
					<td><input type="password" name="newpassword" value="*****" 
					onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" " /></td>
				</td></tr>
				<tr><td>
					<label class="loginLabel">Again: </label></td><td><input type="password" name="againpassword" value="*****"
					onfocus=if(this.value=="*****")this.value="" onblur=if(this.value=="")this.value="*****" />
				</td>
				
				<td>
					<input type="submit" name="change" value="Confirm"/>
				</td>
			</tr>
		</table></form>
		
		</div>';
		
		
		
		if ($_POST['change'])
		{
			$oldpw=$_POST['oldpassword'];
			$newpw=$_POST['newpassword'];
			$againpw=$_POST['againpassword'];
			
			if($newpw != $againpw)
			{
			   echo "passwords do not match";
			}
			
			else if (strlen($newpw) < 6)
			{
			   echo "At least 6 characters";
			}
			
			else
			{	
				
				$oldpwcode = sha1(base64_encode(md5(base64_encode($oldpw))));
				$oldpwcodepass = substr($oldpwcode,5,32);
			
			
				$pwquery=mysql_query("SELECT * FROM users WHERE id='$_SESSION[id]' and password='$oldpwcodepass'");
				
				if(mysql_num_rows($pwquery )> 0)
				{
					$newpwcode = sha1(base64_encode(md5(base64_encode($newpw))));
					$newpwcodepass = substr($newpwcode,5,32);
					
					$againpwcode = sha1(base64_encode(md5(base64_encode($againpw))));
				    $againpwcodepass = substr($againpwcode,5,32);
					
					$updatepw=mysql_query("UPDATE users SET password='$newpwcodepass' WHERE id='$_SESSION[id]'");
					if($updatepw)
					{
						echo "<script>alert('Password successfully updated..!')</script>";
						header("refresh:0;url=index.php?page=profile");
					}
					else
					{
						echo "<script>alert('Your password could not be updated!!!')</script>";
						header("refresh:0;url=index.php?page=profile");
					}
				
				}
				
				else 
				{	
					echo "You have wrong entered your old password!";
				}
			}
			
			
		}

?>