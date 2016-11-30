<?php foreach ($messages as $message): ?>
	<!-- htmlentities va me permettre de me protéger contre l'injection de 
		HTML dont script -->
	<!-- Pour les requêtes du chat, j'ai besoin de l'id du dernier message 
	Ici, je fais en sorte que cette information soit portée par tous mes messages
	-->
	<li data-id="<?php echo $message['id']; ?>">
		<span class="avatar"><img src="<?php echo $this->assetUrl('uploads/' . $message['avatar']); ?>" alt=""/></span>
		<span class="personne"><?php echo $this->e($message['pseudo']); ?> : </span>
		<span class="message">"<?php echo $this->e($message['corps']); ?>"</span>
	</li>
<?php endforeach; ?>
