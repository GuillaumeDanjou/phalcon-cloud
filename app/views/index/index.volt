	<div class="well well-lg">
		<div id="main">
			<fieldset>
				<legend>Interface provisoire de test</legend>
				<a class="btn btn-link" href="Index" data-ajax="Index">Accueil</a>
				<a class="btn btn-default" href="Users" data-ajax="Users">Utilisateurs</a>
				<a class="btn btn-default" href="Services" data-ajax="Services">Services</a>
				<a class="btn btn-default" href="Disques" data-ajax="Disques">Disques</a>
				<a class="btn btn-default" href="Tarifs" data-ajax="Tarifs">Tarifs</a>
				<a class="btn btn-default" href="Historiques" data-ajax="Historiques">Historiques</a>
			</fieldset>
			<fieldset>
				<legend>A implémenter (avec connexion nécessaire)</legend>
				{{ q["btMyDisques"] }}
				{{ q["btScanOne"] }}
				{{ q["btCreateOne"] }}
			</fieldset>
		</div>
		<div id="response"></div>
	</div>
	{{ script_foot }}