{{ form("Users/update", "method": "post", "name":"frmObject", "id":"frmObject") }}
<fieldset>
<legend>Ajouter/modifier un utilisateur</legend>
<div class="alert alert-info">Utilisateur : {{user}}</div>
<div class="form-group">
	<input type="hidden" name="id" id="id" value="{{user.getId()}}">
	<div class="form-group">
		<input type="text" name="nom" id="nom" value="{{user.getNom()}}" placeholder="Entrez votre nom" class="form-control">
		<input type="text" name="prenom" id="prenom" value="{{user.getPrenom()}}" placeholder="Entrez votre prénom" class="form-control">
		<input type="mail" name="mail" id="mail" value="{{user.getMail()}}" placeholder="Entrez l'adresse email" class="form-control">
	</div>
	<div class="form-group">
		<input type="text" name="login" id="login" value="{{user.getLogin()}}" placeholder="Entrez votre login" class="form-control">
		<input type="password" name="password" id="password" value="{{user.getPassword()}}" placeholder="Entrez le mot de passe" class="form-control">
	</div>
	<div class="form-group">
		<input type="text" name="tel" id="tel" value="{{user.getTel()}}" placeholder="Entrez votre téléphone" class="form-control">
	</div>
	<div class="form-group">
		<label><input type="checkbox" name="admin" id="admin" {{user.getAdmin()?"checked":""}} value="1">Administrateur ?</label>
	</div>
</div>
<div class="form-group">
	<input type="submit" value="Valider" class="btn btn-default validate">
	<a class="btn btn-default cancel" href="{{url.get("Users")}}" data-ajax="{{ baseHref ~ "/index"}}">Annuler</a>
</div>
</fieldset>
</form>
{{ script_foot }}