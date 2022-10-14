<div onclick="this.remove()"><?php echo display_error(); ?></div>

<?php if (isset($_SESSION['success'])) : ?>
	<div class="error success" onclick="this.remove()">
		<h3>
			<?php
			echo $_SESSION['success'];
			unset($_SESSION['success']);
			?>
		</h3>
	</div>
<?php endif ?>

<?php if (isset($_SESSION['msg'])) : ?>
	<div class="error success" onclick="this.remove()">
		<h3>
			<?php
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
			?>
		</h3>
	</div>
<?php endif ?>
