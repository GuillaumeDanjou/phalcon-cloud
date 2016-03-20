{% for index, disque in disques %}
   <h4><span class="glyphicon glyphicon-hdd"></span> {{ disque.nom }} <span class="badge">{{ occupationDisques[index] }} {{ uniteDisques[index] }} / {{ quotaDisques[index] }} {{ uniteDisques[index] }}</span></h4>
    {{ progressBars[index] }}
    <a href="./Scan/index/{{ disque.id }}" class="btn btn-info btn-lg btn-block"><span class="glyphicon glyphicon-folder-open"></span> Ouvrir</a>
{% endfor %}