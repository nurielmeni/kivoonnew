<nav id="<?= $name ?>" class="kivoon-nav <?= $cssClass ?>">
	<ul>
		<?php foreach ($items as $item) : ?>
			<li>
				<a href="<?= $item['href'] ?>">
					<div class="bg-bordered-circle">
						<img src="<?= $item['image'] ?>" alt="<?= $item['label'] ?>" width="<?= $size ?>">
					</div>
					<p><?= $item['label'] ?></p>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>