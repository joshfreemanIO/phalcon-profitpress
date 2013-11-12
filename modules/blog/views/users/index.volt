<?php use Phalcon\Tag as Tag ?>

<?php echo $this->getContent() ?>

<div align="center">

	<h2>Log In</h2>

	<?php echo Tag::form(array('users/login', 'class' => 'form-inline', 'autocomplete' => 'off')) ?>

		<p>
			<label class="control-label" for="login">Username/Email</label><br/>
			<?php echo Tag::textField(array('login', 'size' => "30")) ?>
		</p>

		<p>
			<label class="control-label" for="password">Password</label><br/>
			<?php echo Tag::passwordField(array('password', 'size' => "30")) ?>
		</p>

		<p>
			<?php echo Tag::submitButton(array('Login', 'class' => 'btn btn-primary btn-large')) ?>
		</p>

	</form>
</div>